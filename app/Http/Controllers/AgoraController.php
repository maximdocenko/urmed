<?php

namespace App\Http\Controllers;

use App\Models\Call;
use App\Models\Order;
use App\Models\User;
use App\Models\UserCall;
use Illuminate\Http\Request;
use App\Class\RtcTokenBuilder2;
use Illuminate\Support\Str;

class AgoraController extends Controller
{

    public function index() {
        $orders = Call::where('expert_id', auth()->user()->id)->orWhere('user_id', auth()->user()->id)->get();
        return view("account.orders", [
            'orders' => $orders
        ]);
    }

    public function store(Request $request) {

        $expert = User::where("unique_id", $request->expert_id)->first();
        //dd($expert);
        if($expert) {

            Call::create([
                'user_id' => auth()->user()->id,
                'expert_id' => $expert->id,
                'date' => $request->date,
                'time' => $request->time,
                'format' => $request->format,
            ]);

            //dd($expert->phone);

            return redirect(url("success"));

        }

        return "Something went wrong";
    }

    /*
    public function test()
    {

        $appId = "d88b2a459fb54b9c871f37ca55b5bea5";
        $appCertificate = "446e81af9a3e47a9809fe1120fa43965";
        $channelName = "test";
        $uid = null;
        $uidStr = null;
        $seconds = 72600;
        $privilege = 72600;

        echo RtcTokenBuilder2::buildTokenWithUid($appId, $appCertificate, $channelName, $uid, RtcTokenBuilder2::ROLE_PUBLISHER, $seconds, $privilege)."<br>";
        echo RtcTokenBuilder2::buildTokenWithUserAccount($appId, $appCertificate, $channelName, $uidStr, RtcTokenBuilder2::ROLE_PUBLISHER, $seconds, $privilege)."<br>";
        echo RtcTokenBuilder2::buildTokenWithUidAndPrivilege($appId, $appCertificate, $channelName, $uid, $privilege, $privilege, $privilege, $privilege, $privilege)."<br>";
        echo RtcTokenBuilder2::buildTokenWithUserAccountAndPrivilege($appId, $appCertificate, $channelName, $uidStr, $privilege, $privilege, $privilege, $privilege, $privilege)."<br>";

    }
*/

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

            return back();

        }

        return 'There is some error';

    }

    public function user_call(Request $request) {
        UserCall::create([
            'user_id' => auth()->user()->id ?? 0,
            'call_id' => Call::where("channel", $request->call_id)->first()->id ?? 0,
            'time' => 1
        ]);
    }

    public function report($id) {
        $data = Call::find($id);
        return view("account.report", [
            'data' => $data
        ]);
    }

    public function feedback() {
        return view("account.feedback");
    }
}
