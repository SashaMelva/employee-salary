<?php

namespace App\Http\Controllers;

use App\Http\Requests\TransactionRequest;
use App\Http\Services\SalaryApi;
use App\Models\Transaction;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Http\Request;

class TransactionController extends Controller
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
     * @throws GuzzleException
     */
    public function createTransaction(string $employeeId)
    {
        $employee = (new SalaryApi())->getWithId('employee', $employeeId);
        return view('add_transaction', ['employee' => $employee]);
    }

    /**
     * Store a newly created resource in storage.
     * @throws GuzzleException
     */
    public function store(TransactionRequest $request)
    {
        $validate = $request->validated();
        $message = (new SalaryApi())->post($validate, 'transaction');

        if (isset($message['message'])) {
            return back()->withInput()->with('message', $message['message']);
        }

        return redirect()->route('employee.show', (int)$validate['employee_id']);
    }

    /**
     * @throws GuzzleException
     */
    public function payAllTransaction(TransactionRequest $request)
    {
        $validate = $request->validated();
        $employee = (new SalaryApi())->getWithId('employee', $validate['employee_id']);

        if (!empty($employee['transactions'])) {

            foreach ($employee['transactions'] as $transaction) {

                if ($transaction['status']['id'] != 1) {
                    $dataTransaction = [
                        'id' => $transaction['id'],
                        'hours' => $transaction['hours'],
                        'employee_id' => $transaction['employee_id'],
                        'status_transaction_id' => '1'
                    ];
                    (new SalaryApi())->put($transaction['id'], $dataTransaction, 'transaction');
                }
            }
        }

        return redirect()->route('employee.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Transaction $transaction)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Transaction $transaction)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Transaction $transaction)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Transaction $transaction)
    {
        //
    }
}
