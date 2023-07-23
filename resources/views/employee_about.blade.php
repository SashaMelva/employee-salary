@extends('app')

@section('content')
<div class="max-w-7xl mx-auto p-6 lg:p-8">
    <div class="flex justify-center">
        <h1>Личный кабинет сотрудника: {{ $employee['email'] }}</h1>
    </div>
    <div class="mt-16">
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
                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                    <th scope="row"
                        class="px-6 py-5 font-medium text-gray-900 dark:text-white whitespace-nowrap">
                    </th>
                    <td class="px-6 py-5"></td>
                    <td class="px-6 py-5"></td>
                    <td class="px-6 py-5"></td>
                    <td class="px-6 py-5"></td>
                    <td class="px-6 py-5"></td>
                </tr>
                </tbody>
            </table>
        </div>
        <div class="grid gap-6" style="grid-template-columns: 1fr max-content max-content max-content; align-items: center;">
            <p>Сумма всех необходимых выплат: </p>
            <a class="btn-a-green" href="">Выплатить всё</a>
            <a class="btn-a-green" href="{{ route('transaction.create.for.user', $employee['id']) }}">Добавить транзакцию</a>
            <a class="btn-a-green" href="{{ route('employee.index') }}">Назад</a>
        </div>
    </div>
    </div>
</div>
@endsection
