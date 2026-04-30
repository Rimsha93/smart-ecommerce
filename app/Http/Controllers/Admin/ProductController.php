<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\Facades\DataTables;

class ProductController extends Controller {

    public function index(Request $request) {
        if ($request->ajax()) {
            $products = Product::with('category')->select('products.*');

            return DataTables::of($products)
                ->addIndexColumn()
                ->addColumn('image', function($product) {
                    if ($product->image) {
                        return '<img src="'.asset('storage/'.$product->image).'" 
                                style="width:45px;height:45px;object-fit:cover;border-radius:10px">';
                    }
                    return '<div style="width:45px;height:45px;background:linear-gradient(135deg,#1a1a2e,#16213e);
                            border-radius:10px;display:flex;align-items:center;justify-content:center">
                            <i class=\'bi bi-box-seam text-white-50 small\'></i></div>';
                })
                ->addColumn('category_name', function($product) {
                    return $product->category
                        ? '<span class="badge bg-secondary bg-opacity-10 text-secondary px-3" 
                               style="border-radius:50px">'.$product->category->name.'</span>'
                        : '<span class="text-muted">—</span>';
                })
                ->addColumn('price_formatted', function($product) {
                    return '<span class="fw-700" style="color:#e94560">$'.number_format($product->price, 2).'</span>';
                })
                ->addColumn('stock_badge', function($product) {
                    $color = $product->stock <= 5 ? 'text-danger fw-700' : 'text-success fw-600';
                    return '<span class="'.$color.'">'.$product->stock.'</span>';
                })
                ->addColumn('status_badge', function($product) {
                    if ($product->is_active) {
                        return '<span class="badge bg-success bg-opacity-10 text-success px-3" 
                                    style="border-radius:50px">Active</span>';
                    }
                    return '<span class="badge bg-secondary bg-opacity-10 text-secondary px-3" 
                                style="border-radius:50px">Inactive</span>';
                })
                ->addColumn('actions', function($product) {
                    $editUrl   = route('admin.products.edit', $product);
                    $deleteUrl = route('admin.products.destroy', $product);
                    return '
                        <div class="d-flex gap-2">
                            <a href="'.$editUrl.'" class="btn btn-sm btn-outline-primary">
                                <i class="bi bi-pencil"></i>
                            </a>
                            <form action="'.$deleteUrl.'" method="POST" 
                                  onsubmit="return confirm(\'Delete this product?\')">
                                <input type="hidden" name="_token" value="'.csrf_token().'">
                                <input type="hidden" name="_method" value="DELETE">
                                <button type="submit" class="btn btn-sm btn-outline-danger">
                                    <i class="bi bi-trash3"></i>
                                </button>
                            </form>
                        </div>';
                })
                ->rawColumns(['image', 'category_name', 'price_formatted', 'stock_badge', 'status_badge', 'actions'])
                ->make(true);
        }

        return view('admin.products.index');
    }

    // create, store, edit, update, destroy same as before
    public function create() {
        $categories = Category::all();
        return view('admin.products.create', compact('categories'));
    }

    public function store(Request $request) {
        $request->validate([
            'name'        => 'required|string|max:255',
            'price'       => 'required|numeric|min:0',
            'stock'       => 'required|integer|min:0',
            'description' => 'nullable|string',
            'category_id' => 'nullable|exists:categories,id',
            'image'       => 'nullable|image|max:2048',
        ]);

        $data         = $request->except('image');
        $data['slug'] = Str::slug($request->name) . '-' . uniqid();

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('products', 'public');
        }

        Product::create($data);
        return redirect()->route('admin.products.index')->with('success', 'Product created!');
    }

    public function edit(Product $product) {
        $categories = Category::all();
        return view('admin.products.edit', compact('product', 'categories'));
    }

    public function update(Request $request, Product $product) {
        $request->validate([
            'name'        => 'required|string|max:255',
            'price'       => 'required|numeric|min:0',
            'stock'       => 'required|integer|min:0',
            'description' => 'nullable|string',
            'category_id' => 'nullable|exists:categories,id',
            'image'       => 'nullable|image|max:2048',
        ]);

        $data = $request->except('image');

        if ($request->hasFile('image')) {
            if ($product->image) Storage::disk('public')->delete($product->image);
            $data['image'] = $request->file('image')->store('products', 'public');
        }

        $product->update($data);
        return redirect()->route('admin.products.index')->with('success', 'Product updated!');
    }

    public function destroy(Product $product) {
        if ($product->image) Storage::disk('public')->delete($product->image);
        $product->delete();
        return back()->with('success', 'Product deleted!');
    }
}