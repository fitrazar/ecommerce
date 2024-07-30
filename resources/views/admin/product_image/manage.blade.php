@section('title', isset($product_image) ? 'Edit Gambar Produk' : 'Tambah Gambar Produk')

<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <x-card.card-default class="static">
                <a href="{{ route('product_image.index') }}">
                    <x-button.info-button>
                        <i class="fa-solid fa-arrow-left"></i>
                        Kembali
                    </x-button.info-button>
                </a>

                <x-form
                    action="{{ isset($product_image) ? route('product_image.update', $product_image->id) : route('product_image.store') }}"
                    method="POST" class="md:grid md:grid-cols-2 gap-4" enctype="multipart/form-data">
                    @csrf
                    @if (isset($product_image))
                        @method('PATCH')
                    @endif

                    {{-- Product  --}}
                    <div class="mt-4">
                        <x-input.input-label for="product_id" :value="__('Product')" />
                        <select name="product_id" id="product_id" class="mt-1 w-full form-select">
                            <option value="">{{ __('Pilih product') }}</option>
                            @foreach ($products as $product)
                                <option value="{{ $product->id }}"
                                    {{ old('product_id', $product_image->product_id ?? '') == $product->id ? 'selected' : '' }}>
                                    {{ $product->name }}
                                </option>
                            @endforeach
                        </select>
                        <x-input.input-error :messages="$errors->get('product_id')" class="mt-2" />
                    </div>


                    {{-- Gambar --}}
                    <div class="mt-4">
                        {{-- @if ($product->cover ?? '')
                            <div class="avatar">
                                <div class="w-[200px] rounded-xl">
                                    <img src="{{ asset('storage/' . $product->cover ?? '') }}" />
                                </div>
                            </div>
                        @endif --}}
                        <x-input.input-label for="image" :value="__('Gambar')" />
                        <input type="file" id="image" name="image[]" />
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
        <script src="https://unpkg.com/filepond@^4/dist/filepond.js"></script>
        <script>
            FilePond.registerPlugin(FilePondPluginImagePreview);
            FilePond.registerPlugin(FilePondPluginFileValidateType);
        </script>
        <script>
            const inputElement = document.querySelector('#image');
            const pond = FilePond.create(inputElement, {
                acceptedFileTypes: ['image/*'],
                allowMultiple: true,
                server: {
                    process: '{{ route('upload_product_images') }}',
                    revert: '{{ route('revert_product_images') }}',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    // files: @json(isset($product_images) ? $images : []),
                }
            });
        </script>
        {{-- <script>
            const pond = FilePond.create(inputElement, {
                acceptedFileTypes: ['image/*'],
                server: {
                    load: (source, load, error, progress, abort, headers) => {
                        const myRequest = new Request(source);
                        fetch(myRequest).then((res) => {
                            return res.blob();
                        }).then(load);
                    },
                    process: '{{ route('upload_cover') }}',
                    revert: '{{ route('revert_cover') }}',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    }
                },
                files: [{
                    source: '{{ isset($product) ? Storage::url($product->cover) : '' }}',
                    options: {
                        type: 'local',
                    },
                }],
            });
        </script> --}}
    </x-slot>
    @push('styles')
        <link href="https://unpkg.com/filepond@^4/dist/filepond.css" rel="stylesheet" />
        <link href="https://unpkg.com/filepond-plugin-image-preview/dist/filepond-plugin-image-preview.css"
            rel="stylesheet" />
    @endpush
</x-app-layout>
