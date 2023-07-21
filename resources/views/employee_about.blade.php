@extends('app')

@section('content')
<div class="max-w-7xl mx-auto p-6 lg:p-8">
    <div class="flex justify-center">
        <h1>Личныый кабинет</h1>
    </div>
    <div class="mt-16">
        <div class="grid gap-6 lg:gap-8">
            <p>Выплаты сотрудника</p>
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
                </tr>
                </thead>
                <tbody>
                @foreach($employees as $employee)
                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                    <th scope="row"
                        class="px-6 py-5 font-medium text-gray-900 dark:text-white whitespace-nowrap">
                    </th>
                    <td class="px-6 py-5">{{$employee->id}}</td>
                    <td class="px-6 py-5">{{$employee->email}}</td>
                    <td class="px-6 py-5"></td>
                    <td class="px-6 py-5"></td>
                    <td class="px-6 py-5"></td>
                    <td class="px-6 py-5"></td>
                    <td class="px-6 py-5">
                        <a class="btn-a-green" href="{{route('employee.show', $employee->id)}}">Выплатить</a>
                    </td>
                </tr>
                @endforeach
                </tbody>
            </table>
        </div>
        <div class="grid gap-6 lg:gap-8">
            <p>Сумма всех необходимых выплат: </p>
            <a class="btn-a-green" href="{{route('employee.show', $employee->id)}}">Выплатить всё</a>
        </div>
    </div>
</div>
@endsection
