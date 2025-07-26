{{-- <div class="card">
    <div class="card-header">
        <h4 class="card-title">Add magasin Photo</h4>
    </div>
    <div class="card-body">
        <!-- File Upload -->
        <form action="https://techzaa.in/" method="post" class="dropzone" id="myAwesomeDropzone" data-plugin="dropzone"
            data-previews-container="#file-previews" data-upload-preview-template="#uploadPreviewTemplate">
            <div class="fallback">
                <input name="file" type="file" multiple />
            </div>
            <div class="dz-message needsclick">
                <i class="bx bx-cloud-upload fs-48 text-primary"></i>
                <h3 class="mt-4">Drop your images here, or <span class="text-primary">click to browse</span></h3>
                <span class="text-muted fs-13">
                    1600 x 1200 (4:3) recommended. PNG, JPG and GIF files are allowed
                </span>
            </div>
        </div>
    </div>
</div> --}}



<form class="form-store" action="{{ route('app.magasins.update', cryptID($magasin->id)) }}" data-no-controller="true"
    method="POST" data-wait-button="#wait-button-add" id="magasin-form" data-container="#magasins"
    data-names-list='[
        "name",
        "category_id",
        "description",
        "image"
    ]'>

    @method('PUT')

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
                            <input type="text" id="Magasin-name" class="form-control" value="{{ $magasin->name }}"
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
                                <option value="{{ cryptID($category->id) }}" @selected($category->id == $magasin->category_id)>
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
                            placeholder="details de produit">
                            {{ $magasin->description }}
                        </textarea>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="p-3 bg-light mb-3 rounded">
        <div class="row justify-content-end g-2">
            {{-- <div class="col-lg-2">
            <a href="#!" class="btn btn-outline-secondary w-100">Reset</a>
        </div> --}}
            <div class="col-lg-2">
                <button type="submit" class="btn btn-primary w-100" id="wait-button-add">Modifier</button>
            </div>
        </div>
    </div>

</form>
