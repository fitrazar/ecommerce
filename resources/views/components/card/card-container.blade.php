@props(['title' => '', 'card' => '', 'linkButton' => ''])

<div class="w-[90%] border rounded-sm border-gray-400 mt-8 flex justify-center mx-2 card bg-base-100 shadow-xl mb-8">
  <h2 class="mt-6 ml-12 text-2xl font-bold text-[#3ca860]">{{ $title }}</h2>

  <div class="flex flex-wrap ml-9 gap-9">
    @foreach ($card as $item)
      {{-- @dd($item['image']) --}}
      <x-card.card-product :desc="$item['desc']" :image="$item['image']" :detail="$item['detail']" />
    @endforeach
  </div>
  <div class="flex justify-end mr-2">
    <a href={{ $linkButton }}
      class="  text-[#55aa60] border text-center font-bold w-60 py-2   hover:text-white hover:bg-[#018069] border-[#85c99c] bg-white rounded-sm mr-4 mb-4">View
      More</a>
  </div>
</div>
