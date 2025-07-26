{{-- <div class="card">
    <div class="card-header">
        <h4 class="card-title">Add Product Photo</h4>
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



<form class="form-store" action="{{ route('app.products.update', cryptID($product->id)) }}" data-no-controller="true"
    method="POST" data-wait-button="#wait-button-add" id="product-form" data-container="#products"
    data-names-list='[
        "name",
        "category_id",
        "magasin_id",
        "price",
        "compare_price",
        "description"
    ]'>

    @method('PUT')

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
                            <input type="text" id="product-name" class="form-control" placeholder="Items Name"
                                name="name" value="{{ $product->name }}">
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
                                <option value="{{ cryptID($product_category->id) }}" @selected($product_category->id == $product->category_id)>
                                    {{ $product_category->name }}
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
                                <option value="{{ cryptID($magasin->id) }}" @selected($magasin->id == $product->magasin_id)>
                                    {{ $magasin->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
            {{-- <div class="row">
            <div class="col-lg-4">
                <div>
                    <div class="mb-3">
                        <label for="product-brand" class="form-label">Brand</label>
                        <input type="text" id="product-brand" class="form-control" placeholder="Brand Name"
                            value="Larkon Fashion">
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div>
                    <div class="mb-3">
                        <label for="product-weight" class="form-label">Weight</label>
                        <input type="text" id="product-weight" class="form-control" placeholder="In gm & kg"
                            value="300gm">
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div>
                    <label for="gender" class="form-label">Gender</label>
                    <select class="form-control" id="gender" data-choices data-choices-groups
                        data-placeholder="Select Gender">
                        <option value="">Select Gender</option>
                        <option value="Men" selected>Men</option>
                        <option value="Women">Women</option>
                        <option value="Other">Other</option>
                    </select>
                </div>
            </div>
        </div> --}}
            {{-- <div class="row mb-4">
            <div class="col-lg-4">
                <div class="mt-3">
                    <h5 class="text-dark fw-medium">Size :</h5>
                    <div class="d-flex flex-wrap gap-2" role="group" aria-label="Basic checkbox toggle button group">
                        <input type="checkbox" class="btn-check" id="size-xs1">
                        <label class="btn btn-light avatar-sm rounded d-flex justify-content-center align-items-center"
                            for="size-xs1">XS</label>

                        <input type="checkbox" class="btn-check" id="size-s1" checked>
                        <label class="btn btn-light avatar-sm rounded d-flex justify-content-center align-items-center"
                            for="size-s1">S</label>

                        <input type="checkbox" class="btn-check" id="size-m1" checked>
                        <label class="btn btn-light avatar-sm rounded d-flex justify-content-center align-items-center"
                            for="size-m1">M</label>

                        <input type="checkbox" class="btn-check" id="size-xl1" checked>
                        <label class="btn btn-light avatar-sm rounded d-flex justify-content-center align-items-center"
                            for="size-xl1">Xl</label>

                        <input type="checkbox" class="btn-check" id="size-xxl1" checked>
                        <label class="btn btn-light avatar-sm rounded d-flex justify-content-center align-items-center"
                            for="size-xxl1">XXL</label>
                        <input type="checkbox" class="btn-check" id="size-3xl1">
                        <label class="btn btn-light avatar-sm rounded d-flex justify-content-center align-items-center"
                            for="size-3xl1">3XL</label>

                    </div>
                </div>
            </div>
            <div class="col-lg-5">
                <div class="mt-3">
                    <h5 class="text-dark fw-medium">Colors :</h5>
                    <div class="d-flex flex-wrap gap-2" role="group" aria-label="Basic checkbox toggle button group">
                        <input type="checkbox" class="btn-check" id="color-dark1" checked>
                        <label class="btn btn-light avatar-sm rounded d-flex justify-content-center align-items-center"
                            for="color-dark1"> <i class="bx bxs-circle fs-18 text-dark"></i></label>

                        <input type="checkbox" class="btn-check" id="color-yellow1" checked>
                        <label class="btn btn-light avatar-sm rounded d-flex justify-content-center align-items-center"
                            for="color-yellow1"> <i class="bx bxs-circle fs-18 text-warning"></i></label>

                        <input type="checkbox" class="btn-check" id="color-white1" checked>
                        <label class="btn btn-light avatar-sm rounded d-flex justify-content-center align-items-center"
                            for="color-white1"> <i class="bx bxs-circle fs-18 text-white"></i></label>

                        <input type="checkbox" class="btn-check" id="color-red1" checked>
                        <label class="btn btn-light avatar-sm rounded d-flex justify-content-center align-items-center"
                            for="color-red1"> <i class="bx bxs-circle fs-18 text-primary"></i></label>

                        <input type="checkbox" class="btn-check" id="color-green1">
                        <label class="btn btn-light avatar-sm rounded d-flex justify-content-center align-items-center"
                            for="color-green1"> <i class="bx bxs-circle fs-18 text-success"></i></label>

                        <input type="checkbox" class="btn-check" id="color-blue1">
                        <label class="btn btn-light avatar-sm rounded d-flex justify-content-center align-items-center"
                            for="color-blue1"> <i class="bx bxs-circle fs-18 text-danger"></i></label>

                        <input type="checkbox" class="btn-check" id="color-sky1">
                        <label class="btn btn-light avatar-sm rounded d-flex justify-content-center align-items-center"
                            for="color-sky1"> <i class="bx bxs-circle fs-18 text-info"></i></label>

                        <input type="checkbox" class="btn-check" id="color-gray1">
                        <label class="btn btn-light avatar-sm rounded d-flex justify-content-center align-items-center"
                            for="color-gray1"> <i class="bx bxs-circle fs-18 text-secondary"></i></label>

                    </div>
                </div>
            </div>
        </div> --}}
            <div class="row">
                <div class="col-lg-12">
                    <div class="mb-3">
                        <label for="description" class="form-label">Description</label>
                        <textarea class="form-control bg-light-subtle" id="description" name="description" rows="7"
                            placeholder="details de produit">{{ $product->description }}</textarea>
                    </div>
                </div>
            </div>
            {{-- <div class="row">
            <div class="col-lg-4">
                <div>
                    <div class="mb-3">
                        <label for="product-id" class="form-label">Tag
                            Number</label>
                        <input type="number" id="product-id" class="form-control" placeholder="#******"
                            value="36294007">
                    </div>

                </div>
            </div>
            <div class="col-lg-4">
                <div>
                    <div class="mb-3">
                        <label for="product-stock" class="form-label">Stock</label>
                        <input type="number" id="product-stock" class="form-control" placeholder="Quantity"
                            value="465">
                    </div>

                </div>
            </div>
            <div class="col-lg-4">
                <label for="product-stock" class="form-label">Tag</label>
                <select class="form-control" id="choices-multiple-remove-button" data-choices data-choices-removeItem
                    name="choices-multiple-remove-button" multiple>
                    <option value="Fashion" selected>Fashion</option>
                    <option value="Electronics">Electronics</option>
                    <option value="Watches">Watches</option>
                    <option value="Headphones">Headphones</option>
                </select>
            </div>
        </div> --}}
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
                            <input type="number" id="product-price" class="form-control" placeholder="000"
                                value="{{ $product->price }}" name="price">
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div>
                        <label for="product-discount" class="form-label">Prix de comparaison</label>
                        <div class="input-group mb-3">
                            <span class="input-group-text fs-20">MAD</span>
                            <input type="number" id="product-discount" class="form-control" placeholder="000"
                                name="compare_price" value="{{ $product->compare_price }}">
                        </div>
                    </div>
                </div>
                {{-- <div class="col-lg-4">
                <div>
                    <label for="product-tex" class="form-label">Tex</label>
                    <div class="input-group mb-3">
                        <span class="input-group-text fs-20"><i class='bx bxs-file-txt'></i></span>
                        <input type="number" id="product-tex" class="form-control" placeholder="000" value="3">
                    </div>
                </div>
            </div> --}}
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
