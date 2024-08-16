@section('title', 'Products')
@php
  use App\Models\Setting;

  $setting = Setting::first();
@endphp
<x-guest-layout>

  <div class="flex justify-center flex-col items-center">
    @foreach ($data as $item)
      <x-card.card-container :title="$item['title']" :card="$item['card']" :linkButton="$item['linkButton']" />
    @endforeach
  </div>

  <x-guest-footer :$setting />

</x-guest-layout>
