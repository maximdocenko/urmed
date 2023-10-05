<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view("admin.categories.index", [
            'categories' => Category::where("parent_id", 0)->get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view("admin.categories.create", [
            'categories' => Category::where("parent_id", 0)->get()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        
        $data = Service::where("parent_id", 2)->get();

        foreach($data as $item) {
            Category::create([
                'title' => $item->title,
                'image' => $item->image,
                'parent_id' => 82
            ]);
        }

        return "success";
        

        $request->validate([
           //'title' => 'required',
           //'image' => 'required',
        ]);
        //dd($request->all());
        //dd($request->parent_id);

        if($request->has('image')) {
            //foreach ($request->file('image') as $file) {
                $name = str_replace(".png", "", $request->file("image")->getClientOriginalName());
                $image = Str::random(10).".".$request->file("image")->getClientOriginalExtension();
                $request->file("image")->move(public_path('images/uploads'), $image);
            //}
        }

        Category::create([
            'title' => json_encode(
                [
                    'ru' => $request->title['ru'],
                    'uz' => $request->title['uz'],
                    'en' => $request->title['en'],
                ]
            ),
            'image' => $image ?? null,
            'parent_id' => $request->parent_id ?? 0
        ]);
        
                
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
