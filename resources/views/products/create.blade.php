<x-layout>
    <x-slot:title>
        Create new product
    </x-slot>

    <form action="{{ route('products.store') }}" method="post">
        @csrf

        <input type="text" name="name" value="{{ old('name') }}" placeholder="Product name">
        <input type="number" name="quantity" value="{{ old('quantity') }}" placeholder="Quantity" min="0">
        <textarea name="description" placeholder="Product description">{{ old('description') }}</textarea>
        <input type="submit" value="Submit">
    </form>
</x-layout>
