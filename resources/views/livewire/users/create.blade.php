<div class="col-md-12">
    <div class="card mb-4">
        <div class="card-body">
            <div class="card-title mb-3">{{ __('Création d\'utilisateurs')}}</div>
            <form>
                <div class="row">
                    <div class="col-md-6 form-group mb-3">
                        <label for="name">{{ __('name')}}</label>
                        <input type="text" wire:model.defer="name" class="form-control form-control-rounded" id="name" placeholder="">
                        @error('name') 
                        <div class="alert alert-danger" role="alert">
                            {{ $message}}
                        </div>
                        @enderror
                    </div>

                    <div class="col-md-6 form-group mb-3">
                        <label for="email">{{ __('email')}}</label>
                        <input type="email" wire:model.defer="email" class="form-control form-control-rounded" id="email" placeholder="">
                        @error('email') 
                        <div class="alert alert-danger" role="alert">
                            {{ $message}}
                        </div>
                        @enderror
                    </div>


                    <div class="col-md-6 form-group mb-3">
                        <label for="password">{{ __('password')}}</label>
                        <input type="password" wire:model.defer="password" class="form-control form-control-rounded" id="password" placeholder="">
                        @error('password') 
                        <div class="alert alert-danger" role="alert">
                            {{ $message}}
                        </div>
                        @enderror
                    </div>

                    <div class="col-md-12">
                        <button class="btn btn-primary btn-rounded mr-3" wire:click.prevent="saveUser" wire:loading.attr="disabled" wire:target="saveType()">
                            <span wire:loading.remove wire:target="saveUser"><i class="nav-icon i-Yes font-weight-bold"></i> Enregistrer</span>
                            <span wire:loading wire:target="saveUser">
                                <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                                enregistrement...
                            </span>
                        </button>
                        <button class="btn btn-danger btn-rounded mr-3" wire:click.prevent="resetInput()" wire:loading.attr="disabled" wire:target="resetInput()">
                            <span wire:loading.remove wire:target="resetInput"><i class="nav-icon i-Repeat-3 font-weight-bold"></i> Reset</span>
                            <span wire:loading wire:target="resetInput">
                                <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                                reinitialisation...
                            </span>
                        </button>
                        <button class="btn btn-secondary btn-rounded" wire:click.prevent="cancelCreate()" wire:loading.attr="disabled" wire:target="cancelCreate()">
                            <span wire:loading.remove wire:target="cancelCreate"><i class="nav-icon i-Arrow-Back font-weight-bold"></i> Retour</span>
                            <span wire:loading wire:target="cancelCreate">
                                <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                                annulation...
                            </span>
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>