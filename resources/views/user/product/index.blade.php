@section('title', 'Products')

<x-guest-layout>

  <div class="flex justify-center flex-col items-center">
    
    @foreach ($data as $item)
      <x-card.card-container :title="$item['title']" :card="$item['card']" :linkButton="$item['linkButton']" />
    @endforeach
  </div>

</x-guest-layout>
