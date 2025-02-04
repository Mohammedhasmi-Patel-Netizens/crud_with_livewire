<div>

  {{-- Here doing toggle stuff so when the user need to add the product then add-Product form render and vise wersa. --}}
  <button class="btn btn-primary m-15" wire:click="toggleAddProductForm">
    @if($showAddProductForm) Cancel @else Add Products @endif
  </button>

  {{-- conditional rendering for adding product --}}
  @if($showAddProductForm)
      <x-add-product /> 
  @endif

  <button class="btn btn-primary m-15" wire:click="toggleDashboard">
    @if($showDashboard) Cancel @else Dashboard @endif
  </button>

  @if($showDashboard)
      <x-dashboard :products="$products" /> 
  @endif


  <div class="d-flex">
    <div class="container">
      <div class="row">
        <div class="col-md-6">
          <h2>Products</h2>
          <div class="row">
            @foreach ($products as $product)
            <div class="col-md-4 mb-4">
              <div class="card">
                <img src="http://crudwithlivewire.test/storage/{{ $product->image_uri }}" class="card-img-top" height="100"
                  alt="{{ $product->name }}">
                <div class="card-body">
                  <h6 class="card-title">{{ $product->name }}</h6>
                  {{-- <p class="card-text">{{ $product->description }}</p> --}}
                  <p class="card-text"><strong>Price: ${{ $product->price }}</strong></p>
                  <a href="#" class="btn btn-primary" wire:click="addToCart({{ $product->id }})">Add to Cart</a>
                </div>
              </div>
            </div>
            @endforeach
          </div>
        </div>

        <div class="col-md-6">
          <h2>Cart Items</h2>
          @if(isset($carts) && $carts->isNotEmpty())
          <table class="table">
            <thead>
              <tr>
                <th>Id</th>
                <th scope="col">Name</th>
                <th scope="col">Description</th>
                <th scope="col">Price</th>
                <th scope="col">Image</th>
                <th scope="col">Quantity</th>
                <th>Total Price</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($carts as $cart)
              <tr>
                <td>{{ $cart->id }}</td>
                <td>{{ $cart->product->name }}</td>
                <td>{{ $cart->product->description }}</td>
                <td>${{ $cart->product->price }}</td>
                <td>
                  <img src="http://crudwithlivewire.test/storage/{{ $cart->product->image_uri }}"
                    alt="{{ $cart->product->name }}" style="width: 50px; height: auto;" />
                </td>
                <td>{{ $cart->quantity }}</td>
                <td>${{ $cart->product->price * $cart->quantity }}</td>
              </tr>
              @endforeach
              
            </tbody>
          </table>
          
          <x-cart-bill totalCartPrice="{{$total_cart_price}}" :discountedPrice="$discountedPrice" :totalCartAmountAfterDiscount="$totalCartAmountAfterDiscount" />
          @else
          <p>Your cart is empty.</p>
          @endif
        </div>
      </div>
    </div>
  </div>
</div>