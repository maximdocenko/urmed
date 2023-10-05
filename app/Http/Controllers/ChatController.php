<?php

namespace App\Http\Controllers;

use App\Models\Chat;
use App\Models\Order;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ChatController extends Controller
{
    public function index() {
        $users = User::all();

        return view("chat.chat", [
            'users' => $users,
        ]);
    }

    public function room($unique_id) {
        $user = User::where("unique_id", $unique_id)->first();
        $users = User::all();

        $data = Chat::where("unique_user_id", auth()->user()->unique_id)->where("unique_receiver_id", $unique_id)->get();

        return view("chat.room", [
            'user' => $user,
            'users' => $users,
            'data' => $data,
            //'unique_id' => $unique_id
        ]);
    }

    public function message(Request $request) {

        Chat::create([
            'user_id' => auth()->user()->id,
            'room' => $request->room,
            'message' => $request->message,
        ]);

        return 1;
    }

    public function messages(Request $request) {

        $data = Chat::where("room", $request->room)
            ->orderBy('id', 'ASC')
            ->get();

        $html = "";

        foreach ($data as $item) {

            $expert = '
                    <div class="chat-user">
                        <img class="chat-ava" src="'.url("images/user.png").'" alt="">
                        <div class="chat-info">
                            <div class="chat-name">'.$item->id.'</div>
                            <div class="chat-service">Терапевт</div>
                        </div>
                    </div>';

            if($item->user_id == auth()->user()->id) {
                $html .= "<div class='message current'>";
                if(in_array($item->user->role, ['doctor', 'lawyer'])) {
                    $html .= $expert;
                }
                $html .= "<div class='chat-text'>".$item->message."</div>";
                $html .= "</div>";
            }else{
                $html .= "<div class='message'>";
                if(in_array($item->user->role, ['doctor', 'lawyer'])) {
                    $html .= $expert;
                }
                $html .= "<div class='chat-text'>".$item->message."</div>";
                $html .= "</div>";
            }
        }

        return $html;
    }
}
