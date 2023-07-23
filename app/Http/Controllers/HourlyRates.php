<?php

namespace App\Http\Controllers;


use App\Http\Requests\HourlyRatesRequest;
use App\Http\Services\SalaryApi;
use GuzzleHttp\Exception\GuzzleException;

class HourlyRates extends Controller
{
    /**
     * @throws GuzzleException
     */
    public function saveForUser(HourlyRatesRequest $request) {
        $validate = $request->validated();

        $message = (new SalaryApi())->post($validate, 'hourlyRate');

        if (isset($message['message'])) {
            return back()->withInput()->with('message', $message['message']);
        }

        return redirect()->route('employee.show', $validate['id']);

    }
}
