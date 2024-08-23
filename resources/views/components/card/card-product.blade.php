@props(['image' => '', 'desc' => '', 'detail' => ''])

<div class="py-8 cursor-pointer ">
  <div class="flex justify-center rounded-sm border border-gray-200">
    <div class="w-[190px] h-[190px] hover:shadow-2xl transition-all shadow-xl flex justify-center items-center">
      <img src="{{ asset('storage/product/' . $image) }}" class="w-1/2 h-1/2" alt="Shoes" width="20px" height="20px" />
    </div>
  </div>
  <div class="max-w-xl">
    <div class=" max-w-[190px] mt-2  ">
      <div class="ml-1">
        <p><a href={{ url($detail) }} class="hover:underline"> {{ $desc }} </a></p>
      </div>
    </div>
  </div>
</div>
