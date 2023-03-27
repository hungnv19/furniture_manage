<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use Illuminate\Http\Request;
use App\Http\Controllers\BaseController;
use App\Models\Customer;

class BookingController extends BaseController
{

    public Appointment $appointments;


    public function __construct(Appointment $appointments)
    {

        $this->appointments = $appointments;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $appointments = $this->appointments->join('customers', 'customers.id', '=', 'appointments.customer_id')
            ->select('appointments.*', 'customers.name as customer_name')
            ->orderBy('appointments.id', 'desc')
            ->get();
        return view('admin.booking.index', [
            'appointments' => $appointments,
            'title' => 'Cuộc hẹn',
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $customers = Customer::select('id', 'name as label')->get();

        return view('admin.booking.create', [
            'customers' => $customers,
            'title' => 'Thêm cuộc hẹn',
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
        // dd($request->all());
        $appointment = new Appointment();
        $appointment->customer_id = $request->customer_id;
        $appointment->date = $request->date;
        $appointment->start_time = $request->start_time;
        $appointment->end_time = $request->end_time;
        $appointment->note = $request->note;
        $appointment->save();
        if ($appointment) {
            $this->setFlash(__('Thêm cuộc hẹn thành công'));
            return redirect()->route('booking.index');
        }
        $this->setFlash(__('Thêm cuộc hẹn thất bại'));
        return redirect()->route('booking.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $appointment = Appointment::where('id', $id)->first();
        return view('admin.booking.detail', [
            'appointment' => $appointment,
            'title' => 'Chi tiết cuộc hẹn'
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
        $appointment = Appointment::find($id);
        $appointment->delete();
        return redirect()->back();
    }
}
