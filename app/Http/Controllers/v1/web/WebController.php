<?php

namespace App\Http\Controllers\v1\web;

use App\Models\Magasin;
use App\Models\Produit;
use App\Models\Category;
use App\Models\Commande;
use Illuminate\Http\Request;
use App\Models\CommandProduct;
use App\Models\ProductCategory;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;

class WebController extends Controller
{
    public function home()
    {
        $categories = Category::inRandomOrder()->limit(4)->get();
        $products = Produit::inRandomOrder()->limit(6)->get();
        $magasins = Magasin::inRandomOrder()->limit(12)->get();

        return view('v1.web.pages.home.index', compact('products', 'categories', 'magasins'));
    }

    public function changeQuantity(Request $request)
    {
        $productId = dcryptID($request->input('product_id'));
        $quantity = (int) $request->input('quantity', 1);

        // جلب السلة من السيشن
        $cart = session()->get('panier', []);

        if (!isset($cart[$productId])) {
            return response()->json(['message' => 'Produit non trouvé dans le panier.'], 404);
        }

        // تحديث الكمية
        $cart[$productId]['quantity'] = max(1, $quantity); // لا تقل عن 1

        // إعادة حفظ السلة
        session()->put('panier', $cart);

        $products_on_panier = session()->get('panier');

        return response()->json([
            'message' => 'Quantité mise à jour.',
            'html' => view('v1.web.pages.panier.index', compact('products_on_panier'))->render(),
            'html1' => view('v1.web.layouts.header._index')->render(),
        ]);
    }
    public function clear()
    {
        session()->forget('panier');

        return response()->json([
            'message' => 'Le panier a été vidé.',
            'html' => view('v1.web.pages.panier.index')->render(), // أو إعادة جزء فقط
            'html1' => view('v1.web.layouts.header._index')->render(),
        ]);
    }

    public function delete(Request $request)
    {
        $productId = dcryptID($request->input('product_id'));

        // جلب السلة
        $cart = session()->get('panier', []);

        if (isset($cart[$productId])) {
            unset($cart[$productId]);
            session()->put('panier', $cart);
        }

        $products_on_panier = session()->get('panier');

        return response()->json([
            'message' => 'Produit retiré du panier.',
            'html' => view('v1.web.pages.panier.index', compact('products_on_panier'))->render(),
            'html1' => view('v1.web.layouts.header._index')->render(),
        ]);
    }


