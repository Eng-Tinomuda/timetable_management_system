@extends('layouts.app')

@section('content')
    <div>
        <form action="{{route('timetable.generate')}}" method="post" class="bg-white p-6 rounded-lg">
            @csrf
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
            <section class="w-full grid grid-cols-8 gap-4">
                <div>
                    <label class="ml-2 text-xs font-medium text-gray-500 uppercase tracking-wider" for="week">{{_('Week')}}</label>
                    <select name="week" class="bg-gray-100 border-2 p-4 mt-1 w-full rounded-lg @error('week') border-red-500 @enderror">
                        {{$week = 13}}
                        @for ($i = 1; $i <= $week; $i++)
                            <option value="{{ $i }}">{{__('Week ')}}{{ $i }}</option>
                        @endfor
                      </select>
                </div>
                <div>
                    <label class="ml-2 text-xs font-medium text-gray-500 uppercase tracking-wider" for="day">{{_('Day')}}</label>
                    <select name="day" class="bg-gray-100 border-2 p-4 mt-1 w-full rounded-lg @error('day') border-red-500 @enderror">
                        @foreach ($days as $day)
                            <option value="{{ $day }}">{{ $day }}</option>
                        @endforeach
                      </select>
                </div>
                <div>
                    <label class="ml-2 text-xs font-medium text-gray-500 uppercase tracking-wider" for="period">{{_('Period')}}</label>
                    <select name="period" class="bg-gray-100 border-2 p-4 mt-1 w-full rounded-lg @error('period') border-red-500 @enderror">
                        {{$period = 8}}
                        @for ($i = 1; $i <= $period; $i++)
                            <option value="{{ $i }}">{{__('Period ')}}{{ $i }}</option>
                        @endfor
                      </select>
                </div>
                <div>
                    <label class="ml-2 text-xs font-medium text-gray-500 uppercase tracking-wider" for="duration">{{_('Duration')}}</label>
                    <select name="duration" class="bg-gray-100 border-2 p-4 mt-1 w-full rounded-lg @error('duration') border-red-500 @enderror">
                        @foreach ($duration as $time)
                            <option value="{{ $time }}">{{ $time }}{{__(' Minutes')}}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label class="ml-2 text-xs font-medium text-gray-500 uppercase tracking-wider" for="class">{{_('Class')}}</label>
                    <select name="class" class="bg-gray-100 border-2 p-4 mt-1 w-full rounded-lg @error('class') border-red-500 @enderror">
                        @foreach ($class as $cls)
                            <option value="{{ $cls }}">{{ $cls }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label class="ml-2 text-xs font-medium text-gray-500 uppercase tracking-wider" for="class">{{_('Teacher')}}</label>
                    <select name="teacher" class="bg-gray-100 border-2 p-4 mt-1 w-full rounded-lg @error('teacher') border-red-500 @enderror">
                        @if ($users->count())
                            @foreach ($users as $user)
                                <option value="{{ $user->id }}">{{ $user->name }}</option>
                            @endforeach
                        @endif
                    </select>
                </div>
                <div>
                    <label class="ml-2 text-xs font-medium text-gray-500 uppercase tracking-wider" for="class">{{_('Subject')}}</label>
                    <select name="subject" class="bg-gray-100 border-2 p-4 mt-1 w-full rounded-lg @error('subject') border-red-500 @enderror">
                        @foreach ($subjects as $subject)
                            <option value="{{ $subject }}">{{ $subject }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label class="ml-2 text-xs font-medium text-gray-500 uppercase tracking-wider" for="class">{{_('Classroom')}}</label>
                    <select name="classroom" class="bg-gray-100 border-2 p-4 mt-1 w-full rounded-lg @error('classroom') border-red-500 @enderror">
                        @foreach ($classroom as $room)
                            <option value="{{ $room }}">{{ $room }}</option>
                        @endforeach
                    </select>
                </div>
            </section>
            <section>
                <input type="hidden" name="academic_periods_id" value={{$session_id}}>
            </section>
            <button type="submit" class="px-4 py-2 rounded bg-blue-600 text-white hover:bg-blue-500 w-full mt-4">{{__('Generate Timetable Session')}}</button>
        </form>
        <section class="my-8">
            <div class="flex flex-col">
                <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                    <div class="overflow-hidden border-b border-gray-200 sm:rounded-lg">
                    @if($timetable->count())
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                        <tr>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Week
                            </th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Session
                            </th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Lesson Duration
                            </th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Class
                            </th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Teacher
                            </th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Classroom
                            </th>
                            <th scope="col" class="relative px-6 py-3">
                            <span class="sr-only">Edit</span>
                            </th>
                        </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                                @foreach ($timetable as $season)
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                        {{$season->week}}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="flex items-center">
                                                <div>
                                                    <div class="text-sm font-medium text-gray-900">
                                                        {{$season->day}}
                                                    </div>
                                                    <div class="text-sm text-gray-500">
                                                        {{__('Period')}} {{$season->period}}
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                        {{$season->duration}}{{__(' minutes')}}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                                {{$season->class}}
                                            </span>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="text-sm text-gray-900">{{$season->name}}</div>
                                            <div class="text-sm text-gray-500">{{$season->subject}}</div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                        {{$season->classroom}}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                        <a href="#" class="text-indigo-600 hover:text-indigo-900">Edit</a>
                                        </td>
                                    </tr>
                                @endforeach
                        </tbody>
                    </table>
                    <div class="py-4">{{$timetable->links()}}</div>
                    @else
                        <div class="text-center py-3">{{__('No data found')}}</div>
                    @endif
                    </div>
                </div>
                </div>
            </div>
        </section>
    </div>
@endsection
