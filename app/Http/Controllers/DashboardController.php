<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Order;
use App\Models\Product;
use App\Models\NewsletterSubscriber;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        if ($user->role === 'user') {
            return view('dashboard', compact('user'));
        }

        $stats = [
            'orders_total'        => Order::count(),
            'orders_today'        => Order::whereDate('created_at', today())->count(),
            'orders_pending'      => Order::where('status', 'pending')->count(),
            'revenue_total'       => Order::where('payment_status', 'paid')->sum('total'),
            'revenue_month'       => Order::where('payment_status', 'paid')
                                         ->whereMonth('created_at', now()->month)
                                         ->whereYear('created_at', now()->year)
                                         ->sum('total'),
            'customers_total'     => Customer::count(),
            'customers_month'     => Customer::whereMonth('created_at', now()->month)
                                             ->whereYear('created_at', now()->year)
                                             ->count(),
            'products_total'      => Product::count(),
            'subscribers_total'   => NewsletterSubscriber::count(),
        ];

        $recent_orders = Order::with('customer')
            ->latest()
            ->take(8)
            ->get();

        return view('dashboard', compact('user', 'stats', 'recent_orders'));
    }
}