    public function magasins()
    {


        $req = request();

        // this condition for filter data
        $magasins = Magasin::latest();

        // if ($req->filled('order_by')) {
        //     switch ($req->input('order_by')) {
        //         case 'PRICE_ASC':
        //             $magasins->orderBy('price', 'asc');
        //         case 'PRICE_DESC':
        //             $magasins->orderBy('price', 'desc');
        //         case 'NAME_ASC':
        //             $magasins->orderBy('name', 'asc');
        //         case 'NAME_DESC':
        //             $magasins->orderBy('name', 'desc');
        //     }
        // }

        // if ($req->input('product_categories_ids')) {

        //     $category_ids = explode(',', $req->input('product_categories_ids'));

        //     $magasins->whereIn('category_id', explode(',', $category_ids));
        // };

        if ($req->filled('category_ids')) {
            $encryptedIds = explode(',', $req->input('category_ids'));

            $productCategoryIds = collect($encryptedIds)
                ->filter() // remove null/empty
                ->map(fn($id) => dcryptID($id))
                ->toArray();

            $magasins->whereIn('category_id', $productCategoryIds);
        }

        // if ($req->filled('magasin_ids')) {
        //     $encryptedMagasinIds = explode(',', $req->input('magasin_ids'));

        //     $magasinIds = collect($encryptedMagasinIds)
        //         ->filter()
        //         ->map(function ($id) {
        //             try {
        //                 return dcryptID($id);
        //             } catch (\Exception $e) {
        //                 return null; // or log error
        //             }
        //         })
        //         ->filter() // Remove nulls
        //         ->toArray();

        //     // Optional: Debug
        //     // dd($req->input('magasin_ids'), $magasinIds, $magasins->whereIn('magasin_id', $magasinIds)->get());

        //     $magasins->whereIn('magasin_id', $magasinIds);
        // }
        // if ($magasin_ids = $req->input('magasins')) {
        //     $magasins->whereIn('magasin_id', explode(',', $magasin_ids));
        // };

        if ($req->input('q') != null) $magasins->where('name', "LIKE", "%" . $req->input('q') . "%");

        // if ($req->input('min-duration') != null || $req->input('max-duration') != null) {
        //     $magasins->where('duration', ">=", (int) $req->input('min-duration'))->where('duration', "<=", (int) $req->input('max-duration'));
        // };

        $magasins = $magasins->paginate(12)->appends($req->except('page'));

        if ($req->ajax()) {
            return response()->json(['html' => view('v1.web.pages.magasins.html.items', compact('magasins'))->render()]);
        }

        $categories = Category::all();
        return view('v1.web.pages.magasins.index', compact('categories', "magasins"));
    }
    public function panier()
    {
        $categories = Category::inRandomOrder()->limit(4)->get();
        $products = Produit::inRandomOrder()->limit(12)->get();
        $magasins = Magasin::inRandomOrder()->limit(12)->get();

        return view('v1.web.pages.panier.index', compact('products', 'categories', 'magasins'));
    }
    public function thankyou()
    {
        $commande = Commande::find(dcryptID(request()->command_id));
        if (!$commande) return response()->json(['message' => "La Commande est incorrect"], 422);

        return view('v1.web.pages.thankyou.index', compact('commande'));
    }
    public function checkout()
    {
        $categories = Category::inRandomOrder()->limit(4)->get();
        $products = Produit::inRandomOrder()->limit(12)->get();
        $magasins = Magasin::inRandomOrder()->limit(12)->get();

        return view('v1.web.pages.checkout.index', compact('products', 'categories', 'magasins'));
    }
    public function checkoutPost()
    {
        $req = request();


        // Dynamic validation rules
        $rules = [
            'full_name' => 'required|string',
            'phone' => 'required',
            'province' => 'required|string',
            'quartier' => 'nullable|string',
            'address' => 'required|string',
        ];

        // Validation messages
        $messages = [
            'full_name.required' => 'Le nom complet est obligatoire.',
            'phone.required' => 'Le numéro de tелефone est obligatoire.',
            'province.required' => 'La province est obligatoire.',
            'quartier.required' => 'Le quartier est obligatoire.',
            'address.required' => 'L\'adresse est obligatoire.',
        ];

        // Validate the request
        $req->validate($rules, $messages);

        if (!session()->has('panier') || !count(session()->get('panier')) > 0) {
            return response()->json(['message' => 'Le panier est vide.'], 422);
        }

        try {
            $commande = null; // définir en dehors

            DB::transaction(function () use ($req, &$commande) {
                // Créer la commande
                $commande = new Commande();
                $commande->client_id = auth()->user()->hasRole('client') ? auth()->user()->id : null;
                $commande->total = collect(session()->get('panier', []))
                    ->map(fn($item) => $item['price'] * $item['quantity'])
                    ->sum(); 
                $commande->full_name = $req->full_name;
                $commande->phone_number = $req->phone;
                $commande->quartier = $req->quartier;
                $commande->adresse = $req->address;
                $commande->province = $req->province;
                $commande->save();

                foreach (session()->get('panier', []) as $product_on_panier) {
                    // Vérifier les données et décrypter les IDs
                    $product = Produit::find(dcryptID($product_on_panier['product_id']));
                    if (!$product) throw new \Exception("Le produit est incorrect");

                    $magasin = Magasin::find(dcryptID($product_on_panier['magasin_id']));
                    // if (!$magasin) throw new \Exception("Le magasin est incorrect");

                    $category = Category::find(dcryptID($product_on_panier['category_id']));
                    // if (!$category) throw new \Exception("La catégorie est incorrecte");

                    $product_category = ProductCategory::find(dcryptID($product_on_panier['product_category_id']));
                    // if (!$product_category) throw new \Exception("Le type est incorrect");

                    // Enregistrer les produits de la commande
                    $product_on_order = new CommandProduct();
                    $product_on_order->command_id = $commande->id;
                    $product_on_order->product_id = $product->id;
                    $product_on_order->magasin_id = $magasin?->id;
                    $product_on_order->category_id = $category?->id;
                    $product_on_order->product_category_id = $product_category?->id;

                    $product_on_order->unit_price = $product_on_panier['compare_price']; // Original price
                    $product_on_order->prix_remise = $product_on_panier['price'];      // Discounted price

                    // Calculate remise as positive or zero (no negative discounts)
                    $product_on_order->remise = max(0, $product_on_order->unit_price - $product_on_order->prix_remise);

                    // Calculate total based on discounted price * quantity
                    $product_on_order->quantity = $product_on_panier['quantity'];
                    $product_on_order->total = $product_on_order->prix_remise * $product_on_order->quantity;
                    $product_on_order->save();
                }
            });
            session()->forget('panier');

            // Si tout se passe bien
            return response()->json([
                'message' => 'Commande enregistrée avec succès.',
                "redirect" => route('web.thankyou', ["command_id" => cryptID($commande?->id)]),
            ], 200);
        } catch (\Exception $e) {
            // Log l'erreur et retourne une réponse claire
            Log::error('[COMMANDE ERROR] ' . $e->getMessage());

            return response()->json([
                'message' => $e->getMessage(),
            ], 422); // ou 500 si tu veux généraliser l’erreur
        }
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
        $products = Produit::latest();

        if ($req->filled('order_by')) {
            switch ($req->input('order_by')) {
                case 'PRICE_ASC':
                    $products?->orderBy('price', 'asc');
                case 'PRICE_DESC':
                    $products?->orderBy('price', 'desc');
                case 'NAME_ASC':
                    $products?->orderBy('name', 'asc');
                case 'NAME_DESC':
                    $products?->orderBy('name', 'desc');
            }
        }

        // if ($req->input('product_categories_ids')) {

        //     $category_ids = explode(',', $req->input('product_categories_ids'));

        //     $products?->whereIn('category_id', explode(',', $category_ids));
        // };

        if ($req->filled('product_category_ids')) {
            $encryptedIds = explode(',', $req->input('product_category_ids'));

            $productCategoryIds = collect($encryptedIds)
                ->filter() // remove null/empty
                ->map(fn($id) => dcryptID($id))
                ->toArray();

            $products?->whereIn('category_id', $productCategoryIds);
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
            // dd($req->input('magasin_ids'), $magasinIds, $products?->whereIn('magasin_id', $magasinIds)->get());

            $products?->whereIn('magasin_id', $magasinIds);
        }
        // if ($magasin_ids = $req->input('magasins')) {
        //     $products?->whereIn('magasin_id', explode(',', $magasin_ids));
        // };

        if ($req->input('q') != null) $products?->where('name', "LIKE", "%" . $req->input('q') . "%");

        // if ($req->input('min-duration') != null || $req->input('max-duration') != null) {
        //     $products?->where('duration', ">=", (int) $req->input('min-duration'))->where('duration', "<=", (int) $req->input('max-duration'));
        // };

        $products = $products?->paginate(12)->appends($req->except('page'));

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
