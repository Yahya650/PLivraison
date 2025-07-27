<?php

namespace App\Http\Controllers\v1\dashboard;

use App\Models\Produit;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PanierController extends Controller
{

    public function add(Request $request)
    {
        $productId = dcryptID($request->input('product_id'));
        $quantity = $request->input('quantity', 1);

        $product = Produit::find($productId);
        if (!$product) return response()->json(['message' => "Le produit est incorrect"], 422);

        // Get existing cart from session
        $cart = session()->get('panier', []);

        // If product already in cart, update quantity
        if (isset($cart[$productId])) {
            $cart[$productId]['quantity'] += $quantity;
        } else {
            $cart[$productId] = [
                'product_id' => cryptID($product->id),
                'magasin_id' => cryptID($product->magasin_id),
                'category_id' => cryptID($product->magasin->category_id),
                'product_category_id' => cryptID($product->category_id),
                'name' => $product->name,
                'compare_price' => $product->compare_price,
                'price' => $product->price,
                'image' => $product->getLastAttachment()->stream() ?? null, // optional
                'magasin' => $product->magasin->name ?? null,
                'quantity' => $quantity,
            ];
        }

        // Store back to session
        $newCart = [$productId => $cart[$productId]] + array_diff_key($cart, [$productId => '']);
        session()->put('panier', $newCart);

        $products_on_panier = session()->get('panier');

        return response()->json(['message' => 'Produit ajouté au panier avec succès.', "html" => view('v1.web.layouts.header.components.panier', compact('products_on_panier'))->render()], 200);
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
