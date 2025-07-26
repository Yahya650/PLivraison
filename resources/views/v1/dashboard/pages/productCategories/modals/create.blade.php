<form class="form-store" action="{{ route('app.types.store') }}" data-no-controller="true" method="POST"
    data-wait-button="#wait-button-add" id="category-form" data-container="#types" method="POST"
    data-names-list='[
        "name",
        "category_id",
        "description",
        "image"
    ]'>

    <div class="card">
        <div class="card-header">
            <h4 class="card-title">Type Information</h4>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-lg-6">
                    <div>
                        <div class="mb-3">
                            <label for="category-name" class="form-label">
                                le nom du type de produit
                            </label>
                            <input type="text" id="category-name" class="form-control" placeholder="les nom du type"
                                name="name">
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
                    <div class="mb-3">
                        <label for="description" class="form-label">Description</label>
                        <textarea class="form-control bg-light-subtle" id="description" name="description" rows="7"
                            placeholder="details de type"></textarea>
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
