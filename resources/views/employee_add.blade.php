@extends('app')

@section('content')
    <div class="max-w-7xl mx-auto p-6 lg:p-8">
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 container-for-form">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">
                        {{ __("Добавление сотрудника") }}
                    </div>

                    <form method="POST" action="{{ route('employee.store') }}" class="mx-auto max-w-xl sm:mt-20">
                        @csrf
                        <div class="flex flex-wrap -mx-3 mb-6 flex-column flex-direction-col">
                            <label class="label-form" for="email">Email</label>
                            <input class="input-form" id="email" name="email" type="text" placeholder="email"
                                   value="{{ old('email') }}">
                            <label class="label-form" for="password">Пароль</label>
                            <input class="input-form"
                                   id="password" name="password" type="password" placeholder="пароль"
                                   value="{{ old('password') }}">
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
                        <div class="p-6 flex content-space-between">
                            <button class="btn-a-green" type="submit">Сохранить</button>
                            <a class="btn-a-dark" href="{{route('employee.index')}}">Назад</a>
                        </div>
                        <input type="hidden" name="_token" value="{{ csrf_token() }}"/>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
