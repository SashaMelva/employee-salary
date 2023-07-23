@extends('app')

@section('content')
    <div class="max-w-7xl mx-auto p-6 lg:p-8">
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8" style="width: 400px; margin-left: auto; margin-right: auto;">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">
                        {{ __("Добавление транзкции сотруднику") }}
                    </div>

                    <form method="POST" action="{{ route('transaction.store') }}" class="w-full max-w-lg">
                        @csrf
                        <div class="w-full md:w-1/2 px-3">
                            <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2"
                                   for="email">
                                Почта сотрудника: {{ $employee['email'] }}
                            </label>
                            <input id="employee_id" name="employee_id" type="hidden" value="{{ $employee['id'] }}">
                            <input id="status_transaction_id" name="status_transaction_id" type="hidden" value="3">
                        </div>
                        <div class="flex flex-wrap -mx-3 mb-6 flex-column" style="flex-direction: column;">
                            <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                                <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2"
                                       for="hours">
                                    Время
                                </label>
                                <input
                                    class="appearance-none block w-full bg-gray-200 text-gray-700 border border-red-500 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white"
                                    id="hours" name="hours" type="time" placeholder="Время" value="{{ old('hours') }}">
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
                        </div>
                        <div class="p-6" style="display: flex; justify-content: space-between;">
                            <button class="btn-a-green" type="submit">Сохранить</button>
                            <a class="btn-a-dark" href="{{route('employee.show', $employee['id'])}}">Назад</a>
                        </div>
                        <input type="hidden" name="_token" value="{{ csrf_token() }}"/>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
