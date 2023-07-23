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
    public function createTransaction(string $idUser)
    {
        $employee = (new SalaryApi())->getWithId('employee', $idUser);
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
        return redirect('transaction.create.for.user', $validate['employee_id']);
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
