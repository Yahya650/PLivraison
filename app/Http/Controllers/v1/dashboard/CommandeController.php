<?php

namespace App\Http\Controllers\v1\dashboard;

use App\Models\Commande;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CommandeController extends Controller
{

    public function commandes_list()
    {

        $req = request();
        $commands = Commande::query();

        // if ($req->input('search') != null) {
        //     $searchTerm = "%" . $req->input('search') . "%";
        //     $commands->where(function ($query) use ($searchTerm) {
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
        //     $commands->where('country_id', $req->input('country_filter'));
        // }

        // if ($req->input('gender_filter') != null) {
        //     $commands->where('gender', $req->input('gender_filter'));
        // }

        // if ($req->input('is_completed_filter') != null) {
        //     $commands->where('is_completed', $req->input('is_completed_filter') == "true" ? 1 : 0);
        // }

        // if ($req->input('requested_date_filter') != null) {
        //     $commands->whereDate('requested_date', $req->input('requested_date_filter'));
        // }

        // switch ($req->input('order_by')) {
        //     case 'BY_NAME':
        //         $commands->orderBy('first_name');
        //         break;
        //     case 'BY_EMAIL':
        //         $commands->orderBy('email');
        //         break;
        //     case 'BY_DATE':
        //         $commands->orderBy('date_debut');
        //         break;
        //     default:
        //         $commands->orderBy('created_at', 'desc');
        //         break;
        // }


        $commands = $commands->latest()->paginate(12)->appends($req->except('page'));
        return $commands;

        // return Formation::latest()->paginate(9)->appends($req->except('page'));
    }

    // public function validationData($req, $type, $Commande = null)
    // {
    //     // Dynamic validation rules
    //     $rules = [
    //         'category_id' => 'required',
    //         'magasin_id' => 'required',
    //         'name' => 'required|string|unique:Commandes,name,' .  $Commande?->id ?? null,
    //         'description' => 'required|string',
    //         'price' => 'required|numeric',
    //         'compare_price' => 'nullable|numeric|gt:price',
    //         'images' => 'array',
    //         'images.*' => 'mimes:jpg,jpeg,png,gif,svg|max:2048',
    //     ];

    //     // Validation messages
    //     $messages = [
    //         'name.unique' => 'Le nom de la Commande doit être unique.',
    //         'name.required' => 'Le nom de la Commande est obligatoire.',
    //         'price.required' => 'Le prix de la Commande est obligatoire.',
    //         "price.numeric" => "Le prix de la Commande doit être un nombre.",
    //         "compare_price.gt" => "Le prix de comparaison de la Commande doit être supérieur au prix de la Commande.",
    //         "compare_price.numeric" => "Le prix de comparaison de la Commande doit être un nombre.",
    //         'description.required' => 'La description de la Commande est obligatoire.',
    //         'compare_price.required' => 'Le prix de la Commande est obligatoire.',
    //         'category_id.required' => 'La catégorie de la Commande est obligatoire.',
    //         'magasin_id.required' => 'Le magasin de la Commande est obligatoire.',
    //         'images.required' => 'Les images de la Commande sont obligatoires.',
    //         'images.*.mimes' => 'Les images de la Commande doivent être au format jpg, jpeg, png, gif ou svg.',
    //         'images.*.max' => 'Les images de la Commande doivent avoir une taille maximale de 2Mo.',

    //     ];

    //     // Validate the request
    //     $req->validate($rules, $messages);
    // }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $commandes = $this->commandes_list();

        if (request()->ajax()) {
            // return response()->json(['html' => view('v1.dashboard.pages.commandes.html.table', compact('commandes'))->render(), 'redirect' => route('app.commandes.index', ['page' => request()->input('page'), 'search' => request()->input('search')])]);
            return response()->json(['html' => view('v1.dashboard.pages.commandes.html.table', compact('commandes'))->render()]);
        }

        return view('v1.dashboard.pages.commandes.index', compact("commandes"));
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
        $command = Commande::find(dcryptID($id));
        if (!$command) return response()->json(['message' => "La Commande est incorrect"], 422);


        return ["html" => view('v1.dashboard.pages.commandes.modals.show', compact('command'))->render()];
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
    public function isValidToggle(string $id)
    {
        $command = Commande::find(dcryptID($id));
        if (!$command) return response()->json(['message' => "La Commande est incorrect"], 422);

        $command->is_valid = !$command->is_valid;
        $command->save();

        $commandes = $this->commandes_list();
        return response()->json(['html' => view('v1.dashboard.pages.commandes.components.order_status', compact('command'))->render(), 'html1' => view('v1.dashboard.pages.commandes.html.table', compact('commandes'))->render(), "message" => "La Commande a été modifiée le statut avec succès"], 200);
    }
}
