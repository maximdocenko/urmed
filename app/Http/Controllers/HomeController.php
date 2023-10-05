<?php

namespace App\Http\Controllers;

use App\Models\Call;
use App\Models\Order;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        if(auth()->check()) {
            $orders = Call::where('expert_id', auth()->user()->id)
                ->orWhere('user_id', auth()->user()->id)
                ->get();
            return view("index", [
                'orders' => $orders
            ]);
        }else{
            return view("index", [
                'orders' => []
            ]);
        }
    }

    public function privacy_policy() {
        return view("privacy_policy");
    }

    public function delete_my_account() {
        return view("delete_my_account");
    }
}
