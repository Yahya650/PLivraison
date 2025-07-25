@extends('v1.dashboard.auth.layouts._default')

@section('title', 'Login')

@section('style')
    <style>
        /* Add this CSS in your main stylesheet (e.g., app.css) */
        .card-hover-effect {
            transition: transform 0.3s, box-shadow 0.3s;
        }

        .card-hover-effect:hover {
            transform: scale(1.05);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.2);
        }
    </style>
@endsection

@section('content')

    <div class="d-flex justify-content-center align-items-center flex-column flex-lg-row-fluid p-10 container">
        <div class="mb-5 pb-5">
            <img src="/assets/v1/dashboard/media/images/logo/logo.png" alt="{{ env('APP_NAME') }}">
        </div>
        <div class="row g-5 g-xl-8">
            @php
                $roles = [
                    // [
                    //     'name' => 'Administrateur',
                    //     'description' => 'Gérer efficacement la plateforme, les utilisateurs et le contenu.',
                    //     'image' => '/assets/v1/dashboard/media/svg/avatars/029-boy-11.svg',
                    //     'link' => route('auth.login.get', ['guard' => 'admin']),
                    // ],
                    [
                        'name' => 'Formateurs',
                        'description' => 'Créer et gérer des cours de formation pour les participants.',
                        'image' => '/assets/v1/dashboard/media/svg/avatars/014-girl-7.svg',
                        'link' => route('auth.login.get', ['guard' => 'trainer']),
                    ],
                    [
                        'name' => 'Participant',
                        'description' => 'Accéder et apprendre à partir des cours disponibles.',
                        'image' => '/assets/v1/dashboard/media/svg/avatars/004-boy-1.svg',
                        'link' => route('auth.login.get', ['guard' => 'participant']),
                    ],
                ];
            @endphp

            @foreach ($roles as $role)
                <div class="col-xl-6">
                    <a href="{{ $role['link'] }}" class="block">
                        <div class="card card-xl-stretch mb-5 mb-xl-8 cursor-pointer card-hover-effect">
                            <div class="card-body d-flex align-items-center pt-3 pb-0">
                                <div class="d-flex flex-column flex-grow-1 py-2 py-lg-13 me-2">
                                    <span class="fw-bold text-gray-900 fs-4 mb-2">{{ $role['name'] }}</span>
                                    <span class="fw-semibold text-muted fs-5">{{ $role['description'] }}</span>
                                </div>
                                <img src="{{ $role['image'] }}" alt="" class="align-self-end h-100px">
                            </div>
                        </div>
                    </a>
                </div>
            @endforeach
        </div>
    </div>
@endsection
