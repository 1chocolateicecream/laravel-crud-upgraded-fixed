<x-layout>
    <x-slot:title>
        Show a product
    </x-slot>

    <h1>{{ $product->name }}</h1>
    <section class="quantity-control" data-quantity-url="{{ route('products.quantity', $product) }}">
        <h4>Quantity: <span id="product-quantity" aria-live="polite">{{ $product->quantity }}</span></h4>
        <label for="quantity-amount">Change amount</label>
        <input id="quantity-amount" type="number" min="1" step="1" value="1">
        <div class="quantity-actions">
            <button type="button" data-direction="increase">Increase stock</button>
            <button type="button" data-direction="decrease">Decrease stock</button>
        </div>
        <p id="quantity-feedback" role="status" aria-live="polite"></p>
    </section>
    <p>{{ $product->description }}</p>

    <a href="{{ route('products.edit', $product) }}">Edit</a>
    <form action="{{ route('products.destroy', $product) }}" method="post">
        @csrf
        @method('DELETE')
        <input type="submit" value="Delete">
    </form>
</x-layout>
