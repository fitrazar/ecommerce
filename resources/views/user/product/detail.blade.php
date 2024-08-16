@section('title', 'Detail Products |' . $products->name)

@php
  use App\Models\Setting;

  $setting = Setting::first();
@endphp

<x-guest-layout>
  <div class="py-12">

    <div class="max-w-[90rem] mx-auto sm:px-6 lg:px-8 ">
      <x-card.card-default class="static">
        <div class=" flex justify-center flex-wrap">
          <div
            class="card rounded-md flex flex-wrap lg:card-side w-full bg-base-100 shadow-xl border border-black p-2 mt-2">
            @php
              $image = $products->cover;
            @endphp
            <div class="carousel w-1/2">
              @foreach ($product_image as $key)
                {{-- @dd(asset('storage/product_image/' . $key->image)) --}}
                <div id={{ 'slide' . $loop->index }} class="carousel-item relative w-full">
                  <div class="flex justify-center items-center w-full ">
                    <img src={{ asset('storage/product_images/' . $key->image) }} class=" lg:w-[180px] lg:h-[180px]" />
                  </div>
                  <div class="absolute left-5 right-5 top-1/2 flex -translate-y-1/2 transform justify-between">
                    <a href={{ '#slide' . $loop->index - 1 }} class="btn btn-circle">❮</a>
                    <a href={{ '#slide' . $loop->index + 1 }} class="btn btn-circle">❯</a>
                  </div>
                </div>
              @endforeach
            </div>
            <div class="card-body w-1/2">
              <h2 class="card-title">{{ $products->name }}</h2>
              <p>{{ $products->description }}</p>
              <table class="table-auto  ">
                <tr>
                  <td class="border-solid border-2 border-[#a5a2a2b8] pl-2 p-2">{{ __('Stocks') }}</td>
                  <td class="border-solid border-2 border-[#a5a2a2b8] p-2">{{ $products->stock }}</td>
                </tr>
                <tr>
                  <td class="border-solid border-2 border-[#a5a2a2b8] pl-2 p-2">{{ __('Brands') }}</td>
                  <td class="border-solid border-2 border-[#a5a2a2b8] p-2">{{ $products->brand->name }}</td>
                </tr>
                <tr>
                  <td class="border-solid border-2 border-[#a5a2a2b8] pl-2 p-2">{{ __('Material') }}</td>
                  <td class="border-solid border-2 border-[#a5a2a2b8] p-2">{{ $products->material->name }}</td>
                </tr>
                <tr>
                  <td class="border-solid border-2 border-[#a5a2a2b8] pl-2 p-2">{{ __('Color') }}</td>
                  <td class="border-solid border-2 border-[#a5a2a2b8] p-2">{{ $products->color }}</td>
                </tr>
              </table>
            </div>
            <div class="flex gap-3 text-white lg:justify-end lg:pr-4 justify-center w-full">
              <button class="btn btn-active"> <a href={{ 'mailto:' . $setting->email }}><i
                    class="fa-regular fa-envelope text-2xl text-white"></i></a>
              </button>
              <button class="btn btn-active text-white btn-success"> <a href={{ 'https://wa.me/' . $setting->phone }}>
                  <i class="fa-brands fa-whatsapp text-2xl"></i> </a> </button>
              <button class="btn btn-active text-white btn-primary"> <a href={{ $setting->facebook }}><i
                    class="fa-brands fa-facebook text-2xl"></i></a> </button>
            </div>
          </div>
          <div
            class="card rounded-md flex flex-wrap p-4 lg:card-side w-full bg-base-100 shadow-xl border border-black text-2xl mt-2">
            <h3 class="font-bold pl-8 w-full border border-b-black ">Explore Similar Products</h3>

            @foreach ($similar_products as $item)
              <div
                class="w-[200px] p-4 shadow-xl border border-gray-200 mt-4 transition-all hover:shadow-2xl cursor-pointer">
                <div class="w-[190px] h-[190px]   flex justify-center items-center">
                  <img src="{{ asset('storage/product/' . $item['cover']) }}" class="w-1/2 h-1/2" alt="Shoes"
                    width="20px" height="20px" />
                </div>
                <p class="hover:underline text-sm"><a
                    href={{ url('products_detail/' . $item['slug']) }}>{{ $item['name'] }} </a>
                </p>
                <div class="px-2 py-1 rounded-md bg-[#01A884] text-white hover:opacity-85 mt-4">
                  <a href={{ 'https://wa.me/' . $setting->phone }}
                    class="block text-white text-sm bg-[#01A884] rounded md:bg-transparent md:text-white md:p-0  cursor-pointer ">
                    <i class="fa-brands fa-whatsapp text-2xl"></i> Chat Online Now</a>
                </div>
              </div>
            @endforeach


          </div>
          <div
            class="card rounded-md flex flex-wrap justify-center p-4 lg:card-side w-full bg-base-100 shadow-xl border border-black text-2xl mt-2">
            <h3 class="font-bold pl-8 w-full text-center">Products Detail</h3>

            <div class=" max-w-[90rem] ">
              <table class="table table-zebra flex overflow-hidden justify-center lg:w-[50rem]">
                <tbody class="flex flex-col">
                  <!-- row 1 -->
                  <tr class="hover overflow-hidden">
                    <td>Type</td>
                    <td>{{ $products->type }}</td>
                  </tr>
                  {{-- <tr class="hover">
                    <td>Meta Title</td>
                    <td>{{ $products->meta_title }}</td>
                  </tr>
                  <tr class="hover">
                    <td>Meta Keyword</td>
                    <td>{{ $products->meta_keyword }}</td>
                  </tr>
                  <tr class="hover">
                    <td>Meta Description</td>
                    <td>{{ $products->meta_description }}</td>
                  </tr> --}}
                </tbody>
              </table>
            </div>
          </div>
        </div>

        <x-guest-footer :$setting />

      </x-card.card-default>
    </div>
  </div>
</x-guest-layout>
