@extends('app')

@section('content')
    <div class="max-w-7xl mx-auto p-6 lg:p-8">
        <div class="flex justify-center">
            <h1>Личный кабинет сотрудника: {{ $employee['email'] }}</h1>
        </div>
        <div class="mt-16">
            <div class="flex items-center">
                <p class="mr-1">Ставка сотрудника в час:</p>
                @if(!empty($employee['hourlyRates']))
                    {{ $employee['hourlyRates'][0]['price'] }} руб
                @else
                    <form class="flex" action="{{ route('hourly.rates.create.for.user') }}" method="POST">
                        @csrf
                        <input class="input-form" name="price" id="price" type="number">
                        <input name="employee_id" id="employee_id" type="text" hidden="hidden"
                               value="{{ $employee['id'] }}">
                        <button type="submit" class="btn-a-green">Сохранить</button>
                        <input type="hidden" name="_token" value="{{ csrf_token() }}"/>
                    </form>
                @endif
            </div>
            <div class="w-full md:w-1/2 px-3">
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                @if(session('message'))
                    <div class="alert alert-danger">
                        {{ session('message') }}
                    </div>
                @endif
            </div>
            <br/>
            <div class="grid gap-6 lg:gap-8">
                <p>Все транзакции сотрудника</p>
                <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400 mt-4 ">
                    <thead class="text-xs text-gray-700 dark:text-gray-400 text-left">
                    <tr class="bg-gray-50">
                        <th scope="col" class="px-6 py-5">ID</th>
                        <th scope="col" class="px-6 py-5">Кол-во часов</th>
                        <th scope="col" class="px-6 py-5">Сумма</th>
                        <th scope="col" class="px-6 py-5">Статус</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach( $employee['transactions'] as $transaction)
                        <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                            <td class="px-6 py-5">{{ $transaction['id'] }}</td>
                            <td class="px-6 py-5">{{ $transaction['hours'] }}</td>
                            <td class="px-6 py-5">@if(isset($employee['hourlyRates'][0]))
                                        <?php
                                        $timeTransactionArray = explode(':', $transaction['hours']);
                                        $hours = (int)$timeTransactionArray[0];
                                        $minutes = (int)$timeTransactionArray[1];
                                        $sum = $employee['hourlyRates'][0]['price'] * $hours;
                                        $sum += round($employee['hourlyRates'][0]['price'] * $minutes / 60, 2);
                                        ?>
                                    {{ $sum }}
                                @endif руб
                            </td>
                            <td class="px-6 py-5">{{ $transaction['status']['title'] }}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                <br/>
            </div>
            <div class="grid gap-6 template-greed">
                <a class="btn-a-green" href="">Выплатить всё</a>
                <a class="btn-a-green" href="{{ route('transaction.create.for.user', $employee['id']) }}">Добавить
                    транзакцию</a>
                <a class="btn-a-green" href="{{ route('employee.index') }}">Назад</a>
            </div>
        </div>
    </div>
@endsection
