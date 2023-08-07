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

        <h4 class="card-title mb-3">{{ __('Liste des contrats') }}</h4>
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    @can('add-contract')
                    <button class="btn btn-primary btn-rounded mb-3" wire:click="addContract">
                        <span>{{__('Créer un contrat')}}</span>
                    </button>
                    @if ($form == 'addContract')
                    <form wire:submit.prevent="storeContract" class="mb-3">
                        <div class="card">
                            <div class="card-body">
                                <div class="row col-md-12">
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label for="label" class="form-label">{{__('Label')}}<span class="text-danger">(*)</span></label>
                                            <input type="text" class="form-control" id="label" name="label" wire:model.lazy="label">
                                            @error('label')
                                            <div class="alert alert-danger" role="alert">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label for="client_id" class="form-label">{{__('Client')}}<span class="text-danger">(*)</span></label>
                                            <select class="form-control" id="client_id" name="client_id" wire:model.lazy="client_id">
                                                <option value="">{{__('Select Client')}}</option>
                                                @foreach($clients as $client)
                                                <option value="{{ $client->id }}">{{ $client->name }}</option>
                                                @endforeach
                                            </select>
                                            @error('client_id')
                                            <div class="alert alert-danger" role="alert">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label for="company_id" class="form-label">{{__('Companie')}}</label>
                                            <select class="form-control" id="company_id" name="company_id" wire:model.lazy="company_id">
                                                <option value="">{{__('sélectionner Companie')}}</option>
                                                @foreach($companies as $company)
                                                <option value="{{ $company->id }}">{{ $company->name }}</option>
                                                @endforeach
                                            </select>
                                            @error('company_id')
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
                                            <label for="user_id" class="form-label">{{__('Utilisateur')}}<span class="text-danger">(*)</span></label>
                                            <select class="form-control" id="user_id" name="user_id" wire:model.lazy="user_id">
                                                <option value="">{{__('sélectionner Utilisateur')}}</option>
                                                @foreach($users as $user)
                                                <option value="{{ $user->id }}">{{ $user->name }}</option>
                                                @endforeach
                                            </select>
                                            @error('user_id')
                                            <div class="alert alert-danger" role="alert">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label for="daily_rate" class="form-label">{{__('Daily Rate')}}<span class="text-danger">(*)</span></label>
                                            <input type="text" class="form-control" id="daily_rate" name="daily_rate" wire:model.lazy="daily_rate">
                                            @error('daily_rate')
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
                                            <label for="start_date" class="form-label">{{__('Start Date')}}<span class="text-danger">(*)</span></label>
                                            <input type="date" class="form-control" id="start_date" name="start_date" wire:model.lazy="start_date">
                                            @error('start_date')
                                            <div class="alert alert-danger" role="alert">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label for="end_date" class="form-label">{{__('End Date')}}<span class="text-danger">(*)</span></label>
                                            <input type="date" class="form-control" id="end_date" name="end_date" wire:model.lazy="end_date">
                                            @error('end_date')
                                            <div class="alert alert-danger" role="alert">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12 mt-3 mb-3">
                                    <button type="submit" class="btn btn-primary" wire:loading.attr="disabled">
                                        <span wire:loading wire:target="storeContract" class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                                        {{__('Enregister')}}</button>
                                    <button type="button" class="btn btn-danger" wire:click="cancel"> {{__('Annuler')}}</button>
                                </div>
                            </div>
                        </div>
                    </form>
                    @endif
                    @endcan
                    @can('edit-contract')
                    @if ($form == 'editContract')
                    <form class="mb-3">
                        <div class="card">
                            <div class="card-body">
                                <div class="row col-md-12">
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label for="edit_label" class="form-label">{{__('Label')}}</label>
                                            <input type="text" class="form-control" id="edit_label" name="edit_label" wire:model.lazy="label">
                                            @error('label')
                                            <div class="alert alert-danger" role="alert">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label for="edit_client_id" class="form-label">{{__('Client')}}</label>
                                            <select class="form-control" id="edit_client_id" name="edit_client_id" wire:model.lazy="client_id">
                                                <option value="">{{__('sélectionner client')}}</option>
                                                @foreach($clients as $client)
                                                <option value="{{ $client->id }}">{{ $client->name }}</option>
                                                @endforeach
                                            </select>
                                            @error('client_id')
                                            <div class="alert alert-danger" role="alert">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label for="edit_company_id" class="form-label">{{__('Companie')}}</label>
                                            <select class="form-control" id="edit_company_id" name="edit_company_id" wire:model.lazy="company_id">
                                                <option value="">{{__('sélectionner companie')}}</option>
                                                @foreach($companies as $company)
                                                <option value="{{ $company->id }}">{{ $company->name }}</option>
                                                @endforeach
                                            </select>
                                            @error('company_id')
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
                                            <label for="edit_user_id" class="form-label">{{__('Utilisateur')}}</label>
                                            <select class="form-control" id="edit_user_id" name="edit_user_id" wire:model.lazy="user_id">
                                                <option value="">{{__('sélectionner utilisateur')}}</option>
                                                @foreach($users as $user)
                                                <option value="{{ $user->id }}">{{ $user->name }}</option>
                                                @endforeach
                                            </select>
                                            @error('user_id')
                                            <div class="alert alert-danger" role="alert">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label for="edit_daily_rate" class="form-label">{{__('Daily Rate')}}</label>
                                            <input type="text" class="form-control" id="edit_daily_rate" name="edit_daily_rate" wire:model.lazy="daily_rate">
                                            @error('daily_rate')
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
                                            <label for="edit_start_date" class="form-label">{{__('Start Date')}}</label>
                                            <input type="date" class="form-control" id="edit_start_date" name="edit_start_date" wire:model.lazy="start_date">
                                            @error('start_date')
                                            <div class="alert alert-danger" role="alert">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label for="edit_end_date" class="form-label">{{__('End Date')}}</label>
                                            <input type="date" class="form-control" id="edit_end_date" name="edit_end_date" wire:model.lazy="end_date">
                                            @error('end_date')
                                            <div class="alert alert-danger" role="alert">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12 mt-3 mb-3">
                                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#editConfirmationModal" wire:loading.attr="disabled">
                                        <span wire:loading wire:target="updateContractConfirmed" class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                                        {{__('Enregister')}}</button>
                                    <button type="button" class="btn btn-danger" wire:click='cancel'> {{__('Annuler')}}</button>
                                </div>
                            </div>
                        </div>
                        <!-- Edit Modal -->
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
                                        <p>{{__('Êtes-vous sûr de vouloir effectuer cette modification ?')}}</p>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal"> {{__('Annuler')}}</button>
                                        <button type="submit" class="btn btn-primary" wire:click="updateContractConfirmed">{{__('Confirmer')}}</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                    @endif
                    @endcan

                    <!-- Contract Table -->
                    <div>
                        @if ($contracts->isEmpty())
                        <div class="alert alert-info" role="alert">
                            {{ __('Aucun contrat disponible.') }}
                        </div>
                        @else
                        <table class="table table-striped table-hover">
                            <thead>
                                <tr>
                                    <th scope="col">{{__('Label')}}</th>
                                    <th scope="col">{{__('Client')}}</th>
                                    <th scope="col">{{__('Utilisateur')}}</th>
                                    <th scope="col">{{__('Daily Rate')}}</th>
                                    <th scope="col">{{__('Start Date')}}</th>
                                    <th scope="col">{{__('End Date')}}</th>
                                    <th scope="col">{{__('Action')}}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($contracts as $contract)
                                <tr>
                                    <td>{{ $contract->label }}</td>
                                    <td>{{ $contract->client->name }}</td>
                                    <td>{{ $contract->user->name }}</td>
                                    <td>{{ $contract->daily_rate }}</td>
                                    <td>{{ \App\Helpers\Date::formatDateFr($contract->start_date) }}</td>
                                    <td>{{ \App\Helpers\Date::formatDateFr($contract->end_date) }}</td>
                                    <td>
                                        @can('edit-contract')
                                        <button type="button" class="btn btn-raised btn-rounded btn-raised-primary" wire:click="showEdit('{{ $contract->id }}')"><i class="nav-icon i-Pen-2 font-weight-bold"></i></button>
                                        @endcan
                                        @can('delete-contract')
                                        <button type="button" class="btn btn-raised btn-rounded btn-raised-danger" wire:click="deleteContractConfirmation({{ $contract->id }})" data-toggle="modal" data-target="#deleteConfirmationModal"><i class="nav-icon i-Close-Window font-weight-bold"></i></button>
                                        @endcan
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <div class="d-flex justify-content-center">
                            {{ $contracts->links() }}
                        </div>
                        @endif
                        <!-- Delete Modal -->
                        <div wire:ignore.self class="modal fade" id="deleteConfirmationModal" tabindex="-1" role="dialog" aria-labelledby="deleteConfirmationModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="deleteConfirmationModalLabel">{{__('Confirmation')}}</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <p>{{__('Êtes-vous sûr de vouloir supprimer ce contrat ?')}}</p>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal"> {{__('Annuler')}}</button>
                                        <button type="button" class="btn btn-danger" wire:click="deleteContractConfirmed">{{__('Supprimer')}}</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- End Delete Modal -->

                    </div>
                    <!-- End Contract Table -->

                    <!-- Delete Modal -->
                    <div wire:ignore.self class="modal fade" id="deleteConfirmationModal" tabindex="-1" role="dialog" aria-labelledby="deleteConfirmationModalLabel" aria-hidden="true">
                        <!-- ... -->
                    </div>
                    <!-- End Delete Modal -->

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
            </div>
        </div>
    </section>

</div>