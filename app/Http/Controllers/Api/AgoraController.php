<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Api\BaseController as BaseController;
use App\Models\Call;
use App\Models\User;
use App\Models\UserCall;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Class\RtcTokenBuilder2;
use Illuminate\Support\Str;

class AgoraController extends BaseController
{

    public function index(Request $request) {
        $orders = Call::where('expert_id', $request->user_id)
            ->orWhere('user_id', $request->user_id)
            //->with(["user", "expert", "call"])
            ->with(["user", "expert"])
            ->get();
        return $this->sendResponse($orders, 'Order created successfully.');
    }

    public function store(Request $request): JsonResponse
    {
        $data = strtotime($request->date);
        $date = date("Y-m-d", $data);
        $time = date("h:m", $data);
        //return $this->sendResponse([$date, $time], 'Order created successfully.');
        $expert = User::where("id", $request->expert_id)->first();

        if($expert) {

            Call::create([
                'user_id' => $request->user_id,
                'expert_id' => $expert->id,
                'date' => $date,
                'time' => $time,
                'format' => $request->format,
            ]);

            $success = [
                'result' => true
            ];

            return $this->sendResponse($success, 'Order created successfully.');

        }

        return $this->sendError('Some Error.', ['error'=>'Error']);
    }

    public function token(Request $request) {

        if($request->user_id && $request->expert_id) {

            $appId = "d88b2a459fb54b9c871f37ca55b5bea5";
            $appCertificate = "446e81af9a3e47a9809fe1120fa43965";
            $channel = Str::random(8);
            $uid = null;

            $seconds = 72600;
            $privilege = 72600;

            $token = RtcTokenBuilder2::buildTokenWithUid($appId, $appCertificate, $channel, $uid, RtcTokenBuilder2::ROLE_PUBLISHER, $seconds, $privilege);

            $call = Call::find($request->id);

            $call->channel = $channel;
            $call->token = $token;
            $call->status = 1;

            $call->save();

            return response()->json([
                'channel' => $channel,
                'token' => $token,
            ]);

        }

        return 'There is some error';

    }

    public function get_token_by_channel(Request $request) {
        $data = Call::where("channel", $request->channel)->first();
        if($data) {
            return response()->json($data);
        }
        return response()->json([
            'error' => true,
        ]);
    }

    public function user_call(Request $request) {
        if($request->user_id) {
            $user_id = $request->user_id;
        }else{
            $user_id = auth()->user()->id;
        }
        UserCall::create([
            'user_id' => $user_id ?? 0,
            'call_id' => Call::where("channel", $request->call_id)->first()->id ?? 0,
            'time' => 1
        ]);
    }

    public function report($id) {
        $data = Call::where("id", $id)
        //->with(["user", "expert", "call"])
        ->with(["user", "expert"])
        ->first();
        return $this->sendResponse($data, 'Order created successfully.');
    }

    public function feedback() {
        //return view("account.feedback");
    }
}
