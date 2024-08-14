@section('title', 'Detail Products | ' . $products[0]->category->name)
<x-guest-layout>
  <div class="py-12">
    <div class="max-w-[90rem] mx-auto sm:px-6 lg:px-8">
      <x-card.card-default class="static">
        <h1 class="font-bold text-xl">{{ $products[0]->category->name }}</h1>
        <div class="justify-center flex flex-wrap">
          @foreach ($products as $key)
            @php
              $image = "storage/product/$key->cover";
              $linkDetail = "products/$key->id/edit";
            @endphp
            <div class="card lg:card-side w-2/3 bg-base-100 shadow-xl border border-black p-2 mt-2">
              <figure>
                <img src={{ asset($image) }} alt={{ $key->cover }} class="w-64" />
              </figure>
              <div class="card-body">
                <h2 class="card-title">{{ $key->name }}</h2>
                <p>{{ $key->description }}</p>
                <p> {{ __('Stocks') . ':' . $key->stock }}</p>
                <p> {{ __('Brands') . ':' . $key->brand->name }}</p>
                <p> {{ __('Material') . ':' . $key->material->name }}</p>
                <p> {{ __('Color') . ':' . $key->color }}</p>
                <div class="card-actions justify-end">
                  <button class="btn btn-primary text-white"> <a href={{ url($linkDetail) }}>
                      Detail
                    </a> </button>
                </div>
              </div>
            </div>
          @endforeach
        </div>
      </x-card.card-default>
    </div>
  </div>
</x-guest-layout>
