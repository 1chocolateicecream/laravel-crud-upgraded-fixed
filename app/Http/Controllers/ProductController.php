<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::all();

        return view('products.index', compact('products'));
    }

    public function create()
    {
        return view('products.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255', 'unique:products'],
            'quantity' => ['required', 'integer', 'min:0'],
            'description' => ['required', 'string'],
        ]);

        $product = Product::create($validated);

        return redirect()
            ->route('products.show', [$product])
            ->with('message', 'Product created successfully');
    }

    public function show(Product $product)
    {
        return view('products.show', compact('product'));
    }

    public function destroy(Product $product)
    {
        $product->delete();

        return redirect()
            ->route('products.index')
            ->with('message', 'Product deleted successfully');
    }

    public function edit(Product $product)
    {
        return view('products.edit', compact('product'));
    }

    public function update(Request $request, Product $product)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255', Rule::unique('products')->ignore($product->id)],
            'quantity' => ['required', 'integer', 'min:0'],
            'description' => ['required', 'string'],
        ]);

        $product->update($validated);

        return redirect()
            ->route('products.show', [$product])
            ->with('message', 'Product updated successfully');
    }

    public function decreaseQuantity(Request $request, Product $product)
    {
        $request->validate([
            'amount' => ['required', 'integer', 'min:1'],
        ]);

        if ($product->decreaseQuantity($request->amount)) {
            return redirect()
                ->route('products.show', [$product])
                ->with('message', 'Product quantity decreased successfully');
        }

        return redirect()
            ->route('products.show', [$product])
            ->with('error', 'Not enough stock to decrease quantity.');
    }

    public function updateQuantity(Request $request, Product $product)
    {
        $validated = $request->validate([
            'direction' => ['required', 'in:increase,decrease'],
            'amount' => ['required', 'integer', 'min:1'],
        ]);

        $amount = (int) $validated['amount'];

        if ($validated['direction'] === 'increase') {
            Product::whereKey($product->id)->increment('quantity', $amount, ['updated_at' => now()]);
        } else {
            $updated = Product::whereKey($product->id)
                ->where('quantity', '>=', $amount)
                ->decrement('quantity', $amount, ['updated_at' => now()]);

            if ($updated === 0) {
                return response()->json([
                    'message' => 'Not enough stock to decrease quantity.',
                ], 422);
            }
        }

        return response()->json([
            'quantity' => $product->fresh()->quantity,
            'message' => 'Product quantity updated successfully.',
        ]);
    }

    public function increaseQuantity(Product $product)
    {
        Product::whereKey($product->id)
            ->increment('quantity', 1, ['updated_at' => now()]);

        return response()->json([
            'quantity' => $product->fresh()->quantity,
        ]);
    }

    public function decreaseQuantityAjax(Product $product)
    {
        Product::whereKey($product->id)
            ->where('quantity', '>', 0)
            ->decrement('quantity', 1, ['updated_at' => now()]);

        return response()->json([
            'quantity' => $product->fresh()->quantity,
        ]);
    }
}