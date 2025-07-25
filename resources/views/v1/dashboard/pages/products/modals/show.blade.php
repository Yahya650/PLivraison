@php
    use Illuminate\Support\Carbon;
@endphp



<div class="col-md-12 col-lg-12 mb-3">
    <div class="d-flex justify-content-evenly flex-column">
        <div class="d-flex align-items-center gap-2">
            Formulaire {!! $participant->is_completed
                ? '<span class="badge text-bg-success">Complete</span>'
                : '<span class="badge text-bg-danger">Non Complete</span>' !!}
        </div>
    </div>
</div>

<div class="d-flex justify-content-evenly align-items-center">
    {{-- <div class="customer-avatar-section">
        <div class="d-flex align-items-center flex-column">

            @if ($participant->image)
                <img loading="lazy" class="mb-4" src="{{ Storage::url($participant->image) }}" width="350px"
                    alt={{ 'CIFpro-' . $participant->slug }}>
            @else
                <img loading="lazy" class="img-fluid rounded mb-4" src="/v1/assets/img/no-photo.png" alt="CIFpro">
            @endif

            <div class="customer-info text-center mb-6">
                <h5 class="mb-0">{{ $participant->title }} - {{ $participant->custom_id }}</h5>
                <span>Catégorie : {{ $participant->category->display }}</span>
            </div>

        </div>
    </div> --}}

    <div class="col-md-12 col-lg-12 d-flex justify-content-between">
        <table class="w-100">
            <thead>
                <tr>
                    <th></th>
                    <th></th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>
                        <div class="d-flex align-items-center gap-2">
                            <div class="avatar">
                                <div class="avatar-initial rounded bg-label-primary">
                                    <i class="fa-solid fa-book"></i>
                                </div>
                            </div>
                            <div>
                                <h5 class="mb-0">Nom de formation</h5>
                                <span>{{ $participant->name_of_formation }}</span>
                            </div>
                        </div>
                    </td>
                    <td>
                        <div class="d-flex align-items-center gap-2">
                            <div class="avatar">
                                <div class="avatar-initial rounded bg-label-primary">
                                    <i class="fa-solid fa-user-tie"></i>
                                </div>
                            </div>
                            <div>
                                <h5 class="mb-0">Nome Complete</h5>
                                <span> {{ $participant->first_name . ' ' . $participant->last_name }} </span>
                            </div>
                        </div>
                    </td>
                    <td>
                        <div class="d-flex align-items-center gap-2">
                            <div class="avatar">
                                <div class="avatar-initial rounded bg-label-primary">
                                    <i class="fa-solid fa-venus-mars"></i>
                                </div>
                            </div>
                            <div>
                                <h5 class="mb-0">Genre</h5>
                                <span>
                                    {!! $participant->gender == 'male'
                                        ? '<i class="fa-solid fa-person"></i> Homme'
                                        : '<i class="fa-solid fa-person-dress"></i> Femme' !!}
                                </span>
                            </div>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>
                        <div class="d-flex align-items-center gap-2">
                            <div class="avatar">
                                <div class="avatar-initial rounded bg-label-primary">
                                    <i class="fa-solid fa-briefcase"></i>
                                </div>
                            </div>
                            <div>
                                <h5 class="mb-0">Fonction</h5>
                                <span>{{ $participant->function }}</span>
                            </div>
                        </div>
                    </td>
                    <td>
                        <div class="d-flex align-items-center gap-2">
                            <div class="avatar">
                                <div class="avatar-initial rounded bg-label-primary">
                                    <i class="fa-solid fa-phone-volume"></i>
                                </div>
                            </div>
                            <div>
                                <h5 class="mb-0">Les Telephones</h5>
                                <span>{{ $participant->phone . ' / ' . $participant->phone2 }}</span>
                            </div>
                        </div>
                    </td>
                    <td>
                        <div class="d-flex align-items-center gap-2">
                            <div class="avatar">
                                <div class="avatar-initial rounded bg-label-primary">
                                    <i class="fa-regular fa-envelope"></i>
                                </div>
                            </div>
                            <div>
                                <h5 class="mb-0">Email</h5>
                                <span>{{ $participant->email }}</span>
                            </div>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>
                        <div class="d-flex align-items-center gap-2">
                            <div class="avatar">
                                <div class="avatar-initial rounded bg-label-primary">
                                    <i class="fa-regular fa-heart"></i>
                                </div>
                            </div>
                            <div>
                                <h5 class="mb-0">Comment avez-vous entendu parler de nous</h5>
                                <span>{{ $participant->how_did_you_hear_about_us }}</span>
                            </div>
                        </div>
                    </td>
                    <td>
                        <div class="d-flex align-items-center gap-2">
                            <div class="avatar">
                                <div class="avatar-initial rounded bg-label-primary">
                                    <i class="fa-solid fa-earth-americas"></i>
                                </div>
                            </div>
                            <div>
                                <h5 class="mb-0">Pays</h5>
                                <span>{{ $participant->pays?->small_name }} - <img
                                        src="{{ $participant->pays?->flag_url }}" width="13px"
                                        alt="{{ $participant->pays?->small_name }}"> </span>
                            </div>
                        </div>
                    </td>
                    <td>
                        <div class="d-flex align-items-center gap-2">
                            <div class="avatar">
                                <div class="avatar-initial rounded bg-label-primary">
                                    <i class="fa-solid fa-user-tag"></i>
                                </div>
                            </div>
                            <div>
                                <h5 class="mb-0">Organisme employeur</h5>
                                <span>{{ $participant->employing_organization }}</span>
                            </div>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>
                        <div class="d-flex align-items-center gap-2">
                            <div class="avatar">
                                <div class="avatar-initial rounded bg-label-primary">
                                    <i class="fa-solid fa-clock"></i>
                                </div>
                            </div>
                            <div>
                                <h5 class="mb-0">Date souhaitée</h5>
                                <span>{{ $participant->requested_date }}</span>
                            </div>
                        </div>
                    </td>
                    <td>
                        <div class="d-flex align-items-center gap-2">
                            <div class="avatar">
                                <div class="avatar-initial rounded bg-label-primary">
                                    <i class="fa-solid fa-clock"></i>
                                </div>
                            </div>
                            <div>
                                <h5 class="mb-0">Date de la demande</h5>
                                <span>{{ $participant->created_at }}</span>
                            </div>
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>
        <div class="d-flex justify-content-evenly flex-column">



        </div>
        <div class="d-flex justify-content-evenly flex-column">




            {{-- <div class="d-flex align-items-center gap-2">
                <div class="avatar">
                    <div class="avatar-initial rounded bg-label-primary">
                        <i class="fa-regular fa-clock"></i>
                    </div>
                </div>
                <div>
                    <h5 class="mb-0">Date Debut - Date Fin</h5>
                    <span>{{ $participant->date_debut . ' - ' . $participant->date_fin }}</span>
                </div>
            </div> --}}
            {{-- <div class="d-flex align-items-center gap-2">
                <div class="avatar">
                    <div class="avatar-initial rounded bg-label-primary">
                        <i class="fa-regular fa-font-awesome"></i>
                    </div>
                </div>
                <div>
                    <h5 class="mb-0">Type d'inscreption</h5>
                    <span>{{ $participant->insc_type }}</span>
                </div>
            </div> --}}
        </div>
        <div class="d-flex justify-content-evenly flex-column">




        </div>
    </div>

