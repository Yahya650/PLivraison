<?php

namespace App\Http\Controllers\v1\web;

use App\Models\Category;
use App\Http\Controllers\Controller;
use App\Models\Magasin;
use App\Models\ProductCategory;
use App\Models\Produit;

class WebController extends Controller
{
    public function home()
    {
        $categories = Category::inRandomOrder()->limit(4)->get();
        $products = Produit::inRandomOrder()->limit(12)->get();
        $magasins = Magasin::inRandomOrder()->limit(12)->get();

        return view('v1.web.pages.home.index', compact('products', 'categories', 'magasins'));
    }
    public function AddToCart()
    {
        $categories = Category::inRandomOrder()->limit(4)->get();
        $products = Produit::inRandomOrder()->limit(12)->get();
        $magasins = Magasin::inRandomOrder()->limit(12)->get();

        return view('v1.web.pages.home.index', compact('products', 'categories', 'magasins'));
    }

    public function products()
    {
        $req = request();

        // this condition for filter data
        $products = Produit::query();

        if ($req->filled('order_by')) {
            switch ($req->input('order_by')) {
                case 'PRICE_ASC':
                    $products->orderBy('price', 'asc');
                case 'PRICE_DESC':
                    $products->orderBy('price', 'desc');
                case 'NAME_ASC':
                    $products->orderBy('name', 'asc');
                case 'NAME_DESC':
                    $products->orderBy('name', 'desc');
            }
        }

        // if ($req->input('product_categories_ids')) {

        //     $category_ids = explode(',', $req->input('product_categories_ids'));

        //     $products->whereIn('category_id', explode(',', $category_ids));
        // };

        if ($req->filled('product_category_ids')) {
            $encryptedIds = explode(',', $req->input('product_category_ids'));

            $productCategoryIds = collect($encryptedIds)
                ->filter() // remove null/empty
                ->map(fn($id) => dcryptID($id))
                ->toArray();

            $products->whereIn('category_id', $productCategoryIds);
        }

        if ($req->filled('magasin_ids')) {
            $encryptedMagasinIds = explode(',', $req->input('magasin_ids'));

            $magasinIds = collect($encryptedMagasinIds)
                ->filter()
                ->map(function ($id) {
                    try {
                        return dcryptID($id);
                    } catch (\Exception $e) {
                        return null; // or log error
                    }
                })
                ->filter() // Remove nulls
                ->toArray();

            // Optional: Debug
            // dd($req->input('magasin_ids'), $magasinIds, $products->whereIn('magasin_id', $magasinIds)->get());

            $products->whereIn('magasin_id', $magasinIds);
        }
        // if ($magasin_ids = $req->input('magasins')) {
        //     $products->whereIn('magasin_id', explode(',', $magasin_ids));
        // };

        if ($req->input('q') != null) $products->where('name', "LIKE", "%" . $req->input('q') . "%");

        // if ($req->input('min-duration') != null || $req->input('max-duration') != null) {
        //     $products->where('duration', ">=", (int) $req->input('min-duration'))->where('duration', "<=", (int) $req->input('max-duration'));
        // };

        $products = $products->paginate(12)->appends($req->except('page'));

        if ($req->ajax()) {
            return response()->json(['html' => view('v1.web.pages.products.html.items', compact('products'))->render()]);
        }

        $categories = Category::all();
        $magasins = Magasin::all();
        $productCategories = ProductCategory::all();
        return view('v1.web.pages.products.index', compact('products', 'categories', "magasins", "productCategories"));
    }
    public function product($slug)
    {
        $req = request();


        $product = Produit::where('slug', $slug)->first();
        if (!$product) return response()->json(['message' => "La Produit est incorrect"], 422);


        return view('v1.web.pages.products.show.index', compact('product'));
    }
}
