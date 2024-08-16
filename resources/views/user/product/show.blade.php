@section('title', 'Detail Products | ' . $products[0]->category->name)
@php
  use App\Models\Setting;

  $setting = Setting::first();
@endphp
<x-guest-layout>

  <x-menu.sidebar-products />
  <div class="">
    <x-card.card-default class="static">

      <div class="max-w-[90rem] mx-auto sm:px-6 lg:px-8 flex">
        <div class="justify-center flex flex-wrap">
          <h1 class="font-bold text-xl w-full text-center">{{ $products[0]->category->name }}</h1>
          @foreach ($products as $key)
            @php
              $image = "storage/product/$key->cover";
              $linkDetail = "products_detail/$key->slug";
            @endphp
            <div class="card rounded-md  lg:card-side w-2/3 bg-base-100 shadow-xl border border-[#ededed] p-2 mt-12">
              <figure>
                <img src={{ asset($image) }} alt={{ $key->cover }} class="w-64" />
              </figure>
              <div class="card-body">
                <h2 class="card-title">{{ $key->name }}</h2>
                <p>{{ $key->description }}</p>
                <table class="table-auto  ">
                  <tr>
                    <td class="border-solid border-2 border-[#a5a2a2b8] pl-2 p-2">{{ __('Stocks') }}</td>
                    <td class="border-solid border-2 border-[#a5a2a2b8] p-2">{{ $key->stock }}</td>
                  </tr>
                  <tr>
                    <td class="border-solid border-2 border-[#a5a2a2b8] pl-2 p-2">{{ __('Brands') }}</td>
                    <td class="border-solid border-2 border-[#a5a2a2b8] p-2">{{ $key->brand->name }}</td>
                  </tr>
                  <tr>
                    <td class="border-solid border-2 border-[#a5a2a2b8] pl-2 p-2">{{ __('Material') }}</td>
                    <td class="border-solid border-2 border-[#a5a2a2b8] p-2">{{ $key->material->name }}</td>
                  </tr>
                  <tr>
                    <td class="border-solid border-2 border-[#a5a2a2b8] pl-2 p-2">{{ __('Color') }}</td>
                    <td class="border-solid border-2 border-[#a5a2a2b8] p-2">{{ $key->color }}</td>
                  </tr>
                </table>
                <div class="card-actions justify-end">
                  <button class=" p-2 rounded-md bg-[#01A884] hover:bg-opacity-85 text-white"> <a
                      href={{ url($linkDetail) }}>
                      Detail
                    </a> </button>
                </div>
              </div>
            </div>
          @endforeach
        </div>
      </div>
      <x-guest-footer :$setting />
    </x-card.card-default>
  </div>



</x-guest-layout>
