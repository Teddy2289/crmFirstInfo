<div>

    <section class="section">

        <h4 class="card-title mb-3">{{ __('Liste des facture') }}</h4>
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <button class="btn btn-primary btn-rounded mb-3" wire:click="addEmployee">
                        <span>{{__('Créer facture')}}</span>
                    </button>

                    <form wire:submit.prevent="storeEmployee" class="mb-3">
                        <div class="card">
                            <div class="card-body">
                                <div class="card mb-4">
                                    <div class="card-header">
                                        Details facture
                                    </div>
                                    <div class="card-body">
                                        @foreach ($details as $index => $detail)
                                        <div class="col-md-12 row mb-3">
                                            <div class="col-md-3">
                                                <div class="mb-3">
                                                    <label for="date" class="form-label">{{__('label')}}<span class="text-danger">(*)</span></label>
                                                    <input type="text" class="form-control" id="label" name="label" wire:model="details.{{ $index }}.label">
                                                    @error('label')
                                                    <div class="alert alert-danger" role="alert">
                                                        {{ $message }}
                                                    </div>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="mb-3">
                                                    <label for="quantity" class="form-label">{{__('quantity')}}<span class="text-danger">(*)</span></label>
                                                    <input type="number" class="form-control" id="quantity" name="quantity" wire:model="details.{{ $index }}.quantity">
                                                    @error('quantity')
                                                    <div class="alert alert-danger" role="alert">
                                                        {{ $message }}
                                                    </div>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="mb-3">
                                                    <label for="price" class="form-label">{{__('price')}}<span class="text-danger">(*)</span></label>
                                                    <input type="number" class="form-control" id="price" name="price" wire:model="details.{{ $index }}.price">
                                                    @error('price')
                                                    <div class="alert alert-danger" role="alert">
                                                        {{ $message }}
                                                    </div>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-md-2">
                                                <div class="mb-3">
                                                    <label for="fee" class="form-label">{{__('fee')}}<span class="text-danger">(*)</span></label>
                                                    <input type="number" class="form-control" id="fee" name="fee" wire:model="details.{{ $index }}.fee">
                                                    @error('fee')
                                                    <div class="alert alert-danger" role="alert">
                                                        {{ $message }}
                                                    </div>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-md-1">
                                                <button type="button" class="btn btn-danger " wire:click.prevent="removeDetail({{ $index }})">
                                                    <i class="nav-icon i-Close-Window "></i>
                                                </button>
                                            </div>
                                        </div>
                                        <hr>

                                        @endforeach
                                        <button class="btn btn-primary btn-rounded" wire:click.prevent="addDetail">ajout details</button>
                                    </div>
                                </div>

                                <div class="row col-md-12">
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label for="date" class="form-label">{{__('date')}}<span class="text-danger">(*)</span></label>
                                            <input type="text" class="form-control" id="date" name="date" wire:model.lazy="date">
                                            @error('date')
                                            <div class="alert alert-danger" role="alert">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label for="month" class="form-label">{{__('month')}}<span class="text-danger">(*)</span></label>
                                            <input type="text" class="form-control" id="month" name="month" wire:model.lazy="month">
                                            @error('month')
                                            <div class="alert alert-danger" role="alert">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label for="year" class="form-label">{{__('year')}}<span class="text-danger">(*)</span></label>
                                            <input type="text" class="form-control" id="year" name="year" wire:model.lazy="year">
                                            @error('year')
                                            <div class="alert alert-danger" role="alert">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="row col-md-12">
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label for="number" class="form-label">{{__('number')}}</label>
                                            <input type="text" class="form-control" id="number" name="number" wire:model.lazy="number">
                                            @error('number')
                                            <div class="alert alert-danger" role="alert">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label for="day_count" class="form-label">{{__('day_count')}}</label>
                                            <input type="text" class="form-control" id="day_count" name="day_count" wire:model.lazy="day_count">
                                            @error('day_count')
                                            <div class="alert alert-danger" role="alert">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label for="payment_id" class="form-label">{{__('status')}}<span class="text-danger">(*)</span></label>
                                            <select class="form-control" id="payment_id" name="payment_id" wire:model.lazy="payment_id">
                                                <option value="">{{__('Sélectionner une status payement')}}</option>
                                                @foreach($payements as $payement)
                                                <option value="{{ $payement->id }}">{{ $payement->label }}</option>
                                                @endforeach
                                            </select>
                                            @error('payment_id')
                                            <div class="alert alert-danger" role="alert">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="row col-md-12">
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label for="contract_id" class="form-label">{{__('Pays')}}<span class="text-danger">(*)</span></label>
                                            <select class="form-control" id="contract_id" name="contract_id" wire:model.lazy="contract_id">
                                                <option value="">{{__('Sélectionner un pays')}}</option>
                                                @foreach($contracts as $contract)
                                                <option value="{{ $contract->id }}">{{ $contract->label }}</option>
                                                @endforeach
                                            </select>
                                            @error('contract_id')
                                            <div class="alert alert-danger" role="alert">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label for="note" class="form-label">{{__('note')}}</label>
                                            <input type="text" class="form-control" id="note" name="note" wire:model.lazy="note">
                                            @error('note')
                                            <div class="alert alert-danger" role="alert">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="row col-md-12">
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label for="montant_ht" class="form-label">{{__('montant_ht')}}</label>
                                            <input type="text" class="form-control" id="montant_ht" name="montant_ht" wire:model.lazy="montant_ht">
                                            @error('montant_ht')
                                            <div class="alert alert-danger" role="alert">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label for="montant_ttc" class="form-label">{{__('montant_ttc')}}</label>
                                            <input type="text" class="form-control" id="montant_ttc" name="montant_ttc" wire:model.lazy="montant_ttc">
                                            @error('montant_ttc')
                                            <div class="alert alert-danger" role="alert">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label for="date_sent" class="form-label">{{__('date_sent')}}</label>
                                            <input type="text" class="form-control" id="date_sent" name="date_sent" wire:model.lazy="date_sent">
                                            @error('date_sent')
                                            <div class="alert alert-danger" role="alert">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="row col-md-12">
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label for="date_paid" class="form-label">{{__('date_paid')}}</label>
                                            <input type="date" class="form-control" id="date_paid" name="date_paid" wire:model.lazy="date_of_birth">
                                            @error('date_paid')
                                            <div class="alert alert-danger" role="alert">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12 mt-3 mb-3">
                                    <button type="submit" class="btn btn-primary" wire:loading.attr="disabled">
                                        <span wire:loading wire:target="storeEmployee" class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                                        {{__('Enregistrer')}}</button>
                                    <button type="button" class="btn btn-danger" wire:click="cancel">{{__('Annuler')}}</button>
                                </div>
                            </div>
                        </div>
                    </form>

                    <!-- Vue Livewire -->
                    <!-- Vue Blade -->


                    <!-- End Default Table Example -->
                </div>
            </div>
        </div>
    </section>
</div>