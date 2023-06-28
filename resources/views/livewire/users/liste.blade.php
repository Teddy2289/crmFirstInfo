<div class="table-responsive">
    <table class="table custom-table m-0">
        <thead>
            <tr>
                <th>Libelle catégorie</th>
                <th>Commentaires</th>
                <th>Status</th>
                <th>Date enregistrement</th>
                <th width="220px">Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($types as $type)
            <tr>
                <td>{{ $type->categorie }}</td>
                <td>{{ $type->commentaire }}</td>
                <td>
                    @if ($type->actif == 1)
                        <label class="badge bg-success text-white">Actif</label>
                    @else
                        <label class="badge bg-danger text-white">Inactif</label>
                    @endif
                </td>
                <td>{{ $type->created_at->format('M, d y')}}</td>
                <td>
                    <button class="btn btn-outline-info" wire:click.prevent="editType({{ $type->id }})"  wire:loading.attr="disabled" wire:target="editType({{ $type->id }})">
                    <span wire:loading.remove wire:target="editType({{ $type->id }})">Modifier</span>
                    <span wire:loading wire:target="editType({{ $type->id }})">
                        <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                        
                    </span>
                    </button>

                    <button class="btn btn-outline-danger" wire:click.prevent="confirmerDelete({{ $type->id }})"  wire:loading.attr="disabled" wire:target="confirmerDelete({{ $type->id }})">
                    <span wire:loading.remove wire:target="confirmerDelete({{ $type->id }})">Suppression</span>
                    <span wire:loading wire:target="confirmerDelete({{ $type->id }})">
                        <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                        
                    </span>
                    </button>
                </td>
            </tr>         
            @endforeach
        </tbody>
    </table>
</div>
<div class="mb-2 mt-2">
    {{ $types->links() }}
</div>
@if($recordToDelete)
<div class="position-fixed fixed-top fixed-bottom w-100 h-100 d-flex align-items-center justify-content-center bg-gray-500 bg-opacity-50">
    <div class="alert-notify danger">
        <div class="alert-notify-body">
            <span class="type">Suppression</span>
            <div class="alert-notify-title">Vous etes sure ?<img src="{{ asset('img/notification-danger.svg')}}" alt=""></div>
            <div class="alert-notify-text">Remarque: La suppression sera effectué apres la confirmation</div>
            <p class="text-center">
                <button class="btn btn-white" wire:click="cancelDelete()">Non</button>
                <button class="btn btn-danger" wire:click="delete()">Oui</button>
            </p>
        </div>
    </div>
</div>

@endif