<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class OrderController extends Controller
{
    public function index(Request $request)
    {
        $orders = $request->user()
            ->orders()
            ->with('items.product')
            ->latest()
            ->paginate(10);

        return view('orders.index', compact('orders'));
    }

    public function store(Request $request, Product $product)
    {
        abort_unless($product->is_active, 404);

        if ($product->stock < 1) {
            return back()->withErrors(['qty' => 'Stok produk habis.']);
        }

        $data = $request->validate([
            'qty' => ['required', 'integer', 'min:1', 'max:'.$product->stock],
        ]);

        DB::transaction(function () use ($request, $product, $data) {
            $order = $request->user()->orders()->create([
                'code' => 'INV-'.strtoupper(Str::random(8)),
                'status' => 'pending',
            ]);

            $order->items()->create([
                'product_id' => $product->id,
                'qty' => $data['qty'],
                'price' => $product->price,
            ]);

            $product->decrement('stock', $data['qty']);
        });

        return redirect()->route('orders.index')->with('status', 'Pesanan berhasil dibuat.');
    }
}
