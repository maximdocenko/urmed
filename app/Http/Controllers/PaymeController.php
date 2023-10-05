<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Models\Payment;
//use Log;

class PaymeController extends Controller
{

    protected $merchant_key;

    public function __construct() {
        $this->merchant_id = '';
        $this->merchant_key = '';
    }

    public function payme(Request $request) {

        $data = json_decode(file_get_contents('php://input'), true);

        $headers = getallheaders();

        $encoded_credentials = base64_encode("Paycom:$this->merchant_key");

        if (!$headers || // there is no headers
            !isset($headers['Authorization']) || // there is no Authorization
            !preg_match('/^\s*Basic\s+(\S+)\s*$/i', $headers['Authorization'], $matches) || // invalid Authorization value
            $matches[1] != $encoded_credentials // invalid credentials
        ) {
            return $this->error_authorization($data);
        }

        if($data['method'] == 'CheckPerformTransaction') {
            $order = $this->get_order($data);
            if(!$order) {
                return $this->error_order_id($data);
            }
            $amount = $order->amount;

            if ($amount != $data['params']['amount']) {
                $response = $this->error_amount($data);
            } else {
                $response = [
                    'id' => $data['id'],
                    'result' => [
                        'allow' => true
                    ],
                    "detail" => [
                        "receipt_type" => 0, //тип фискального чека
                        "discount" => [ //скидка, необязательное поле
                            "title" => "Скидка 0%",
                            "price" => $amount
                        ],
                        "shipping" => [ //доставка, необязательное поле
                            "title" => "Доставка до ттз-4 28/23",
                            "price" => $amount
                        ],
                        "items" => [ //товарная позиция, обязательное поле для фискализации
                            [
                                "title" => $order->id, //нааименование товара или услуги
                                "price" => $amount, //цена за единицу товара или услуги, сумма указана в тийинах
                                "count" => 1, //кол-во товаров или услуг
                                "code" => "00702001001000001", // код *ИКПУ обязательное поле
                                "units" => 241092, //значение изменится в зависимости от вида товара
                                "vat_percent" => 0, //обязательное поле, процент уплачиваемого НДС для данного товара или услуги
                                "package_code" => null, //Код упаковки для конкретного товара или услуги, содержится на сайте в деталях найденного ИКПУ.
                                "commission_info" => [
                                    "tin" => "00000000000000"
                                ]
                            ]
                        ]
                    ],
                    'error' => null
                ];
            }

            return json_encode($response);
        }

        if($data['method'] == 'CreateTransaction') {
            $order = $this->get_order($data);
            if(!$order) {
                return $this->error_order_id($data);
            }
            $amount = $order->amount;
            if ($amount != $data['params']['amount']) {
                $response = $this->error_amount($data);
            } else {
                $create_time = $this->current_timestamp();
                $transaction_id = $data['params']['id'];
                $saved_transaction_id = $order->transaction_id;
                if ($order->status == "pending") {
                    $order->create_time = $create_time;
                    $order->transaction_id = $transaction_id;
                    $order->status = 'processing';
                    $order->save();

                    $response = [
                        "id" => $data['id'],
                        "result" => [
                            "create_time" => (double)$order->create_time,
                            "transaction" => (string)$order->id,
                            "state" => 1
                        ]
                    ];
                } elseif ($order->status == "processing" && $transaction_id == $saved_transaction_id) {
                    $response = [
                        "id" => $data['id'],
                        "result" => [
                            "create_time" => (double)$order->create_time,
                            "transaction" => (string)$order->id,
                            "state" => 1
                        ]
                    ];
                } elseif ($order->status == "processing" && $transaction_id !== $saved_transaction_id) {
                    $response = $this->error_has_another_transaction($data);
                } else {
                    $response = $this->error_unknown($data);
                }

            }
            return json_encode($response);
        }

        if($data['method'] == 'PerformTransaction') {
            $perform_time = $this->current_timestamp();
            $order = Payment::where("transaction_id", $data['params']['id'])->first();

            if ($order->status == "processing") { // handle new Perform request
                // Save perform time
                $order->perform_time = $perform_time;

                $response = [
                    "id" => $data['id'],
                    "result" => [
                        "transaction" => (string)$order->id,
                        "perform_time" => (double)$perform_time,
                        "state" => 2
                    ]
                ];

                // Mark order as completed
                $order->status = 'completed';

                $order->save();


            } elseif ($order->status == "completed") { // handle existing Perform request
                $response = [
                    "id" => $data['id'],
                    "result" => [
                        "transaction" => (string)$order->id,
                        "perform_time" => (double)$order->perform_time,
                        "state" => 2
                    ]
                ];
            } elseif ($order->status == "cancelled" || $order->status == "refunded") {
                $response = $this->error_cancelled_transaction($data);
            } else {
                $response = $this->error_unknown($data);
            }

            return json_encode($response);
        }

        if($data['method'] == 'CheckTransaction') {
            $transaction_id = $data['params']['id'];
            $order = Payment::where("transaction_id", $data['params']['id'])->first();

            // Get transaction id from the order
            $saved_transaction_id = $order->transaction_id;

            $response = [
                "id" => $data['id'],
                "result" => [
                    "create_time"  => (double)$order->create_time,
                    "perform_time" => (double)$order->perform_time ? (int)$order->perform_time : 0,
                    "cancel_time"  => (double)$order->cancel_time ? (int)$order->cancel_time : 0,
                    "transaction"  => (string)$order->id,
                    "state"        => null,
                    "reason"       => $order->reason ? (int)$order->reason : null,
                ],
                "error" => null
            ];

            if ($transaction_id == $saved_transaction_id) {

                switch ($order->status) {

					case 'processing': $response['result']['state'] = 1;  break;
                    case 'completed':  $response['result']['state'] = 2;  break;
                    case 'cancelled':  $response['result']['state'] = -1; break;
                    case 'refunded':   $response['result']['state'] = -2; break;

                    default: $response = $this->error_transaction($data); break;
                }
            } else {
                $response = $this->error_transaction($data);
            }

            return json_encode($response);
        }


        if($data['method'] == 'CancelTransaction') {
            $order = $this->get_order_by_transaction($data);

            $transaction_id = $data['params']['id'];
            $saved_transaction_id = $order->transaction_id;

            if ($transaction_id == $saved_transaction_id) {

                $cancel_time = $this->current_timestamp();

                $response = [
                    "id" => $data['id'],
                    "result" => [
                        "transaction" => (string)$order->id,
                        "cancel_time" => $cancel_time,
                        "state" => null
                    ]
                ];

                switch ($order->status) {
                    case 'pending':
                        $order->cancel_time = $cancel_time;
                        $order->status = "cancelled";

                        $response['result']['state'] = -1;

						$order->reason = $data['params']['reason'];
                        $order->save();
                        break;
					case 'processing':
                        $order->cancel_time = $cancel_time;
                        $order->status = "cancelled";

                        $response['result']['state'] = -1;

						$order->reason = $data['params']['reason'];
                        $order->save();
                        break;

                    case 'completed':
                        $order->cancel_time = $cancel_time;
                        $order->status = "refunded";

                        $response['result']['state'] = -2;

						$order->reason = $data['params']['reason'];
                        $order->save();
                        break;

                    case 'cancelled':
                        $response['result']['cancel_time'] = $this->get_cancel_time($order->id);
                        $response['result']['state'] = -1;
                        break;

                    case 'refunded':
                        $response['result']['cancel_time'] = $this->get_cancel_time($order->id);
                        $response['result']['state'] = -2;
                        break;

                    default:
                        $response = $this->error_cancel($data);
                        break;
                }
            } else {
                $response = $this->error_transaction($data);
            }

            return $response;
        }

    }

