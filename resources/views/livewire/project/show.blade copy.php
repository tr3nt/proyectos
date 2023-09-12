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

    <div x-show="isOpen" class="fixed inset-0 flex items-center justify-center z-50">
        <div class="bg-white p-4 shadow-lg rounded-lg">
            <p>Are you sure you want to delete project {{ $project->title }}?</p>
            <div class="mt-4">
                <button @click="isOpen = false" class="px-4 py-2 mr-2 bg-gray-200 hover:bg-gray-300">Cancel</button>
                <button @click="isOpen = false" wire:click="delete" class="px-4 py-2 bg-red-900 hover:bg-red-600 text-white">Confirm</button>
            </div>
        </div>
    </div>
</div>