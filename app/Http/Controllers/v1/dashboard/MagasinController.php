<?php

namespace App\Http\Controllers\v1\dashboard;

use App\Models\Magasin;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class MagasinController extends Controller
{

    public function magasins_list()
    {

        $req = request();
        $magasins = Magasin::query();

        // if ($req->input('search') != null) {
        //     $searchTerm = "%" . $req->input('search') . "%";
        //     $magasins->where(function ($query) use ($searchTerm) {
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
        //     $magasins->where('country_id', $req->input('country_filter'));
        // }

        // if ($req->input('gender_filter') != null) {
        //     $magasins->where('gender', $req->input('gender_filter'));
        // }

        // if ($req->input('is_completed_filter') != null) {
        //     $magasins->where('is_completed', $req->input('is_completed_filter') == "true" ? 1 : 0);
        // }

        // if ($req->input('requested_date_filter') != null) {
        //     $magasins->whereDate('requested_date', $req->input('requested_date_filter'));
        // }

        // switch ($req->input('order_by')) {
        //     case 'BY_NAME':
        //         $magasins->orderBy('first_name');
        //         break;
        //     case 'BY_EMAIL':
        //         $magasins->orderBy('email');
        //         break;
        //     case 'BY_DATE':
        //         $magasins->orderBy('date_debut');
        //         break;
        //     default:
        //         $magasins->orderBy('created_at', 'desc');
        //         break;
        // }


        $magasins = $magasins->latest()->paginate(12)->appends($req->except('page'));
        return $magasins;

        // return Formation::latest()->paginate(9)->appends($req->except('page'));
    }

    public function validationData($req, $type, $magasin = null)
    {
        // Dynamic validation rules
        $rules = [
            'category_id' => 'required',
            'name' => 'required|string|unique:magasins,name,' .  $magasin?->id ?? null,
            'image' => 'nullable|mimes:jpg,jpeg,png,gif,svg|max:2048',
            'description' => 'nullable|string',
        ];

        // Validation messages
        $messages = [
            'category_id.required' => 'La catégorie de la Magasin est obligatoire.',
            'name.unique' => 'Le nom de la Magasin doit être unique.',
            'name.required' => 'Le nom de la Magasin est obligatoire.',
            'image.required' => 'Les images de la Magasin sont obligatoires.',
            'image.mimes' => 'Les images de la Magasin doivent être au format jpg, jpeg, png, gif ou svg.',
            'image.max' => 'Les images de la Magasin doivent avoir une taille maximale de 2Mo.',

        ];


        // Validate the request
        $req->validate($rules, $messages);
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $magasins = $this->magasins_list();

        if (request()->ajax()) {
            // return response()->json(['html' => view('v1.dashboard.pages.magasins.html.table', compact('magasins'))->render(), 'redirect' => route('app.magasins.index', ['page' => request()->input('page'), 'search' => request()->input('search')])]);
            return response()->json(['html' => view('v1.dashboard.pages.magasins.html.table', compact('magasins'))->render()]);
        }

        return view('v1.dashboard.pages.magasins.index', compact("magasins"));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::get();

        return ["html" => view('v1.dashboard.pages.magasins.modals.create', compact('categories'))->render()];
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validationData($request, 'CREATE');

        $category = Category::find(dcryptID($request->category_id));
        if (!$category) return response()->json(['message' => "La catégorie est incorrect"], 422);

        $magasin = new Magasin();

        $magasin->category_id = dcryptID($request->category_id);

        $magasin->name = $request->name;
        $magasin->slug = Str::slug($request->name);
        $magasin->description = $request->description;
        $magasin->save();

        if ($request->hasFile('image')) {
            $magasin->addAttachment($request->file('image'));
        }

        $magasins = $this->magasins_list();

        return ["html" => view('v1.dashboard.pages.magasins.html.table', compact('magasins'))->render(), 'message' => "Le Magasin a été ajouté avec succès"];
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

        $magasin = Magasin::find(dcryptID($id));
        if (!$magasin) return response()->json(['message' => "Le Magasin est incorrect"], 422);

        $categories = Category::get();

        return ["html" => view('v1.dashboard.pages.magasins.modals.edit', compact('magasin', 'categories'))->render()];
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {

        $magasin = Magasin::find(dcryptID($id));
        if (!$magasin) return response()->json(['message' => "Le Magasin est incorrect"], 422);

        $this->validationData($request, 'UPDATE', $magasin);

        $category = Category::find(dcryptID($request->category_id));
        if (!$category) return response()->json(['message' => "La catégorie est incorrect"], 422);

        $magasin->category_id = dcryptID($request->category_id);

        $magasin->name = $request->name;
        $magasin->slug = Str::slug($request->name);
        $magasin->description = $request->description;
        $magasin->save();

        if ($request->hasFile('image')) {
            $magasin->addAttachment($request->file('image'));
        }

        $magasins = $this->magasins_list();

        return ["html" => view('v1.dashboard.pages.magasins.html.table', compact('magasins'))->render(), 'message' => "Le Magasin a été ajouté avec succès"];
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $magasin = Magasin::find(dcryptID($id));
        if (!$magasin) return response()->json(['message' => "Le Magasin est incorrect"], 422);

        // $magasin->deleteAttachments();
        $magasin->delete(); // To trash

        $magasins = $this->magasins_list();
        return ["html" => view('v1.dashboard.pages.magasins.html.table', compact('magasins'))->render(), 'message' => "Le Magasin a été supprimé avec succès"];
    }
}
