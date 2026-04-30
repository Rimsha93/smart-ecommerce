<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class AdminOrderController extends Controller {

    public function index(Request $request) {
        if ($request->ajax()) {
            $orders = Order::with('user')->select('orders.*');

            return DataTables::of($orders)
                ->addIndexColumn()
                ->addColumn('customer', function($order) {
                    return '<div>
                                <div class="fw-600">'.$order->user->name.'</div>
                                <div class="text-muted small">'.$order->user->email.'</div>
                            </div>';
                })
                ->addColumn('total_formatted', function($order) {
                    return '<span class="fw-700" style="color:#e94560">$'.number_format($order->total_amount, 2).'</span>';
                })
                ->addColumn('status_badge', function($order) {
                    $colors = [
                        'pending'    => 'badge-status-pending',
                        'processing' => 'badge-status-processing',
                        'shipped'    => 'badge-status-shipped',
                        'delivered'  => 'badge-status-delivered',
                        'cancelled'  => 'badge-status-cancelled',
                    ];
                    $class = $colors[$order->status] ?? 'bg-secondary';
                    return '<span class="badge '.$class.' px-3 py-2" 
                                style="border-radius:50px;text-transform:capitalize">
                                '.$order->status.'
                            </span>';
                })
                ->addColumn('items_count', function($order) {
                    return $order->items()->count() . ' items';
                })
                ->addColumn('date', function($order) {
                    return $order->created_at->format('M d, Y');
                })
                ->addColumn('actions', function($order) {
                    $url = route('admin.orders.show', $order);
                    return '<a href="'.$url.'" class="btn btn-sm btn-outline-primary">Details</a>';
                })
                ->rawColumns(['customer', 'total_formatted', 'status_badge', 'actions'])
                ->make(true);
        }

        return view('admin.orders.index');
    }

    public function show(Order $order) {
        $order->load('items.product', 'user');
        return view('admin.orders.show', compact('order'));
    }

    public function updateStatus(Request $request, Order $order) {
        $request->validate(['status' => 'required|in:pending,processing,shipped,delivered,cancelled']);
        $order->update(['status' => $request->status]);
        return back()->with('success', 'Order status updated!');
    }
}