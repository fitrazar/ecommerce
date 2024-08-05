@props(['title' => '', 'card' => '', 'linkButton' => ''])

<div class="w-full mr-10  card bg-base-100 shadow-xl mb-8">
  <h2 class="mt-6 ml-32 text-2xl font-bold">{{ $title }}</h2>

  @foreach ($card as $item)
    {{-- @dd($item['image']) --}}
    <x-card.card-product :desc="$item['desc']" :image="$item['image']" />
  @endforeach


  <a href={{ $linkButton }} class="btn btn-primary w-72 right-6 absolute bottom-3">View More</a>
</div>
