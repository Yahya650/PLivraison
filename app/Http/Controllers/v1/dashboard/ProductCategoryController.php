<?php

namespace App\Http\Controllers\v1\dashboard;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\ProductCategory;
use App\Http\Controllers\Controller;

class ProductCategoryController extends Controller
{

    public function productCategories_list()
    {

        $req = request();
        $productCategories = ProductCategory::query();

        // if ($req->input('search') != null) {
        //     $searchTerm = "%" . $req->input('search') . "%";
        //     $productCategories->where(function ($query) use ($searchTerm) {
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
        //     $productCategories->where('country_id', $req->input('country_filter'));
        // }

        // if ($req->input('gender_filter') != null) {
        //     $productCategories->where('gender', $req->input('gender_filter'));
        // }

        // if ($req->input('is_completed_filter') != null) {
        //     $productCategories->where('is_completed', $req->input('is_completed_filter') == "true" ? 1 : 0);
        // }

        // if ($req->input('requested_date_filter') != null) {
        //     $productCategories->whereDate('requested_date', $req->input('requested_date_filter'));
        // }

        // switch ($req->input('order_by')) {
        //     case 'BY_NAME':
        //         $productCategories->orderBy('first_name');
        //         break;
        //     case 'BY_EMAIL':
        //         $productCategories->orderBy('email');
        //         break;
        //     case 'BY_DATE':
        //         $productCategories->orderBy('date_debut');
        //         break;
        //     default:
        //         $productCategories->orderBy('created_at', 'desc');
        //         break;
        // }


        $productCategories = $productCategories->latest()->paginate(12)->appends($req->except('page'));
        return $productCategories;

        // return Formation::latest()->paginate(9)->appends($req->except('page'));
    }

    public function validationData($req, $type, $productCategory = null)
    {
        // Dynamic validation rules
        $rules = [
            'name' => 'required|string|unique:product_categories,name,' .  $productCategory?->id ?? null,
            'image' => 'nullable|mimes:jpg,jpeg,png,gif,svg|max:2048',
            'description' => 'nullable|string',
        ];

        // Validation messages
        $messages = [
            'name.unique' => 'Le nom de la type doit être unique.',
            'name.required' => 'Le nom de la type est obligatoire.',
            // 'image.required' => 'Les images de la type sont obligatoires.',
            'image.mimes' => 'Les images de la type doivent être au format jpg, jpeg, png, gif ou svg.',
            'image.max' => 'Les images de la type doivent avoir une taille maximale de 2Mo.',

        ];

        // Validate the request
        $req->validate($rules, $messages);
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $productCategories = $this->productCategories_list();

        if (request()->ajax()) {
            // return response()->json(['html' => view('v1.dashboard.pages.productCategories.html.table', compact('productCategories'))->render(), 'redirect' => route('app.productCategories.index', ['page' => request()->input('page'), 'search' => request()->input('search')])]);
            return response()->json(['html' => view('v1.dashboard.pages.productCategories.html.table', compact('productCategories'))->render()]);
        }

        return view('v1.dashboard.pages.productCategories.index', compact("productCategories"));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return ["html" => view('v1.dashboard.pages.productCategories.modals.create')->render()];
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validationData($request, 'CREATE');

        $productCategory = new ProductCategory();

        $productCategory->name = $request->name;
        $productCategory->slug = Str::slug($request->name);
        $productCategory->description = $request->description;
        $productCategory->save();

        if ($request->hasFile('image')) {
            $productCategory->addAttachment($request->file('image'));
        }

        $productCategories = $this->productCategories_list();

        return ["html" => view('v1.dashboard.pages.productCategories.html.table', compact('productCategories'))->render(), 'message' => "Le ProductCategory a été ajouté avec succès"];
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

        $productCategory = ProductCategory::find(dcryptID($id));
        if (!$productCategory) return response()->json(['message' => "Le type est incorrect"], 422);

        return ["html" => view('v1.dashboard.pages.productCategories.modals.edit', compact('productCategory'))->render()];
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {

        $productCategory = ProductCategory::find(dcryptID($id));
        if (!$productCategory) return response()->json(['message' => "Le type est incorrect"], 422);

        $this->validationData($request, 'UPDATE', $productCategory);

        $productCategory->name = $request->name;
        $productCategory->slug = Str::slug($request->name);
        $productCategory->description = $request->description;
        $productCategory->save();

        if ($request->hasFile('image')) {
            $productCategory->addAttachment($request->file('image'));
        }

        $productCategories = $this->productCategories_list();

        return ["html" => view('v1.dashboard.pages.productCategories.html.table', compact('productCategories'))->render(), 'message' => "Le ProductCategory a été ajouté avec succès"];
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $productCategory = ProductCategory::find(dcryptID($id));
        if (!$productCategory) return response()->json(['message' => "Le type est incorrect"], 422);

        // $productCategory->deleteAttachments();
        $productCategory->delete(); // To trash

        $productCategories = $this->productCategories_list();
        return ["html" => view('v1.dashboard.pages.productCategories.html.table', compact('productCategories'))->render(), 'message' => "Le ProductCategory a été supprimé avec succès"];
    }
}
