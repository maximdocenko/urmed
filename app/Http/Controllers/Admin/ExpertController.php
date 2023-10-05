<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ExpertController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view("admin.experts.index", [
            'experts' => User::whereIn("role", ["doctor", "lawyer"])->get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view("admin.experts.create", [
            //'users' => User::where("parent_id", 0)->get()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
           //'title' => 'required',
           //'image' => 'required',
        ]);

        foreach ($request->file('image') as $file) {
            $name = str_replace(".png", "", $file->getClientOriginalName());
            $image = Str::random(10).".".$file->getClientOriginalExtension();

            Topic::create([
                'title' => json_encode(
                    [
                        'ru' => $name,
                        'uz' => '',
                        'en' => '',
                    ]
                ),
                'image' => $image ?? null,
                'parent_id' => 6
            ]);

            $file->move(public_path('images/uploads'), $image);
        }

        return back()->with("success", "Created successfully");
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
