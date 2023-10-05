<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SMSController extends Controller
{

    public function __construct()
    {
        $this->token = '';
    }

    public function send(Request $request) {
        $curl = curl_init();

        $authorization = "Authorization: Bearer ".$this->token;

        $code = rand(1000, 9999);
        session()->put('sms', $code);

        curl_setopt_array($curl, array(
            CURLOPT_URL => 'notify.eskiz.uz/api/message/sms/send',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => array('mobile_phone' => "998" . str_replace(" ", "", $request->phone),'message' => 'Код авторизации: '.$code,'from' => '4546', 'callback_url' => 'http://0000.uz/test.php'),
            CURLOPT_HTTPHEADER => array( $authorization ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        echo $response;

    }

    public function custom($phone, $message) {
        $curl = curl_init();

        $authorization = "Authorization: Bearer ".$this->token;

        $code = rand(1000, 9999);
        session()->put('sms', $code);

        curl_setopt_array($curl, array(
            CURLOPT_URL => 'notify.eskiz.uz/api/message/sms/send',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => array('mobile_phone' => "998" . $phone,'message' => $message, 'from' => '4546', 'callback_url' => 'http://0000.uz/test.php'),
            CURLOPT_HTTPHEADER => array( $authorization ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        echo $response;

    }

    public function check(Request $request) {
        if($request->code == session()->get("sms")) {
            return true;
        }
        return false;
    }
}
