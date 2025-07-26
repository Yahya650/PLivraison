<div class="card-body">
    <div class="d-flex flex-wrap align-items-center justify-content-between gap-2">
        <div>
            {{-- <h4 class="fw-medium text-dark d-flex align-items-center gap-2">
                #0758267/90 <span class="badge bg-success-subtle text-success  px-2 py-1 fs-13">Paid</span><span
                    class="border border-warning text-warning fs-13 px-2 py-1 rounded">In
                    Progress</span></h4>
            <p class="mb-0">Order / Order Details / #0758267/90 - April
                23 , 2024 at 6:23 pm</p> --}}
        </div>
        <div>
            <a href="#!" class="btn btn-outline-secondary">{!! $command->status() !!}</a>
            {{-- <a href="#!" class="btn btn-outline-secondary">Return</a> --}}
            {{-- <a href="#!" class="btn btn-primary">Edit Order</a> --}}
        </div>

    </div>
</div>
<div class="card-footer d-flex flex-wrap align-items-center justify-content-between bg-light-subtle gap-2">
    <p class="border rounded mb-0 px-2 py-1 bg-body"><i class='bx bx-arrow-from-left align-middle fs-16'></i>
        La date de la commande : <span class="text-dark fw-medium">
            {{ Carbon\Carbon::parse($command->created_at)->format('M d, Y') }} -
            {{ Carbon\Carbon::parse($command->created_at)->diffForHumans() }}</span></p>
    <div>
        <a href="#!" data-container="#order-status"
            data-href="{{ route('app.commands.is.valid.toggle', cryptID($command->id)) }}" data-container1="#commandes"
            data-method="GET"
            class="btn btn-primary anchor-message">{{ $command->is_valid ? 'Non Valider' : 'Valider' }}</a>
    </div>
</div>
