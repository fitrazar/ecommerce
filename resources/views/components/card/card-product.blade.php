@props(['image' => '', 'desc' => ''])

<div class="py-12 ">
  <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
    <div class="card bg-base-100 w-96 shadow-xl">
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
