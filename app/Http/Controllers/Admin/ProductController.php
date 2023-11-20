<?php

namespace App\Http\Controllers\Admin;

use App\Models\Product;
use App\Http\Controllers\Controller;
use App\Models\Section;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = DB::table('products', 'p')
            ->select('p.*', 'sections.name as NameS')
            ->join('sections', 'p.Bank', '=', 'sections.id')
            ->paginate(COUNTER);
        $sections = DB::table('sections')->select('id', 'name')->get();
        return view('Site.Products.products', compact('products', 'sections'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:products,name|max:20|min:4',
            'Bank' => 'required',
        ]);
        Product::create($request->except('_token'));
        session()->flash('success', __('Created Product'));
        return redirect()->route('products.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        $id = $product->id;
        $request->validate([
            'name' => "required|unique:products,name,$id|max:20|min:4",
            'Bank' => 'required',
        ]);
        $product->update($request->all());
        session()->flash('update', __('Updated Product'));
        return redirect()->route('products.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        //
    }
}
