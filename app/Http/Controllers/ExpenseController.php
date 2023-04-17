<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\BaseController;
use App\Models\Expense;
use Illuminate\Support\Facades\DB;

class ExpenseController extends BaseController
{

    public Expense $expense;
    public function __construct(Expense $expense)
    {
        $this->expense = $expense;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $expenses = Expense::get();
        return view('admin.expense.index', [
            'expenses' => $expenses,
            'title' => 'expense'
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.expense.create', [
            'title' => 'expense add'
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
        $expense = new Expense();
        $expense->details = $request->details;
        $expense->amount =  strval(intval($request->amount));
        $expense->expense_date = $request->expense_date;
        $expense->save();
        if ($expense) {
            $this->setFlash(__('Thêm expense thành công'));
            return redirect()->route('expense.index');
        }
        $this->setFlash(__('Thêm expense thất bại'));
        return redirect()->route('expense.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id)
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
        $expense = Expense::where('id', $id)->first();

        return view('admin.expense.edit', [
            'expense' => $expense,
            'title' => 'Expense Edit'
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

            $expense =  $this->expense->where('id', $id)->first();
            $expense->details = $request->details;
            $expense->amount =  strval(intval($request->amount));
            $expense->expense_date = $request->expense_date;
            $expense->save();
            $this->setFlash(__('Cập nhật  thành công'));
            return redirect()->route('expense.index');
        } catch (\Throwable $th) {
            DB::rollback();
            $this->setFlash(__('Đã có một lỗi không mong muốn xảy ra'), 'error');
            return redirect()->route('expense.index');
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
        $expense = Expense::find($id);
        $expense->delete();
        return redirect()->back();
    }
}
