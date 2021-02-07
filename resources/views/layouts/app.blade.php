<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href={{asset('css/app.css')}}>
    <title>Timetable Management System</title>
    <style>
        .contain{
            max-width: 80%;
        }

        .wrapper{
            min-height: 78vh;
        }

        .logo{
            height: 40px !important;
        }
        .btn-outline{
            color: #81BD00;
            border-color: #81BD00;
        }
        .btn-outline:hover{
            background-color: #81BD00;
            color: #ffffff;
        }

        .btn-solid{
            background-color: #81BD00;
            color: #ffffff;
        }

        .btn-solid:hover{
            background-color: #b3df56;
        }

        .border-light:hover{
            border: 1px solid #81BD00;
        }
    </style>
</head>
<body class="bg-gray-100">
    <header class="p-2 bg-white border border-b mb-6">
        <nav class="flex justify-between contain mx-auto">
            <ul class="flex items-center">
                <li class="p-2">
                    <a href="#"><img src={{asset('img/Logo-2-1.jpg')}} alt="Logo" class="logo" /></a>
                </li>
            </ul>
            <ul class="flex items-center">
                @auth
                    <li class="p-2 hover:text-green-600">
                        <a href="{{route('dashboard')}}">{{__('Dashboard')}}</a>
                    </li>
                    <li class="p-2 mr-5 hover:text-green-600">
                        <a href="{{route('register')}}">{{__('Create Account')}}</a>
                    </li>
                    <li class="p-2 border-l font-semibold">
                        <a href="{{route('register')}}">{{Auth()->user()->name}}</a>
                    </li>
                    <li class="p-2">
                        <form class="inline" action="{{route('logout')}}" method="post">
                            @csrf
                            <button class="px-4 text-sm py-2 rounded bg-red-600 text-white hover:bg-red-500">{{__('LOGOUT')}}</button>
                        </form>
                    </li>
                @endauth
                @guest
                    <li class="p-2 hover:text-green-600">
                        <a href="{{route('login')}}" class="px-4 py-2 rounded bg-gray-700 text-white hover:bg-gray-600">{{__('SIGN IN')}}</a>
                    </li>
                @endguest
            </ul>
        </nav>
    </header>
    <div class="wrapper">
        <div class="contain mx-auto">
            @yield('content')
        </div>
    </div>
    <div class="w-100">
        <footer class="py-6 bg-gray-100 border-t mt-10">
            <div class="contain mx-auto">
                <div class="flex text-gray-700 justify-between">
                    <p>&#169;{{__('Copyright ')}}<script>document.write(new Date().getFullYear())</script>{{__(",")}} {{__('All rights reserved')}}</p>
                    <p>{{__('Developed by')}} <a class="text-indigo-600 hover:border-b hover:border-indigo-600" href="https://www.facebook.com/TinnoMadz" target="_blank">{{__('Tinomuda Madzima-Msipa')}}</a>
                </div>
            </div>
        </footer>
    </div>
</body>
</html>
