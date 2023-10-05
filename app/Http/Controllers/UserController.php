<?php

namespace App\Http\Controllers;

use App\Models\Call;
use App\Models\User;
use App\Models\UserRating;
use Illuminate\Http\Request;
use Psy\Util\Str;

class UserController extends Controller
{

    public function experts($id) {

        $data = User::whereIn('role', ['doctor', 'lawyer'])
            ->whereHas('categories', function($q) use ($id){
                $q->where('category_id', $id);
            })->get();

        return view("experts", [
            'data' => $data
        ]);
    }

    public function expert($unique_id) {
        $item = User::where("unique_id", $unique_id)->first();
        $curDate = strtotime(date("Y-m"));
        $workDate = strtotime(meta($item->meta, "start_of_work_year")."-".meta($item->meta, "start_of_work_month"));
        $exp = $curDate - $workDate;
        return view("expert", [
            'item' => $item,
            'exp' => round($exp / 60 / 60 / 24 / 365, 1)
        ]);
    }

    public function order($unique_id) {
        return view("order", [
            'unique_id' => $unique_id
        ]);
    }

    public function agora(Request $request) {
        if($request->channel) {
            $data = Call::where("channel", $request->channel)->first();
            if(in_array(auth()->user()->role, ['doctor', 'lawyer'])) {
                $unique_id = User::find($data->user_id)->unique_id;
            }
            if(auth()->user()->role == 'user') {
                $unique_id = User::find($data->expert_id)->unique_id;
            }
            return view("agora", [
                'data' => $data,
                'unique_id' => $unique_id,
            ]);
        }
        return view("agora", [
            'data' => [],
            'unique_id' => '',
        ]);
    }

    public function chat() {
        return view("chat");
    }

    public function database() {
        return view("database");
    }

    public function success() {
        return view("success");
    }

    public function rating(Request $request) {
        $request->validate([
            'rate' => 'required',
            'expert_id' => 'required',
        ]);
        $data = UserRating::create([
            'expert_id' => $request->expert_id,
            'user_id' => auth()->user()->id,
            'rate' => $request->rate,
            'comment' => $request->comment,
        ]);
        return back();
    }
}
