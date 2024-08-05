@section('title', 'Home')

<x-guest-layout>
  @foreach ($data as $item)
    <x-card.card-container :title="$item['title']" :card="$item['card']" :linkButton="$item['linkButton']" />
  @endforeach
</x-guest-layout>
