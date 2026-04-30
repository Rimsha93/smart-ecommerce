<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Http\Request;

class CustomerController extends Controller {

    public function index(Request $request) {
        if ($request->ajax()) {
            $customers = User::where('role', 'user')
                             ->withCount('orders')
                             ->select('users.*');

            return DataTables::of($customers)
                ->addIndexColumn()
                ->addColumn('avatar', function($user) {
                    $initial = strtoupper(substr($user->name, 0, 1));
                    return '<div class="rounded-circle d-flex align-items-center justify-content-center 
                                text-white fw-700" 
                                style="width:38px;height:38px;background:#e94560;font-size:.85rem">
                                '.$initial.'
                            </div>';
                })
                ->addColumn('orders_badge', function($user) {
                    return '<span class="badge bg-primary bg-opacity-10 text-primary px-3" 
                                style="border-radius:50px">'.$user->orders_count.' orders</span>';
                })
                ->addColumn('joined', function($user) {
                    return $user->created_at->format('M d, Y');
                })
                ->addColumn('actions', function($user) {
                    $url = route('admin.customers.show', $user);
                    return '<a href="'.$url.'" class="btn btn-sm btn-outline-primary">View</a>';
                })
                ->rawColumns(['avatar', 'orders_badge', 'actions'])
                ->make(true);
        }

        return view('admin.customers.index');
    }

    public function show(User $user) {
        $user->load('orders.items.product');
        return view('admin.customers.show', compact('user'));
    }
}