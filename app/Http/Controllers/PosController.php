<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\BaseController;
use App\Models\GiftCard;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class PosController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.pos.index', [


            'title' => 'Pos'
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
    public function categoryProducts($id)
    {
        $categoryProducts = DB::table('products')->where('category_id', $id)->get();

        return response()->json($categoryProducts);
    }

    public function order(Request $request)
    {
        // $request->validate([
        // 	'customer_id' => 'required',
        // 	'payBy' => 'required',
        // 	'pay' => [
        // 		$request->payby == 'handCash' ? 'required' : 'nullable',
        // 		'numeric',
        // 		'min:0'
        // 	],
        // 	'due' => 'nullable|numeric|min:0',
        // 	'gift_card_id' => $request->payby == 'giftCard' ? 'required' : 'nullable',
        // 	'qty' => 'required|numeric|min:1'
        // ]);

        try {
            DB::beginTransaction();
            if ($request->gift_card_id) {
                $giftCard = GiftCard::find($request->gift_card_id);
                if (!$giftCard) {
                    return response()->json(
                        [
                            'result' => false
                        ],
                        200
                    );
                }
                $giftBalance = $giftCard->balance;
                $giftCard->balance = $giftBalance >= $request->total ? $giftBalance - $request->total : 0;
                $giftCard->save();
            }
            $data = [];
            $data['customer_id'] = $request->customer_id;
            $data['qty'] = $request->qty;
            $data['sub_total'] = $request->sub_total;
            $data['vat'] = $request->vat;
            $data['total'] = $request->total;
            $data['pay'] = $request->pay;
            $data['due'] = $request->due;
            $data['payBy'] = $request->payBy;
            $data['gift_card_id'] = $request->gift_card_id;
            $data['order_date'] = date('d/m/Y');
            $data['order_month'] = date('F');
            $data['order_year'] = date('Y');
            $data['created_at'] = Carbon::now();
            $data['updated_at'] = Carbon::now();
            $order_id = DB::table('orders')->insertGetId($data);

            $cartContents = DB::table('pos')->get();

            $cartData = [];
            foreach ($cartContents as $content) {
                $cartData['order_id'] = $order_id;
                $cartData['product_id'] = $content->product_id;
                $cartData['product_quantity'] = $content->product_quantity;
                $cartData['product_price'] = $content->product_price;
                $cartData['sub_total'] = $content->sub_total;
                $cartData['created_at'] = Carbon::now();
                $cartData['updated_at'] = Carbon::now();
                DB::table('order_details')->insert($cartData);

                DB::table('products')
                    ->where('id', $content->product_id)
                    ->update(['product_quantity' => DB::raw('product_quantity - ' . $content->product_quantity)]);
            }

            DB::table('pos')->delete();
            DB::commit();
            return response()->json([
                'result' => true
            ], 200);
        } catch (\Exception $ex) {
            DB::rollBack();
            return response()->json([
                'result' => false
            ], 200);
        }
    }

    public function todaySell()
    {
        $todaySell = DB::table('orders')->where('order_date', date('d/m/Y'))->sum('total');
        return response()->json($todaySell);
    }

    public function todayIncome()
    {
        $todayIncome = DB::table('orders')->where('order_date', date('d/m/Y'))->sum('pay');
        return response()->json($todayIncome);
    }

    public function todayDue()
    {
        $todayDue = DB::table('orders')->where('order_date', date('d/m/Y'))->sum('due');
        return response()->json($todayDue);
    }

    public function expenses()
    {
        $expenses = DB::table('expenses')->where('expense_date', date('Y-m-d'))->sum('amount');
        return response()->json($expenses);
    }

    public function stockOut()
    {
        $stockOut = DB::table('products')->where('product_quantity', '<', 1)->get();
        return response()->json($stockOut);
    }
}
