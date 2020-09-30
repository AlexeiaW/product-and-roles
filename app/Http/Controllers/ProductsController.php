<?php

namespace App\Http\Controllers;

use App\Models\Products;
use Illuminate\Http\Request;

class ProductsController extends Controller
{

    /**
     * Instantiate a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('check_user_role:' . \App\Role\UserRole::ROLE_SUBMIT)->only('store');

        $this->middleware('check_user_role:' . \App\Role\UserRole::ROLE_APPROVE)->only('index');
        $this->middleware('check_user_role:' . \App\Role\UserRole::ROLE_APPROVE)->only('update');
        $this->middleware('check_user_role:' . \App\Role\UserRole::ROLE_APPROVE)->only('edit');
        $this->middleware('check_user_role:' . \App\Role\UserRole::ROLE_APPROVE)->only('show');

        $this->middleware('check_user_role:' . \App\Role\UserRole::ROLE_ADMIN)->only('destroy');

        $this->middleware('check_user_role:' . \App\Role\UserRole::ROLE_CLIENT)->only('approvedProducts');
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index(Products $products)
    {
        return $products->all();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create(Request $request)
    {
        // 
    }

    /**
     * Store a newly created resource in storage.
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
     * Display the specified resource.
     *
     * @param  \App\Models\Products  $products
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return Products::find($id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Products  $products
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return Products::find($id);
    }

    /**
     * Update the specified resource in storage.
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
     * Remove the specified resource from storage.
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
        return $products->all();
    }
}