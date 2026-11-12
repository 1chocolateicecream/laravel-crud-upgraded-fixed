<x-layout>
    <x-slot:title>
        Edit product
    </x-slot>

    <form action="{{ route('products.update', $product) }}" method="post">
        @csrf
        @method('PUT')

        <input type="text" name="name" value="{{ old('name', $product->name) }}">
        <input type="number" name="quantity" value="{{ old('quantity', $product->quantity) }}" min="0">
        <textarea name="description">{{ old('description', $product->description) }}</textarea>
        <input type="submit" value="Submit">
    </form>
</x-layout>
