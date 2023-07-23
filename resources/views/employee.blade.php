@extends('app')

@section('content')
    <div class="max-w-7xl mx-auto p-6 lg:p-8">
        <div class="flex justify-center">
            <h1>Список сотрудников</h1>
        </div>
        <div class="flex justify-left">
            <a class="btn-a-dark"
               style="background-color: rgb(30 41 59);"
               href="{{route('employee.create')}}">Добавить сотрудника</a>
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
                        <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                            <td class="px-6 py-5">{{ $employee['id'] }}</td>
                            <td class="px-6 py-5">{{ $employee['email'] }}</td>
                            <td class="px-6 py-5">
                                    <?php
                                    if (empty($employee['hourlyRates'])) {
                                        $price = 0;
                                    } else {
                                        $price = $employee['hourlyRates']['price'];
                                    }

                                    $time = 0;
                                    foreach ($employee['transactions'] as $transaction) {

                                        if ($transaction['status_id'] !== 3) {
                                            $time = strtotime($time) + strtotime($transaction['time']) - strtotime("00:00:00");
                                        }
                                    }
                                    $sum = $price * $time;
                                    echo date('H:i', $time);
                                    ?>
                            </td>
                            <td class="px-6 py-5">
                                    <?= $price ?> руб

                            </td>
                            <td class="px-6 py-5">
                                    <?= $sum ?> руб
                            </td>
                            <td class="px-6 py-5">
                                @if($sum == 0)
                                    Не выплачено
                                @else
                                    Выплачено
                                @endif
                            </td>
                            <td class="px-6 py-5">
                                <a class="btn-a-green" href="{{ route('employee.buy', $employee['id']) }}">Выплатить всё</a>
                            </td>
                            <td class="px-6 py-5">
                                <a class="btn-a-green" href="{{ route('employee.show', $employee['id']) }}">Профиль</a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
