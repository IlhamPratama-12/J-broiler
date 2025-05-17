<?php

namespace App\Http\Controllers;

use App\Models\Guest;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Models\ProductCategory;

class MainController extends Controller
{
    private $categories;
    private $products;
    public function __construct(){
        $this->categories = ProductCategory::where('is_visible', true)->get();
        $this->products = Product::query();
    }

    public function home() {
        return view('main.pages.home', [
            'categories' => $this->categories,
            'products' => $this->products->where('is_visible', true)->latest()->paginate(10),
        ]);
    }

    public function products(Request $request) {
        $category = $request->query('category_');
        $old = $request->query('old');
        $asc = $request->query('asc');
        $desc = $request->query('desc');
        $lowToHigh = $request->query('low');
        $highToLow = $request->query('high');

        $products = $this->products->select('products.*','pc.slug as category_slug')
                ->leftJoin('product_categories as pc', 'pc.id', 'products.product_category_id')
                ->where('products.is_visible', true);

        if (isset($category)) {
            $products = $products->where('pc.slug', $category);
        };
        if (isset($asc)) {
            $products = $products->orderBy('products.name', 'ASC');
        };
        if (isset($desc)) {
            $products = $products->orderBy('products.name', 'DESC');
        };
        if (isset($lowToHigh)) {
            $products = $products->orderBy('products.price', 'ASC');
        };
        if (isset($highToLow)) {
            $products = $products->orderBy('products.price', 'DESC');
        };
        if (isset($old)) {
            $products = $products->orderBy('products.created_at', 'ASC');
        }
        $products = $products->paginate(12);
        return view('main.pages.products', [
            'categories' => $this->categories,
            'products' => $products
        ]);
    }

    public function productDetail() {
        $product = $this->products->where('slug', request('slug'))->first();
        return view('main.pages.detail-product' , [
            'categories' => $this->categories,
            'product' => $product,
        ]);
    }
    public function contact() {
        return view('main.pages.contact', ['categories' => $this->categories]);
    }
    public function partnership() {
        return view('main.pages.partnership', ['categories' => $this->categories]);
    }
    public function about() {
        return view('main.pages.about', ['categories' => $this->categories]);
    }

    public function guestCreate(Request $request) {
        $input = $request->validate([
            'full_name' => 'required',
            'phone' => 'required',
            'message' => 'required',
        ]);
        Guest::create($input);
        return redirect()->route('main.home')->with('success','Pesan berhasil terkirim. Terima Kasih');
    }
}
