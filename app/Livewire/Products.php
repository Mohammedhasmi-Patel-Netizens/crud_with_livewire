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
    public $carts = [];

    public $name;
    public $description;
    public $image;
    public $price;

    public $showAddProductForm = false;
    public $showDashboard = false;

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
        $this->carts = Cart::all();
    }

    public function toggleAddProductForm()
    {
        $this->showAddProductForm = !$this->showAddProductForm;
    }

    public function toggleDashboard()
    {
        $this->showDashboard = !$this->showDashboard;
    }



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


        // Optionally, you can emit a success message
        session()->flash('message', 'Product added to cart successfully!');
    }


    public function render()
    {
        return view('livewire.products');
    }
}