    public function get_order(array $data) {
        try {
            return Payment::find($data['params']['account']['transaction_id']);
        } catch (Exception $ex) {
            $this->error_order_id($data);
        }
    }

    public function get_order_by_transaction($data) {
        try {
            $prepared = Payment::where("transaction_id", $data['params']['id'])->first();
            return $prepared;
        } catch (Exception $ex) {
            $this->error_transaction($data);
        }
    }

    public function error_amount($data) {
        $response = [
            "error" => [
                "code" => -31001,
                "message" => [
                    "ru" => "Order amount is incorrect",
                    "uz" => "Order amount is incorrect",
                    "en" => "Order amount is incorrect",
                ],
                "data" => "amount"
            ],
            "result" => null,
            "id" => $data['id']
        ];

        return $response;
    }

    public function error_has_another_transaction($data) {
        $response = [
            "error" => [
                "code" => -31099,
                "message" => [
                    "ru" => 'Other transaction for this order is in progress',
                    "uz" => 'Other transaction for this order is in progress',
                    "en" => 'Other transaction for this order is in progress'
                ],
                "data" => "order"
            ],
            "result" => null,
            "id" => $data['id']
        ];

        return $response;
    }

    public function error_unknown($data) {
        $response = [
            "error" => [
                "code" => -31008,
                "message" => [
                    "ru" => 'Unknown error',
                    "uz" => 'Unknown error',
                    "en" => 'Unknown error'
                ],
                "data" => null
            ],
            "result" => null,
            "id" => $data['id']
        ];

        return $response;
    }

    public function error_transaction($data) {
        $response = [
            "error" => [
                "code" => -31003,
                "message" => [
                    "ru" => 'Transaction number is wrong',
                    "uz" => 'Transaction number is wrong',
                    "en" => 'Transaction number is wrong'
                ],
                "data" => "id"
            ],
            "result" => null,
            "id" => $data['id']
        ];

        return $response;
    }

    public function error_cancelled_transaction($data) {
        $response = [
            "error" => [
                "code" => -31008,
                "message" => [
                    "ru" => 'Transaction was cancelled or refunded',
                    "uz" => 'Transaction was cancelled or refunded',
                    "en" => 'Transaction was cancelled or refunded'
                ],
                "data" => "order"
            ],
            "result" => null,
            "id" => $data['id']
        ];

        return $response;
    }

    private function error_authorization($data) {
        $response = [
            "error" =>
                [
                    "code" => -32504,
                    "message" => [
                        "ru" => 'Error during authorization',
                        "uz" => 'Error during authorization',
                        "en" => 'Error during authorization'
                    ],
                    "data" => null
                ],
            "result" => null,
            "id" => $data['id']
        ];

        return $response;
    }

    private function error_order_id($data)
        {
            $response = [
                "error" => [
                    "code" => -31099,
                    "message" => [
                        "ru" => 'Order number cannot be found', 'payme',
                        "uz" => 'Order number cannot be found', 'payme',
                        "en" => 'Order number cannot be found', 'payme'
                    ],
                    "data" => "order"
                ],
                "result" => null,
                "id" => $data['id']
            ];

            return $response;
        }

        private function error_cancel($data)
        {
            $response = [
                "error" => [
                    "code" => -31007,
                    "message" => [
                        "ru" => 'It is impossible to cancel. The order is completed',
                        "uz" => 'It is impossible to cancel. The order is completed',
                        "en" => 'It is impossible to cancel. The order is completed',
                    ],
                    "data" => "order"
                ],
                "result" => null,
                "id" => $data['id']
            ];

            return $response;
        }

        private function get_cancel_time($order)
        {
            return (double)Payment::find($order)->cancel_time;
        }


    public function current_timestamp() {
        return round(microtime(true) * 1000);
    }

}
