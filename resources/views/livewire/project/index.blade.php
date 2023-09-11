<div class="flex-shrink-0 min-w-0" x-data="{ isOpen: false }">
    <div class="text-2xl leading-[4rem]">
        {{ $project->title }}
    </div>
    <img class="w-[480px] mx-auto" src="{{ asset('storage/' . $project->image) }}">
    <div class="mt-2 text-justify">
        {!! $project->description !!}
    </div>
    @guest
    <div class="mt-2 text-right">
        Author: {{ $project->user->name }}
    </div>
    @endguest

    @auth
    <form class="w-full" wire:submit.prevent="update">

        <!-- Radio field -->
        <div class="md:w-2/3 mt-3">
            <div class="flex items-center mb-4">
                <input id="default-radio-1" type="radio" value="1" name="default-radio" wire:model="public"
                    class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                <label for="default-radio-1" class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-400">Public</label>
            </div>
            <div class="flex items-center">
                <input id="default-radio-2" type="radio" value="0" name="default-radio" wire:model="public"
                    class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                <label for="default-radio-2" class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-400">Draft</label>
            </div>
        </div>
        
        <!-- Button field -->
        <div class="items-center">
            <button class="shadow bg-gray-500 hover:bg-red-900 focus:shadow-outline focus:outline-none text-white font-bold py-2 px-4 rounded"
                type="submit">
                Update
            </button>
            <button class="shadow bg-red-900 hover:bg-red-900 focus:shadow-outline focus:outline-none text-white font-bold py-2 px-4 rounded"
                type="button" @click="isOpen = true">
                Delete
            </button>
        </div>
    </form>
    @endauth

    <!-- Alert field -->
    @if (strlen($response) > 0)
    <div class="flex items-center bg-gray-500 text-white text-sm font-bold px-4 py-3 my-5 text-left" role="alert">
        <svg class="fill-current w-4 h-4 mr-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
            <path d="M12.432 0c1.34 0 2.01.912 2.01 1.957 0 1.305-1.164 2.512-2.679 2.512-1.269 0-2.009-.75-1.974-1.99C9.789 1.436 10.67 0 12.432 0zM8.309 20c-1.058 0-1.833-.652-1.093-3.524l1.214-5.092c.211-.814.246-1.141 0-1.141-.317 0-1.689.562-2.502 1.117l-.528-.88c2.572-2.186 5.531-3.467 6.801-3.467 1.057 0 1.233 1.273.705 3.23l-1.391 5.352c-.246.945-.141 1.271.106 1.271.317 0 1.357-.392 2.379-1.207l.6.814C12.098 19.02 9.365 20 8.309 20z"/>
        </svg>
        <p>{!! $response !!}</p>
    </div>
    @endif

    <div x-show="isOpen" class="fixed inset-0 flex items-center justify-center z-50">
        <div class="bg-white p-4 shadow-lg rounded-lg">
            <p>Are you sure you want to perform this action?</p>
            <div class="mt-4">
                <button @click="isOpen = false" class="px-4 py-2 mr-2 bg-gray-200 hover:bg-gray-300">Cancel</button>
                <button @click="isOpen = false" wire:click="deleteById({{ $id }})" class="px-4 py-2 bg-red-900 hover:bg-red-600 text-white">Confirm</button>
            </div>
        </div>
    </div>
</div>