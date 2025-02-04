<?php

namespace App\Livewire;

use App\Models\Cart;
use App\Models\Product;
use Livewire\Component;
use Livewire\WithFileUploads;

class Products extends Component
{

    use WithFileUploads;
    public $products = [];
    public $carts;

    public $name;
    public $description;
    public $image;
    public $price;

    public $total_cart_price = 0;

    public $showAddProductForm = false;
    public $showDashboard = false;

    public $discountNumber = 0;

    public $discountedPrice = 0;

    public $totalCartAmountAfterDiscount;

    public function mount()
    {
        $this->loadProducts();
        $this->loadCarts();
    }

    public function loadProducts()
    {
        $this->products = Product::all();
    }

    public function loadCarts()
    {
        $this->carts = Cart::with('product')->get();
        $this->calculateCartSum();

    }

    public function toggleAddProductForm()
    {
        $this->showAddProductForm = !$this->showAddProductForm;
    }

    public function toggleDashboard()
    {
        $this->showDashboard = !$this->showDashboard;
    }



    // Logic for every page.

    public function addProduct()
    {
        $this->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'image' => 'required|image|max:2048',
            'price' => 'required|numeric|min:0',
        ]);

        $imagePath = $this->image->store('images', 'public');

        Product::create([
            'name' => $this->name,
            'description' => $this->description,
            'image_uri' => $imagePath,
            'price' => $this->price,
        ]);

        $this->reset(['name', 'description', 'image', 'price']);

        $this->loadProducts();

        session()->flash('message', 'Product added successfully!');
    }

    public function addToCart($productid)
    {

        $items = Cart::where('product_id','=',$productid)->first();
        // dd($items);
        if ($items) {
            $items->quantity += 1;
            $items->save();
        } else {
            $cart = new Cart();
            $cart->product_id = $productid;
            $cart->user_id = 1;
            $cart->quantity = 1;
            $cart->save();
        }

        $this->loadCarts();
        $this->applyDiscount();


        // Optionally, you can emit a success message
        session()->flash('message', 'Product added to cart successfully!');
    }

    public function calculateCartSum(){

        $this->total_cart_price = $this->carts->sum(function($item){
            return $item['quantity'] * $item['product']['price'];
        });

        // dd($this->total_cart_price);
    }

    public function applyDiscount()
    {

        // dd($this->total_cart_price );

        if ($this->total_cart_price > 0) {
            $percentage = $this->discountNumber/100;
            $this->discountedPrice = $this->total_cart_price * $percentage;

        } else {
            $this->discountedPrice = 0;
        }

        $this->totalCartAmountAfterDiscount = $this->total_cart_price - $this->discountedPrice;

    }

    public function updateProductById($productid){
        dd($productid);
    }

    public function deleteProductById($productid){
        // dd($productid);

        Product::destroy($productid);
        // $this->loadProducts();
        $this->mount();

    }

    public function render()
    {
        return view('livewire.products');
    }
}
