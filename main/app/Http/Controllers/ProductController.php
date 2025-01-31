<?php

namespace App\Http\Controllers;

use App\Jobs\ProductLiked;
use App\Models\Product;
use App\Models\ProductUser;
use Http;
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
    public function like($id, Request $request)
    {
        $response  = Http::get('http://127.0.0.1:8000/api/user');
        $user =  $response->json();

        try {
            $productuser = ProductUser::create([
                'user_id' => $user['id'],
                'product_id' => $id,
            ]);
            ProductLiked::dispatch($productuser->toArray())->onQueue('admin_queue');
            return response()->json(['message' => 'Product liked successfully'], 200);
        } catch (\Exception $e) {
            return response([
                'error' => 'Product already liked',
            ], Response::HTTP_BAD_REQUEST);
        }
    }
}
