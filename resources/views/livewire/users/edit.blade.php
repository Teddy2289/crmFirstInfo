<div class="col-md-12">
    <div class="card mb-4">
        <div class="card-body">
            <div class="card-title mb-3">{{ __('Modification catégorie depense')}}</div>
            <form>
                <div class="row">
                    <div class="col-md-6 form-group mb-3">
                        <label for="name">{{ __('Libelle du catégorie')}}</label>
                        <input type="text" wire:model.defer="name" class="form-control form-control-rounded" id="name" placeholder="">
                        @error('name')
                        <div class="alert alert-danger" role="alert">
                            {{ $message}}
                        </div>
                        @enderror
                    </div>

                    <div class="col-md-6 form-group mb-3">
                        <label for="email">{{ __('email')}}</label>
                        <input type="text" wire:model.defer="email" class="form-control form-control-rounded" id="email" placeholder="">
                        @error('email')
                        <div class="alert alert-danger" role="alert">
                            {{ $message}}
                        </div>
                        @enderror
                    </div>


                    <div class="col-md-6 form-group mb-3">
                        <label for="password">{{ __('password')}}</label>
                        <input type="password" wire:model.defer="password" class="form-control form-control-rounded" id="email" placeholder="">
                        @error('password')
                        <div class="alert alert-danger" role="alert">
                            {{ $message}}
                        </div>
                        @enderror
                    </div>

                    <div class="col-md-6 form-group mb-3">
                        <label for="role">Rôle</label>
                        <select wire:model="selectedRole" class="form-control" id="role">
                            <option value="">Sélectionner un rôle</option>
                            @foreach($roles as $role)
                            <option value="{{ $role->id }}">{{ $role->name }}</option>
                            @endforeach
                        </select>
                        @error('selectedRole') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>

                    <div class="col-md-12">
                        <button class="btn btn-primary btn-rounded mr-3" wire:click.prevent="confirmerUpdate()">
                            <i class="nav-icon i-Yes font-weight-bold"></i> Enregistrer
                        </button>
                        <button class="btn btn-secondary btn-rounded" wire:click.prevent="cancelUpdate()">
                            <i class="nav-icon i-Arrow-Back font-weight-bold"></i> Retour
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

<!-- HTML -->
<div class="overlay">
    <div class="centered">
        <div class="alert alert-warning text-center">
            <strong class="text-black">{{ __('Modification catégorie depense')}} !</strong>
            <p class="text-black">Vous etes sure de valider la modification categorie depense</p>
            <p class="text-center">
                <button class="btn btn-secondary btn-rounded" wire:click="cancelModal()">{{ __('Annuler') }}</button>
                <button class="btn btn-danger btn-rounded" wire:click.prevent="updateType()">{{ __('Valider') }}</button>
            </p>
        </div>
    </div>
</div>

<script>
    // Désactiver le clic sur le reste de la page
    document.querySelector('.overlay').addEventListener('click', function(e) {
        e.stopPropagation();
    });
</script>
@endif