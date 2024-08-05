@section('title', isset($setting) ? 'Edit Pengaturan' : 'Tambah Pengaturan')

<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <x-card.card-default class="static">
                <a href="{{ route('dashboard') }}">
                    <x-button.info-button>
                        <i class="fa-solid fa-arrow-left"></i>
                        Kembali
                    </x-button.info-button>
                </a>

                <x-form action="{{ isset($setting) ? route('setting.update', $setting->id) : route('setting.store') }}"
                    method="POST" class="md:grid md:grid-cols-2 gap-4" enctype="multipart/form-data">
                    @csrf
                    @if (isset($setting))
                        @method('PATCH')
                    @endif

                    {{-- Name --}}
                    <div class="mt-4">
                        <x-input.input-label for="name" :value="__('Nama Toko')" />
                        <x-input.text-input id="name" class="mt-1 w-full" type="text" name="name"
                            :value="old('name', $setting->name ?? '')" autofocus autocomplete="name" />
                        <x-input.input-error :messages="$errors->get('name')" class="mt-2" />
                    </div>

                    {{-- Alias --}}
                    <div class="mt-4">
                        <x-input.input-label for="alias" :value="__('Alias')" />
                        <x-input.text-input id="alias" class="mt-1 w-full" type="text" name="alias"
                            :value="old('alias', $setting->alias ?? '')" autofocus autocomplete="alias" />
                        <x-input.input-error :messages="$errors->get('alias')" class="mt-2" />
                    </div>


                    {{-- Description --}}
                    <div class="mt-4 col-span-2">
                        <x-input.input-label for="description" :value="__('Deskripsi')" />
                        <x-input.text-area id="description" class="mt-1 w-full" name="description" rows="4"
                            :value="old('description', $setting->description ?? '')" />
                        <x-input.input-error :messages="$errors->get('description')" class="mt-2" />
                    </div>

                    {{-- Logo --}}
                    <div class="mt-4">
                        <x-input.input-label for="logo" :value="__('Logo')" />
                        @if (isset($setting) && $setting->logo)
                            <span class="text-xs text-gray-400">{{ __('Logo Sebelumnya') }}</span>
                            <div
                                class="preview w-full rounded-xl border overflow-hidden flex items-center justify-center mt-1 p-2 box-border">
                                <img src="{{ asset('storage/setting/' . $setting->logo) }}" class="w-32" />
                            </div>
                        @endif
                        <span class="text-xs text-gray-400">{{ __('*Logo ecommerce anda') }}</span>
                        <input type="file" id="logo" name="logo" class="mt-1" />
                        <x-input.input-error :messages="$errors->get('logo')" class="mt-2" />
                    </div>

                    {{-- Banner  --}}
                    <div class="mt-4">
                        <x-input.input-label for="banner" :value="__('Banner')" />
                        @if ($setting->banner->count())
                            <span class="text-xs text-gray-400">{{ __('Banner Sebelumnya') }}</span>
                            <div class="carousel w-full relative mt-2 border rounded-xl">
                                @foreach ($setting->banner as $index => $bannerImage)
                                    <div class="carousel-item w-full flex justify-center h-[200px] {{ $index === 0 ? 'block' : 'hidden' }}"
                                        data-slide="{{ $index }}">
                                        <img src="{{ asset('storage/banner/' . $bannerImage->image) }}"
                                            class="max-w-full max-h-full m-2 object-cover border rounded-xl"
                                            alt="Banner Image" />
                                    </div>
                                @endforeach
                                <div
                                    class="absolute left-5 right-5 top-1/2 flex -translate-y-1/2 transform justify-between">
                                    <button type="button" class="btn btn-circle carousel-prev">❮</button>
                                    <button type="button" class="btn btn-circle carousel-next">❯</button>
                                </div>
                            </div>
                        @endif
                        <span class="text-xs text-gray-400">{{ __('*Bisa lebih dari satu') }}</span>
                        <input type="file" id="banner" name="banner[]" class="mt-1" />
                        <x-input.input-error :messages="$errors->get('banner')" class="mt-2" />
                    </div>

                    {{-- Phone --}}
                    <div class="mt-4">
                        <x-input.input-label for="phone" :value="__('No. HP')" />
                        <span class="text-xs text-gray-400">{{ __('*Masukkan No Hp anda') }}</span>
                        <x-input.text-input id="phone" class="mt-1 w-full" type="text" inputmode="numeric"
                            name="phone" :value="old('phone', $setting->phone ?? '')" autofocus autocomplete="phone" />
                        <x-input.input-error :messages="$errors->get('phone')" class="mt-2" />
                    </div>

                    {{-- Address --}}
                    <div class="mt-4">
                        <x-input.input-label for="address" :value="__('Alamat')" />
                        <span class="text-xs text-gray-400">{{ __('*Masukkan alamat lengkap anda') }}</span>
                        <x-input.text-input id="address" class="mt-1 w-full" type="text" inputmode="numeric"
                            name="address" :value="old('address', $setting->address ?? '')" autofocus autocomplete="address" />
                        <x-input.input-error :messages="$errors->get('address')" class="mt-2" />
                    </div>

                    {{-- Instagram --}}
                    <div class="mt-4">
                        <x-input.input-label for="instagram" :value="__('Instagram')" />
                        <span class="text-xs text-gray-400">{{ __('*Masukkan url instagram anda') }}</span>
                        <x-input.text-input id="instagram" class="mt-1 w-full" type="text" name="instagram"
                            :value="old('instagram', $setting->instagram ?? '')" autofocus autocomplete="instagram" />
                        <x-input.input-error :messages="$errors->get('instagram')" class="mt-2" />
                    </div>

                    {{-- X --}}
                    <div class="mt-4">
                        <x-input.input-label for="x" :value="__('x')" />
                        <span class="text-xs text-gray-400">{{ __('*Masukkan url X anda') }}</span>
                        <x-input.text-input id="x" class="mt-1 w-full" type="text" name="x"
                            :value="old('x', $setting->x ?? '')" autofocus autocomplete="x" />
                        <x-input.input-error :messages="$errors->get('x')" class="mt-2" />
                    </div>

                    {{-- Facebook --}}
                    <div class="mt-4">
                        <x-input.input-label for="facebook" :value="__('Facebook')" />
                        <span class="text-xs text-gray-400">{{ __('*Masukkan url facebook anda') }}</span>
                        <x-input.text-input id="facebook" class="mt-1 w-full" type="text" name="facebook"
                            :value="old('facebook', $setting->facebook ?? '')" autofocus autocomplete="facebook" />
                        <x-input.input-error :messages="$errors->get('facebook')" class="mt-2" />
                    </div>

                    {{-- Email --}}
                    <div class="mt-4">
                        <x-input.input-label for="email" :value="__('Email')" />
                        <span class="text-xs text-gray-400">{{ __('*Masukkan email anda') }}</span>
                        <x-input.text-input id="email" class="mt-1 w-full" type="email" name="email"
                            :value="old('email', $setting->email ?? '')" autofocus autocomplete="email" />
                        <x-input.input-error :messages="$errors->get('email')" class="mt-2" />
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

            const inputElement = document.querySelector('#logo');
            const pond = FilePond.create(inputElement, {
                credits: false,
                acceptedFileTypes: ['image/*'],
                allowFileSizeValidation	: true,
                maxFileSize: '2MB',
                server: {
                    process: '{{ route('upload_logo') }}',
                    revert: '{{ route('revert_logo') }}',
                    @if (isset($setting) && $setting->logo)
                        load: (source, load, error, progress, abort, headers) => {
                            const myRequest = new Request(source);
                            fetch(myRequest).then((res) => res.blob()).then(load);
                        },
                    @endif
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                },
                @if (isset($setting) && $setting->logo)
                    files: [{
                        source: '{{ $setting->logo }}',
                        options: {
                            type: 'local'
                        }
                    }],
                @endif
            });

            const items = document.querySelectorAll('.carousel-item');
            let currentIndex = 0;

            const showSlide = (index) => {
                items.forEach((item, i) => {
                    item.classList.toggle('block', i === index);
                    item.classList.toggle('hidden', i !== index);
                });
                currentIndex = index;
            };

            document.querySelector('.carousel-prev').addEventListener('click', () => {
                const newIndex = (currentIndex - 1 + items.length) % items.length;
                showSlide(newIndex);
            });

            document.querySelector('.carousel-next').addEventListener('click', () => {
                const newIndex = (currentIndex + 1) % items.length;
                showSlide(newIndex);
            });
        </script>
        <script>
            const bannerInput = document.querySelector('#banner');
            FilePond.create(bannerInput, {
                allowMultiple: true,
                credits: false,
                acceptedFileTypes: ['image/*'],
                allowFileSizeValidation	: true,
                maxFileSize: '2MB',
                server: {
                    process: '{{ route('upload_banner') }}',
                    revert: '{{ route('revert_banner') }}',
                    @if (isset($setting) && $setting->banner->count() > 0)
                        load: (source, load, error, progress, abort, headers) => {
                            const myRequest = new Request(source);
                            fetch(myRequest).then((res) => res.blob()).then(load);
                        },
                    @endif
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                },
                @if (isset($setting) && $setting->banner->count() > 0)
                    files: [
                        @foreach ($banner as $bannerImage)
                            {
                                source: '{{ $bannerImage->image }}',
                                options: {
                                    type: 'local'
                                }
                            },
                        @endforeach
                    ],
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
