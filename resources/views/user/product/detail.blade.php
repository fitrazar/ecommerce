@section('title', 'Detail Products |' . $products->name)
<x-guest-layout>
  <div class="py-12">
    <div class="max-w-[90rem] mx-auto sm:px-6 lg:px-8 ">
      <x-card.card-default class="static">
        <div class=" flex justify-center flex-wrap">
          <div class="card flex flex-wrap lg:card-side w-full bg-base-100 shadow-xl border border-black p-2 mt-2">
            @php
              $image = "storage/product/$products->cover";
              $linkDetail = "products/$products->id/edit";
            @endphp
            <div class="carousel w-1/2">
              @foreach ($product_image as $key)
                {{-- @dd(asset('storage/product_image/' . $key->image)) --}}
                <div id={{ 'slide' . $loop->index }} class="carousel-item relative w-full">
                  <img src={{ asset('storage/product_images/' . $key->image) }} class="w-full" />
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
              <p class="  border-b-2 border-0 border-gray-300"> {{ __('Stocks') . ':' . $products->stock }}</p>
              <p class=" border-b-2 border-0 border-gray-300"> {{ __('Brands') . ':' . $products->brand->name }}</p>
              <p class=" border-b-2 border-0 border-gray-300"> {{ __('Material') . ':' . $products->material->name }}
              </p>
              <p class=" border-b-2 border-0 border-gray-300"> {{ __('Color') . ':' . $products->color }}</p>
            </div>
            <div class="flex gap-3 text-white lg:justify-end lg:pr-4 justify-center w-full">
              <button class="btn btn-active"> <a href="#">Email</a> </button>
              <button class="btn btn-active text-white btn-success"> <a href="#">Whatsapp</a> </button>
              <button class="btn btn-active text-white btn-primary"> <a href="#">Facebook</a> </button>
            </div>
          </div>

          <div
            class="card flex flex-wrap justify-center p-4 lg:card-side w-full bg-base-100 shadow-xl border border-black text-2xl mt-2">
            <h3 class="font-bold pl-8 w-full text-center">Products Detail</h3>

            <div class=" max-w-[90rem] ">
              <table class="table table-zebra flex overflow-hidden justify-center lg:w-[50rem]">
                <tbody class="flex gap-7 flex-col">
                  <!-- row 1 -->
                  <tr class="hover overflow-hidden">
                    <th>Type</th>
                    <td>{{ $products->type }}</td>
                  </tr>
                  <tr class="hover">
                    <th>Meta Title</th>
                    <td>{{ $products->meta_title }}</td>
                  </tr>
                  <tr class="hover">
                    <th>Meta Keyword</th>
                    <td>{{ $products->meta_keyword }}</td>
                  </tr>
                  <tr class="hover">
                    <th>Meta Description</th>
                    <td>{{ $products->meta_description }}</td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </x-card.card-default>
    </div>
  </div>
</x-guest-layout>
