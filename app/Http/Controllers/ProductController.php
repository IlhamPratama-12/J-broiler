<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Support\Str;
use App\Helpers\ImageHelper;
use Illuminate\Http\Request;
use App\Models\ProductCategory;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;
use App\Http\Resources\ProductResource;
use Illuminate\Database\Eloquent\Builder;
use App\Http\Resources\ProductCategoryResource;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::orderBy('name', 'ASC')->get();
        return view('admin.pages.products.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = ProductCategory::all();
        $product = new Product();
        return view('admin.pages.products.create', [
            'categories' => $categories,
            'product' => $product,
            'title' => 'Tambah Produk',
            'route' => route('products.store'),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $input = $request->validate([
            'product_category_id' => 'nullable|exists:product_categories,id',
            'name' => ['required',
                Rule::unique('products', 'name')->whereNull('deleted_at'),
            ],
            'description' => 'nullable',
            'stock' => 'nullable|numeric',
            'price' => 'nullable|numeric',
            'unit' => 'nullable',
            'notes' => 'nullable',
            'image'=> 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:5048',
        ]);
        if ($file = $request->file('image')) {
            $path = ImageHelper::resize('public/product/', $file);
            $input['image'] = $path;
        }
        $inputSlug = Str::slug($input['name'], '-');
        $input['slug'] = $inputSlug . "-" .Str::random(5);
        Product::create($input);
        return redirect()->route('products.index')->with('success','Produk berhasil disimpan.');

    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        return view('admin.pages.products.show', [
            'product' => $product,
            'title' => 'Detail Produk',
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        $categories = ProductCategory::all();
        return view('admin.pages.products.create', [
            'categories' => $categories,
            'product' => $product,
            'title' => 'Ubah Produk',
            'route' => route('products.update', $product->id),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        $input = $request->validate([
            'product_category_id' => 'nullable|exists:product_categories,id',
            'name' => ['required',
                Rule::unique('products', 'name')->whereNull('deleted_at')->ignore($product->id)
            ],
            'description' => 'nullable',
            // 'stock' => 'nullable|numeric',
            'add_stock' => 'nullable|numeric',
            'price' => 'nullable|numeric',
            'unit' => 'nullable',
            'notes' => 'nullable',
            'image'=> 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:5048',
        ]);

        $addStock = isset($input['add_stock']) ? (int)$input['add_stock'] : 0;
        $stock = isset($product->stock) ? (int) $product->stock : 0;
        $input['stock'] = $stock + $addStock;

        if ($file = $request->file('image')) {
            $path = ImageHelper::resize('public/product/',$file);
            $input['image'] = $path;
        }else{
            unset($input['image']);
        }
        $product->update($input);
        return redirect()->route('products.index')->with('success','Produk berhasil diubah.');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        $product->delete();
        return response()->json([
            'success' =>'Produk berhasil dihapus.'
        ]);
    }

    public function isVisible(Product $product)
    {
        $visible = false;
        $message = 'Produk disembunyikan diwebsite utama.';
        if ($product->is_visible == false) {
            $message = 'Produk ditampilkan diwebsite utama.';
            $visible = true;
        };
        $product->update([
            "is_visible" => $visible,
        ]);
        return redirect()->route('products.index')->with('success', $message);
    }
}
