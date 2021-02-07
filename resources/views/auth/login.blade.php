<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href={{asset('css/app.css')}}>
    <title>Timetable Management System</title>
</head>
<body class="bg-gray-100">
    <div class="flex justify-center mt-20">
        <div class="w-5/12 bg-white p-6 rounded-lg">
            @if(session('error'))
                <div class="bg-red-500 p-4 rounded mb-6 text-white flex items-center">
                    <div>
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#fff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-bell"><path d="M18 8A6 6 0 0 0 6 8c0 7-3 9-3 9h18s-3-2-3-9"></path><path d="M13.73 21a2 2 0 0 1-3.46 0"></path></svg>
                    </div>
                    <div>
                        <span class="mx-2 font-semibold">{{__('Snap!')}}</span>{{ session('error')}}
                    </div>
                </div>
            @endif
            <div class="py-3">
                <img class="img-responsive block mx-auto" style="height: 90px !important;" src="{{asset('img/schoolbadge_mobile_old.jpg')}}" />
                <h1 class="text-center text-2xl font-semibold text-indigo-600 uppercase">{{__('Girls College')}}</h1>
                <h2 class="text-center font-medium text-lg text-gray-700 tracking-wide font-mono">{{__('Timetable Management System')}}</h2>
            </div>
            <form action="{{route('login')}}" method="post" autocomplete="off" role="form">
                <h1 class="text-lg text-gray-800 font-semibold mb-5 uppercase">{{__('Sign In')}}</h1>
                @csrf
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
                    <div class="flex items-center">
                        <input type="checkbox" name="remember" id="remember" class="mr-2" />
                        <label for="remember">{{__('Remember me')}}</label>
                    </div>
                </div>
                <div>
                    <button class="bg-gray-700 hover:bg-gray-600 text-white px-4 py-3 rounded-lg font-medium w-full uppercase">{{_('Login')}}</button>
                </div>
            </form>
        </div>
    </div>
</body>
</html>
