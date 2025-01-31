<?php

namespace App\Http\Controllers;

use App\Jobs\ProductCreated;
use App\Jobs\ProductDeleted;
use App\Jobs\ProductUpdated;
use App\Models\Product;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        return Product::all();
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
        //
        $product = Product::create($request->only('title', 'image'));

        ProductCreated::dispatch($product->toArray())->onQueue('main_queue');;

        return response($product, Response::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     */
    public function show(int $id)
    {
        //
        return Product::find($id);
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
    public function update(Request $request, int $id)
    {
        //
        $product = Product::find($id);
        $product->update($request->only('title', 'image'));

        ProductUpdated::dispatch($product->toArray())->onQueue('main_queue');
        return response($product, Response::HTTP_ACCEPTED);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id)
    {
        //
        Product::destroy($id);

        ProductDeleted::dispatch($id)->onQueue('main_queue');

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
