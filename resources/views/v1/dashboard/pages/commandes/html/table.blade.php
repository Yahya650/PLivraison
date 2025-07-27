<table class="table align-middle mb-0 table-hover table-centered">
    <thead class="bg-light-subtle">
        <tr>
            {{-- <th style="width: 20px;">
                <div class="form-check ms-1">
                    <input type="checkbox" class="form-check-input" id="customCheck1">
                    <label class="form-check-label" for="customCheck1"></label>
                </div>
            </th> --}}
            <th>Le Client</th>
            <th>NBR PR</th>
            <th>adresse</th>
            <th>province</th>
            <th>Prix de livraison</th>
            <th>Total</th>
            <th>Status</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($commandes as $command)
            <tr>

                <td>
                    <div class="d-flex align-items-center gap-2">
                        {{-- <div class="rounded bg-light avatar-md d-flex align-items-center justify-content-center">
                            <img src="{{ $command->getLastAttachment()?->stream() }}" alt=""
                                class="avatar-md rounded rounded-2">
                        </div> --}}
                        <div>
                            <a href="#!" class="text-dark fw-medium fs-15">{{ $command->full_name }}</a>
                            <p class="text-muted mb-0 mt-1 fs-13"><span>Tél : </span>{{ $command->phone_number }}
                            </p>
                        </div>
                    </div>
                </td>

                <td>
                    {{ $command->products()->count() }}
                </td>
                <td>
                    {{ $command->adresse . ' ' . $command->quartier }}
                </td>
                <td>
                    {{ $command->province }}
                </td>
                <td>
                    {{ $command->delivery_price ?? 0     . ' MAD' }}
                </td>
                <td>
                    {{ $command->total() . ' MAD' }}
                </td>
                <td>
                    {!! $command->status() !!}
                </td>
                <td>
                    <div class="d-flex gap-2">
                        <a href="#!" class="btn btn-light btn-sm anchor-modal" data-controller="CommandController"
                            data-modal-title="Voir les details de la commande"
                            data-href="{{ route('app.commands.show', cryptID($command->id)) }}"
                            data-modal-size="modal-fullscreen"><iconify-icon icon="solar:eye-broken"
                                class="align-middle fs-18"></iconify-icon></a>
                        {{-- <a href="#!" class="btn btn-soft-primary btn-sm anchor-modal"
                            data-controller="CommandController" data-modal-title="{{ $command->name }} (Modifier)"
                            data-href="{{ route('app.commands.edit', cryptID($command->id)) }}"
                            data-modal-size="modal-xl"><iconify-icon icon="solar:pen-2-broken"
                                class="align-middle fs-18"></iconify-icon></a>
                        <a href="#!" class="btn btn-soft-danger btn-sm anchor-delete"
                            data-href="{{ route('app.commands.destroy', cryptID($command->id)) }}"
                            data-container="#commands"><iconify-icon icon="solar:trash-bin-minimalistic-2-broken"
                                class="align-middle fs-18"></iconify-icon></a> --}}
                    </div>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
