<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class CartBill extends Component
{
    /**
     * Create a new component instance.
     */
    public $totalCartPrice;
    public $discountedPrice;

    public $totalCartAmountAfterDiscount;
    public function __construct($totalCartPrice=0, $discountedPrice=0,$totalCartAmountAfterDiscount= 0)
    {
        $this->totalCartPrice = $totalCartPrice;
        $this->discountedPrice = $discountedPrice;
        $this->totalCartAmountAfterDiscount = $totalCartAmountAfterDiscount;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.cart-bill');
    }
}
