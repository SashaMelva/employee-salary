@extends('app')

@section('content')
    <div class="max-w-7xl mx-auto p-6 lg:p-8">
        <div class="flex justify-center">
            <h1>Список сотрудников</h1>
        </div>
        <div class="flex justify-left">
            <a class="btn-a-dark" href="{{route('employee.create')}}">Добавить сотрудника</a>
        </div>
        <div class="mt-16">
            <div class="grid gap-6 lg:gap-8">
                <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                    <thead class="text-xs text-gray-700 dark:text-gray-400">
                    <tr class="bg-gray-50">
                        <th scope="col" class="px-6 py-5">#</th>
                        <th scope="col" class="px-6 py-5">Email сотрудника</th>
                        <th scope="col" class="px-6 py-5">Кол-во часов</th>
                        <th scope="col" class="px-6 py-5">Зарплата в час</th>
                        <th scope="col" class="px-6 py-5">Сумма выплаты</th>
                        <th scope="col" class="px-6 py-5">Статус</th>
                        <th scope="col" class="px-6 py-5"></th>
                        <th scope="col" class="px-6 py-5"></th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($employees as $employee)
                            <?php
                            $hours = 0;
                            $minutes = 0;

                            if (empty($employee['hourlyRates'])) {
                                $price = 0;
                            } else {
                                $price = $employee['hourlyRates'][0]['price'];
                            }

                            foreach ($employee['transactions'] as $transaction) {
                                if ($transaction['status']['id'] !== 1) {
                                    $timeTransactionArray = explode(':', $transaction['hours']);
                                    $hours += (int)$timeTransactionArray[0];
                                    $minutes += (int)$timeTransactionArray[1];
                                }

                                if ($minutes > 60) {
                                    $hours += (int)($minutes / 60);
                                    $minutes = $minutes % 60;
                                }
                            }

                            $sum = $price * $hours;
                            $sum += round($price * $minutes / 60, 2);

                            if ($minutes < 10) {
                                $minutes = '0' . $minutes;
                            }

                            $time = $hours . ':' . $minutes;
                            ?>
                        <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                            <td class="px-6 py-5">{{ $employee['id'] }}</td>
                            <td class="px-6 py-5">{{ $employee['email'] }}</td>
                            <td class="px-6 py-5">
                                 {{ $time }}
                            </td>
                            <td class="px-6 py-5">
                                {{ $price }} руб
                            </td>
                            <td class="px-6 py-5">
                                {{ $sum }} руб
                            </td>
                            <td class="px-6 py-5">
                                @if($sum == 0)
                                    Выплачено
                                @else
                                    Не выплачено
                                @endif
                            </td>
                            <td class="px-6 py-5">
                                <form action="{{ route('pay.all.transaction') }}" method="POST">
                                    @csrf
                                    <input id="employee_id" name="employee_id" type="hidden"
                                           value="{{ $employee['id'] }}">
                                    <input id="status_transaction_id" name="status_transaction_id" type="hidden"
                                           value="3">
                                    <input id="hours" name="hours" type="hidden" value="00:00">
                                    <input type="hidden" name="_token" value="{{ csrf_token() }}"/>
                                    <button type="submit" class="btn-a-green">
                                        Выплатить всё
                                    </button>
                                </form>
                            </td>
                            <td class="px-6 py-5">
                                <a class="btn-a-green" href="{{ route('employee.show', $employee['id']) }}">Профиль</a>
                            </td>
                        </tr>
                    @endforeach
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
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection


