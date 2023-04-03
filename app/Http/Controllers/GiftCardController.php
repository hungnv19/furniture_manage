<?php

namespace App\Http\Controllers;

use App\Models\GiftCard;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\BaseController;
class GiftCardController extends BaseController
{
    public GiftCard $giftCard;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct(GiftCard $giftCard)
    {
        $this->giftCard = $giftCard;
    }
    public function index()
    {
        $giftCard = GiftCard::get();
        return view('admin.gift_card.index', [
            'title' => 'Gift Card',
            'giftCards' => $giftCard,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.gift_card.create', [
            'title' => 'Gift Card Create',
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $giftCard = new GiftCard;
        $giftCard->type = $request->type;
        $giftCard->amount = $request->type == '4' ? $request->other : $request->amount;
        $giftCard->balance = $request->type == '4' ? $request->other : $request->balance;
        $giftCard->code = $request->code;
        $giftCard->save();
        if ($giftCard) {
            $this->setFlash(__('Thêm thẻ thành công'));
            return redirect()->route('gift-card.index');
        }
        $this->setFlash(__('Thêm thẻ thất bại'));
        return redirect()->route('gift-card.index');
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
        $giftCard = GiftCard::where('id', $id)->first();
        return view('admin.gift_card.edit', [
            'title' => 'Gift Card Edit',
            'giftCard' => $giftCard,
        ]);
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

        try {
            $giftCard =  $this->giftCard->where('id', $id)->first();
            $giftCard->type = $request->type;
            $giftCard->amount = $request->type == '4' ? $request->other : $request->amount;
            $giftCard->balance = $request->type == '4' ? $request->other : $request->balance;
            $giftCard->code = $request->code;

            $giftCard->save();
            $this->setFlash(__('Cập nhật  thành công'));
            return redirect()->route('gift-card.index');
        } catch (\Throwable $th) {
            DB::rollback();
            $this->setFlash(__('Đã có một lỗi không mong muốn xảy ra'), 'error');
            return redirect()->route('gift-card.index');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (GiftCard::destroy($id)) {
            session()->flash('comment', 'Xóa  thành công!');
            return redirect()->back();
        }
    }
    public function generateCode($pre = null)
    {
        $str = substr(preg_replace('/[^0-9]/', '', Str::uuid()->getHex()), 0, 8);
        return response()->json(DB::table('gift_card')->where('code', $pre . '_' . $str)->exists() ? $this->generateCode($pre) : $pre . 'GC' . '_' . $str);
    }
    public function getGiftCardList()
    {
        $IdGiftCardUsed = DB::table('gift_card')
            ->join('customer_gift_card', 'gift_card.id', '=', 'customer_gift_card.gift_card_id')
            ->select('gift_card.*', 'customer_gift_card.gift_card_id as gift_id')
            ->pluck('gift_id');
        $listGiftCardAvailable = GiftCard::whereNotIn('id', $IdGiftCardUsed)->get();
        return response()->json($listGiftCardAvailable);
    }
}
