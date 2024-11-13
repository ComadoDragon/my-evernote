<x-app-layout>
    <div class="max-w-3xl mx-auto p-4 sm:p-6 lg:p-8">
        <form method="POST" action="{{ route('documents.update', $document) }}">
            @csrf
            @method('patch')
            <div class="mb-4">
                <input type="text" 
                name="title" 
                class="block w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm" value="{{ old('title', $document->title) }}"/>
                <x-input-error :messages="$errors->get('title')" class="mt-2" />
            </div>
            <div class="mb-4">
                <input
                id="description"
                name="description"
                type="hidden"
                class="block w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm"
                />
                <trix-editor input="description" class="bg-white trix-content">{!! old('description', $document->description) !!}</trix-editor>
                <x-input-error :messages="$errors->get('description')" class="mt-2" />
            </div>           
            <div class="mt-4 space-x-2">
                <x-primary-button>{{ __('Save') }}</x-primary-button>
                <a href="{{ route('documents.index') }}">{{ __('Cancel') }}</a>
            </div>
        </form>
    </div>
    @push('scripts')
        <script type="text/javascript" src="https://unpkg.com/trix@2.0.8/dist/trix.umd.min.js"></script>
    @endpush
</x-app-layout>