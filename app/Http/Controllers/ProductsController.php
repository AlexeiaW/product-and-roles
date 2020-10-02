<?php

namespace App\Http\Controllers;

use App\Models\Products;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ProductsController extends Controller
{

    /**
     * Instantiate a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // Set appropriate middleware for each method in this controller based on the 
        // user role
        $this->middleware('check_user_role:' . \App\Role\UserRole::ROLE_SUBMIT)->only('store');

        $this->middleware('check_user_role:' . \App\Role\UserRole::ROLE_APPROVE)->only('index');
        $this->middleware('check_user_role:' . \App\Role\UserRole::ROLE_APPROVE)->only('update');
        $this->middleware('check_user_role:' . \App\Role\UserRole::ROLE_APPROVE)->only('edit');
        $this->middleware('check_user_role:' . \App\Role\UserRole::ROLE_APPROVE)->only('show');

        $this->middleware('check_user_role:' . \App\Role\UserRole::ROLE_ADMIN)->only('destroy');

        $this->middleware('check_user_role:' . \App\Role\UserRole::ROLE_CLIENT)->only('approvedProducts');
    }

    /**
     * Display a listing of the product.
     *
     * @return Response
     */
    public function index(Products $products)
    {
        return $products->all();
    }

    /**
     * Show the form for creating a new product.
     *
     * @return Response
     */
    public function create(Request $request)
    {
        // 
    }

    /**
     * Store a newly created product in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $name = $request->get('name');
        $published = $request->get('published');
        $product = new Products();
        $product->name = $name;
        $product->published = $published;
        $product->save();

        return response('Success', 200);
    }

    /**
     * Display the specified product.
     *
     * @param  \App\Models\Products  $products
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return Products::find($id);
    }

    /**
     * Show the form for editing the specified product.
     *
     * @param  \App\Models\Products  $products
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return Products::find($id);
    }

    /**
     * Update the specified product in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Products  $products
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        $product = Products::find($id);
        $name = $request->get('name');
        $published = $request->get('published');
        $product->name = $name;
        $product->published = $published;
        $product->save();

        return response('Success', 200);
    }

    /**
     * Remove the specified product from storage.
     *
     * @param  \App\Models\Products  $products
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = Products::find($id);
        $product->delete();
    }

    /**
     * Show all approved products.
     *
     * @param  \App\Models\Products  $products
     * @return \Illuminate\Http\Response
     */
    public function approvedProducts(Products $products)
    {
        return $products->where('published', 'LIKE', '%1%')->get();
    }
}
