@extends('app')

@section('content')
    <div class="max-w-7xl mx-auto p-6 lg:p-8">
        <div class="flex justify-center">
            <h1>Личный кабинет сотрудника: {{ $employee['email'] }}</h1>
        </div>
        <div class="mt-16">
            <div class="grid gap-6 lg:gap-8">
                <p>Ставка сотрудника в час:</p>
                @if(!empty($employee['hourlyRates']))
                    {{ $employee['hourlyRates'][0]['price'] }}
                @else
                    <form action="{{ route('hourly.rates.create.for.user') }}" method="POST">
                        @csrf
                        <input
                            class="appearance-none block w-full bg-gray-200 text-gray-700 border border-red-500 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white"
                            name="price" id="price" type="number">
                        <input name="employee_id" id="employee_id" type="text" hidden="hidden" value="{{ $employee['id'] }}">
                        <button type="submit" class="btn-a-green">Сохранить</button>
                        <input type="hidden" name="_token" value="{{ csrf_token() }}"/>
                    </form>
                @endif
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
            </div>
            <div class="grid gap-6 lg:gap-8">
                <p>Все транзакции сотрудника</p>
                <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                    <thead class="text-xs text-gray-700 dark:text-gray-400">
                    <tr class="bg-gray-50">
                        <th scope="col" class="px-6 py-5">#</th>
                        <th scope="col" class="px-6 py-5">Кол-во часов</th>
                        <th scope="col" class="px-6 py-5">Зарплата в час</th>
                        <th scope="col" class="px-6 py-5">Статус</th>
                        <th scope="col" class="px-6 py-5"></th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach( $employee['transactions'] as $transaction)
                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                        <th scope="row"
                            class="px-6 py-5 font-medium text-gray-900 dark:text-white whitespace-nowrap">
                        </th>
                        <td class="px-6 py-5">{{ $transaction['id'] }}</td>
                        <td class="px-6 py-5">{{ $transaction['hours'] }}</td>
                        <td class="px-6 py-5">{{ $employee['hourlyRates'][0]['price'] }} руб</td>
                        <td class="px-6 py-5">{{ $transaction['status']['title'] }}</td>
                        <td class="px-6 py-5"></td>
                    </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
            <div class="grid gap-6"
                 style="grid-template-columns: 1fr max-content max-content max-content; align-items: center;">
                <p>Сумма всех необходимых выплат: </p>
                <a class="btn-a-green" href="">Выплатить всё</a>
                <a class="btn-a-green" href="{{ route('transaction.create.for.user', $employee['id']) }}">Добавить
                    транзакцию</a>
                <a class="btn-a-green" href="{{ route('employee.index') }}">Назад</a>
            </div>
        </div>
    </div>
    </div>
@endsection
