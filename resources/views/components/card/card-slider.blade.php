@props(['slider_data'])


@php
  use App\Models\Setting;

  $setting = Setting::first();
@endphp

<!-- Swiper CSS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css">

<!-- CSS -->
<style>
  /* Google Fonts - Poppins */
  @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap');

  .slide-container {
    max-width: 1120px;
    width: 100%;
    padding: 40px 0;
  }

  .slide-content {
    margin: 0 40px;
    overflow: hidden;
    border-radius: 25px;
  }

  .card {
    border-radius: 25px;
    background-color: #FFF;
  }

  .image-content,
  .card-content {
    display: flex;
    flex-direction: column;
    align-items: center;
    padding: 10px 14px;
  }

  .image-content {
    position: relative;
    row-gap: 5px;
    padding: 25px 0;
  }

  .overlay {
    position: absolute;
    left: 0;
    top: 0;
    height: 100%;
    width: 100%;
    background-color: #4070F4;
    border-radius: 25px 25px 0 25px;
  }

  .overlay::before,
  .overlay::after {
    content: '';
    position: absolute;
    right: 0;
    bottom: -40px;
    height: 40px;
    width: 40px;
    background-color: #4070F4;
  }

  .overlay::after {
    border-radius: 0 25px 0 0;
    background-color: #FFF;
  }

  .card-image {
    position: relative;
    height: 150px;
    width: 150px;
    border-radius: 50%;
    background: #FFF;
    padding: 3px;
  }

  .card-image .card-img {
    height: 100%;
    width: 100%;
    object-fit: cover;
    border-radius: 50%;
    border: 4px solid #4070F4;
  }

  .name {
    font-size: 18px;
    font-weight: 500;
    color: #333;
  }

  .description {
    font-size: 14px;
    color: #707070;
    text-align: center;
  }

  .button {
    border: none;
    font-size: 16px;
    color: #FFF;
    padding: 8px 16px;
    background-color: #4070F4;
    border-radius: 6px;
    margin: 14px;
    cursor: pointer;
    transition: all 0.3s ease;
  }

  .button:hover {
    background: #265DF2;
  }

  .swiper-navBtn {
    color: #01A884;
    transition: color 0.3s ease;
  }

  .swiper-navBtn:hover {
    color: #01A884;
  }

  .swiper-navBtn::before,
  .swiper-navBtn::after {
    font-size: 35px;
  }

  .swiper-button-next {
    right: 0;
  }

  .swiper-button-prev {
    left: 0;
  }

  .swiper-pagination-bullet {
    background-color: #01A884;
    opacity: 1;
  }

  .swiper-pagination-bullet-active {
    background-color: #01A884;
  }

  @media screen and (max-width: 768px) {
    .slide-content {
      margin: 0 10px;
    }

    .swiper-navBtn {
      display: none;
    }
  }
</style>


{{-- <div class="container swiper w-[80%] bg-red-700 ">
  <div class="slider-wrapper recommend-store__contain">
    <div class="card-list swiper-wrapper flex justify-center recommend-store__center w-full">
      @foreach ($slider_data as $item)
        <div class="swiper-slide slider__card" style="width: 100px;">
          <div class="flex justify-center relative">
            <img src="{{ asset('storage/product/' . $item['cover']) }}" alt="User Image" class="user-image w-40 h-40 ">
          </div>
          <div class="recommend-store__cover">
            <p class="user-profession text-center hover:underline">
              <a href={{ url('products_detail/' . $item['slug']) }}>{{ $item['name'] }} </a>
            </p>
            <div class="px-2 py-1 rounded-md bg-[#01A884] text-white hover:opacity-85 w-52  justify-center mx-auto ">
              <a href={{ 'https://wa.me/' . $setting->phone }}
                class="block text-white text-sm bg-[#01A884] rounded md:bg-transparent md:text-white md:p-0  cursor-pointer ">
                <i class="fa-brands fa-whatsapp text-2xl"></i> Chat Online Now</a>
            </div>
          </div>
        </div>
      @endforeach
    </div>
    <div class="swiper-slide-button swiper-button-prev"></div>
    <div class="swiper-slide-button swiper-button-next"></div>
  </div>

</div> --}}


<div class="slide-container swiper">
  <div class="slide-content">
    <div class="card-wrapper swiper-wrapper">

      @foreach ($slider_data as $item)
        <div class="swiper-slide slider__card" style="width: 100px;">
          <div class="flex justify-center relative">
            <img src="{{ asset('storage/product/' . $item['cover']) }}" alt="User Image" class="user-image w-40 h-40 ">
          </div>
          <div class="recommend-store__cover mt-4">
            <p class="user-profession text-center hover:underline">
              <a href={{ url('products_detail/' . $item['slug']) }}>{{ $item['name'] }} </a>
            </p>
            <div class="px-2 py-1 rounded-md bg-[#01A884] text-white hover:opacity-85 w-52  justify-center mx-auto ">
              <a href={{ 'https://wa.me/' . $setting->phone }}
                class="block text-white text-center text-sm bg-[#01A884] rounded md:bg-transparent md:text-white md:p-0  cursor-pointer ">
                <i class="fa-brands fa-whatsapp text-2xl"></i> Chat Online Now</a>
            </div>
          </div>
        </div>
      @endforeach

    </div>
  </div>

  <div class="swiper-button-next swiper-navBtn"></div>
  <div class="swiper-button-prev swiper-navBtn"></div>
  <div class="swiper-pagination"></div>
</div>





<!-- Swiper JS -->
<script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>

<!-- JavaScript -->
<script>
  var swiper = new Swiper(".slide-content", {
    slidesPerView: 3,
    spaceBetween: 25,
    loop: true,
    centerSlide: 'true',
    fade: 'true',
    grabCursor: 'true',
    pagination: {
      el: ".swiper-pagination",
      clickable: true,
      dynamicBullets: true,
    },
    navigation: {
      nextEl: ".swiper-button-next",
      prevEl: ".swiper-button-prev",
    },

    breakpoints: {
      0: {
        slidesPerView: 1,
      },
      520: {
        slidesPerView: 2,
      },
      950: {
        slidesPerView: 3,
      },
    },
  });
</script>
