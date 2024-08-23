@section('title', 'Detail Products | ' . $category_name)

<x-guest-layout>

  <div class="w-48 ml-24 rounded-md lg:block top-28 z-50 mt-5 mb-6">
    <form>
      <label class="bg-white flex">
        <input type="text" name="search" class="" placeholder="{{ __('Search') }}" value="{{ $search_field }}" />

        <button class="btn bg-[#44ac66] hover:opacity-80 hover:text-black text-white" type="submit">
          <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" fill="currentColor" class="h-4 w-4 opacity-70">
            <path fill-rule="evenodd"
              d="M9.965 11.026a5 5 0 1 1 1.06-1.06l2.755 2.754a.75.75 0 1 1-1.06 1.06l-2.755-2.754ZM10.5 7a3.5 3.5 0 1 1-7 0 3.5 3.5 0 0 1 7 0Z"
              clip-rule="evenodd" />
          </svg>
        </button>
      </label>
    </form>
  </div>


  <x-menu.sidebar-products />
  <div class="">
    <x-card.card-default class="static">
      {{-- @dd($products) --}}

      <div class="max-w-[90rem] mx-auto sm:px-6 lg:px-8 flex">


        <div class="justify-center flex flex-wrap ml-5">
          <h1 class="font-bold text-xl w-full text-center">{{ $category_name }}</h1>


          {{-- test --}}
          {{-- <div class="relative overflow-x-auto mt-5">
            <table id="products" class="table">
              <thead>
                <tr>
                  <th scope="col" class="px-6 py-3"></th>
                </tr>
              </thead>
              <tbody>
                <tr>
                    <td>s</td>
                </tr>
              </tbody>
            </table>
          </div> --}}
          {{-- test --}}
          @foreach ($products as $key)
            @php
              $image = "storage/product/$key->cover";
              $linkDetail = "products_detail/$key->slug";
            @endphp
            <div
              class="card rounded-md  lg:card-side {{ $products_count == 1 ? 'w-full' : 'w-2/3' }} bg-base-100 shadow-xl border border-[#ededed] p-2 mt-12">
              <figure>
                <img src={{ asset($image) }} alt={{ $key->cover }} class="w-64" />
              </figure>
              <div class="card-body">
                <h2 class="card-title">{{ $key->name }}</h2>
                <p>{{ $key->description }}</p>
                <div class="card-actions justify-end">
                  <button class=" p-2 rounded-md bg-[#01A884] hover:bg-opacity-85 text-white"> <a
                      href={{ url($linkDetail) }}>
                      Detail
                    </a> </button>

                </div>
              </div>
            </div>
          @endforeach
          <div class="w-full">
            {{ $products->links() }}
          </div>
          {{-- @if ($products_count >= 1)
            <div class="w-full">
              <div>
              </div>
            </div>
          @else
            <h3 class="bg-red-500 mt-3 p-3 text-white rounded-md mb-44">{{ __('Data Not Found') }}</h3>
          @endif --}}
        </div>
      </div>
    </x-card.card-default>
  </div>


  <x-slot name="script">
    <script>
      $(document).ready(function() {
            $('#products').DataTable();
          }
    </script>
  </x-slot>



</x-guest-layout>
