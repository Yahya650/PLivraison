<table class="table align-middle mb-0 table-hover table-centered">
    <thead class="bg-light-subtle">
        <tr>
            {{-- <th style="width: 20px;">
                <div class="form-check ms-1">
                    <input type="checkbox" class="form-check-input" id="customCheck1">
                    <label class="form-check-label" for="customCheck1"></label>
                </div>
            </th> --}}
            <th>Le Magasin</th>
            <th>Les nombre de produits</th>
            <th>Category</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($magasins as $magasin)
            <tr>

                <td>
                    <div class="d-flex align-items-center gap-2">
                        <div class="rounded bg-light avatar-md d-flex align-items-center justify-content-center">
                            <img src="{{ $magasin->getLastAttachment()?->stream() }}" alt=""
                                class="avatar-md rounded rounded-2">
                        </div>
                        <div>
                            <a href="#!" class="text-dark fw-medium fs-15">{{ $magasin->name }}</a>
                            {{-- <p class="text-muted mb-0 mt-1 fs-13"><span>Size : </span>S , M , L , Xl
                            </p> --}}
                        </div>
                    </div>
                </td>

                <td>
                    {{ $magasin->products()?->count() }}
                    {{ $magasin->products()?->count() == 1 ? 'Produit' : 'Produits' }}
                </td>
                <td>
                    {{ $magasin->category?->name }}
                </td>
                <td>
                    <div class="d-flex gap-2">
                        {{-- <a href="#!" class="btn btn-light btn-sm anchor-modal" data-controller="MagasinController"
                            data-modal-title="Ajouter un Produit" data-href="{{ route('app.products.create') }}"
                            data-modal-size="modal-xl"><iconify-icon icon="solar:eye-broken"
                                class="align-middle fs-18"></iconify-icon></a> --}}
                        <a href="#!" class="btn btn-soft-primary btn-sm anchor-modal"
                            data-controller="MagasinController" data-modal-title="{{ $magasin->name }} (Modifier)"
                            data-href="{{ route('app.magasins.edit', cryptID($magasin->id)) }}"
                            data-modal-size="modal-xl"><iconify-icon icon="solar:pen-2-broken"
                                class="align-middle fs-18"></iconify-icon></a>
                        <a href="#!" class="btn btn-soft-danger btn-sm anchor-delete"
                            data-href="{{ route('app.magasins.destroy', cryptID($magasin->id)) }}"
                            data-container="#magasins"><iconify-icon icon="solar:trash-bin-minimalistic-2-broken"
                                class="align-middle fs-18"></iconify-icon></a>
                    </div>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