</div>



<div class="d-flex justify-content-center gap-4 mt-3">
    <button class="btn btn-primary w-100 waves-effect waves-light anchor-modal"
        data-modal-title="{{ $participant->title }} (Modifier)" data-controller="PartcipantController"
        data-href="{{ route('admin.participants.edit', $participant->id) }}"
        data-modal-call_center_id="{{ $participant->id }}" data-modal-size="modal-xl">
        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
            stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
            class="icon icon-tabler icons-tabler-outline icon-tabler-edit">
            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
            <path d="M7 7h-1a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-1" />
            <path d="M20.385 6.585a2.1 2.1 0 0 0 -2.97 -2.97l-8.415 8.385v3h3l8.385 -8.415z" />
            <path d="M16 5l3 3" />
        </svg> <span class="ms-1">Modifier</span>
    </button>
    <button type="button" data-href="{{ route('admin.participants.destroy', $participant->id) }}"
        data-controller="PartcipantController" data-container="#participants"
        class="btn btn-danger w-100 waves-effect waves-light anchor-delete"><svg xmlns="http://www.w3.org/2000/svg"
            width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
            stroke-linecap="round" stroke-linejoin="round"
            class="icon icon-tabler icons-tabler-outline icon-tabler-trash">
            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
            <path d="M4 7l16 0" />
            <path d="M10 11l0 6" />
            <path d="M14 11l0 6" />
            <path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12" />
            <path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3" />
        </svg>
        <span class="ms-1">Supprimer</span>
    </button>
