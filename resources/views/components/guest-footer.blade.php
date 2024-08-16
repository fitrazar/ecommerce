@props(['setting'])


{{-- get in touch  --}}
<div>
  <div class="p-3 bg-[#3ca860] mt-4 text-white text-2xl font-bold">
    <p>Get in Touch with Us</p>
  </div>

  <div class="flex w-full">
    <div class="w-1/2 ml-3">
      <h2 class="mt-5 text-xl font-semibold mb-4 ">Our Company</h2>
      <ul class="flex gap-4 flex-col mb-4">
        <li>About Us</li>
        <li>Our Products</li>
        <li>Contact Us</li>
      </ul>
      <p>

        <i class="fa-solid fa-share-nodes mr-3"></i> <span>Share us Via</span>
        <i class="fa-brands fa-facebook ml-3 text-blue-800 text-xl"></i>
        <i class="fa-brands fa-twitter ml-3 text-blue-800 text-xl"></i>
        <i class="fa-brands fa-linkedin ml-3 text-blue-800 text-xl"></i>

      </p>
    </div>

    <div class="w-1/2 ml-3">
      <h2 class="mt-5 text-xl font-semibold mb-4 ">Reach Us</h2>
      <ul class="flex gap-4 mb-4">
        <li><i class="fa-solid fa-location-dot"></i></li>
        <li>{{ $setting->address }}</li>

      </ul>
    </div>
  </div>
</div>
