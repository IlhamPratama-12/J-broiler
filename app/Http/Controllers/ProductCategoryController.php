<?php

namespace App\Http\Controllers;

use Illuminate\Support\Str;
use App\Helpers\ImageHelper;
use Illuminate\Http\Request;
use App\Models\ProductCategory;

class ProductCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $productCategories = ProductCategory::all();
        return view('admin.pages.product-categories.index', compact('productCategories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $category = new ProductCategory();
        return view('admin.pages.product-categories.create', [
            'category' => $category,
            'title' => 'Tambah Kategori',
            'route' => route('product-categories.store'),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $input = $request->validate([
            'name' => 'required',
            'description' => 'nullable',
            'image'     => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:5048',
        ]);

        if ($file = $request->file('image')) {
            $path = ImageHelper::resize('public/categories/', $file);
            $input['image'] = $path;
        }

        $input['slug'] = Str::slug($input['name'], '-');
        ProductCategory::create($input);
        return redirect()->route('product-categories.index')->with('success','Kategori Produk berhasil disimpan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(ProductCategory $productCategory)
    {
        return view('admin.pages.product-categories.show', [
            'category' => $productCategory,
            'title' => 'Detail Kategori',
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ProductCategory $productCategory)
    {
        return view('admin.pages.product-categories.create', [
            'category' => $productCategory,
            'title' => 'Ubah Kategori',
            'route' => route('product-categories.update', $productCategory->id),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ProductCategory $productCategory)
    {
        $input = $request->validate([
            'name' => 'required',
            'description' => 'nullable',
            'image'     => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:5048',
        ]);

        if ($file = $request->file('image')) {
            $path = ImageHelper::resize('public/categories/', $file);
            $input['image'] = $path;
        }else{
            unset($input['image']);
        }

        $input['slug'] = Str::slug($input['name'], '-');
        $productCategory->update($input);
        return redirect()->route('product-categories.index')->with('success','Kategori Produk berhasil diubah.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ProductCategory $productCategory)
    {
        $productCategory->delete();
        return response()->json(['message' => 'Kategori Produk berhasil dihapus.']);
    }

    public function isVisible(ProductCategory $productCategory)
    {
        $visible = false;
        $message = 'Produk Kategori disembunyikan diwebsite utama.';
        if ($productCategory->is_visible == false) {
            $message = 'Produk Kategori ditampilkan diwebsite utama.';
            $visible = true;
        };
        $productCategory->update([
            "is_visible" => $visible,
        ]);
        return redirect()->route('product-categories.index')->with('success', $message);
    }
}
