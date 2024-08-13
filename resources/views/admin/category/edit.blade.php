@section('title', 'Edit Data Kategori')

<x-app-layout>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <x-card.card-default class="static">
                <a href="{{ route('category.index') }}">
                    <x-button.info-button>
                        <i class="fa-solid fa-arrow-left"></i>
                        Kembali
                    </x-button.info-button>
                </a>

                <x-form action="{{ route('category.update', $category->slug) }}" class="md:grid md:grid-cols-2 gap-4"
                    enctype="multipart/form-data">
                    @csrf
                    @method('PATCH')

                    <div class="mt-4">
                        <x-input.input-label for="image" :value="__('Gambar')" />
                        @if ($category->image)
                            <span class="text-xs text-gray-400">{{ __('Gambar Sebelumnya') }}</span>
                            <div
                                class="preview w-full rounded-xl border overflow-hidden flex items-center justify-center mt-1 p-2 box-border">
                                <img src="{{ asset('storage/category/' . $category->image) }}" />
                            </div>
                        @endif
                        <input type="file" id="image" name="image" class="mt-2" />
                        <x-input.input-error :messages="$errors->get('image')" class="mt-2" />
                    </div>

                    <div class="mt-4">
                        <x-input.input-label for="name" :value="__('Nama Kategori')" />
                        <x-input.text-input id="name" class="mt-1 w-full" type="text" name="name"
                            :value="old('name', $category->name)" autofocus autocomplete="name" />
                        <x-input.input-error :messages="$errors->get('name')" class="mt-2" />
                    </div>

                    {{-- Hidden Input --}}
                    <x-input.text-input id="slug" class="mt-1 w-full" type="hidden" name="slug"
                        :value="old('slug', $category->slug)" autofocus autocomplete="slug" />

                    <div class="mt-4 col-span-2">
                        <x-input.input-label for="status" class="label cursor-pointer mr-6">
                            <x-input.checkbox name="status" id="status" :value="old('status', $category->status) == true ? ' ' : ' checked'" :title="__('Sembunyikan?')" />
                        </x-input.input-label>
                    </div>

                    <div class="col-span-2">
                        <x-button.primary-button type="submit">
                            {{ __('Simpan') }}
                        </x-button.primary-button>
                    </div>

                </x-form>
            </x-card.card-default>
        </div>
    </div>
    <x-slot name="script">
        <script src="https://unpkg.com/filepond-plugin-file-validate-type/dist/filepond-plugin-file-validate-type.js"></script>
        <script src="https://unpkg.com/filepond-plugin-image-preview/dist/filepond-plugin-image-preview.js"></script>
        <script src="https://unpkg.com/filepond-plugin-file-validate-size/dist/filepond-plugin-file-validate-size.js"></script>
        <script src="https://unpkg.com/filepond@^4/dist/filepond.js"></script>
        <script>
            const name = document.querySelector("#name");
            const slug = document.querySelector("#slug");

            name.addEventListener("keyup", function() {
                let preslug = name.value;
                preslug = preslug.replace(/[^a-zA-Z0-9\s]/g, "");
                preslug = preslug.replace(/ /g, "-");
                slug.value = preslug.toLowerCase();
            });
            FilePond.registerPlugin(FilePondPluginImagePreview);
            FilePond.registerPlugin(FilePondPluginFileValidateType);
            FilePond.registerPlugin(FilePondPluginFileValidateSize);

            const inputElement = document.querySelector('#image');
            const pond = FilePond.create(inputElement, {
                maxFileSize: '2MB',
                credits: false,
                acceptedFileTypes: ['image/*'],
                server: {
                    process: '{{ route('upload_category') }}',
                    revert: '{{ route('revert_category') }}',
                    load: (source, load, error, progress, abort, headers) => {
                        const myRequest = new Request(source);
                        fetch(myRequest).then((res) => res.blob()).then(load);
                    },
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    }
                },
                @if (isset($category->image))
                    files: [{
                        source: '{{ $category->image }}',
                        options: {
                            type: 'local'
                        }
                    }],
                @endif
            });
        </script>
    </x-slot>
    @push('styles')
        <link href="https://unpkg.com/filepond@^4/dist/filepond.css" rel="stylesheet" />
        <link href="https://unpkg.com/filepond-plugin-image-preview/dist/filepond-plugin-image-preview.css"
            rel="stylesheet" />
    @endpush
</x-app-layout>
