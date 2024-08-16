@props(['slider_data'])


@php
  use App\Models\Setting;

  $setting = Setting::first();
@endphp


<div class="container swiper w-[80%] bg-red-700 ">
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

</div>


<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css">
<style>
  /* Importing Google Font - Montserrat */
  @import url('https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap');

  .recommend-store__cover {
    margin-top: 10px;
    width: 100%;
    height: 150px;
    background: rgba(0, 0, 0, .7);
    position: absolute;
    right: 0;
    bottom: -98px;
    box-sizing: border-box;
    font-size: 16px;
    color: #feffff;
    text-align: center;
    transition: bottom .3s ease;
    cursor: pointer
  }

  .recommend-store__contain {
    background: #feffff;
    border: 1px solid #e3e3e3;
    border-radius: 4px 4px 0 0;
    box-sizing: border-box;
    float: left;
    /* overflow: hidden */
  }

  .recommend-store__center {
    overflow: hidden;
    width: 1500px;
  }

  .recommend-store__center>.slider__card {
    width: 10px;
    height: 272px;
    border-right: 1px solid #e3e3e3;
    float: left;
    padding: 9px 15px 21px 15px;
    box-sizing: border-box;
    position: relative
  }

  .recommend-store__center>.slider__card:hover .recommend-store__cover {
    bottom: -10px
  }

  .slider-wrapper .swiper-slide-button {
    color: #3ca860;
  }
</style>


<!-- Linking SwiperJS script -->
<script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>

<script>
  const swiper = new Swiper('.slider-wrapper', {
    loop: true,
    grabCursor: true,
    spaceBetween: 3,

    // Pagination bullets
    pagination: {
      el: '.swiper-pagination',
      clickable: true,
      dynamicBullets: true
    },

    // Navigation arrows
    navigation: {
      nextEl: '.swiper-button-next',
      prevEl: '.swiper-button-prev',
    },

    // Responsive breakpoints
    breakpoints: {
      0: {
        slidesPerView: 1
      },
      768: {
        slidesPerView: 2
      },
      1024: {
        slidesPerView: 5
      }
    }
  });
</script>
