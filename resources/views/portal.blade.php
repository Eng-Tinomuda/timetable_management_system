@extends('layouts.app')

@section('content')
    <div>
        <div class="flex items-center py-5">
            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-calendar"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect><line x1="16" y1="2" x2="16" y2="6"></line><line x1="8" y1="2" x2="8" y2="6"></line><line x1="3" y1="10" x2="21" y2="10"></line></svg>
            <p class="ml-3 text-gray-800 text-lg">School Calender<p>
        </div>
        <div class="grid grid-cols-5 gap-4 flex-auto">
            @if($academic->count())
                @foreach ($academic as $session)
                    <a href="{{route('portal.generate', $session->id)}}">
                        <div class="text-center cursor-pointer items-center pt-3 border-2 border-double border-blue-500 h-24 bg-blue-500 rounded hover:bg-blue-600 hover:shadow-md hover:border-blue-600">
                            <p class="pb-2 block text-white border-b font-bold text-lg font-mono">{{$session->academic_year}}</p>
                            <p class="pt-2 text-white">{{__('Term')}} {{$session->term}}</p>
                        </div>
                    </a>
                @endforeach
            @endif
        </div>
    </div>
@endsection
