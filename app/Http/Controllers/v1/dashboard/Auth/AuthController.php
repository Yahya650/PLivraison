<?php

namespace App\Http\Controllers\v1\dashboard\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function guards()
    {
        return view('v1.dashboard.auth.index');
    }
    public function getLogin()
    {
        return view('v1.dashboard.auth.login.index');
        // if ($guard == "Administrateur") {
        // }
        // if ($guard == "Assistant Administratif") {
        //     return view('v1.dashboard.auth.administrative_assistant.login.index');
        // }
        // abort(404);
    }


    // public function sanctum_login(Request $req, $guard)
    // {
    //     $req->validate([
    //         'email' => 'required|email',
    //         'password' => 'required',
    //     ], [
    //         'email.required' => 'L\'adresse email est obligatoire.',
    //         'email.email' => 'Veuillez entrer une adresse email valide.',
    //         'password.required' => 'Le mot de passe est obligatoire.',
    //     ]);

    //     if ($guard === "admin") {
    //         // Recherche de l'administrateur par email
    //         $admin = Admin::where('email', $req->email)->first();

    //         // Vérification des identifiants
    //         if ($admin && Hash::check($req->password, $admin->password)) {
    //             // Connexion de l'administrateur
    //             Auth::guard($req->guard)->login($admin);

    //             // Réponse en cas de succès
    //             return response()->json([
    //                 'message' => "Connexion réussie !",
    //                 'redirect' => route('admin.dashboard')
    //             ], 200);
    //         }

    //         // Réponse en cas d'échec d'authentification
    //         return response()->json([
    //             'message' => "Les identifiants fournis ne correspondent pas à nos enregistrements."
    //         ], 401);
    //     } else {
    //         // Réponse en cas de garde non reconnue
    //         abort(404, "Page non trouvée.");
    //     }
    // }
    public function login(Request $req)
    {
        $req->validate([
            'email' => 'required|email',
            'password' => 'required',
        ], [
            'email.required' => 'L\'adresse email est obligatoire.',
            'email.email' => 'Veuillez entrer une adresse email valide.',
            'password.required' => 'Le mot de passe est obligatoire.',
        ]);

        // Recherche de l'administrateur par email
        $user = User::where('email', $req->email)->first();

        // Vérification des identifiants
        if ($user && Hash::check($req->password, $user->password)) {
            // Connexion de l'useristrateur
            auth()->logout();
            session()->flush();
            Auth::login($user);


            if ($user->hasRole('admin'))
                // Réponse en cas de succès
                return response()->json([
                    'message' => "Connexion réussie !",
                    'redirect' => $req->redirect_url ? $req->redirect_url : route('app.dash')
                ], 200);

            // Réponse en cas de succès
            return response()->json([
                'message' => "Connexion réussie !",
                'redirect' => $req->redirect_url ? $req->redirect_url : route('web.home')
            ], 200);
        }


        // Réponse en cas d'échec d'authentification
        return response()->json([
            'message' => "Les identifiants fournis ne correspondent pas à nos enregistrements."
        ], 401);
    }
    public function logout()
    {
        auth()->logout();
        return redirect()->route('auth.login.get');
    }
}
