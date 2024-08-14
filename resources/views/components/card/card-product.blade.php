@props(['image' => '', 'desc' => '', 'detail' => ''])

<div class="py-12">
  <div class="max-w-xl sm:px-1 lg:px-1">
    <div class="card bg-base-100 max-w-[250px] shadow-xl border border-gray-400">
      <figure>
        <img src="{{ asset('storage/product/' . $image) }}" alt="Shoes" width="200" />
      </figure>
      <div class="card-body">
        {{-- <h2 class="card-title">{{ $title }}</h2> --}}
        <p><a href={{ $detail }} class="hover:underline"> {{ $desc }} </a></p>
        {{-- <a class="btn btn-link" href={{ $detail }}>Detail</a> --}}
      </div>
    </div>
  </div>
</div>
