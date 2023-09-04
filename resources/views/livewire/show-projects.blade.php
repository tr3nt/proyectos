@extends('app')

@section('content')
<h1 class="font-semibold leading-7 text-gray-900 text-5xl">Projects</h1>
<!--div class="flex justify-center items-center h-screen"-->
    <div class="flex justify-center items-center mt-16">
        <button onclick="window.location.href='{{ url('/new') }}'"
            class="flex items-center border-none bg-transparent text-blue-500 hover:text-blue-600 focus:outline-none">
            <span class="mr-2">CREATE PROJECT</span>
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
            <path d="M14.293 1.293a1 1 0 0 1 1.414 1.414l-10 10a1 1 0 0 1-.39.242l-3.074.77a1 1 0 0 1-1.27-1.27l.77-3.074a1 1 0 0 1 .242-.39l10-10z"/>
            <path d="M14 3l3 3L5 18H2v-3L14 3z"/>
            </svg>
        </button>
    </div>
<!--/div-->
@endsection