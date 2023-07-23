<?php

namespace App\Http\Controllers;

use App\Http\Requests\EmployeeRequest;
use App\Http\Services\SalaryApi;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     * @throws GuzzleException
     */
    public function index()
    {
        $employees = (new SalaryApi())->get('employee');
        $statusTransactions = (new SalaryApi())->get('statusTransaction');
        return view('employee', ['employees' => $employees, 'statusTransactions' => $statusTransactions]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('employee_add');
    }

    /**
     * Store a newly created resource in storage.
     * @throws GuzzleException
     */
    public function store(EmployeeRequest $request)
    {
        $validate = $request->validated();
        $message = (new SalaryApi())->post($validate, 'employee');

        if (isset($message['message'])) {
            return back()->withInput()->with('message', $message['message']);
        }

        return redirect()->route('employee.index');
    }

    /**
     * Display the specified resource.
     * @throws GuzzleException
     */
    public function show(string $id)
    {
        $employee = (new SalaryApi())->getWithId('employee', $id);
        return view('employee_about', ['employee' => $employee]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
