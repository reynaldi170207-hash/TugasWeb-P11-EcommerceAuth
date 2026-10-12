<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use App\Models\User;

class DashboardController extends Controller
{
    public function __invoke()
    {
        $stats = [
            'users' => User::count(),
            'products' => Product::count(),
            'orders' => Order::count(),
            'revenue' => (int) OrderItem::query()->selectRaw('COALESCE(SUM(qty * price), 0) as revenue')->value('revenue'),
        ];

        $products = Product::with(['category', 'user'])->latest()->take(10)->get();

        $orders = Order::with('user')
            ->withSum('items as total_qty', 'qty')
            ->latest()
            ->take(10)
            ->get();

        return view('manage.dashboard', compact('stats', 'products', 'orders'));
    }
}
