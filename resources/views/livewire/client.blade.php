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

        <h4 class="card-title mb-3">{{ __('Liste des clients') }}</h4>
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    @can('add-client')
                    <button class="btn btn-primary btn-rounded mb-3" wire:click="addClient">
                        <span>{{__('Crée client')}}</span>
                    </button>
                    @if ($form == 'addClient')
                    <form wire:submit.prevent="storeClient" class="mb-3">
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
                                            <label for="phone" class="form-label">{{__('Phone')}}</label>
                                            <input type="text" class="form-control" id="phone" name="phone" wire:model.lazy="phone">
                                            @error('phone')
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
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label for="country_id" class="form-label">{{__('Country')}}<span class="text-danger">(*)</span></label>
                                            <select class="form-control" id="country_id" name="country_id" wire:model.lazy="country_id">
                                                <option value="">{{__('Select Country')}}</option>
                                                @foreach($countries as $country)
                                                <option value="{{ $country->id }}">{{ $country->name }}</option>
                                                @endforeach
                                            </select>
                                            @error('country_id')
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
                                            <label for="tva" class="form-label">{{__('tva')}}<span class="text-danger">(*)</span></label>
                                            <input type="text" class="form-control" id="tva" name="tva" wire:model.lazy="tva">
                                            @error('tva')
                                            <div class="alert alert-danger" role="alert">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label for="rcs" class="form-label">{{__('rcs')}}<span class="text-danger">(*)</span></label>
                                            <input type="text" class="form-control" id="rcs" name="rcs" wire:model.lazy="rcs">
                                            @error('rcs')
                                            <div class="alert alert-danger" role="alert">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label for="siret" class="form-label">{{__('siret')}}<span class="text-danger">(*)</span></label>
                                            <input type="text" class="form-control" id="siret" name="siret" wire:model.lazy="siret">
                                            @error('siret')
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

                    @can('edit-client')
                    @if ($form == 'editClient')
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
                                            <label for="edit_phone" class="form-label">{{__('Phone')}}</label>
                                            <input type="text" class="form-control" id="edit_phone" name="edit_phone" wire:model.lazy="phone">
                                            @error('phone')
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
                                     <div class="col-md-4">
                                        <div class="mb-3">
                                            <label for="country_id" class="form-label">{{__('Country')}}<span class="text-danger">(*)</span></label>
                                            <select class="form-control" id="country_id" name="country_id" wire:model.lazy="country_id">
                                                <option value="">{{__('Select Country')}}</option>
                                                @foreach($countries as $country)
                                                <option value="{{ $country->id }}">{{ $country->name }}</option>
                                                @endforeach
                                            </select>
                                            @error('country_id')
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
                                            <label for="tva" class="form-label">{{__('tva')}}</label>
                                            <input type="text" class="form-control" id="tva" name="tva" wire:model.lazy="tva">
                                            @error('tva')
                                            <div class="alert alert-danger" role="alert">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label for="rcs" class="form-label">{{__('rcs')}}<span class="text-danger">(*)</span></label>
                                            <input type="text" class="form-control" id="rcs" name="rcs" wire:model.lazy="rcs">
                                            @error('rcs')
                                            <div class="alert alert-danger" role="alert">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label for="siret" class="form-label">{{__('siret')}}<span class="text-danger">(*)</span></label>
                                            <input type="text" class="form-control" id="siret" name="siret" wire:model.lazy="siret">
                                            @error('siret')
                                            <div class="alert alert-danger" role="alert">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12 mt-3 mb-3">
                                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#editConfirmationModal" wire:loading.attr="disabled">
                                        <span wire:loading wire:target="updateClientConfirmed" class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
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
                                        <button type="submit" class="btn btn-primary" wire:click="updateClientConfirmed">{{__('Confirm')}}</button>
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
                        @if ($clients->isEmpty())
                        <div class="alert alert-info" role="alert">
                            {{ __('Aucun client disponible.') }}
                        </div>
                        @else
                        <table class="table table-striped table-hover">
                            <thead>
                                <tr>
                                    <th scope="col">{{__('Name')}}</th>
                                    <th scope="col">{{__('Country')}}</th>
                                    <th scope="col">{{__('phone')}}</th>
                                    <th scope="col">{{__('Siret')}}</th>
                                    <th scope="col">{{__('Rcs')}}</th>
                                    <th scope="col">{{__('Date creation')}}</th>
                                    <th scope="col">{{__('Action')}}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($clients as $client)
                                <tr>
                                    <td>{{ $client->name }}</td>
                                    <td>{{ $client->country->name }}</td>
                                    <td>{{ $client->phone }}</td>
                                    <td>{{ $client->siret }}</td>
                                    <td>{{ $client->rcs }}</td>
                                    <td>{{ \App\Helpers\Date::formatDateFr($client->created_at) }}</td>

                                    <td>
                                        @can('edit-client')
                                        <button type="button" class="btn btn-raised btn-rounded btn-raised-primary" wire:click="showEdit('{{ $client->id }}')"><i class="nav-icon i-Pen-2 font-weight-bold"></i></button>
                                        @endcan
                                        @can('delete-client')
                                        <button type="button" class="btn btn-raised btn-rounded btn-raised-danger" wire:click="deleteInvoiceConfirmation({{ $client->id }})" data-toggle="modal" data-target="#deleteConfirmationModal"> <i class="nav-icon i-Close-Window font-weight-bold"></i></button>
                                        @endcan
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <div class="d-flex justify-content-center">
                            {{ $clients->links() }}
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
                                        <p>{{__('Are you sure you want to delete this client?')}}</p>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal"> {{__('Annuler')}}</button>
                                        <button type="button" class="btn btn-danger" wire:click="deleteClientConfirmed">{{__('Delete')}}</button>
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