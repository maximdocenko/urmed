<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TelegramController extends Controller
{

    public function __construct() {
        $this->token = "";
    }

    public function index() {

        $update = file_get_contents('php://input');
        $update = json_decode($update, true);
        $chat_id = $update['message']['chat']['id'];
        $message = $update['message']['text'];

        $keyboard = [
            ['ℹ️ Как пользоваться', '🗄 Личный кабинет'],
            ['👨🏻‍💻 Онлайн консультация'],
            ['💰 Счет', '💳 История оплат'],
            ['🌐 Сайт', '📱 Приложение AVI'],
            ['📰 Что нового', '✉ Написать нам'],
            ['👋 О нас']
        ];

        $text = 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Accusamus aperiam consequatur dicta inventore laudantium molestiae nisi non, officia porro recusandae repellendus sint, temporibus unde. Aliquam earum inventore neque sit unde?';

        //if($message == '/start') {
        $keyboard = [
            ["🇷🇺 Русский", "🇺🇿 O'zbekcha"],
        ];
        $text = "Выберите язык";
        $this->send($chat_id, $text, $keyboard);
        exit();
        //}

        if($message == 'ℹ Как пользоваться') {
            $this->send($chat_id, "<b>Инструкция</b>\n".$text, $keyboard);
            exit();
        }

        if($message == '👋 О нас') {
            $this->send($chat_id, "<b>О нас</b>\n".$text, $keyboard);
            exit();
        }

        if($message == '🌐 Сайт') {
            $this->sendImage($update['message']['chat']['id'], 'https://avi-24.uz', 'logo.png');
            exit();
        }

        if($message == '📱 Приложение AVI') {
            $this->sendImage($update['message']['chat']['id'], 'https://avi-24.uz/appstore', 'app-store.jpeg');
            $this->sendImage($update['message']['chat']['id'], 'https://avi-24.uz/googleplay', 'google-play.png');
            exit();
        }

        if($message == '👨🏻‍💻 Онлайн консультация') {
            $users = file_get_contents("https://avi-24.uz/api/users");

            $users = json_decode($users);
            foreach($users as $user) {
                $txt = urlencode($user->name. "\nЦена:".$user->price." сум \n".$user->rating."⭐️ \n".strip_tags($user->description)." \n");
                file_get_contents("https://api.telegram.org/bot5628338447:AAHc-g0v5I8zQW58k4AIEsE0sWDx_WOBPeE/sendPhoto?chat_id=1529555510&photo=https://avi-24.uz/assets/images/".$user->image."&caption=$txt&parse_mode=html");
            }

            exit();
        }

        $this->send($update['message']['chat']['id'], $text, $keyboard);

        $this->send($chat_id, $message, $keyboard);
    }

    public function send($chat_id, $message, $buttons) {

        $replyMarkup = [
            'keyboard' => $buttons,
            'resize_keyboard' => true
        ];
        $encodedMarkup = json_encode($replyMarkup);
        $content = array(
            'chat_id' => $chat_id,
            'reply_markup' => $encodedMarkup,
            'text' => $message,
            'parse_mode' => 'html'
        );

        file_get_contents("https://api.telegram.org/bot$this->token/sendMessage?" .
            http_build_query($content)
        );
    }

    public function sendImage($chat_id, $caption, $img) {

        $bot_url    = "https://api.telegram.org/bot$this->token";
        $url        = $bot_url . "/sendPhoto?chat_id=" . $chat_id;

        $post_fields = array(
            'chat_id'   => $chat_id,
            'photo'     => new CURLFile(realpath("/home/n/nkrichkc/avi-24.uz/public_html/public/assets/images/logo.png")),
            'caption'   => $caption
        );

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            "Content-Type:multipart/form-data"
        ));
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $post_fields);
        $output = curl_exec($ch);

    }

}
