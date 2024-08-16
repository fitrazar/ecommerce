@php
  use App\Models\Category;
  use App\Models\Product;

  $categories = Category::all();
  $products = Product::all();
  $product_sidebar = [];

  foreach ($categories as $key) {
      $list_product = [];
      foreach ($products as $key2) {
          if ($key->id === $key2->category_id) {
              $row = [
                  'name' => $key2->name,
                  'slug' => $key2->slug,
              ];
              $list_product[] = $row;
          }
      }

      if (count($list_product) < 1) {
          continue;
      }

      $row = [
          'category' => $key->name,
          'list_product' => $list_product,
      ];

      $product_sidebar[] = $row;
  }
@endphp

<style>
  details {
    overflow: hidden;
    margin-top: 0.125em;
    border: 1px solid #dddddd;
    background: #ffffff;
    color: #333333;
    border-radius: 3px;
  }

  details summary {
    display: block;
    cursor: pointer;
    padding: .5em .5em .5em .7em;
    /* background: #ededed; */
    color: #2b2b2b;
    /* border-radius: 3px 3px 0 0; */
  }

  details:not([open]) summary:hover,
  details:not([open]) summary:focus {
    background: #f6f6f6;
    color: #454545;
  }

  details[open] summary {
    color: black;
  }

  details main {
    padding: 1em 2.2em;
  }
</style>


<div class="w-48 ml-24 rounded-md hidden lg:block top-52 z-50 fixed">
  <h3 class="text-black bg-[#e3e3e3] p-2 font-semibold">Products</h3>
  @foreach ($product_sidebar as $item)
    <details>
      <summary>{{ $item['category'] }}</summary>
      <main class="p-0">
        @foreach ($item['list_product'] as $item_2)
          <li class="list-none hover:underline mt-3 mb-3 ml-2"><a
              href={{ url('products_detail/' . $item_2['slug']) }}>{{ $item_2['name'] }} </a>
          </li>
        @endforeach
      </main>
    </details>
  @endforeach
</div>
