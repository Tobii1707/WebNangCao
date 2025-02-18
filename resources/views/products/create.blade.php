<h1>Add Product</h1>
<form action="{{ route('products.store') }}" method="POST">
    @csrf
    <label>Name:</label>
    <input type="text" name="name" required>
    <label>Description:</label>
    <textarea name="description"></textarea>
    <label>Price:</label>
    <input type="number" name="price" step="0.01" required>
    <label>Quantity:</label>
    <input type="number" name="quantity" required>
    <button type="submit">Save</button>
</form>
<a href="{{ route('products.index') }}">Back</a>