</div>

{{-- <div class="info-container">
    <h5 class="pb-4 border-bottom text-capitalize mt-6 mb-4">Details</h5>


    <ul class="list-unstyled mb-6">
        <li class="mb-2">
            <span class="h6 me-1">Les Sessions</span>
            <br>
            <table class="table">
                <thead>
                    <tr>
                        <th></th>
                        <th>Date Debut</th>
                        <th>Date Fin</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <th><b>Session 1</b> : </th>
                        <td>{{ Carbon::parse($participant->first_date_sess1)->format('d M Y') }}
                        </td>
                        <td>{{ Carbon::parse($participant->last_date_sess1)->format('d M Y') }}
                        </td>
                    </tr>
                    <tr>
                        <th><b>Session 2</b> : </th>
                        <td>{{ Carbon::parse($participant->first_date_sess2)->format('d M Y') }}
                        </td>
                        <td>{{ Carbon::parse($participant->last_date_sess2)->format('d M Y') }}
                        </td>
                    </tr>
                    <tr>
                        <th><b>Session 3</b> : </th>
                        <td>{{ Carbon::parse($participant->first_date_sess3)->format('d M Y') }}
                        </td>
                        <td>{{ Carbon::parse($participant->last_date_sess3)->format('d M Y') }}
                        </td>
                    </tr>
                </tbody>
            </table>
        </li>
        <li class="mb-2">
            <span class="h6 me-1">Description</span>
            <br>
            <span>
                {!! $participant->description !!}
            </span>
        </li>
        <li class="mb-2">
            <span class="h6 me-1">Objectives</span>
            <br>
            <span>
                {!! $participant->objectives !!}
            </span>
        </li>
        <li class="mb-2">
            <span class="h6 me-1">Target Audience</span>
            <br>
            <span>
                {!! $participant->target_audience !!}
            </span>
        </li>
        <li class="mb-2">
            <span class="h6 me-1">Pedagogical Method</span>
            <br>
            <span>
                {!! $participant->pedagogical_method !!}
            </span>
        </li>
        <li class="mb-2">
            <span class="h6 me-1">Program</span>
            <br>
            <span>
                {!! $participant->program !!}
            </span>
        </li>
        <li class="mb-2">
            <span class="h6 me-1">Meta descreption</span>
            <br>
            <span>
                {{ $participant->meta_description }}
            </span>
        </li>
        <li class="mb-2">
            <span class="h6 me-1">Tags</span>
            <br>
            <span>
                @if ($participant->tags)
                    @foreach (json_decode($participant->tags) as $tag)
                        <span class="badge rounded-pill bg-label-secondary">{{ $tag }}</span>
                    @endforeach
                @endif
            </span>
        </li>
    </ul>
    <div class="d-flex justify-content-center gap-4">
        <button  class="btn btn-primary w-100 waves-effect waves-light anchor-modal"
            data-modal-title="{{ $participant->title }} (Modifier)"
            data-href="{{ route('admin.participants.edit', $participant->id) }}"
            data-modal-call_center_id="{{ $participant->id }}" data-modal-size="modal-xl">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                class="icon icon-tabler icons-tabler-outline icon-tabler-edit">
                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                <path d="M7 7h-1a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-1" />
                <path d="M20.385 6.585a2.1 2.1 0 0 0 -2.97 -2.97l-8.415 8.385v3h3l8.385 -8.415z" />
                <path d="M16 5l3 3" />
            </svg> <span class="ms-1">Edit Details</span>
        </button>
        <button  type="button" data-href="{{ route('admin.participants.destroy', $participant->id) }}"
            data-container="#participants" class="btn btn-danger w-100 waves-effect waves-light anchor-delete"><svg
                xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                class="icon icon-tabler icons-tabler-outline icon-tabler-trash">
                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                <path d="M4 7l16 0" />
                <path d="M10 11l0 6" />
                <path d="M14 11l0 6" />
                <path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12" />
                <path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3" />
            </svg>
            <span class="ms-1">Delete</span>
        </button>
    </div>
</div> --}}
