<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Order;
use App\Models\Product;
use App\Models\Contact;

class DashboardController extends Controller {
    public function index() {
        $totalUsers    = User::where('role', 'user')->count();
        $totalOrders   = Order::count();
        $totalRevenue  = Order::where('status', 'delivered')->sum('total_amount');
        $pendingOrders = Order::where('status', 'pending')->count();
        $recentOrders  = Order::with('user')->latest()->take(5)->get();
        $openMessages  = Contact::where('status', 'open')->count();
        $totalProducts = Product::count();

        return view('admin.dashboard', compact(
            'totalUsers', 'totalOrders', 'totalRevenue',
            'pendingOrders', 'recentOrders', 'openMessages', 'totalProducts'
        ));
    }
}