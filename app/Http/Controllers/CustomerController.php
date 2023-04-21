<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;
use App\Http\Controllers\BaseController;
use Illuminate\Support\Facades\DB;

class CustomerController extends BaseController
{

    public Customer $customer;
    public function __construct(Customer $customer)
    {
        $this->customer = $customer;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $customer = Customer::get();
        return view('admin.customer.index', [
            'customers' => $customer,
            'title' => 'Khách hàng'
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.customer.create', [

            'title' => 'Thêm san pham'
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
        $request->validate([
            'name' => 'required|max:80',
            'email' => 'required',
            'phone' => 'required',
        ]);

        $customer = new Customer();
        $customer->name = $request->name;
        $customer->email = $request->email;
        $customer->phone = $request->phone;

        $customer->address = $request->address;
        if ($request->hasFile('photo')) {
            $customer->photo = $request->photo->storeAs('public/images', $request->photo->hashName());
        }

        $customer->save();
        if ($customer) {
            $this->setFlash(__('Thêm khach hang thành công'));
            return redirect()->route('customer.index');
        }
        $this->setFlash(__('Thêm khach hang thất bại'));
        return redirect()->route('customer.index');
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

        $customer = Customer::where('id', $id)->first();

        return view('admin.customer.edit', [
            'customer' => $customer,
            'title' => 'Sua danh mục'
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
        $request->validate([
            'name' => 'required|max:80',
            'email' => 'required',
            'phone' => 'required',
        ]);

        dd($request->all());
        try {

            $customer =  $this->customer->where('id', $id)->first();
            $customer->name = $request->name;
            $customer->email = $request->email;
            $customer->phone = $request->phone;
            $customer->address = $request->address;
            if ($request->hasFile('photo')) {
                $customer->photo = $request->photo->storeAs('public/images', $request->photo->hashName());
            }
            $customer->save();
            $this->setFlash(__('Cập nhật  thành công'));
            return redirect()->route('customer.index');
        } catch (\Throwable $th) {
            DB::rollback();
            $this->setFlash(__('Đã có một lỗi không mong muốn xảy ra'), 'error');
            return redirect()->route('customer.index');
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

        $customer = Customer::find($id);
        $customer->delete();
        return redirect()->back();
    }
}
