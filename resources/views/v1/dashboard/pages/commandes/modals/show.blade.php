<div class="row">
    <div class="col-xl-9 col-lg-8">
        <div class="row">
            <div class="col-lg-12">
                <div class="card" id="order-status">
                    @include('v1.dashboard.pages.commandes.components.order_status')
                </div>
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">les produits de la commande</h4>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table align-middle mb-0 table-hover table-centered">
                                <thead class="bg-light-subtle border-bottom">
                                    <tr>
                                        <th>Nom</th>
                                        <th>Prix unitaire</th>
                                        <th>quantité</th>
                                        <th>Remise</th>
                                        <th>Prix Remise</th>
                                        <th>Total</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($command->products as $product)
                                        <tr>
                                            <td>
                                                <div class="d-flex align-items-center gap-2">
                                                    <div
                                                        class="rounded bg-light avatar-md d-flex align-items-center justify-content-center">
                                                        <img src="{{ $product->getLastAttachment()?->stream() }}"
                                                            alt="" class="avatar-md">
                                                    </div>
                                                    <div>
                                                        <a href="#!" class="text-dark fw-medium fs-15">
                                                            {{ $product->name }}
                                                        </a>
                                                        <p class="text-muted mb-0 mt-1 fs-13">
                                                            <span>Magazine : </span> {{ $product->magasin->name }}
                                                        </p>
                                                    </div>
                                                </div>

                                            </td>
                                            <td>{{ $product->pivot->unit_price . ' MAD' }}</td>
                                            <td>{{ $product->pivot->quantity }}</td>
                                            <td>{{ $product->pivot->remise . ' MAD' }}
                                                (-
                                                {{ calculateDiscountPercentage($product->pivot->remise, $product->pivot->unit_price) . ' %' }})
                                            </td>
                                            <td>{{ $product->pivot->prix_remise . ' MAD' }}</td>
                                            <td>{{ $product->pivot->total . ' MAD' }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                {{-- <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Order Timeline</h4>
                    </div>
                    <div class="card-body">
                        <div class="position-relative ms-2">
                            <span class="position-absolute start-0  top-0 border border-dashed h-100"></span>
                            <div class="position-relative ps-4">
                                <div class="mb-4">
                                    <span
                                        class="position-absolute start-0 avatar-sm translate-middle-x bg-light d-inline-flex align-items-center justify-content-center rounded-circle">
                                        <div class="spinner-border spinner-border-sm text-warning" role="status">
                                            <span class="visually-hidden">Loading...</span>
                                        </div>
                                    </span>
                                    <div
                                        class="ms-2 d-flex flex-wrap gap-2 align-items-center justify-content-between">
                                        <div>
                                            <h5 class="mb-1 text-dark fw-medium fs-15">
                                                The packing has been started</h5>
                                            <p class="mb-0">Confirmed by Gaston Lapierre
                                            </p>
                                        </div>
                                        <p class="mb-0">April 23, 2024, 09:40 am</p>

                                    </div>
                                </div>
                            </div>
                            <div class="position-relative ps-4">
                                <div class="mb-4">
                                    <span
                                        class="position-absolute start-0 avatar-sm translate-middle-x bg-light d-inline-flex align-items-center justify-content-center rounded-circle text-success fs-20">
                                        <i class='bx bx-check-circle'></i>
                                    </span>
                                    <div
                                        class="ms-2 d-flex flex-wrap gap-2  align-items-center justify-content-between">
                                        <div>
                                            <h5 class="mb-1 text-dark fw-medium fs-15">
                                                The Invoice has been sent to the
                                                customer</h5>
                                            <p class="mb-2">Invoice email was sent to <a href="#!"
                                                    class="link-primary">hello@dundermuffilin.com</a>
                                            </p>
                                            <a href="#!" class="btn btn-light">Resend
                                                Invoice</a>
                                        </div>
                                        <p class="mb-0">April 23, 2024, 09:40 am</p>

                                    </div>
                                </div>
                            </div>
                            <div class="position-relative ps-4">
                                <div class="mb-4">
                                    <span
                                        class="position-absolute start-0 avatar-sm translate-middle-x bg-light d-inline-flex align-items-center justify-content-center rounded-circle text-success fs-20">
                                        <i class='bx bx-check-circle'></i>
                                    </span>
                                    <div
                                        class="ms-2 d-flex flex-wrap gap-2 align-items-center justify-content-between">
                                        <div>
                                            <h5 class="mb-1 text-dark fw-medium fs-15">
                                                The Invoice has been created</h5>
                                            <p class="mb-2">Invoice created by Gaston
                                                Lapierre</p>
                                            <a href="#!" class="btn btn-primary">Download
                                                Invoice</a>
                                        </div>
                                        <p class="mb-0">April 23, 2024, 09:40 am</p>

                                    </div>
                                </div>
                            </div>
                            <div class="position-relative ps-4">
                                <div class="mb-4">
                                    <span
                                        class="position-absolute start-0 avatar-sm translate-middle-x bg-light d-inline-flex align-items-center justify-content-center rounded-circle text-success fs-20">
                                        <i class='bx bx-check-circle'></i>
                                    </span>
                                    <div
                                        class="ms-2 d-flex flex-wrap gap-2 align-items-center justify-content-between">
                                        <div>
                                            <h5 class="mb-1 text-dark fw-medium fs-15">
                                                Order Payment</h5>
                                            <p class="mb-2">Using Master Card</p>
                                            <div class="d-flex align-items-center gap-2">
                                                <p class="mb-1 text-dark fw-medium">
                                                    Status :</p>
                                                <span
                                                    class="badge bg-success-subtle text-success  px-2 py-1 fs-13">Paid</span>
                                            </div>
                                        </div>
                                        <p class="mb-0">April 23, 2024, 09:40 am</p>

                                    </div>
                                </div>
                            </div>
                            <div class="position-relative ps-4">
                                <div class="mb-2">
                                    <span
                                        class="position-absolute start-0 avatar-sm translate-middle-x bg-light d-inline-flex align-items-center justify-content-center rounded-circle text-success fs-20">
                                        <i class='bx bx-check-circle'></i>
                                    </span>
                                    <div
                                        class="ms-2 d-flex flex-wrap gap-2  align-items-center justify-content-between">
                                        <div>
                                            <h5 class="mb-2 text-dark fw-medium fs-15">4
                                                Order conform by Gaston Lapierre</h5>
                                            <a href="#!"
                                                class="badge bg-light text-dark fw-normal  px-2 py-1 fs-13">Order
                                                1</a>
                                            <a href="#!"
                                                class="badge bg-light text-dark fw-normal  px-2 py-1 fs-13">Order
                                                2</a>
                                            <a href="#!"
                                                class="badge bg-light text-dark fw-normal  px-2 py-1 fs-13">Order
                                                3</a>
                                            <a href="#!"
                                                class="badge bg-light text-dark fw-normal  px-2 py-1 fs-13">Order
                                                4</a>
                                        </div>
                                        <p class="mb-0">April 23, 2024, 09:40 am</p>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div> --}}
                <div class="card bg-light-subtle">
                    <div class="card-body">
                        <div class="row g-3 g-lg-0">
                            {{-- <div class="col-lg-3 border-end">
                                <div class="d-flex align-items-center gap-3 justify-content-between px-3">
                                    <div>
                                        <p class="text-dark fw-medium fs-16 mb-1">Vender
                                        </p>
                                        <p class="mb-0">Catpiller</p>
                                    </div>
                                    <div
                                        class="avatar bg-light d-flex align-items-center justify-content-center rounded">
                                        <iconify-icon icon="solar:shop-2-bold-duotone"
                                            class="fs-35 text-primary"></iconify-icon>
                                    </div>
                                </div>
                            </div> --}}
                            {{-- <div class="col-lg-6 border-end">
                                <div class="d-flex align-items-center gap-3 justify-content-between px-3">
                                    <div>
                                        <p class="text-dark fw-medium fs-16 mb-1">Date de la commande</p>
                                        <p class="mb-0">{{ $command->created_at->format('d-m-Y') }}</p>
                                    </div>
                                    <div
                                        class="avatar bg-light d-flex align-items-center justify-content-center rounded">
                                        <iconify-icon icon="solar:calendar-date-bold-duotone"
                                            class="fs-35 text-primary"></iconify-icon>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6 border-end">
                                <div class="d-flex align-items-center gap-3 justify-content-between px-3">
                                    <div>
                                        <p class="text-dark fw-medium fs-16 mb-1">Le client
                                        </p>
                                        <p class="mb-0">{{ $command->client->fullName() }}</p>
                                    </div>
                                    <div
                                        class="avatar bg-light d-flex align-items-center justify-content-center rounded">
                                        <iconify-icon icon="solar:user-circle-bold-duotone"
                                            class="fs-35 text-primary"></iconify-icon>
                                    </div>
                                </div>
                            </div> --}}
                            {{-- <div class="col-lg-3">
                                <div class="d-flex align-items-center gap-3 justify-content-between px-3">
                                    <div>
                                        <p class="text-dark fw-medium fs-16 mb-1">
                                            Reference #IMEMO</p>
                                        <p class="mb-0">#0758267/90</p>
                                    </div>
                                    <div
                                        class="avatar bg-light d-flex align-items-center justify-content-center rounded">
                                        <iconify-icon icon="solar:clipboard-text-bold-duotone"
                                            class="fs-35 text-primary"></iconify-icon>
                                    </div>
                                </div>
                            </div> --}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-lg-4">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Résumé de la commande</h4>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table mb-0">
                        <tbody>
                            <tr>
                                <td class="px-0">
                                    <p class="d-flex mb-0 align-items-center gap-1">
                                        <iconify-icon icon="solar:clipboard-text-broken"></iconify-icon>
                                        sous-total :
                                    </p>
                                </td>
                                <td class="text-end text-dark fw-medium px-0">{{ $command->subTotal() . ' MAD' }}</td>
                            </tr>
                            <tr>
                                <td class="px-0">
                                    <p class="d-flex mb-0 align-items-center gap-1">
                                        <iconify-icon icon="solar:ticket-broken" class="align-middle"></iconify-icon>
                                        Remise
                                        :
                                    </p>
                                </td>
                                <td class="text-end text-dark fw-medium px-0">
                                    {{ $command->discount() . ' MAD' }}
                                </td>
                            </tr>
                            <tr>
                                <td class="px-0">
                                    <p class="d-flex mb-0 align-items-center gap-1">
                                        <iconify-icon icon="solar:kick-scooter-broken"
                                            class="align-middle"></iconify-icon> frais de livraison :
                                    </p>
                                </td>
                                <td class="text-end text-dark fw-medium px-0">
                                    {{ $command->delivery_price ?? 0 . ' MAD' }}
                                </td>
                            </tr>
                            {{-- <tr>
                                <td class="px-0">
                                    <p class="d-flex mb-0 align-items-center gap-1">
                                        <iconify-icon icon="solar:calculator-minimalistic-broken"
                                            class="align-middle"></iconify-icon>
                                        Total sans remise :
                                    </p>
                                </td>
                                <td class="text-end text-dark fw-medium px-0">{{ $command->total() . ' MAD' }}</td>
                            </tr> --}}

                        </tbody>
                    </table>
                </div>
            </div>
            <div class="card-footer d-flex align-items-center justify-content-between bg-light-subtle">
                <div>
                    <p class="fw-medium text-dark mb-0">Total</p>
                </div>
                <div>
                    <p class="fw-medium text-dark mb-0">{{ $command->total() . ' MAD' }}</p>
                </div>

            </div>
        </div>
        {{-- <div class="card">
            <div class="card-header">
                <h4 class="card-title">Payment Information</h4>
            </div>
            <div class="card-body">
                <div class="d-flex align-items-center gap-3 mb-3">
                    <div class="rounded-3 bg-light avatar d-flex align-items-center justify-content-center">
                        <img src="/v1/web/assets/images/card/mastercard.svg" alt="" class="avatar-sm">
                    </div>
                    <div>
                        <p class="mb-1 text-dark fw-medium">Master Card</p>
                        <p class="mb-0 text-dark">xxxx xxxx xxxx 7812</p>
                    </div>
                    <div class="ms-auto">
                        <iconify-icon icon="solar:check-circle-broken" class="fs-22 text-success"></iconify-icon>
                    </div>
                </div>
                <p class="text-dark mb-1 fw-medium">Transaction ID : <span class="text-muted fw-normal fs-13">
                        #IDN768139059</span></p>
                <p class="text-dark mb-0 fw-medium">Card Holder Name : <span class="text-muted fw-normal fs-13">
                        Gaston Lapierre</span></p>

            </div>
        </div> --}}
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Détails du client</h4>
            </div>
            <div class="card-body">
                <div class="d-flex align-items-center gap-2">
                    <img src="{{ $command->client?->avatar() }}" alt=""
                        class="avatar rounded-3 border border-light border-3">
                    <div>
                        <p class="mb-1">{{ $command->full_name }}</p>
                        <a href="mailto:{{ $command->client?->email }}"
                            class="link-primary fw-medium">{{ $command->client?->email }}</a>
                    </div>
                </div>
                <div class="d-flex justify-content-between mt-3">
                    <h5 class="">Numéro de contact</h5>
                    {{-- <div>
                        <a href="#!"><i class='bx bx-edit-alt fs-18'></i></a>
                    </div> --}}
                </div>
                <p class="mb-1">{{ $command->phone_number }}</p>

                <div class="d-flex justify-content-between mt-3">
                    <h5 class="">Adresse de livraison</h5>
                    {{-- <div>
                        <a href="#!"><i class='bx bx-edit-alt fs-18'></i></a>
                    </div> --}}
                </div>

                <div>
                    <p class="mb-1"><b>Quartier :</b> {{ $command->quartier ?? 'N/A' }} ,</p>
                    <p class="mb-1"><b>Adresse :</b> {{ $command->adresse ?? 'N/A' }} ,</p>
                    <p class="mb-1"><b>Province/communauté :</b> {{ $command->province ?? 'N/A' }} ,</p>
                    <p class="mb-1">Maroc</p>
                </div>

                {{-- <div class="d-flex justify-content-between mt-3">
                    <h5 class="">Billing Address</h5>
                    <div>
                        <a href="#!"><i class='bx bx-edit-alt fs-18'></i></a>
                    </div>
                </div>

                <p class="mb-1">Same as shipping address</p> --}}
            </div>
        </div>
        {{-- <div class="card">
            <div class="card-body">
                <div class="mapouter">
                    <div class="gmap_canvas"><iframe class="gmap_iframe rounded" width="100%"
                            style="height: 418px;" frameborder="0" scrolling="no" marginheight="0" marginwidth="0"
                            src="https://maps.google.com/maps?width=1980&amp;height=400&amp;hl=en&amp;q=University%20of%20Oxford&amp;t=&amp;z=14&amp;ie=UTF8&amp;iwloc=B&amp;output=embed"></iframe>
                    </div>
                </div>
            </div>
        </div> --}}
    </div>
</div>
