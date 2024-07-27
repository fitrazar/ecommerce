{{-- penerapan manage agar mempermudah crud --}}
{{-- penambahan "old" pada value input yang diambil untuk mengedit data --}}
@section('title', isset($product) ? 'Edit Product' : 'Tambah Product')

<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <x-card.card-default class="static">
                <a href="{{ route('product.index') }}">
                    <x-button.info-button>
                        <i class="fa-solid fa-arrow-left"></i>
                        Kembali
                    </x-button.info-button>
                </a>

                <x-form action="{{ isset($product) ? url('/admin/product/' . $product->slug) : url('/admin/product') }}"
                    method="POST" class="md:grid md:grid-cols-2 gap-4" enctype="multipart/form-data">
                    @csrf
                    @if (isset($product))
                        @method('PATCH')
                    @endif

                    {{-- Name --}}
                    <div class="mt-4">
                        <x-input.input-label for="name" :value="__('Nama Product')" />
                        <x-input.text-input id="name" class="mt-1 w-full" type="text" name="name"
                            :value="old('name', $product->name ?? '')" autofocus autocomplete="name" />
                        <x-input.input-error :messages="$errors->get('name')" class="mt-2" />
                    </div>

                    {{-- Slug --}}
                    <x-input.text-input id="slug" class="mt-1 w-full" type="hidden" name="slug"
                        :value="old('slug', $product->slug ?? '')" autofocus autocomplete="slug" />

                    {{-- Brand --}}
                    <div class="mt-4">
                        <x-input.input-label for="brand_id" :value="__('Brand')" />
                        <select name="brand_id" id="brand_id" class="mt-1 w-full form-select">
                            <option value="">{{ __('Pilih Brand') }}</option>
                            @foreach ($brands as $brand)
                                <option value="{{ $brand->id }}"
                                    {{ old('brand_id', $product->brand_id ?? '') == $brand->id ? 'selected' : '' }}>
                                    {{ $brand->name }}
                                </option>
                            @endforeach
                        </select>
                        <x-input.input-error :messages="$errors->get('brand_id')" class="mt-2" />
                    </div>

                    {{-- Category --}}
                    <div class="mt-4">
                        <x-input.input-label for="category_id" :value="__('Kategori')" />
                        <select name="category_id" id="category_id" class="mt-1 w-full form-select">
                            <option value="">{{ __('Pilih Kategori') }}</option>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}"
                                    {{ old('category_id', $product->category_id ?? '') == $category->id ? 'selected' : '' }}>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                        <x-input.input-error :messages="$errors->get('category_id')" class="mt-2" />
                    </div>

                    {{-- Material --}}
                    <div class="mt-4">
                        <x-input.input-label for="material_id" :value="__('Material')" />
                        <select name="material_id" id="material_id" class="mt-1 w-full form-select">
                            <option value="">{{ __('Pilih Material') }}</option>
                            @foreach ($materials as $material)
                                <option value="{{ $material->id }}"
                                    {{ old('material_id', $product->material_id ?? '') == $material->id ? 'selected' : '' }}>
                                    {{ $material->name }}
                                </option>
                            @endforeach
                        </select>
                        <x-input.input-error :messages="$errors->get('material_id')" class="mt-2" />
                    </div>

                    {{-- Unit --}}
                    <div class="mt-4">
                        <x-input.input-label for="unit_id" :value="__('Unit')" />
                        <select name="unit_id" id="unit_id" class="mt-1 w-full form-select">
                            <option value="">{{ __('Pilih Unit') }}</option>
                            @foreach ($units as $unit)
                                <option value="{{ $unit->id }}"
                                    {{ old('unit_id', $product->unit_id ?? '') == $unit->id ? 'selected' : '' }}>
                                    {{ $unit->name }}
                                </option>
                            @endforeach
                        </select>
                        <x-input.input-error :messages="$errors->get('unit_id')" class="mt-2" />
                    </div>

                    {{-- Model Number --}}
                    <div class="mt-4">
                        <x-input.input-label for="model_number" :value="__('Nomor Model')" />
                        <x-input.text-input id="model_number" class="mt-1 w-full" type="text" name="model_number"
                            :value="old('model_number', $product->model_number ?? '')" autocomplete="model_number" />
                        <x-input.input-error :messages="$errors->get('model_number')" class="mt-2" />
                    </div>

                    {{-- Description --}}
                    <div class="mt-4 col-span-2">
                        <x-input.input-label for="description" :value="__('Deskripsi')" />
                        <x-input.text-area id="description" class="mt-1 w-full" name="description" rows="4"
                            :value="old('description', $product->description ?? '')" />
                        <x-input.input-error :messages="$errors->get('description')" class="mt-2" />
                    </div>

                    {{-- Cover --}}
                    <div class="mt-4">
                        <input type="hidden" name="oldCover" value="{{ $product->cover ?? '' }}">
                        @if ($product->cover ?? '')
                            <div class="avatar">
                                <div class="w-[200px] rounded-xl">
                                    <img src="{{ asset('storage/product/' . $product->cover ?? '') }}" />
                                </div>
                            </div>
                        @endif
                        <img class="coverPreview h-auto max-w-lg mx-auto hidden" alt="cover">
                        <x-input.input-label for="cover" :value="__('Cover')" />
                        <x-input.input-file id="cover" class="mt-1 w-full" type="file" name="cover"
                            :value="old('cover')" autofocus autocomplete="cover" onchange="previewCover()" />
                        <x-input.input-error :messages="$errors->get('cover')" class="mt-2" />
                    </div>

                    {{-- Stock --}}
                    <div class="mt-4">
                        <x-input.input-label for="stock" :value="__('Stok')" />
                        <x-input.text-input id="stock" class="mt-1 w-full" type="number" name="stock"
                            :value="old('stock', $product->stock ?? 0)" min="0" />
                        <x-input.input-error :messages="$errors->get('stock')" class="mt-2" />
                    </div>

                    {{-- Color --}}
                    <div class="mt-4">
                        <x-input.input-label for="colors" :value="__('Warna')" style="width: 100%" />
                        <div id="color-checkboxes">
                            @foreach ($colors as $color)
                                <div class="color-checkbox flex items-center mb-2 gap-2">
                                    <input type="checkbox" class="checkbox" name="colors[]"
                                        id="color-{{ $color->id }}" value="{{ $color->id }}"
                                        {{ in_array($color->id, old('colors', $selectedColorIds ?? [])) ? 'checked' : '' }} />
                                    <img src="{{ asset('storage/color/' . $color->image) }}"
                                        class="color-preview ml-2 w-[40px] h-[40px] rounded-full"
                                        alt="{{ $color->name }}" />
                                    <span>{{ $color->name }}</span>
                                </div>
                            @endforeach
                        </div>
                        <x-input.input-error :messages="$errors->get('colors')" class="mt-2" />
                    </div>

                    {{-- Type --}}
                    <div class="mt-4">
                        <x-input.input-label for="type" :value="__('Tipe')" />
                        <x-input.text-input id="type" class="mt-1 w-full" type="text" name="type"
                            :value="old('type', $product->type ?? '')" autocomplete="type" />
                        <x-input.input-error :messages="$errors->get('type')" class="mt-2" />
                    </div>

                    {{-- Size --}}
                    <div class="mt-4">
                        <x-input.input-label for="size" :value="__('Size')" />
                        <select name="size" id="size" class="mt-1 w-full form-select">
                            <option value="">{{ __('Pilih Ukuran') }}</option>
                            <option value="XS" {{ old('size', $product->size ?? '') == 'XS' ? 'selected' : '' }}>
                                {{ __('XS') }}</option>
                            <option value="S" {{ old('size', $product->size ?? '') == 'S' ? 'selected' : '' }}>
                                {{ __('S') }}</option>
                            <option value="M" {{ old('size', $product->size ?? '') == 'M' ? 'selected' : '' }}>
                                {{ __('M') }}</option>
                            <option value="L" {{ old('size', $product->size ?? '') == 'L' ? 'selected' : '' }}>
                                {{ __('L') }}</option>
                            <option value="XL" {{ old('size', $product->size ?? '') == 'XL' ? 'selected' : '' }}>
                                {{ __('XL') }}</option>
                            <option value="XXL" {{ old('size', $product->size ?? '') == 'XXL' ? 'selected' : '' }}>
                                {{ __('XXL') }}</option>
                        </select>
                        <x-input.input-error :messages="$errors->get('size')" class="mt-2" />
                    </div>


                    {{-- Meta Title --}}
                    <div class="mt-4">
                        <x-input.input-label for="meta_title" :value="__('Meta Title')" />
                        <x-input.text-input id="meta_title" class="mt-1 w-full" type="text" name="meta_title"
                            :value="old('meta_title', $product->meta_title ?? '')" autocomplete="meta_title" />
                        <x-input.input-error :messages="$errors->get('meta_title')" class="mt-2" />
                    </div>

                    {{-- Meta Description --}}
                    <div class="mt-4">
                        <x-input.input-label for="meta_description" :value="__('Meta Description')" />
                        <x-input.text-area id="meta_description" class="mt-1 w-full" name="meta_description"
                            rows="3">
                            {{ old('meta_description', $product->meta_description ?? '') }}
                        </x-input.text-area>
                        <x-input.input-error :messages="$errors->get('meta_description')" class="mt-2" />
                    </div>

                    {{-- Meta Keywords --}}
                    <div class="mt-4">
                        <x-input.input-label for="meta_keyword" :value="__('Meta Keywords')" />
                        <x-input.text-input id="meta_keyword" class="mt-1 w-full" type="text" name="meta_keyword"
                            :value="old('meta_keyword', $product->meta_keyword ?? '')" autocomplete="meta_keyword" />
                        <x-input.input-error :messages="$errors->get('meta_keyword')" class="mt-2" />
                    </div>

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
            const slug = document.querySelector("#slug");

            name.addEventListener("keyup", function() {
                let preslug = name.value;
                preslug = preslug.replace(/[^a-zA-Z0-9\s]/g, "");
                preslug = preslug.replace(/ /g, "-");
                slug.value = preslug.toLowerCase();
            });

            function previewCover() {
                const cover = document.querySelector('#cover')
                const coverPreview = document.querySelector('.coverPreview')

                coverPreview.style.display = 'block';
                coverPreview.style.width = '200px';

                const oFReader = new FileReader()
                oFReader.readAsDataURL(cover.files[0])
                oFReader.onload = function(oFREvent) {
                    coverPreview.src = oFREvent.target.result
                }
            }
        </script>
    </x-slot>

</x-app-layout>
