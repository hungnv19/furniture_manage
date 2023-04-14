<?php

namespace App\Http\Controllers;

use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        return view('admin.order.index', [
           
            'title' => 'Order'
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
    public function todayOrder()
	{
		$orders = DB::table('orders')
			->join('customers', 'orders.customer_id', 'customers.id')
			->where('orders.order_date', date('d/m/Y'))
			->select('customers.name', 'orders.*')
			->orderBy('orders.id', 'desc')
			->get();
		return response()->json($orders);
	}

	public function orders($id)
	{
		$orders = DB::table('orders')
			->join('customers', 'orders.customer_id', 'customers.id')
			->where('orders.id', $id)
			->select('customers.name', 'customers.phone', 'customers.address', 'orders.*')
			->first();

		return response()->json($orders);
	}

	public function orderDetails($id)
	{
		$details = DB::table('order_details')
			->join('products', 'order_details.product_id', 'products.id')
			->where('order_details.order_id', $id)
			->select('products.product_name', 'products.product_code', 'products.image', 'order_details.*')
			->get();
		return response()->json($details);
	}

	public function searchOrder(Request $request)
	{
		$orderdate = $request->date;
		$newdate = new DateTime($orderdate);
		$done = $newdate->format('d/m/Y');

		$order = DB::table('orders')
			->join('customers', 'orders.customer_id', 'customers.id')
			->select('customers.name', 'orders.*')
			->where('orders.order_date', $done)
			->get();

		return response()->json($orderdate);
	}
}
