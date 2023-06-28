<div class="col-md-12">
    <div class="card mb-4">
        <div class="card-body">
            <div class="card-title mb-3">{{ __('Modification du rôle')}}</div>
            <form wire:submit.prevent="updateRole">
                <div class="row">
                    <div class="col-md-6 form-group mb-3">
                        <label for="name">{{ __('Libellé du rôle')}}</label>
                        <input type="text" wire:model.defer="name" class="form-control form-control-rounded" id="name" placeholder="">
                        @error('name')
                        <div class="alert alert-danger" role="alert">
                            {{ $message}}
                        </div>
                        @enderror
                    </div>

                    <div class="col-md-12 mb-4">
                        <div class="card text-left">
                            <div class="card-body">
                                <h4 class="card-title mb-2">{{__('Permissions')}}</h4>
                                <input type="checkbox" wire:click="selectAllPermissions" wire:model="selectAll">
                                <label for="checkAll">Tout cocher</label>

                                @foreach ($permissions as $permission)
                                <ul class="list-group">
                                    <li class="list-group-item">
                                        <input type="checkbox" wire:click="togglePermission({{ $permission->id }})" {{ in_array($permission->id, $selectedPermissions) ? 'checked' : '' }}>
                                        <label for="permission">{{ $permission->name }}</label>
                                    </li>
                                </ul>
                                @endforeach
                                <div class="col-md-12 mt-3">
                                    {{ $permissions->links() }}
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12 mt-4">
                        <button class="btn btn-primary btn-rounded mr-3" wire:click.prevent="confirmerUpdate()">
                            <i class="nav-icon i-Yes font-weight-bold"></i> {{__('Enregistrer')}}
                        </button>
                        <button class="btn btn-secondary btn-rounded" wire:click.prevent="cancelUpdate()">
                            <i class="nav-icon i-Arrow-Back font-weight-bold"></i> {{__('Retour')}}
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@if($confirmUpdate)
<!-- CSS -->
<style>
    .overlay {
        position: fixed;
        top: 0;
        left: 0;
        bottom: 0;
        right: 0;
        background-color: rgba(0, 0, 0, 0.5);
        z-index: 9999;
    }

    .centered {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
    }
</style>
<div class="overlay">
    <div class="centered">
        <div class="alert alert-warning text-center">
            <strong class="text-black">{{ __('Modification du rôle')}}!</strong>
            <p class="text-black">{{ __('Êtes-vous sûr de vouloir valider la modification ?')}}</p>
            <p class="text-center">
                <button class="btn btn-secondary btn-rounded" wire:click="cancelModal()">{{ __('Annuler') }}</button>
                <button class="btn btn-danger btn-rounded" wire:click.prevent="updateRole()">{{ __('Valider') }}</button>
            </p>
        </div>
    </div>
</div>

<script>
    // Désactiver le clic sur le reste de la page
    document.querySelector('.overlay').addEventListener('click',
        function(e) {
            e.stopPropagation();
        });
</script>
@endif