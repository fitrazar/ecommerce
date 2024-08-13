@section('title', 'Detail Produk')
<x-app-layout>
    <div class="container mx-auto py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <x-card.card-default class="static">
                <div class="mb-4">
                    <a href="{{ route('product.index') }}">
                        <x-button.info-button>
                            <i class="fa-solid fa-arrow-left"></i>
                            Kembali
                        </x-button.info-button>
                    </a>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <!-- Informasi Produk -->
                    <x-card.card-custom title="Informasi Produk">
                        <p><strong>Nama Produk:</strong> {{ $data->name }}</p>
                        <p><strong>Deskripsi Produk:</strong> {{ $data->description }}</p>
                        <p><strong>Brand:</strong> {{ $data->brand->name }}</p>
                        <p><strong>Kategori:</strong> {{ $data->category->name }}</p>
                        <p><strong>Unit:</strong> {{ $data->unit->name }}</p>
                        <p><strong>Bahan:</strong> {{ $data->material->name }}</p>
                        <p><strong>Stock:</strong> {{ $data->stock }}</p>
                        <p><strong>Tanggal Dibuat:</strong> {{ $data->created_at->diffForHumans() }}</p>
                        <p><strong>Tanggal Diedit:</strong> {{ $data->updated_at->diffForHumans() }}</p>
                    </x-card.card-custom>

                    <!-- Cover Produk -->
                    <x-card.card-custom title="Cover Produk">
                        <img src="{{ asset('storage/product/' . $data->cover) }}" alt="{{ $data->name }}"
                            class="w-[200px] rounded-xl border border-gray-500">
                    </x-card.card-custom>
                </div>

                <!-- Warna Produk -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <x-card.card-custom title="Warna Produk">
                        <div class="flex flex-wrap gap-5">
                            @if ($data->productColors->count())
                                @foreach ($data->productColors as $color)
                                    <div class="flex-shrink-0">
                                        <span class="text-sm text-gray-800">{{ $color->name }}</strong>
                                        <img src="{{ asset('storage/color/' . $color->image) }}"
                                            alt="{{ $color->name }}"
                                            class="w-[40px] h-[40px] rounded-full border-2 border-gray-800">
                                    </div>
                                @endforeach
                            @else
                                <span class="text-slate-500">{{ 'Product belum memiliki warna' }}</span>
                            @endif
                        </div>
                    </x-card.card-custom>
                    <x-card.card-custom title="Ukuran Produk">
                        <div class="flex flex-wrap gap-5">
                            @if ($data->productSizes->count())
                                @foreach ($data->productSizes as $size)
                                    <div class="flex-shrink-0">
                                        <strong>{{ $size->size_number }}</strong>
                                        <span class="text-gray-500 text-xs">{{ $size->size_chart }}</strong>
                                    </div>
                                @endforeach
                            @else
                                <span class="text-sm text-slate-500">{{ 'Product belum memiliki ukuran' }}</span>
                            @endif
                        </div>
                    </x-card.card-custom>

                    {{-- Gambar Product --}}
                    <x-card.card-custom title="Gambar Produk">
                        @if ($data->productImages->count())
                            <div class="carousel w-full relative mt-2 border rounded-xl">
                                @foreach ($data->productImages as $index => $productImage)
                                    <div class="carousel-item w-full flex justify-center h-[200px] {{ $index === 0 ? 'block' : 'hidden' }}"
                                        data-slide="{{ $index }}">
                                        <img src="{{ asset('storage/product_images/' . $productImage->image) }}"
                                            class="max-w-full max-h-full m-2 object-cover border rounded-xl" alt="Product Image" />
                                    </div>
                                @endforeach
                                <div
                                    class="absolute left-5 right-5 top-1/2 flex -translate-y-1/2 transform justify-between">
                                    <button type="button" class="btn btn-circle carousel-prev">❮</button>
                                    <button type="button" class="btn btn-circle carousel-next">❯</button>
                                </div>
                            </div>
                        @else
                            <span class="text-slate-500 text-sm ">{{ 'Product belum memiliki gambar' }}</span>
                        @endif
                    </x-card.card-custom>
                </div>

            </x-card.card-default>
        </div>
    </div>

    <x-slot name="script">
        <script>
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
    </x-slot>
</x-app-layout>
