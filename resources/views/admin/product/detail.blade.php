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

                    <!-- Tanggal Produk -->
                    <x-card.card-custom title="Cover Produk">
                        <img src="{{ asset('storage/product/' . $data->cover) }}" alt="{{ $data->name }}"
                            class="w-[200px] rounded-xl">
                    </x-card.card-custom>
                </div>

                <!-- Warna Produk -->
                <div class="mt-4">
                    <x-card.card-custom title="Warna Produk">
                        <div class="flex flex-wrap gap-5">
                            @foreach ($data->productColors as $color)
                                <div class="flex-shrink-0">
                                    <strong>{{$color->name}}</strong>
                                    <img src="{{ asset('storage/color/' . $color->image) }}" alt="{{ $color->name }}"
                                        class="w-[40px] h-[40px] rounded-full">
                                </div>
                            @endforeach
                        </div>
                    </x-card.card-custom>
                </div>

            </x-card.card-default>
        </div>
    </div>
</x-app-layout>
