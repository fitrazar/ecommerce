@section('title', isset($size) ? 'Edit Ukuran' : 'Tambah Ukuran')

<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <x-card.card-default class="static">
                <a href="{{ route('size.index') }}">
                    <x-button.info-button>
                        <i class="fa-solid fa-arrow-left"></i>
                        Kembali
                    </x-button.info-button>
                </a>

                <x-form action="{{ isset($size) ? route('size.update', $size->id) : route('size.store') }}" method="POST"
                    class="md:grid md:grid-cols-2 gap-4" enctype="multipart/form-data">
                    @csrf
                    @if (isset($size))
                        @method('PATCH')
                    @endif

                    {{-- Size Number --}}
                    <div class="mt-4">
                        <x-input.input-label for="size_number" :value="__('Nomor Ukuran')" />
                        <x-input.text-input id="size_number" class="mt-1 w-full" type="number" name="size_number"
                            :value="old('size_number', $size->size_number ?? '')" autofocus autocomplete="size_number" />
                        <x-input.input-error :messages="$errors->get('size_number')" class="mt-2" />
                    </div>

                    {{-- Size Chart --}}
                    <div class="mt-4">
                        <x-input.input-label for="size_chart" :value="__('Size Chart')" />
                        <x-input.input-file id="size_chart" class="mt-1 w-full" type="text" name="size_chart"
                            :value="old('size_chart', $size->size_chart ?? '')" autofocus autocomplete="size_chart" />
                        <x-input.input-error :messages="$errors->get('size_chart')" class="mt-2" />
                    </div>

                    {{-- Status --}}
                    <div class="mt-4 col-span-2">
                        <x-input.input-label for="status" class="label cursor-pointer mr-6">
                            <x-input.checkbox name="status" id="status" :title="__('Sembunyikan?')" />
                        </x-input.input-label>
                        <x-input.input-error :messages="$errors->get('status')" class="mt-2" />
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
        <script>
            const name = document.querySelector("#name");

            function previewImage() {
                const image = document.querySelector('#image')
                const imgPreview = document.querySelector('.imgPreview')

                imgPreview.style.display = 'block';
                imgPreview.style.width = '200px';

                const oFReader = new FileReader()
                oFReader.readAsDataURL(image.files[0])
                oFReader.onload = function(oFREvent) {
                    imgPreview.src = oFREvent.target.result
                }
            }
        </script>
    </x-slot>
</x-app-layout>
