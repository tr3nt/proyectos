<div>
    <div class="text-2xl leading-[4rem]">
        New Project
    </div>
    <form class="w-full" wire:submit.prevent="create">
    
        <!-- Title field -->
        <div class="md:flex md:items-center mb-6">
            <div class="md:w-1/3">
                <label class="block text-gray-500 font-bold md:text-right mb-1 md:mb-0 pr-4" for="inline-title">
                    Title
                </label>
            </div>
            <div class="md:w-2/3">
                <input class="w-[480px] bg-gray-100 appearance-none border-2 border-gray-200 rounded py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-red-900"
                    id="inline-title" type="text" placeholder="Back to the future" wire:model="title">
                @error('title') <span class="text-sm text-red-600">{{ $message }}</span> @enderror
            </div>
        </div>
    
        <!-- Description field -->
        <div class="md:flex md:items-center mb-6">
            <div class="md:w-1/3">
                <label class="block text-gray-500 font-bold md:text-right mb-1 md:mb-0 pr-4" for="editor">
                    Description
                </label>
            </div>
            <div class="md:w-2/3" wire:ignore>
                <textarea class="w-[480px] bg-gray-100 appearance-none border-2 border-gray-200 rounded py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-red-900 h-20"
                    id="editor" wire:model="description"></textarea>
            </div>
        </div>
        <div class="text-center mb-6 text-sm text-red-600">
            @error('description') {{ $message }} @enderror
        </div>
        
        <!-- Image field -->
        <div class="md:flex md:items-center mb-6">
            <div class="md:w-1/3">
                <label class="block text-gray-500 font-bold md:text-right mb-1 md:mb-0 pr-4" for="inline-image">
                    Image
                </label>
            </div>
            <div class="md:w-2/3">
                <input class="block w-[480px] text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400"
                    id="inline-image" type="file" wire:model="image">
                @error('image') <span class="text-sm text-red-600">{{ $message }}</span> @enderror
            </div>
        </div>

        <!-- Radio field -->
        <div class="md:flex md:items-center mb-6">
            <div class="md:w-1/3">
                <label class="block text-gray-500 font-bold md:text-right mb-1 md:mb-0 pr-4" for="inline-image">
                    Status
                </label>
            </div>
            <div class="md:w-2/3">
                <div class="flex items-center mb-4">
                    <input id="default-radio-1" type="radio" value="1" name="default-radio" wire:model="public"
                        class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                    <label for="default-radio-1" class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-400">Public</label>
                </div>
                <div class="flex items-center">
                    <input checked id="default-radio-2" type="radio" value="0" name="default-radio" wire:model="public"
                        class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                    <label for="default-radio-2" class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-400">Draft</label>
                </div>
                @error('public') <span class="text-sm text-red-600">{{ $message }}</span> @enderror
            </div>
        </div>
        
        <!-- Button field -->
        <div class="md:flex md:items-center">
            <div class="md:w-1/3"></div>
            <div class="md:w-2/3 lg:text-left">
                <button class="shadow bg-gray-500 hover:bg-red-900 focus:shadow-outline focus:outline-none text-white font-bold py-2 px-4 rounded"
                    type="submit">
                    Create
                </button>
            </div>
        </div>
    </form>

    <!-- Alert field -->
    @if (session()->has('message'))
    <div class="flex items-center bg-gray-500 text-white text-sm font-bold px-4 py-3 my-5 text-left" role="alert">
        <svg class="fill-current w-4 h-4 mr-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
            <path d="M12.432 0c1.34 0 2.01.912 2.01 1.957 0 1.305-1.164 2.512-2.679 2.512-1.269 0-2.009-.75-1.974-1.99C9.789 1.436 10.67 0 12.432 0zM8.309 20c-1.058 0-1.833-.652-1.093-3.524l1.214-5.092c.211-.814.246-1.141 0-1.141-.317 0-1.689.562-2.502 1.117l-.528-.88c2.572-2.186 5.531-3.467 6.801-3.467 1.057 0 1.233 1.273.705 3.23l-1.391 5.352c-.246.945-.141 1.271.106 1.271.317 0 1.357-.392 2.379-1.207l.6.814C12.098 19.02 9.365 20 8.309 20z"/>
        </svg>
        <p>{!! session('message') !!}</p>
    </div>
    @endif

    <!-- CKEditor WYSIWYG -->
    @push('js')
        <script src="https://cdn.ckeditor.com/ckeditor5/27.1.0/classic/ckeditor.js"></script>
        <script>
            ClassicEditor
                .create(document.querySelector('#editor'), {
                    toolbar: [ 'bold', 'italic', 'bulletedList', 'numberedList' ],
                })
                .then(function(editor){
                    editor.model.document.on('change:data', () => {
                        @this.set('description', editor.getData());
                    })
                })
                .catch(error => {
                    console.error(error)
                });
        </script>
    @endpush
</div>
