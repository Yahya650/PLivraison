@php
    use App\Models\Participant;
    use App\Models\Country;
@endphp

@extends('v1.dashboard.layouts._default')

@section('title', 'Gestion Des categories')

@section('content')
    <div class="container-fluid">

        <div class="row">
            <div class="col-xl-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center gap-1">
                        <h4 class="card-title flex-grow-1">Tout Les categories</h4>

                        {{-- <a href="product-add.html" class="btn btn-sm btn-primary">
                            Add Product
                        </a> --}}

                        <a href="#!" class="btn btn-sm btn-primary anchor-modal" data-controller="CategoryController"
                            data-modal-title="Ajouter un Categorie" data-href="{{ route('app.categories.create') }}"
                            data-modal-size="modal-xl">
                            Ajouter un Categorie
                        </a>


                        <div class="dropdown">
                            {{-- <a href="#" class="dropdown-toggle btn btn-sm btn-outline-light" data-bs-toggle="dropdown"
                                aria-expanded="false">
                                This Month
                            </a> --}}
                            {{-- <div class="dropdown-menu dropdown-menu-end">
                                <!-- item-->
                                <a href="#!" class="dropdown-item">Download</a>
                                <!-- item-->
                                <a href="#!" class="dropdown-item">Export</a>
                                <!-- item-->
                                <a href="#!" class="dropdown-item">Import</a>
                            </div> --}}
                        </div>
                    </div>
                    <div>
                        <div class="table-responsive" id="categories">
                            @include('v1.dashboard.pages.categories.html.table')
                        </div>
                        <!-- end table-responsive -->
                    </div>
                    <div class="card-footer border-top">
                        {{ $categories->links('pagination::bootstrap-5') }}
                    </div>
                </div>
            </div>

        </div>

    </div>
@endsection

@section('script')
    <script src="{{ '/v1/dash/controllers/CategoryController.js?v=' . time() }}"></script>
@endsection
