<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Category;
use App\Models\UserCategory;
use App\Models\User;
use App\Models\UserMeta;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Str;

class AccountController extends Controller
{

    public function index() {
        $role = auth()->user()->role;
        $services = [];
        $topics = [];
        if($role == 'doctor') {
            $topics = Category::whereIn("parent_id", [4,5])->get();
            $services = Category::whereIn("parent_id", [81])->get();
        }
        if($role == 'lawyer') {
            $topics = Category::whereIn("parent_id", [43,44])->get();
            $services = Category::whereIn("parent_id", [82])->get();
        }
        return view("account.index", [
            'services' => $services,
            'topics' => $topics,
            'role' => $role
        ]);
    }

    public function update(Request $request) {

        $metas = [
            'start_of_work_year',
            'start_of_work_month',
            'qualification',
            'education',
            'training',
            'place_of_work', //clinic
            'address'
        ];

        $user = User::find(auth()->user()->id);

        if($request->file('image')) {
            $file = $request->file('image');
            $name = str_replace(".png", "", $file->getClientOriginalName());
            $image = Str::random(10).".".$file->getClientOriginalExtension();

            $file->move(public_path('images/ava'), $image);


            $user->photo = $image;
            $user->save();
        }

        if(isset($request->category_id)) {
            UserCategory::where("user_id", $user->id)->delete();
            foreach($request->category_id as $category) {
                UserCategory::create([
                    'category_id' => $category,
                    'user_id' => $user->id,
                ]);
            }
        }

        foreach ($metas as $meta) {

            if($request->$meta) {
                $user_meta = UserMeta::where("user_id", auth()->user()->id)->where("key", $meta)->first();
                if($user_meta) {
                    $user_meta->value = $request->$meta;
                    $user_meta->save();
                }
            }

        }

        return back()->with("success", "Данные успешно обновлены");
    }

    public function payment() {
        return view("account.payment");
    }

    public function pay(Request $request) {
        $amount = $request->amount;
        return Redirect::to("https://checkout.payme.uz/".base64_encode("m=6412e1eb4a0c17825593c444;ac.transaction_id=$payment->id;a=$amount")."");
        return view("success");
    }

    public function edit() {
        return view("account.edit");
    }
}
