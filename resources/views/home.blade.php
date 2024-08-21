@section('title', 'Home')
<x-guest-layout>
  <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
    <x-card.card-default class="static rounded-sm mt-8">

      <x-card.card-slider :$slider_data />

      {{-- About Us --}}
      <div class="text-center flex flex-col items-center ">
        <h2 class=" text-2xl font-semibold mt-16 ">About Us</h2>
        <hr class="w-10 bg-[#3ca860] h-1 border border-[#3ca860] ">

        <div class="flex justify-center flex-wrap mt-7">
          <div class="w-full lg:w-1/3 flex justify-center">
            <img src="storage/product/1hBfewFGSejWiUXrkZanCUFKFe1pAps0xETvlica.jpg" alt="sss" class="w-72">
          </div>
          <div class="w-full lg:w-2/3 text-left">
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Voluptatem voluptatibus doloribus, ipsa eius
              earum iure fugiat id. Ut sapiente consectetur voluptatem iure. Maxime, ex atque magni facere doloribus
              dicta?</p>
          </div>
        </div>
      </div>

      {{-- Popular Products --}}
      <div class="text-center flex flex-col items-center  ">
        <h2 class=" text-2xl font-semibold mt-16 ">Popular Products</h2>
        <hr class="w-10 bg-[#3ca860] h-1 border border-[#3ca860] ">

        <div class="flex gap-3 flex-wrap justify-center">
          @foreach ($data as $item)
            <div class="mt-16 w-full lg:w-1/3 border p-2 border-[#e6e6e6] ">
              <div class="flex bg-[#f7f7f7] justify-center border border-[#e6e6e6] items-center  p-7">
                <div class=" border border-black mr-2">
                  <img src={{ asset('storage/product/' . $item['cover']) }} class="" alt="">
                </div>
                <p class="text-[#323192] font-bold text-xl">{{ $item['title'] }}</p>
              </div>
              {{-- list products categories --}}
              <div>
                @foreach ($item['card'] as $key)
                  @if ($loop->index < 3)
                    <li
                      class="list-none hover:underline text-left mt-3 border-b-2 border-b-[#e6e6e6] flex justify-between">
                      <a href={{ $key['detail'] }}>
                        <div>{{ $key['name'] }}</div>
                        <div> <i class="fa-solid fa-play"></i>
                      </a>
                    </li>
                  @endif
                @endforeach
              </div>

              <div>
                <p class="text-[#56a860] text-lg font-semibold hover:underline mt-3"><a
                    href={{ $item['linkButton'] }}>View Details</a>
                </p>
              </div>
            </div>
          @endforeach
        </div>


      </div>

    </x-card.card-default>
  </div>




</x-guest-layout>
