<form class="form-store" action="{{ route('app.magasins.store') }}" data-no-controller="true" method="POST"
    data-wait-button="#wait-button-add" id="Magasin-form" data-container="#magasins" method="POST"
    data-names-list='[
        "name",
        "category_id",
        "description",
        "image"
    ]'>

    <div class="card">
        <div class="card-header">
            <h4 class="card-title">Magasin Information</h4>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-lg-6">
                    <div>
                        <div class="mb-3">
                            <label for="Magasin-name" class="form-label">
                                le nom du Magasin
                            </label>
                            <input type="text" id="Magasin-name" class="form-control"
                                placeholder="les nom du Magasin" name="name">
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div>
                        <label for="image" class="form-label">image</label>
                        <input type="file" name="image" id="image" class="form-control" accept="image/*">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div>
                        <label for="Magasin-categories" class="form-label">les categories</label>
                        <select class="form-control" id="Magasin-categories" data-choices data-choices-groups
                            data-placeholder="Select Categorie" name="category_id">
                            <option value="">Choise a categorie</option>
                            @foreach ($categories as $category)
                                <option value="{{ cryptID($category->id) }}">
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="mb-3">
                        <label for="description" class="form-label">Description</label>
                        <textarea class="form-control bg-light-subtle" id="description" name="description" rows="7"
                            placeholder="details de produit"></textarea>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- <div class="card">
        <div class="card-header">
            <h4 class="card-title">détail des prix</h4>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-lg-6">
                    <div>
                        <label for="Magasin-price" class="form-label">Prix</label>
                        <div class="input-group mb-3">
                            <span class="input-group-text fs-20">MAD</span>
                            <input type="number" id="Magasin-price" class="form-control" placeholder="000DH"
                                name="price">
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div>
                        <label for="Magasin-discount" class="form-label">Prix de comparaison</label>
                        <div class="input-group mb-3">
                            <span class="input-group-text fs-20">MAD</span>
                            <input type="number" id="Magasin-discount" class="form-control" placeholder="000DH"
                                name="compare_price">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div> --}}
    <div class="p-3 bg-light mb-3 rounded">
        <div class="row justify-content-end g-2">
            <div class="col-lg-2">
                <button type="submit" class="btn btn-primary w-100" id="wait-button-add">Ajouter</button>
            </div>
        </div>
    </div>

</form>
