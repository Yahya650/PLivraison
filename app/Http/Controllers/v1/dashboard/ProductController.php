<?php

namespace App\Http\Controllers\v1\dashboard;

use App\Models\Magasin;
use App\Models\Produit;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\ProductCategory;
use App\Http\Controllers\Controller;

class ProductController extends Controller
{

    public function products_list()
    {

        $req = request();
        $products = Produit::query();

        // if ($req->input('search') != null) {
        //     $searchTerm = "%" . $req->input('search') . "%";
        //     $products->where(function ($query) use ($searchTerm) {
        //         $query->where('title', 'LIKE', $searchTerm)
        //             ->orWhere('slug', 'LIKE', $searchTerm);
        //     })
        //         ->orWhereHas('pays', function ($query) use ($searchTerm) {
        //             $query->where('full_name', 'LIKE', $searchTerm);
        //         })
        //         ->orWhereHas('city', function ($query) use ($searchTerm) {
        //             $query->where('full_name', 'LIKE', $searchTerm);
        //         });
        // }

        // if ($req->input('country_filter') != null) {
        //     $products->where('country_id', $req->input('country_filter'));
        // }

        // if ($req->input('gender_filter') != null) {
        //     $products->where('gender', $req->input('gender_filter'));
        // }

        // if ($req->input('is_completed_filter') != null) {
        //     $products->where('is_completed', $req->input('is_completed_filter') == "true" ? 1 : 0);
        // }

        // if ($req->input('requested_date_filter') != null) {
        //     $products->whereDate('requested_date', $req->input('requested_date_filter'));
        // }

        // switch ($req->input('order_by')) {
        //     case 'BY_NAME':
        //         $products->orderBy('first_name');
        //         break;
        //     case 'BY_EMAIL':
        //         $products->orderBy('email');
        //         break;
        //     case 'BY_DATE':
        //         $products->orderBy('date_debut');
        //         break;
        //     default:
        //         $products->orderBy('created_at', 'desc');
        //         break;
        // }


        $products = $products->latest()->paginate(12)->appends($req->except('page'));
        return $products;

        // return Formation::latest()->paginate(9)->appends($req->except('page'));
    }

    public function validationData($req, $type, $produit = null)
    {
        // Dynamic validation rules
        $rules = [
            'category_id' => 'required',
            'magasin_id' => 'required',
            'name' => 'required|string|unique:produits,name,' .  $produit?->id ?? null,
            'description' => 'required|string',
            'price' => 'required|numeric',
            'compare_price' => 'nullable|numeric|gt:price',
            'images' => 'array',
            'images.*' => 'mimes:jpg,jpeg,png,gif,svg|max:2048',
        ];

        // Validation messages
        $messages = [
            'name.unique' => 'Le nom de la produit doit être unique.',
            'name.required' => 'Le nom de la produit est obligatoire.',
            'price.required' => 'Le prix de la produit est obligatoire.',
            "price.numeric" => "Le prix de la produit doit être un nombre.",
            "compare_price.gt" => "Le prix de comparaison de la produit doit être supérieur au prix de la produit.",
            "compare_price.numeric" => "Le prix de comparaison de la produit doit être un nombre.",
            'description.required' => 'La description de la produit est obligatoire.',
            'compare_price.required' => 'Le prix de la produit est obligatoire.',
            'category_id.required' => 'La catégorie de la produit est obligatoire.',
            'magasin_id.required' => 'Le magasin de la produit est obligatoire.',
            'images.required' => 'Les images de la produit sont obligatoires.',
            'images.*.mimes' => 'Les images de la produit doivent être au format jpg, jpeg, png, gif ou svg.',
            'images.*.max' => 'Les images de la produit doivent avoir une taille maximale de 2Mo.',

        ];

        // Validate the request
        $req->validate($rules, $messages);
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $products = $this->products_list();

        if (request()->ajax()) {
            // return response()->json(['html' => view('v1.dashboard.pages.products.html.table', compact('products'))->render(), 'redirect' => route('app.products.index', ['page' => request()->input('page'), 'search' => request()->input('search')])]);
            return response()->json(['html' => view('v1.dashboard.pages.products.html.table', compact('products'))->render()]);
        }

        return view('v1.dashboard.pages.products.index', compact("products"));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $product_categories = ProductCategory::get();
        $magasins = Magasin::get();

        return ["html" => view('v1.dashboard.pages.products.modals.create', compact('product_categories', 'magasins'))->render()];
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validationData($request, 'CREATE');

        $magasin = Magasin::find(dcryptID($request->magasin_id));
        if (!$magasin) return response()->json(['message' => "Le pays est incorrect"], 422);

        $category = ProductCategory::find(dcryptID($request->category_id));
        if (!$category) return response()->json(['message' => "La catégorie est incorrect"], 422);

        $product = new Produit();

        $product->category_id = dcryptID($request->category_id);
        $product->magasin_id = dcryptID($request->magasin_id);

        $product->name = $request->name;
        $product->slug = Str::slug($request->name);
        $product->description = $request->description;
        $product->price = $request->price;
        $product->compare_price = $request->compare_price ?? null;

        $product->save();

        if ($request->has('images')) {
            foreach ($request->file('images') as $image) {
                $product->addAttachment($image);
            }
        }

        $products = $this->products_list();

        return ["html" => view('v1.dashboard.pages.products.html.table', compact('products'))->render(), 'message' => "Le produit a été ajouté avec succès"];
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id) {}

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {

        $product = Produit::find(dcryptID($id));
        if (!$product) return response()->json(['message' => "Le produit est incorrect"], 422);

        $product_categories = ProductCategory::get();
        $magasins = Magasin::get();

        return ["html" => view('v1.dashboard.pages.products.modals.edit', compact('product', 'product_categories', 'magasins'))->render()];
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {

        $produit = Produit::find(dcryptID($id));
        if (!$produit) return response()->json(['message' => "Le produit est incorrect"], 422);

        $this->validationData($request, 'UPDATE', $produit);

        $magasin = Magasin::find(dcryptID($request->magasin_id));
        if (!$magasin) return response()->json(['message' => "Le pays est incorrect"], 422);

        $category = ProductCategory::find(dcryptID($request->category_id));
        if (!$category) return response()->json(['message' => "La catégorie est incorrect"], 422);

        $produit->category_id = dcryptID($request->category_id);
        $produit->magasin_id = dcryptID($request->magasin_id);

        $produit->name = $request->name;
        $produit->slug = Str::slug($request->name);
        $produit->description = $request->description;
        $produit->price = $request->price;
        $produit->compare_price = $request->compare_price ?? null;

        $produit->save();

        if ($request->has('images')) {
            foreach ($request->file('images') as $image) {
                $produit->updateAttachment($image);
            }
        }

        $products = $this->products_list();

        return ["html" => view('v1.dashboard.pages.products.html.table', compact('products'))->render(), 'message' => "Le produit a été ajouté avec succès"];
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $produit = Produit::find(dcryptID($id));
        if (!$produit) return response()->json(['message' => "Le produit est incorrect"], 422);

        // $produit->deleteAttachments();
        $produit->delete(); // To trash

        $products = $this->products_list();
        return ["html" => view('v1.dashboard.pages.products.html.table', compact('products'))->render(), 'message' => "Le produit a été supprimé avec succès"];
    }
}
