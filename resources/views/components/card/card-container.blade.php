@props(['title' => '', 'card' => '', 'linkButton' => ''])

<div class="w-[90%] border border-gray-400 mt-8 flex justify-center mx-2 card bg-base-100 shadow-xl mb-8">
  <h2 class="mt-6 ml-14 text-2xl font-bold">{{ $title }}</h2>

  <div class="flex flex-wrap ">
    @foreach ($card as $item)
      {{-- @dd($item['image']) --}}
      <x-card.card-product :desc="$item['desc']" :image="$item['image']" />
    @endforeach
  </div>

  <div class="flex justify-end mr-2">
    <a href={{ $linkButton }} class="btn btn-primary w-72 ml-4 mb-4">View More</a>
  </div>
</div>
