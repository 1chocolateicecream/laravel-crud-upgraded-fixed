<x-layout>
    <x-slot:title>
        Edit product
    </x-slot>

    <form action="{{ route('products.update', $product) }}" method="post">
        @csrf
        @method('PUT')

        <input
            type="text"
            name="name"
            value="{{ old('name', $product->name) }}"
        >

        <div>
            <button type="button" id="decrease-btn">−</button>

            <span id="quantity">
                {{ old('quantity', $product->quantity) }}
            </span>

            <button type="button" id="increase-btn">+</button>

            <input
                type="hidden"
                id="quantity-input"
                name="quantity"
                value="{{ old('quantity', $product->quantity) }}"
            >
        </div>

        <textarea name="description">{{ old('description', $product->description) }}</textarea>

        <input type="submit" value="Submit">
    </form>

    <script>
        const productId = {{ $product->id }};
        const quantityText = document.getElementById('quantity');
        const quantityInput = document.getElementById('quantity-input');

        document.getElementById('increase-btn').addEventListener('click', async () => {
            const response = await fetch(
                `/products/${productId}/increase-quantity`,
                {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        'Accept': 'application/json'
                    }
                }
            );

            const data = await response.json();

            quantityText.textContent = data.quantity;
            quantityInput.value = data.quantity;
        });


        document.getElementById('decrease-btn').addEventListener('click', async () => {
            const response = await fetch(
                `/products/${productId}/decrease-quantity-ajax`,
                {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        'Accept': 'application/json'
                    }
                }
            );

            const data = await response.json();

            quantityText.textContent = data.quantity;
            quantityInput.value = data.quantity;
        });
    </script>
</x-layout>