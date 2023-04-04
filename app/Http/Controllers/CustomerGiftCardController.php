<?php

namespace App\Http\Controllers;

use App\Http\Controllers\BaseController;
use App\Models\CustomerGiftCard;
use App\Models\GiftCard;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CustomerGiftCardController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $IdGiftCardUsed = DB::table('gift_card')
            ->join('customer_gift_card', 'gift_card.id', '=', 'customer_gift_card.gift_card_id')
            ->select('gift_card.*', 'customer_gift_card.gift_card_id as gift_id')
            ->pluck('gift_id');
        //   dd($IdGiftCardUsed->distinct()); 

        $listGiftCardAvailable = GiftCard::whereIn('id', $IdGiftCardUsed)->get();
        // dd($listGiftCardAvailable);
        $giftCards = GiftCard::select('id', 'code as label')->get();
        return view('admin.customer-gift-card.index', [
            'giftCards' => $giftCards,
            'listGiftCardAvailable' => $listGiftCardAvailable,
            'title' => 'Customer Gift Card'
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
        $customerGiftCard = CustomerGiftCard::where('gift_card_id', $id)->first();
        $customerGiftCard->gift_card_id = 0;
        $customerGiftCard->save();
        $customerGiftCard->delete();
    }
    public function addGiftCardId(Request $request, $id)
    {

        $customerGiftCard = new CustomerGiftCard;
        $customerGiftCard->customer_id = $id;
        $customerGiftCard->gift_card_id = $request->id;
        $customerGiftCard->save();
    }   


    public function getListCustomerGift(Request $request, $id)
    {
        $IdsGiftCard = CustomerGiftCard::where('customer_id', $id)->pluck('gift_card_id');
        $customerGiftCard = GiftCard::whereIn('id', $IdsGiftCard)->get();
        return response()->json($customerGiftCard);
    }
}
