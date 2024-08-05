@section('title', isset($color) ? 'Edit Warna' : 'Tambah Warna')

<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <x-card.card-default class="static">
                <a href="{{ route('color.index') }}">
                    <x-button.info-button>
                        <i class="fa-solid fa-arrow-left"></i>
                        Kembali
                    </x-button.info-button>
                </a>

                <x-form action="{{ isset($color) ? route('color.update', $color->id) : route('color.store') }}"
                    method="POST" class="md:grid md:grid-cols-2 gap-4" enctype="multipart/form-data">
                    @csrf
                    @if (isset($color))
                        @method('PATCH')
                    @endif

                    {{-- Name --}}
                    <div class="mt-4">
                        <x-input.input-label for="name" :value="__('Nama Warna')" />
                        <x-input.text-input id="name" class="mt-1 w-full" type="text" name="name"
                            :value="old('name', $color->name ?? '')" autofocus autocomplete="name" />
                        <x-input.input-error :messages="$errors->get('name')" class="mt-2" />
                    </div>

                    {{-- Image --}}
                    <div class="mt-4">
                        <x-input.input-label for="image" :value="__('Gambar')" />
                        @if ($color->image)
                            <span class="text-xs text-gray-400">{{ __('Gambar Sebelumnya') }}</span>
                            <div
                                class="preview w-full rounded-xl border overflow-hidden flex items-center justify-center mt-1 p-2 box-border">
                                <img src="{{ asset('storage/color/' . $color->image) }}" />
                            </div>
                        @endif
                        <input type="file" id="image" name="image" />
                        <x-input.input-error :messages="$errors->get('image')" class="mt-2" />
                    </div>


                    {{-- Submit Button --}}
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
            FilePond.registerPlugin(FilePondPluginImagePreview);
            FilePond.registerPlugin(FilePondPluginFileValidateType);
            FilePond.registerPlugin(FilePondPluginFileValidateSize);


            const inputElement = document.querySelector('#image');
            const pond = FilePond.create(inputElement, {
                maxFileSize: '2MB',
                credits: false,
                acceptedFileTypes: ['image/*'],
                server: {
                    process: '{{ route('upload_color') }}',
                    revert: '{{ route('revert_color') }}',
                    @if ($color->image)
                        load: (source, load, error, progress, abort, headers) => {
                            const myRequest = new Request(source);
                            fetch(myRequest).then((res) => res.blob()).then(load);
                        },
                    @endif
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                },
                @if ($color->image)
                    files: [{
                        source: '{{ $color->image }}',
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
