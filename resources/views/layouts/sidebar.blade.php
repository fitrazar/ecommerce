  {{-- <!-- Sidebar Content -->
  <div class="drawer-side">
      <label for="my-drawer-2" aria-label="close sidebar" class="drawer-overlay"></label>
      <ul class="menu bg-base-200 text-base-content min-h-full w-[250px] p-4">
          @auth
              <li><a href="{{ route('dashboard') }}">Beranda</a></li>
              <li>
                  <details>
                      <summary>Data Master</summary>
                      <ul class="p-2 z-10 w-[13rem]">
                          <li>
                              <details>
                                  <summary>Data Product</summary>
                                  <ul class="pl-4">
                                      <li><a href=" {{ route('product.index') }} ">Product</a></li>
                                      <li><a href="{{ route('category.index') }}">Kategori</a></li>
                                      <li><a href="{{ route('brand.index') }}">Brand</a></li>
                                  </ul>
                              </details>
                          </li>
                          <li>
                              <details>
                                  <summary>Data Detail Product</summary>
                                  <ul class="pl-4">
                                      <li><a href="{{ route('material.index') }}">Bahan</a></li>
                                      <li><a href="{{ route('unit.index') }}">Satuan</a></li>
                                      <li><a href="{{ route('color.index') }}">Warna</a></li>
                                      <li><a href="{{ route('size.index') }}">Ukuran</a></li>
                                  </ul>
                              </details>
                          </li>
                      </ul>
                  </details>
              </li>
          @else
              <li><a href="{{ route('home') }}">Home</a></li>
              <li><a href="/products">Products</a></li>
          @endauth
      </ul>
  </div> --}}

