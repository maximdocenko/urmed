<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\UserCategory;
use App\Models\User;
use Illuminate\Http\Request;

class DataController extends Controller
{

    public function topics() {
        return response()->json(Category::whereIn("parent_id", [4,5,43,44])->orderBy("title")->get());
    }

    public function topics_doctor() {
        return response()->json(Category::whereIn("parent_id", [4,5])->orderBy("title")->get());
    }

    public function topics_lawyer() {
        return response()->json(Category::whereIn("parent_id", [43,44])->orderBy("title")->get());
    }

    public function services(Request $request) {
        $data = Service::whereIn("parent_id", [81,82])->get();
        if($request->search) {
            $data = Service::whereIn("parent_id", [81])->where("title", "like", "%".$request->search."%")->get();
        }
        return response()->json($data);
    }

    public function services_doctor(Request $request) {
        $data = Category::whereIn("parent_id", [81])->get();
        if($request->search) {
            $data = Service::whereIn("parent_id", [81])->where("title", "like", "%".$request->search."%")->get();
        }
        return response()->json($data);
    }

    public function services_lawyer(Request $request) {
        $data = Category::whereIn("parent_id", [82])->get();
        if($request->search) {
            $data = Service::whereIn("parent_id", [82])->where("title", "like", "%".$request->search."%")->get();
        }
        return response()->json($data);
    }

    public function experts(Request $request) {
        $role = $request->role;
        $type = 'categories';
        $id = $request->id;

        $data = User::where("role", $role)
        ->whereHas($type, function($q) use ($id, $type){
            $q->where("category_id", $id);
        })->with("rating")->orderBy("created_at", "DESC")->get();

        return response()->json($data);
    }

    public function expert(Request $request, $id) {
        $data = \App\Models\User::where('id', $id)->with('meta')->with('rating')->with('categories')->first();

        $start_of_work_year = date("Y");
        $start_of_work_month = date("m");

        $meta = [];

        foreach($data->meta as $key => $value) {
            if($key == 'start_of_work_year') {
                $start_of_work_year = $value;
            }
            if($key == 'start_of_work_month') {
                $start_of_work_month = $value;
            }
            if($value->key != 'start_of_work_year' && $value->key != 'start_of_work_month') {
                $meta[] = $value;
            }
        }

        //dd($meta);

        //$data->meta = $meta;
        //dd($data->meta);

        $exp = strtotime("01"."-".$start_of_work_month."-".$start_of_work_year);
        $exp = time() - $exp;
        $exp = intval($exp / 60 / 60 / 24 / 365);
        if($exp == 0) {
            $exp = 1;
        }

        $services = [];
        $topics = [];
        if($data->role == 'doctor') {
            $topics = Category::whereIn("parent_id", [4,5])->get();
            $services = Category::whereIn("parent_id", [81])->get();
        }
        if($data->role == 'lawyer') {
            $topics = Category::whereIn("parent_id", [43,44])->get();
            $services = Category::whereIn("parent_id", [82])->get();
        }

        return response()->json([
            'data' => $data,
            'meta' => $meta,
            'services' => $services,
            'topics' => $topics,
            'exp' => $exp,
        ]);
    }

}
