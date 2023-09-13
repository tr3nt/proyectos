<div class="text-left" x-data="{ isOpen: false, idProject: '', openUrl: function(url) { window.location.href = url; } }">
    <div class="text-[3rem] leading-[5rem] w-[480px] mx-auto text-center border-b-2 border-t-2 border-red-600">
        Portafolio
    </div>
    @guest
    <div class="w-full max-w-[75%] p-5 pb-10 mx-auto mb-10 gap-4 columns-3 space-y-3">
        @foreach ($projects as $project)
        <div x-data="{show: false}">
            <div class="relative"
                    x-on:mouseenter="show = true"
                    x-on:mouseleave="show = false"
                >
                <!-- Image -->
                <img src="{{ asset('storage/' . $project->image) }}" alt="Your Image" class="w-full h-auto" />

                <!-- Semi-transparent card -->
                <div class="animate-fadeIn absolute inset-0 bg-red-700 bg-opacity-75 p-4"
                        x-show="show"
                        x-transition:enter="transition ease-out duration-300 transform"
                        x-transition:enter-start="opacity-0 scale-95"
                        x-transition:enter-end="opacity-100 scale-100"
                        x-transition:leave="transition ease-in duration-200 transform"
                        x-transition:leave-start="opacity-100 scale-100"
                        x-transition:leave-end="opacity-0 scale-95"
                    >
                    <!-- Card content goes here -->
                    <div class="border-white border h-full text-white p-4">
                    <!-- Card content -->
                    <div class="text-[1.5rem] font-bold pb-5">{{ $project->title }}</div>
                    {!! $project->description !!}
                </div>
            </div>
        </div>
        @endforeach
        
        <!-- If there are no projects of logged user -->
        @if (count($projects) < 1)
        <ul>
            <li class="text-center">
            @guest
                No active Projects
            @endguest
            </li>
        </ul>
        @endif
    </div>
    @endguest

    @auth
    <div class="mt-9 w-[480px] mx-auto text-center pb-5">
        @foreach ($projects as $project)
        <div class="text-2xl justify-left items-center flex">
            <a href="{{ url("/projects/edit/{$project->id}") }}">
                <p>
                @if ($project->public > 0)
                    <span class="text-green-700 text-xs">Public</span>
                @else
                    <span class="text-red-700 text-xs">Draft&nbsp;&nbsp;</span>
                @endif
                | {{ $project->title }}
                </p>
            </a>
            <svg class="w-4 h-4 ml-2" fill="none" stroke="red" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"
                @click="isOpen = true; idProject = '{{"/projects/delete/{$project->id}"}}'">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 6h18M12 6v14M5 6l1 14M19 6l-1 14"></path>
            </svg>
        </div>
        @endforeach
        <!-- If there are no projects of logged user -->
        @if (count($projects) < 1)
            <li class="text-center">
            @auth
                <a class="hover:text-red-900" href="{{ route("create") }}">New Project</a>
            @endauth
            </li>
        @endif
        </ul>
    </div>
    @endauth

    <!-- Alert field -->
    @if (session()->has('message'))
    <div class="flex items-center bg-gray-500 text-white text-sm font-bold px-4 py-3 my-5 text-left" role="alert">
        <svg class="fill-current w-4 h-4 mr-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
            <path d="M12.432 0c1.34 0 2.01.912 2.01 1.957 0 1.305-1.164 2.512-2.679 2.512-1.269 0-2.009-.75-1.974-1.99C9.789 1.436 10.67 0 12.432 0zM8.309 20c-1.058 0-1.833-.652-1.093-3.524l1.214-5.092c.211-.814.246-1.141 0-1.141-.317 0-1.689.562-2.502 1.117l-.528-.88c2.572-2.186 5.531-3.467 6.801-3.467 1.057 0 1.233 1.273.705 3.23l-1.391 5.352c-.246.945-.141 1.271.106 1.271.317 0 1.357-.392 2.379-1.207l.6.814C12.098 19.02 9.365 20 8.309 20z"/>
        </svg>
        <p>{!! session('message') !!}</p>
    </div>
    @endif

    <!-- Delete modal -->
    @if (count($projects) > 0)
    <div x-show="isOpen" class="fixed inset-0 flex items-center justify-center z-50">
        <div class="bg-white p-4 shadow-lg rounded-lg">
            <p>Are you sure you want to delete project {{ $project->title }}?</p>
            <div class="mt-4">
                <button @click="isOpen = false" class="px-4 py-2 mr-2 bg-gray-200 hover:bg-gray-300">Cancel</button>
                <button @click="openUrl(idProject)" class="px-4 py-2 bg-red-900 hover:bg-red-600 text-white">Confirm</button>
            </div>
        </div>
    </div>
    @endif
</div>
