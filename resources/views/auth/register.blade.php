@extends('layouts.app')
@section('content')
    <div class="grid grid-cols-3 gap-6">
        <div class="col-span-2">
            <div class="bg-white p-6 rounded-lg">
                @if(session('status'))
                    <div class="bg-green-500 p-4 rounded mb-6 text-white flex items-center">
                        <div>
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#fff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-bell"><path d="M18 8A6 6 0 0 0 6 8c0 7-3 9-3 9h18s-3-2-3-9"></path><path d="M13.73 21a2 2 0 0 1-3.46 0"></path></svg>
                        </div>
                        <div>
                            <span class="mx-2 font-semibold">Yay!</span>{{ session('status')}}
                        </div>
                    </div>
                @endif
                <form action="{{route('register')}}" method="post" autocomplete="off" role="form">
                    <h1 class="text-lg text-gray-800 font-semibold mb-5 uppercase">{{__('Register New User')}}</h1>
                    @csrf
                    <div class="mb-4">
                        <label class="sr-only" for="name">{{_('Name')}}</label>
                        <input type="text" name="name" id="name" placeholder="Enter your name" class="bg-gray-100 border-2 p-4 w-full rounded-lg @error('name') border-red-500 @enderror" value="{{old('name')}}"/>
                        @error('name')
                            <div class="text-red-500 mt-2 text-sm">
                                {{$message}}
                            </div>
                        @enderror
                    </div>
                    <div class="mb-4">
                        <label class="sr-only" for="email">{{_('E-Mail')}}</label>
                        <input type="text" name="email" id="email" placeholder="Enter your email" class="bg-gray-100 border-2 p-4 w-full rounded-lg @error('email') border-red-500 @enderror" value="{{old('email')}}"/>
                        @error('email')
                            <div class="text-red-500 mt-2 text-sm">
                                {{$message}}
                            </div>
                        @enderror
                    </div>
                    <div class="mb-4">
                        <label class="sr-only" for="password">{{_('Password')}}</label>
                        <input type="password" name="password" id="password" placeholder="Type password" class="bg-gray-100 border-2 p-4 w-full rounded-lg @error('password') border-red-500 @enderror" value=""/>
                        @error('password')
                            <div class="text-red-500 mt-2 text-sm">
                                {{$message}}
                            </div>
                        @enderror
                    </div>
                    <div class="mb-4">
                        <label class="sr-only" for="password_confirmation">{{_('Confirm Password')}}</label>
                        <input type="password" name="password_confirmation" id="password" placeholder="Confirm password" class="bg-gray-100 border-2 p-4 w-full rounded-lg" value=""/>
                    </div>
                    <div class="mb-4 ml-2">
                        <span class="text-gray-600 text-lg">Account Type</span>
                        <div class="mt-2">
                            <label class="inline-flex items-center cursor-pointer">
                            <input type="radio" class="form-radio" name="role" value="administrator">
                            <span class="ml-2 text-gray-700">Administrator</span>
                            </label>
                            <label class="inline-flex items-center cursor-pointer ml-8">
                            <input type="radio" class="form-radio" name="role" value="teacher">
                            <span class="ml-2 text-gray-700">Teacher</span>
                            </label>
                        </div>
                        @error('role')
                            <div class="text-red-500 mt-2 text-sm">
                                {{$message}}
                            </div>
                        @enderror
                    </div>
                    <div>
                        <button class="bg-gray-700 hover:bg-gray-600 text-white px-4 py-3 rounded-lg font-medium w-full uppercase">{{_('Create New Account')}}</button>
                    </div>
                </form>
            </div>
        </div>
        <div>
            @if($users->count())
                @foreach($users as $user)
                    @if(Auth()->user()->id !== $user->id)
                        <div class="bg-white rounded-lg hover:shadow mb-6">
                            <div class="py-3 text-center bg-white text-gray-800">
                                <h1 class="text-2xl font-semibold">{{$user->name}}</h1>
                                <h2 class="italic">{{$user->email}}</h2>
                                <p class="font-mono font-medium">{{$user->role}}</p>
                                @if(Auth()->user()->role === 'administrator')
                                    <form action="{{route('register.user', $user)}}" method="post" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button class="py-1 px-4 rounded-md border border-indigo-800 mt-3 text-indigo-800 bg-white hover:text-white hover:bg-indigo-800">Delete</button>
                                    </form>
                                @endif
                            </div>
                        </div>
                    @endif
                @endforeach
                {{$users->links()}}
            @endif
        </div>
    </div>
@endsection
