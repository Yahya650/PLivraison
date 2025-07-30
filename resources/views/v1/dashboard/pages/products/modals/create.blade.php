<form class="form-store" action="{{ route('app.products.store') }}" data-no-controller="true" method="POST"
    data-wait-button="#wait-button-add" id="product-form" data-container="#products" method="POST"
    data-names-list='[
        "name",
        "category_id",
        "magasin_id",
        "price",
        "compare_price",
        "description",
        "images"
    ]'>

    <div class="card">
        <div class="card-header">
            <h4 class="card-title">Product Information</h4>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-lg-12">
                    <div>
                        <div class="mb-3">
                            <label for="product-name" class="form-label">
                                le nom du produit
                            </label>
                            <input type="text" id="product-name" class="form-control"
                                placeholder="les nom du produit" name="name">
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-4">
                    <div>
                        <label for="images" class="form-label">les images</label>
                        <input type="file" name="images[]" id="images" class="form-control" multiple
                            accept="image/*">
                    </div>
                </div>
                <div class="col-lg-4">
                    <div>
                        <label for="product-categories" class="form-label">les categories de produits</label>
                        <select class="form-control" id="product-categories" data-choices data-choices-groups
                            data-placeholder="Select Categorie" name="category_id">
                            <option value="">Choise a categorie</option>
                            @foreach ($product_categories as $product_category)
                                <option value="{{ cryptID($product_category?->id) }}">
                                    {{ $product_category?->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div>
                        <label for="Magasines" class="form-label">les Magasines</label>
                        <select class="form-control" id="Magasines" data-choices data-choices-groups
                            data-placeholder="Select Categorie" name="magasin_id">
                            <option value="">Choise a categorie</option>
                            @foreach ($magasins as $magasin)
                                <option value="{{ cryptID($magasin?->id) }}">
                                    {{ $magasin?->name }}
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
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">détail des prix</h4>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-lg-6">
                    <div>
                        <label for="product-price" class="form-label">Prix</label>
                        <div class="input-group mb-3">
                            <span class="input-group-text fs-20">MAD</span>
                            <input type="number" id="product-price" class="form-control" placeholder="000DH"
                                name="price">
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div>
                        <label for="product-discount" class="form-label">Prix de comparaison</label>
                        <div class="input-group mb-3">
                            <span class="input-group-text fs-20">MAD</span>
                            <input type="number" id="product-discount" class="form-control" placeholder="000DH"
                                name="compare_price">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="p-3 bg-light mb-3 rounded">
        <div class="row justify-content-end g-2">
            <div class="col-lg-2">
                <button type="submit" class="btn btn-primary w-100" id="wait-button-add">Ajouter</button>
            </div>
        </div>
    </div>

</form>
