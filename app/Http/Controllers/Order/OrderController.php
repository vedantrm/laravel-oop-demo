<?php

namespace App\Http\Controllers\Order;

use App\Http\Controllers\Controller;
use App\Http\Requests\Order\CreateOrderRequest;
use App\Http\Services\OrderService;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class OrderController extends Controller
{   
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request, OrderService $orderService)
    {
        
    }   

    /**
     * Store a newly created resource in storage.
     * @param CreateOrderRequest $request
     * @param OrderService $orderService
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(CreateOrderRequest $request, OrderService $orderService)
    {
        $order = $orderService->createNewOrder($request->validated());
        $message = 'Order created successfully with status '. $order->status;
        return $this->apiResponse($order, Response::HTTP_CREATED, $message);
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
