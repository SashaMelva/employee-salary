<?php

namespace App\Http\Controllers;

use App\Http\Requests\EmployeeRequest;
use App\Http\Servises\SalaryApi;
use App\Models\Employee;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     * @throws GuzzleException
     */
    public function index()
    {
        $response = Http::get('http://0.0.0.0/api/employee');
        dd($response);
       // $employees = (new SalaryApi())->get('employee');
        var_dump("yyui");
       // return view('employee', ['employees' => $employees]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): \Illuminate\Contracts\View\View
    {
        return view('employee_add');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(EmployeeRequest $request)
    {
//        $validate = $request->validated();
//        $validateForJsonApi = [
//            'email' => $this->$validate['email'],
//            'password' => $this->$validate['password']
//        ];
//
//        (new BaseApi())->post($validateForJsonApi, 'employee');
//
//        return redirect()->route('employee.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return view('employee_about');
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
