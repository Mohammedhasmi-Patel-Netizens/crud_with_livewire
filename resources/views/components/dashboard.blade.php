<table class="table">
    <thead>
      <tr>
        <th>Id</th>
        <th scope="col">Name</th>
        <th scope="col">Description</th>
        <th scope="col">Price</th>
        <th scope="col">Image</th>
        <th scope="col">Action</th>
      </tr>
    </thead>
    <tbody>
      @foreach ($products as $product)
      <tr>
        <td>{{ $product->id }}</td>
        <td>{{ $product->name }}</td>
        <td>{{ $product->description }}</td>
        <td>${{ $product->price }}</td>
        <td>
          <img src="http://crudwithlivewire.test/storage/{{ $product->image_uri }}"
            alt="{{ $product->name }}" style="width: 50px; height: auto;" />
        </td>
        <td>
            <button class="btn btn-primary" wire:click="updateProductById({{ $product->id }})">Update</button>
            <button class="btn btn-danger" wire:click="deleteProductById({{$product->id}})">Delete</button>
        </td>
      </tr>
      @endforeach
      
    </tbody>
  </table>