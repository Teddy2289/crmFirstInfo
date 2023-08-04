<div>
        @if($notification)
                    <div class="alert alert-success mt-3">
                        {{ $notificationMessage }}
                    </div>

                    <!-- JavaScript to automatically hide the notification after 3 seconds -->
                    <script>
                        setTimeout(() => {
                            Livewire.emit('clearNotification');
                        }, 3000);
                    </script>
            @endif
    <section class="section">

        <h4 class="card-title mb-3">{{ __('Liste des entreprises') }}</h4>
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    @can('add-company')
                    <button class="btn btn-primary btn-rounded mb-3" wire:click="addCompany">
                        <span>{{__('Crée entrepise')}}</span>
                    </button>
                    @if ($form == 'addCompany')
                    <form wire:submit.prevent="storeCompany" class="mb-3">
                        <div class="card">
                            <div class="card-body">
                                <div class="row col-md-12">
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label for="name" class="form-label">{{__('Name')}}<span class="text-danger">(*)</span></label>
                                            <input type="text" class="form-control" id="name" name="name" wire:model.lazy="name">
                                            @error('name')
                                            <div class="alert alert-danger" role="alert">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label for="trade_name" class="form-label">{{__('Trade Name')}}<span class="text-danger">(*)</span></label>
                                            <input type="text" class="form-control" id="trade_name" name="trade_name" wire:model.lazy="trade_name">
                                            @error('trade_name')
                                            <div class="alert alert-danger" role="alert">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label for="email" class="form-label">{{__('Email')}}<span class="text-danger">(*)</span></label>
                                            <input type="email" class="form-control" id="email" name="email" wire:model.lazy="email">
                                            @error('email')
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
                                            <label for="phone" class="form-label">{{__('Phone')}}</label>
                                            <input type="text" class="form-control" id="phone" name="phone" wire:model.lazy="phone">
                                            @error('phone')
                                            <div class="alert alert-danger" role="alert">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label for="address" class="form-label">{{__('Address')}}<span class="text-danger">(*)</span></label>
                                            <input type="text" class="form-control" id="address" name="address" wire:model.lazy="address">
                                            @error('address')
                                            <div class="alert alert-danger" role="alert">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label for="postal_code" class="form-label">{{__('Postal Code')}}<span class="text-danger">(*)</span></label>
                                            <input type="text" class="form-control" id="postal_code" name="postal_code" wire:model.lazy="postal_code">
                                            @error('postal_code')
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
                                            <label for="town" class="form-label">{{__('Town')}}<span class="text-danger">(*)</span></label>
                                            <input type="text" class="form-control" id="town" name="town" wire:model.lazy="town">
                                            @error('town')
                                            <div class="alert alert-danger" role="alert">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label for="capital" class="form-label">{{__('Capital')}}<span class="text-danger">(*)</span></label>
                                            <input type="text" class="form-control" id="capital" name="capital" wire:model.lazy="capital">
                                            @error('capital')
                                            <div class="alert alert-danger" role="alert">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label for="siren" class="form-label">{{__('SIREN')}}</label>
                                            <input type="text" class="form-control" id="siren" name="siren" wire:model.lazy="siren">
                                            @error('siren')
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
                                            <label for="siret" class="form-label">{{__('SIRET')}}</label>
                                            <input type="text" class="form-control" id="siret" name="siret" wire:model.lazy="siret">
                                            @error('siret')
                                            <div class="alert alert-danger" role="alert">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label for="ape" class="form-label">{{__('APE')}}</label>
                                            <input type="text" class="form-control" id="ape" name="ape" wire:model.lazy="ape">
                                            @error('ape')
                                            <div class="alert alert-danger" role="alert">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label for="rcs" class="form-label">{{__('RCS')}}</label>
                                            <input type="text" class="form-control" id="rcs" name="rcs" wire:model.lazy="rcs">
                                            @error('rcs')
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
                                            <label for="num_vat" class="form-label">{{__('VAT Number')}}</label>
                                            <input type="text" class="form-control" id="num_vat" name="num_vat" wire:model.lazy="num_vat">
                                            @error('num_vat')
                                            <div class="alert alert-danger" role="alert">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label for="iban" class="form-label">{{__('IBAN')}}</label>
                                            <input type="text" class="form-control" id="iban" name="iban" wire:model.lazy="iban">
                                            @error('iban')
                                            <div class="alert alert-danger" role="alert">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label for="bic" class="form-label">{{__('BIC')}}</label>
                                            <input type="text" class="form-control" id="bic" name="bic" wire:model.lazy="bic">
                                            @error('bic')
                                            <div class="alert alert-danger" role="alert">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12 mt-3 mb-3">
                                    <button type="submit" class="btn btn-primary" wire:loading.attr="disabled">
                                        <span wire:loading wire:target="storeCompany" class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                                        {{__('Enregister')}}</button>
                                    <button type="button" class="btn btn-danger" wire:click="cancel"> {{__('Annuler')}}</button>
                                </div>

                            </div>
                        </div>

                    </form>

                    @endif
                    @endcan

                    @can('edit-company')
                    @if ($form == 'editCompany')
                    <form class="mb-3">
                        <div class="card">
                            <div class="card-body">
                                <div class="row col-md-12">
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label for="edit_name" class="form-label">{{__('Name')}}</label>
                                            <input type="text" class="form-control" id="edit_name" name="edit_name" wire:model.lazy="name">
                                            @error('name')
                                            <div class="alert alert-danger" role="alert">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label for="edit_trade_name" class="form-label">{{__('Trade Name')}}</label>
                                            <input type="text" class="form-control" id="edit_trade_name" name="edit_trade_name" wire:model.lazy="trade_name">
                                            @error('trade_name')
                                            <div class="alert alert-danger" role="alert">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label for="edit_email" class="form-label">{{__('Email')}}</label>
                                            <input type="email" class="form-control" id="edit_email" name="edit_email" wire:model.lazy="email">
                                            @error('email')
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
                                            <label for="edit_phone" class="form-label">{{__('Phone')}}</label>
                                            <input type="text" class="form-control" id="edit_phone" name="edit_phone" wire:model.lazy="phone">
                                            @error('phone')
                                            <div class="alert alert-danger" role="alert">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label for="edit_address" class="form-label">{{__('Address')}}</label>
                                            <input type="text" class="form-control" id="edit_address" name="edit_address" wire:model.lazy="address">
                                            @error('address')
                                            <div class="alert alert-danger" role="alert">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label for="edit_postal_code" class="form-label">{{__('Postal Code')}}</label>
                                            <input type="text" class="form-control" id="edit_postal_code" name="edit_postal_code" wire:model.lazy="postal_code">
                                            @error('postal_code')
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
                                            <label for="edit_town" class="form-label">{{__('Town')}}</label>
                                            <input type="text" class="form-control" id="edit_town" name="edit_town" wire:model.lazy="town">
                                            @error('town')
                                            <div class="alert alert-danger" role="alert">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label for="edit_capital" class="form-label">{{__('Capital')}}</label>
                                            <input type="text" class="form-control" id="edit_capital" name="edit_capital" wire:model.lazy="capital">
                                            @error('capital')
                                            <div class="alert alert-danger" role="alert">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label for="edit_siren" class="form-label">{{__('SIREN')}}</label>
                                            <input type="text" class="form-control" id="edit_siren" name="edit_siren" wire:model.lazy="siren">
                                            @error('siren')
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
                                            <label for="edit_siret" class="form-label">{{__('SIRET')}}</label>
                                            <input type="text" class="form-control" id="edit_siret" name="edit_siret" wire:model.lazy="siret">
                                            @error('siret')
                                            <div class="alert alert-danger" role="alert">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label for="edit_ape" class="form-label">{{__('APE')}}</label>
                                            <input type="text" class="form-control" id="edit_ape" name="edit_ape" wire:model.lazy="ape">
                                            @error('ape')
                                            <div class="alert alert-danger" role="alert">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label for="edit_rcs" class="form-label">{{__('RCS')}}</label>
                                            <input type="text" class="form-control" id="edit_rcs" name="edit_rcs" wire:model.lazy="rcs">
                                            @error('rcs')
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
                                            <label for="edit_num_vat" class="form-label">{{__('VAT Number')}}</label>
                                            <input type="text" class="form-control" id="edit_num_vat" name="edit_num_vat" wire:model.lazy="num_vat">
                                            @error('num_vat')
                                            <div class="alert alert-danger" role="alert">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label for="edit_iban" class="form-label">{{__('IBAN')}}</label>
                                            <input type="text" class="form-control" id="edit_iban" name="edit_iban" wire:model.lazy="iban">
                                            @error('iban')
                                            <div class="alert alert-danger" role="alert">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label for="edit_bic" class="form-label">{{__('BIC')}}</label>
                                            <input type="text" class="form-control" id="edit_bic" name="edit_bic" wire:model.lazy="bic">
                                            @error('bic')
                                            <div class="alert alert-danger" role="alert">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12 mt-3 mb-3">
                                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#editConfirmationModal" wire:loading.attr="disabled">
                                        <span wire:loading wire:target="updateCompanyConfirmed" class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                                        {{__('Enregister')}}</button>
                                    <button type="button" class="btn btn-danger" wire:click='cancel'> {{__('Annuler')}}</button>
                                </div>
                            </div>
                        </div>

                        <!-- Edit  Modal -->
                        <div wire:ignore.self class="modal fade" id="editConfirmationModal" tabindex="-1" role="dialog" aria-labelledby="editConfirmationModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="editConfirmationModalLabel">{{__('Confirmation')}}</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <p>{{__('Est vous sur de vouloir effectuez ce modification?')}}</p>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal"> {{__('Annuler')}}</button>
                                        <button type="submit" class="btn btn-primary" wire:click="updateCompanyConfirmed">{{__('Confirm')}}</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                    @endif
                    @endcan
                    <!-- Vue Livewire -->
                    <!-- Vue Blade -->
                    <div>
                    @if ($companies->isEmpty())
                            <div class="alert alert-info" role="alert">
                                {{ __('Aucun entreprise disponible.') }}
                            </div>
                        @else
                        <table class="table table-striped table-hover">
                            <thead>
                                <tr>
                                    <th scope="col">{{__('Name')}}</th>
                                    <th scope="col">{{__('Trade Name')}}</th>
                                    <th scope="col">{{__('Email')}}</th>
                                    <th scope="col">{{__('Action')}}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($companies as $company)
                                <tr>
                                    <td>
                                        <p>{{ $company->name }}</p>
                                    </td>
                                    <td>{{ $company->trade_name }}</td>
                                    <td>{{ $company->email }}</td>
                                    <td>
                                        @can('edit-company')
                                        <button type="button" class="btn btn-raised btn-rounded btn-raised-primary" wire:click="showEdit('{{ $company->id }}')"><i class="nav-icon i-Pen-2 font-weight-bold"></i></button>
                                        @endcan
                                        @can('delete-company')
                                        <button type="button" class="btn btn-raised btn-rounded btn-raised-danger" wire:click="deleteCompanyConfirmation({{ $company->id }})" data-toggle="modal" data-target="#deleteConfirmationModal"> <i class="nav-icon i-Close-Window font-weight-bold"></i></button>
                                        @endcan
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <div class="d-flex justify-content-center">
                            {{ $companies->links() }}
                        </div>
                        @endif
                        <!-- Delete  Modal -->
                        <div wire:ignore.self class="modal fade" id="deleteConfirmationModal" tabindex="-1" role="dialog" aria-labelledby="deleteConfirmationModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="deleteConfirmationModalLabel">{{__('Confirm Delete')}}</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <p>{{__('Are you sure you want to delete this company?')}}</p>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal"> {{__('Annuler')}}</button>
                                        <button type="button" class="btn btn-danger" wire:click="deleteCompanyConfirmed">{{__('Delete')}}</button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        @push('scripts')
                        <script>
                            Livewire.on('success', () => {
                                // Close the delete confirmation modal
                                $('#deleteConfirmationModal').modal('hide');
                            });

                            Livewire.on('close-delete-confirmation-modal', () => {
                                // Close the delete confirmation modal
                                $('#deleteConfirmationModal').modal('hide');
                            });
                        </script>
                        @endpush
                    </div>
                    <!-- End Default Table Example -->
                </div>
            </div>
        </div>
    </section>
</div>