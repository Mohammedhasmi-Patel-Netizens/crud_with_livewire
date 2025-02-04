<?php

namespace App\Livewire;

use App\Models\Product;
use Livewire\Component;
use Livewire\WithFileUploads;

class AddProduct extends Component
{

    use WithFileUploads;
    public $name;
    public $description;
    public $image;
    public $price;

    protected $rules = [
        'name' => 'required|string|max:255',
        'description' => 'required|string',
        'image' => 'required|image|max:2048', 
        'price' => 'required|numeric|min:0',
    ];

    public function addProduct()
    {
        
        $this->validate();
        $imagePath = $this->image->store('images', 'public');

        Product::create([
            'name' => $this->name,
            'description' => $this->description,
            'image_uri' => $imagePath,
            'price' => $this->price,
        ]);

        $this->reset();

        $this->emit('Product');

        session()->flash('message', 'Product added successfully!');
    }
    public function render()
    {
        return view('livewire.add-product');
    }
}
