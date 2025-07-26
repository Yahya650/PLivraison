<table class="table align-middle mb-0 table-hover table-centered">
    <thead class="bg-light-subtle">
        <tr>
            {{-- <th style="width: 20px;">
                <div class="form-check ms-1">
                    <input type="checkbox" class="form-check-input" id="customCheck1">
                    <label class="form-check-label" for="customCheck1"></label>
                </div>
            </th> --}}
            <th>categorie</th>
            {{-- <th>Les nombres de magasins</th> --}}
            <th>Les nombres de produits</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($productCategories as $category)
            <tr>
                <td>
                    <div class="d-flex align-items-center gap-2">
                        <div class="rounded bg-light avatar-md d-flex align-items-center justify-content-center">
                            <img src="{{ $category->getLastAttachment()?->stream() }}" alt=""
                                class="avatar-md rounded rounded-2">
                        </div>
                        <div>
                            <a href="#!" class="text-dark fw-medium fs-15">{{ $category->name }}</a>
                            {{-- <p class="text-muted mb-0 mt-1 fs-13"><span>Size : </span>S , M , L , Xl
                            </p> --}}
                        </div>
                    </div>
                </td>
                {{-- <td>
                    {{ $category->magasins()->count() }}
                    {{ $category->magasins()->count() == 1 ? 'Magasin' : 'Magasins' }}
                </td> --}}
                <td>
                    {{ $category->products()?->count() }}
                    {{ $category->products()?->count() == 1 ? 'Produit' : 'Produits' }}
                </td>
                <td>
                    <div class="d-flex gap-2">
                        {{-- <a href="#!" class="btn btn-light btn-sm anchor-modal" data-controller="categoryController"
                            data-modal-title="Ajouter un Produit" data-href="{{ route('app.products.create') }}"
                            data-modal-size="modal-xl"><iconify-icon icon="solar:eye-broken"
                                class="align-middle fs-18"></iconify-icon></a> --}}
                        <a href="#!" class="btn btn-soft-primary btn-sm anchor-modal"
                            data-controller="CategoryController" data-modal-title="{{ $category->name }} (Modifier)"
                            data-href="{{ route('app.types.edit', cryptID($category->id)) }}"
                            data-modal-size="modal-xl"><iconify-icon icon="solar:pen-2-broken"
                                class="align-middle fs-18"></iconify-icon></a>
                        <a href="#!" class="btn btn-soft-danger btn-sm anchor-delete"
                            data-href="{{ route('app.types.destroy', cryptID($category->id)) }}"
                            data-container="#types"><iconify-icon icon="solar:trash-bin-minimalistic-2-broken"
                                class="align-middle fs-18"></iconify-icon></a>
                    </div>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
