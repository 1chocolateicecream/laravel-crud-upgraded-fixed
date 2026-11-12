<x-layout>
    <x-slot:title>
        Show a product
    </x-slot>

    <h1>{{ $product->name }}</h1>
    <h4>Quantity: {{ $product->quantity }}</h4>
    <p>{{ $product->description }}</p>

    <a href="{{ route('products.edit', $product) }}">Edit</a>
    <form action="{{ route('products.destroy', $product) }}" method="post">
        @csrf
        @method('DELETE')
        <input type="submit" value="Delete">
    </form>
</x-layout>
