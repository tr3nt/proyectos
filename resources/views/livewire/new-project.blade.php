@extends('app')

@section('content')
<form>
    <div class="space-y-12">
        <div class="border-b border-gray-900/10 pb-12">
        <h2 class="text-base font-semibold leading-7 text-gray-900">Project</h2>
        
        <div class="mt-10 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">

            <!-- TITLE field -->
            <div class="col-span-full">
            <label for="title" class="block text-sm font-medium leading-6 text-gray-900">Title</label>
            <div class="mt-2">
                <div class="flex rounded-md shadow-sm ring-1 ring-inset ring-gray-300 focus-within:ring-2 focus-within:ring-inset focus-within:ring-indigo-600">
                    <input type="text" name="title" id="title" autocomplete="title"
                        class="block w-full flex-1 border-0 bg-transparent py-1.5 pl-1 text-gray-900 placeholder:text-gray-400 focus:ring-0 sm:text-sm sm:leading-6">
                </div>
            </div>
            </div>
    
            <!-- DESCRIPTION field -->
            <div class="col-span-full">
            <label for="desc" class="block text-sm font-medium leading-6 text-gray-900">Description</label>
            <div class="mt-2">
                <textarea id="desc" name="description" rows="3" 
                    class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"></textarea>
            </div>
            </div>
    
            <!-- IMAGE field -->
            <div class="col-span-full">
            <label for="image" class="block text-sm font-medium leading-6 text-gray-900">Image</label>
            <div class="mt-2 flex justify-center rounded-lg border border-dashed border-gray-900/25 px-6 py-10">
                <div class="text-center">
                <svg class="mx-auto h-12 w-12 text-gray-300" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true">
                    <path fill-rule="evenodd" d="M1.5 6a2.25 2.25 0 012.25-2.25h16.5A2.25 2.25 0 0122.5 6v12a2.25 2.25 0 01-2.25 2.25H3.75A2.25 2.25 0 011.5 18V6zM3 16.06V18c0 .414.336.75.75.75h16.5A.75.75 0 0021 18v-1.94l-2.69-2.689a1.5 1.5 0 00-2.12 0l-.88.879.97.97a.75.75 0 11-1.06 1.06l-5.16-5.159a1.5 1.5 0 00-2.12 0L3 16.061zm10.125-7.81a1.125 1.125 0 112.25 0 1.125 1.125 0 01-2.25 0z" clip-rule="evenodd" />
                </svg>
                <div class="mt-4 flex text-sm leading-6 text-gray-600">
                    <label for="file-upload" class="mx-auto relative cursor-pointer rounded-md bg-white font-semibold text-indigo-600 focus-within:outline-none focus-within:ring-2 focus-within:ring-indigo-600 focus-within:ring-offset-2 hover:text-indigo-500">
                    <span>Upload a file</span>
                    <input id="image" name="image" type="file" class="sr-only">
                    </label>
                </div>
                <p class="text-xs leading-5 text-gray-600">PNG, JPG, GIF up to 10MB</p>
                </div>
            </div>
            </div>
    
            <!-- STATUS field -->
            <div class="mt-10 space-y-10">
                <fieldset>
                <legend class="text-sm font-semibold leading-6 text-gray-900">Status</legend>
                <div class="mt-6 space-y-6">
                    <div class="flex items-center gap-x-3">
                    <input id="public" name="status" type="radio" checked="true"
                        class="h-4 w-4 border-gray-300 text-indigo-600 focus:ring-indigo-600">
                    <label for="public" class="block text-sm font-medium leading-6 text-gray-900">Public</label>
                    </div>
                    <div class="flex items-center gap-x-3">
                    <input id="draft" name="status" type="radio"
                        class="h-4 w-4 border-gray-300 text-indigo-600 focus:ring-indigo-600">
                    <label for="draft" class="block text-sm font-medium leading-6 text-gray-900">Draft</label>
                    </div>
                </div>
                </fieldset>
            </div>
            </div>
        </div>
        </div>
    
        <!-- BUTTONS field -->
        <div class="mt-6 flex items-center justify-end gap-x-6">
            <button type="button" onclick="window.location.href='{{ url('/') }}'"
                class="text-sm font-semibold leading-6 text-gray-900">Cancel</button>
            <button type="submit"
                class="rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Save</button>
        </div>
    </div>
</form>
@endsection