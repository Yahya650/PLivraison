<?php

namespace App\Http\Controllers\v1\dashboard;

use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CategoryController extends Controller
{

    public function categories_list()
    {

        $req = request();
        $categories = Category::query();

        // if ($req->input('search') != null) {
        //     $searchTerm = "%" . $req->input('search') . "%";
        //     $categories->where(function ($query) use ($searchTerm) {
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
        //     $categories->where('country_id', $req->input('country_filter'));
        // }

        // if ($req->input('gender_filter') != null) {
        //     $categories->where('gender', $req->input('gender_filter'));
        // }

        // if ($req->input('is_completed_filter') != null) {
        //     $categories->where('is_completed', $req->input('is_completed_filter') == "true" ? 1 : 0);
        // }

        // if ($req->input('requested_date_filter') != null) {
        //     $categories->whereDate('requested_date', $req->input('requested_date_filter'));
        // }

        // switch ($req->input('order_by')) {
        //     case 'BY_NAME':
        //         $categories->orderBy('first_name');
        //         break;
        //     case 'BY_EMAIL':
        //         $categories->orderBy('email');
        //         break;
        //     case 'BY_DATE':
        //         $categories->orderBy('date_debut');
        //         break;
        //     default:
        //         $categories->orderBy('created_at', 'desc');
        //         break;
        // }


        $categories = $categories->latest()->paginate(12)->appends($req->except('page'));
        return $categories;

        // return Formation::latest()->paginate(9)->appends($req->except('page'));
    }

    public function validationData($req, $type, $category = null)
    {
        // Dynamic validation rules
        $rules = [
            'name' => 'required|string|unique:categories,name,' .  $category?->id ?? null,
            'image' => 'nullable|mimes:jpg,jpeg,png,gif,svg|max:2048',
            'description' => 'nullable|string',
        ];

        // Validation messages
        $messages = [
            'name.unique' => 'Le nom de la Category doit être unique.',
            'name.required' => 'Le nom de la Category est obligatoire.',
            // 'image.required' => 'Les images de la Category sont obligatoires.',
            'image.mimes' => 'Les images de la Category doivent être au format jpg, jpeg, png, gif ou svg.',
            'image.max' => 'Les images de la Category doivent avoir une taille maximale de 2Mo.',
        ];

        // Validate the request
        $req->validate($rules, $messages);
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $categories = $this->categories_list();

        if (request()->ajax()) {
            // return response()->json(['html' => view('v1.dashboard.pages.categories.html.table', compact('categories'))->render(), 'redirect' => route('app.categories.index', ['page' => request()->input('page'), 'search' => request()->input('search')])]);
            return response()->json(['html' => view('v1.dashboard.pages.categories.html.table', compact('categories'))->render()]);
        }

        return view('v1.dashboard.pages.categories.index', compact("categories"));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return ["html" => view('v1.dashboard.pages.categories.modals.create')->render()];
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validationData($request, 'CREATE');

        $category = new Category();

        $category?->name = $request->name;
        $category?->slug = Str::slug($request->name);
        $category?->description = $request->description;
        $category?->save();

        if ($request->hasFile('image')) {
            $category?->addAttachment($request->file('image'));
        }

        $categories = $this->categories_list();

        return ["html" => view('v1.dashboard.pages.categories.html.table', compact('categories'))->render(), 'message' => "Le Category a été ajouté avec succès"];
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

        $category = Category::find(dcryptID($id));
        if (!$category) return response()->json(['message' => "Le Category est incorrect"], 422);

        return ["html" => view('v1.dashboard.pages.categories.modals.edit', compact('category'))->render()];
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {

        $category = Category::find(dcryptID($id));
        if (!$category) return response()->json(['message' => "Le Category est incorrect"], 422);

        $this->validationData($request, 'UPDATE', $category);

        $category?->name = $request->name;
        $category?->slug = Str::slug($request->name);
        $category?->description = $request->description;
        $category?->save();

        if ($request->hasFile('image')) {
            $category?->addAttachment($request->file('image'));
        }

        $categories = $this->categories_list();

        return ["html" => view('v1.dashboard.pages.categories.html.table', compact('categories'))->render(), 'message' => "Le Category a été ajouté avec succès"];
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $category = Category::find(dcryptID($id));
        if (!$category) return response()->json(['message' => "Le Category est incorrect"], 422);

        // $category?->deleteAttachments();
        $category?->delete(); // To trash

        $categories = $this->categories_list();
        return ["html" => view('v1.dashboard.pages.categories.html.table', compact('categories'))->render(), 'message' => "Le Category a été supprimé avec succès"];
    }
}
