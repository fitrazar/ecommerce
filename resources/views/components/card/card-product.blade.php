@props(['image' => '', 'desc' => ''])

<div class="py-12">
  <div class="max-w-xl sm:px-1 lg:px-1">
    <div class="card bg-base-100 max-w-[250px] shadow-xl border border-gray-400">
      <figure>
        <img src="{{ asset($image) }}" alt="Shoes" width="200" />
      </figure>
      <div class="card-body">
        {{-- <h2 class="card-title">{{ $title }}</h2> --}}
        <p>{{ $desc }}</p>
      </div>
    </div>
  </div>
</div>
