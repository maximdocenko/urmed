<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ClickController extends Controller {

    public function complete(Request $request) {
        Log::info($request);
        $params = $request;
        $additional_params = [
            "click_trans_id" => $params["click_trans_id"],
            "merchant_trans_id" => $params["merchant_trans_id"],
            "merchant_confirm_id" => null,
        ];
        $secret_key = "YrRGIMclL2H";
        $action = $request["action"];
        $sign_string = $request["sign_string"];
        $click_trans_id = $request["click_trans_id"];
        $service_id = $request["service_id"];
        $merchant_trans_id = $request["merchant_trans_id"];
        $merchant_prepare_id = $request["merchant_prepare_id"];
        $amount = $request["amount"];
        $sign_time = $request["sign_time"];
        $error = $request["error"];

        $order = Order::find($merchant_trans_id);
        $transaction = Order::find($merchant_trans_id);

        $my_hash = md5(
            $request["click_trans_id"] .
            $request["service_id"] .
            $secret_key .
            $request["merchant_trans_id"] .
            $request["merchant_prepare_id"] .
            $request["amount"] .
            $request["action"] .
            $request["sign_time"]
        );

        if ($my_hash != $sign_string) {
            $anser = ["error_note" => "Ошибка проверки подписи", "error" => -1];
            return json_encode($anser);
        }
        if ($transaction->id != $merchant_trans_id) {
            $anser = ["error_note" => "Не найдена транзакция", "error" => -6];
            return json_encode($anser);
        }

        if ($request["error"] == -1) {
            $additional_params["error_note"] = $params["error_note"];
            $anser = [
                "error_note" =>
                    "Транзакция ранее была подтверждена (при попытке подтвердить или отменить ранее подтвержденную транзакцию)",
                "error" => -4,
            ];
            return json_encode($anser);
        }
        if ($params["error"] == -5017) {
            $additional_params["error_note"] = $params["error_note"];
            $transaction->exi = "-1";
            $transaction->update();
            $anser = [
                "error_note" => "Транзакция ранее была отменена",
                "error" => -9,
            ];
            return json_encode($anser);
        }
        if ($transaction->exi == "-1") {
            $anser = [
                "error_note" => "Транзакция ранее была отменена",
                "error" => -9,
            ];
            return json_encode($anser);
        }
        if ($transaction->exi != "1") {
            $anser = [
                "error_note" => "Транзакция ранее была подтверждена",
                "error" => -4,
            ];
            return json_encode($anser);
        }
        if ($transaction->amount != $params["amount"]) {
            $anser = ["error_note" => "Неверная сумма оплаты", "error" => -2];
            return json_encode($anser);
        }

        $transaction->exi = "2";
        $transaction->state = "Оплачено";
        $transaction->update();

        $anser = [
            "error_note" => "Success",
            "error" => 0,
            "click_trans_id" => $request["click_trans_id"],
            "merchant_trans_id" => $request["merchant_trans_id"],
            "merchant_confirm_id" => $transaction->id,
        ];

        $lol =
            "\n" .
            '<b>🤑Оплата прошла.</b><a href="https://fabricio.uz/admin/orders/' .
            $transaction->id .
            '">Посмотреть заказ</a>' .
            "\n\n" .
            "<b>Метод оплаты:</b> " .
            $order->payment_method .
            chr(10) .
            "\n" .
            "<b>Cтоимость:</b> " .
            $order->amount .
            chr(10);

        $data = [
            "chat_id" => "-391411495",
            "text" => $lol,
            "parse_mode" => "html",
        ];

        $token = "394111149:AAGsRUr-ErCkuqE7JY_poC7Sg3dvejIghAY";

        //file_get_contents("https://api.telegram.org/bot$token/sendMessage?" . http_build_query($data));

        return json_encode($anser);
    }

    public function prepare(Request $request) {
        Log::info("prepare");
        Log::info($request);

        $secret_key = "YrRGIMclL2H";
        $action = $request["action"];

        $sign_string = $request["sign_string"];
        $click_trans_id = $request["click_trans_id"];
        $service_id = $request["service_id"];
        $merchant_trans_id = $request["merchant_trans_id"];
        $amount = $request["amount"];
        $sign_time = $request["sign_time"];

        $my_hash = md5(
            $request["click_trans_id"] .
            $request["service_id"] .
            $secret_key .
            $request["merchant_trans_id"] .
            $request["amount"] .
            $request["action"] .
            $request["sign_time"]
        );
        // $amoun = number_format(intval($order->amount)+intval($order->shipping_method_id), 2, '.', '');

        $order = Order::where("id", $merchant_trans_id)->first();

        if (!$order) {
            $anser = [
                "click_trans_id" => $click_trans_id,
                "merchant_trans_id" => $merchant_trans_id,
                "merchant_prepare_id" => $order["amount"],
                "amount" => $order["amount"],
                "error" => -5,
                "error_note" => "User does not exist",
            ];
            return json_encode($anser);
        } else {
            if ($sign_string !== $my_hash) {
                $anser = [
                    "click_trans_id" => $click_trans_id,
                    "merchant_trans_id" => $merchant_trans_id,
                    "merchant_prepare_id" => $order["amount"],
                    "amount" => $order["amount"],
                    "error" => -1,
                    "error_note" =>
                        "SIGN CHECK FAILED!" .
                        $sign_string .
                        "+" .
                        $my_hash .
                        "",
                ];
                return json_encode($anser);
            } else {
                $anser = [
                    "click_trans_id" => $click_trans_id,
                    "merchant_trans_id" => $merchant_trans_id,
                    "merchant_prepare_id" => $order["amount"],
                    "amount" => $order["amount"],
                    "error" => 0,
                    "error_note" => "SUCCESS",
                ];
                return json_encode($anser);
            }
        }
    }
}
