{{-- <div class="container mt-3">
    <div class="row">
        <div class="col-md-6 offset-md-3">
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0">Apply Discount Code</h5>
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <label for="discount" class="form-label">Discount Code</label>
                        <div class="input-group">
                            <input type="text" class="form-control" id="discount" wire:model="discountNumber" placeholder="Enter discount code">
                            <button wire:click="applyDiscount($event.target.previousElementSibling.value)" type="button" class="btn btn-primary">Apply</button>
                        </div>
                    </div>

                    <h4 class="mt-4">Actual Total Price: 
                        <span class="text-success">${{ number_format($totalCartPrice, 2) }}</span>
                    </h4>
                    <h4>Discounted Price: 
                        <span class="text-warning">${{ number_format($discountedPrice, 2) }}</span>
                    </h4>
                    <h4>After Discount Total Price: 
                        <span class="text-danger">${{ number_format($totalCartAmountAfterDiscount, 2) }}</span>
                    </h4>
                </div>
            </div>
        </div>
    </div>
</div> --}}

<div class="container mt-5">
    <div class="row">
        <div class="col-md-6 offset-md-3">
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0">Apply Your Discount Code</h5>
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <label for="discount" class="form-label">Enter Discount Code</label>
                        <div class="input-group">
                            <input type="text" class="form-control" id="discount" wire:model="discountNumber" placeholder="e.g., SAVE10">
                            <button wire:click="applyDiscount($event.target.previousElementSibling.value)" type="button" class="btn btn-primary">Apply</button>
                        </div>
                    </div>

                    <h4 class="mt-4">Subtotal: 
                        <span class="text-success">${{ number_format($totalCartPrice, 2) }}</span>
                    </h4>
                    <h4>Discount Applied: 
                        <span class="text-warning">${{ number_format($discountedPrice, 2) }}</span>
                    </h4>
                    <h4>Total After Discount: 
                        <span class="text-danger">${{ number_format($totalCartAmountAfterDiscount, 2) }}</span>
                    </h4>
                </div>
            </div>
        </div>
    </div>
</div>