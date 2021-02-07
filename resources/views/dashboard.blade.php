@extends('layouts.app')

@section('content')
    <div>
        @if($status->count())
            @if($status[0]->active === 1)
                @if(session('error'))
                    <div class="w-6/12 mx-auto bg-red-500 p-4 rounded mb-6 text-white flex items-center">
                        <div>
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#fff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-bell"><path d="M18 8A6 6 0 0 0 6 8c0 7-3 9-3 9h18s-3-2-3-9"></path><path d="M13.73 21a2 2 0 0 1-3.46 0"></path></svg>
                        </div>
                        <div>
                            <span class="mx-2 font-semibold">{{__('Snap!')}}</span>{{ session('error')}}
                        </div>
                    </div>
                @endif
                <div class="flex">
                    <div class="w-6/12 mx-auto bg-white p-6 rounded-lg">
                        <form action="{{route('dashboard.active')}}" method="post" class="text-right">
                            @csrf
                            <button class="focus:outline-none">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#DC143C" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
                            </button>
                        </form>
                        <form action="{{route('term.new')}}" method="post">
                            @csrf
                            <h2 class="text-gray-800 text-lg mb-3">Start a New Term</h2>
                            <div class="mb-3">
                                <label class="text-gray-700 block mb-1 ml-1">Academic Year</label>
                                <select class="bg-gray-100 border-2 p-4 w-full rounded-lg @error('academic_year') border-red-500 @enderror" name="academic_year" id="academic_year">
                                    @for ($i = 2020; $i <= 2030; $i++)
                                        <option value={{$i}}>{{$i}}</option>
                                    @endfor
                                </select>
                            </div>
                            <div class="mb-3">
                                <label class="text-gray-700 block mb-1 ml-1">School Term</label>
                                <select class="bg-gray-100 border-2 p-4 w-full rounded-lg @error('term') border-red-500 @enderror" name="term" id="academic_year">
                                    @for ($i = 1; $i <= 3; $i++)
                                        <option value={{$i}}>{{$i}}</option>
                                    @endfor
                                </select>
                            </div>
                            <div class="pt-1">
                                <button type="submit" class="bg-gray-700 hover:bg-gray-600 text-white px-4 py-2 mr-2 rounded font-medium uppercase">{{_('Create')}}</button>
                            </div>
                        </form>
                    </div>
                </div>
            @else
            <div class="flex items-center py-5">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-calendar"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect><line x1="16" y1="2" x2="16" y2="6"></line><line x1="8" y1="2" x2="8" y2="6"></line><line x1="3" y1="10" x2="21" y2="10"></line></svg>
                <p class="ml-3 text-gray-800 text-lg">School Calender<p>
            </div>
            <div class="grid grid-cols-5 gap-4 flex-auto">
                @if($status->count())
                    @if($status[0]->active === 0)
                        <div>
                            <form action="{{route('dashboard.active')}}" method="post" class="h-24 flex items-center justify-center">
                                @csrf
                                <button type="submit" class="h-24 border-2 border-blue-500 bg-white border-dashed rounded hover:bg-blue-100 w-full">
                                    {{__('New')}}
                                </button>
                            <form>
                        </div>
                    @endif
                @endif
                @if($academic->count())
                    @foreach ($academic as $session)
                        <a href="{{route('timetable', $session->id)}}">
                            <div class="text-center cursor-pointer items-center pt-3 border-2 border-double border-blue-500 h-24 bg-blue-500 rounded hover:bg-blue-600 hover:shadow-md hover:border-blue-600">
                                <p class="pb-2 block text-white border-b font-bold text-lg font-mono">{{$session->academic_year}}</p>
                                <p class="pt-2 text-white">{{__('Term')}} {{$session->term}}</p>
                            </div>
                        </a>
                    @endforeach
                @endif
            </div>
            @endif
        @endif
    </div>
@endsection
