<div class="container">
    <h1 class="text-center mb-4">Update Product</h1>
    <form wire:submit.prevent="addProduct" enctype="multipart/form-data">
        @csrf 
        <div class="mb-3">
            <label for="name" class="form-label">Product Name</label>
            <input type="text" class="form-control" id="name" wire:model="name" required>
        </div>

        <div class="mb-3">
            <label for="description" class="form-label">Description</label>
            <textarea class="form-control" id="description" wire:model="description" rows="3" required></textarea>
        </div>

        <div class="mb-3">
            <label for="image" class="form-label">Image</label>
            <input type="file" class="form-control" id="image" wire:model="image" accept="image/*" required>
        </div>

        <div class="mb-3">
            <label for="price"  class="form-label">Price</label>
            <input type="number" class="form-control" id="price" wire:model="price" step="0.01" required>
        </div>

        <button type="submit" class="btn btn-success">Update Product</button>
    </form>

    @if (session()->has('message'))
        <div class="alert alert-success mt-3">
            {{ session('message') }}
        </div>
    @endif
</div>