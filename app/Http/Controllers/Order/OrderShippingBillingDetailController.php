<?php

namespace App\Http\Controllers\Order;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Order\CreateOrderShippingBillingDetailRequest;
use App\Http\Services\OrderShippingBillingDetailService;

class OrderShippingBillingDetailController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
    public function store(CreateOrderShippingBillingDetailRequest $request, OrderShippingBillingDetailService $OrderShippingBillingDetailService)
    {
        $OrderShippingBillingDetail = $OrderShippingBillingDetailService->createNewOrderShippingBillingDetail($request->validated());
        return response()->json($OrderShippingBillingDetail, 201);
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