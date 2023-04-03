<?php

namespace App\Http\Controllers;

use App\Http\Controllers\BaseController;
use App\Models\CustomerGiftCard;
use App\Models\GiftCard;
use Illuminate\Http\Request;

class CustomerGiftCardController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $customerGiftCards = CustomerGiftCard::get();
        return view('admin.customer-gift-card.index', [
            'customerGiftCards' => $customerGiftCards,
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

    public function customerGiftCardList($id){
        $customerGiftCard = CustomerGiftCard::find($id);
        return view('admin.customer-gift-card.updateGiftCard', [
            'customerGiftCard' => $customerGiftCard,
            
        ]);
    }

    public function getListCustomerGift(Request $request, $id)
    {
        $IdsGiftCard = CustomerGiftCard::where('customer_id', $id)->pluck('gift_card_id');
        $customerGiftCard = GiftCard::whereIn('id', $IdsGiftCard)->get();
        return response()->json($customerGiftCard);
    }
}
