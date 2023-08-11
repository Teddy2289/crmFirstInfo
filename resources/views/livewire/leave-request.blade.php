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

        <h4 class="card-title mb-3">{{ __('Liste des demandes') }}</h4>
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    @can('add-leave-request')
                    <button class="btn btn-primary btn-rounded mb-3" wire:click="addLeaveRequest">
                        <span>{{__('Créer une demande')}}</span>
                    </button>
                    @if ($form == 'addLeaveRequest')
                    <form wire:submit.prevent="storeLeaveRequest" class="mb-3">
                        <div class="card">
                            <div class="card-body">
                                <div class="row col-md-12">
                                    <div class="col-md-4">

                                        <div class="mb-3">
                                            <label for="employe_id" class="form-label">{{__('Nom Employe')}}</label>
                                            <select class="form-control" id="employe_id" name="employe_id" wire:model.lazy="employe_id">
                                                <option value="">{{__('Sélection employe')}}</option>
                                                @foreach($employees as $employe)
                                                <option value="{{ $employe->id }}">{{ $employe->first_name }}</option>
                                                @endforeach
                                            </select>
                                            @error('employe_id')
                                            <div class="alert alert-danger" role="alert">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label for="leave_type_id" class="form-label">{{__('Type de congé')}}</label>
                                            <select class="form-control" id="leave_type_id" name="leave_type_id" wire:model.lazy="leave_type_id">
                                                <option value="">{{__('Sélection Type de congé')}}</option>
                                                @foreach($leaveTypes as $leaveType)
                                                <option value="{{ $leaveType->id }}">{{ $leaveType->Libelle }}</option>
                                                @endforeach
                                            </select>
                                            @error('leave_type_id')
                                            <div class="alert alert-danger" role="alert">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                        </div>
                                    </div>
                                        <div class="col-md-4">
                                            <div class="mb-3">
                                                <label for="company_id" class="form-label">{{__('Entreprise')}}</label>
                                                <select class="form-control" id="company_id" name="company_id" wire:model.lazy="company_id">
                                                    <option value="">{{__('Sélectionner une entreprise')}}</option>
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

                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label for="Leave_reason" class="form-label">{{__('Motif')}}</label>
                                            <input type="text" class="form-control" id="Leave_reason" name="Leave_reason" wire:model.lazy="Leave_reason">
                                            @error('Leave_reason')
                                            <div class="alert alert-danger" role="alert">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label for="start_date" class="form-label">{{__('Début congé')}}</label>
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
                                            <label for="end_date" class="form-label">{{__('Fin congé')}}</label>
                                            <input type="date" class="form-control" id="end_date" name="end_date" wire:model.lazy="end_date">
                                            @error('end_date')
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
                                            <label for="statut" class="form-label">{{ __('Statut') }}</label>
                                            <select class="form-control" id="statut" name="statut" wire:model.lazy="statut">
                                                <option value="">{{ __('Sélectionner un statut') }}</option>
                                                <option value="on hold">{{ __('En attente') }}</option>
                                                <option value="approved">{{ __('Approuvé') }}</option>
                                                <option value="denied">{{ __('Refusé') }}</option>
                                            </select>                                            
                                            @error('statut')
                                            <div class="alert alert-danger" role="alert">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                        </div>
                                    </div>
                                    
                                <div class="col-md-12 mt-3 mb-3">
                                    <button type="submit" class="btn btn-primary" wire:loading.attr="disabled">
                                        <span wire:loading wire:target="storeLeaveRequest" class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                                        {{__('Enregistrer')}}</button>
                                    <button type="button" class="btn btn-danger" wire:click="cancel">{{__('Annuler')}}</button>
                                </div>
                            </div>
                        </div>
                    </form>
                    @endif
                    @endcan


                    @can('edit-leave-request')
                    @if ($form == 'editLeaveRequest')
                    <form class="mb-3">
                        <div class="card">
                            <div class="card-body">
                            <div class="row col-md-12">
                                    <div class="col-md-4">

                                        <div class="mb-3">
                                            <label for="edit_employe_id" class="form-label">{{__('Nom Employe')}}<span class="text-danger">(*)</span></label>
                                            <select class="form-control" id="edit_employe_id" name="edit_employe_id" wire:model.lazy="employe_id">
                                                <option value="">{{__('Sélection employe')}}</option>
                                                @foreach($employees as $employe)
                                                <option value="{{ $employe->id }}">{{ $employe->first_name }}</option>
                                                @endforeach
                                            </select>
                                            @error('employe_id')
                                            <div class="alert alert-danger" role="alert">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label for="edit_leave_type_id" class="form-label">{{__('Type de congé')}}<span class="text-danger">(*)</span></label>
                                            <select class="form-control" id="edit_leave_type_id" name="edit_leave_type_id" wire:model.lazy="leave_type_id">
                                                <option value="">{{__('Sélection Type de congé')}}</option>
                                                @foreach($leaveTypes as $leaveType)
                                                <option value="{{ $leaveType->id }}">{{ $leaveType->Libelle }}</option>
                                                @endforeach
                                            </select>
                                            @error('leave_type_id')
                                            <div class="alert alert-danger" role="alert">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                        </div>
                                    </div>
                                        <div class="col-md-4">
                                            <div class="mb-3">
                                                <label for="edit_company_id" class="form-label">{{__('Entreprise')}}</label>
                                                <select class="form-control" id="edit_company_id" name="edit_company_id" wire:model.lazy="company_id">
                                                    <option value="">{{__('Sélectionner une entreprise')}}</option>
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

                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label for="edit_Leave_reason" class="form-label">{{__('Motif')}}</label>
                                            <input type="text" class="form-control" id="edit_Leave_reason" name="edit_Leave_reason" wire:model.lazy="Leave_reason">
                                            @error('Leave_reason')
                                            <div class="alert alert-danger" role="alert">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label for="edit_start_date" class="form-label">{{__('Début congé')}}</label>
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
                                            <label for="edit_end_date" class="form-label">{{__('Fin congé')}}</label>
                                            <input type="date" class="form-control" id="edit_end_date" name="edit_end_date" wire:model.lazy="end_date">
                                            @error('end_date')
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
                                            <label for="edit_statut" class="form-label">{{ __('Statut') }}</label>
                                            <select class="form-control" id="edit_statut" name="edit_statut" wire:model.lazy="statut">
                                                <option value="">{{ __('Sélectionner un statut') }}</option>
                                                <option value="on hold">{{ __('En attente') }}</option>
                                                <option value="approved">{{ __('Approuvé') }}</option>
                                                <option value="denied">{{ __('Refusé') }}</option>
                                            </select>                                            
                                            @error('statut')
                                            <div class="alert alert-danger" role="alert">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                        </div>
                                    </div>

                                <div class="row col-md-12">
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#editConfirmationModal" wire:loading.attr="disabled">
                                                <span wire:loading wire:target="updateLeaveRequestConfirmed" class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                                                {{__('Enregistrer')}}
                                            </button>
                                            <button type="button" class="btn btn-danger" wire:click="cancel">{{__('Annuler')}}</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Edit Confirmation Modal -->
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
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">{{__('Annuler')}}</button>
                                        <button type="submit" class="btn btn-primary" wire:click="updateLeaveRequestConfirmed">{{__('Confirmer')}}</button>
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
                    @if ($leaveRequesteds->isEmpty())
                            <div class="alert alert-info" role="alert">
                                {{ __('Aucun demande disponible.') }}
                            </div>
                        @else
                        <table class="table table-striped table-hover">
                            <thead>
                                <tr>
                                    <th scope="col">{{__('Nom Employe')}}</th>
                                    <th scope="col">{{__('Type de congé')}}</th>
                                    <th scope="col">{{__('Entreprise')}}</th>
                                    <th scope="col">{{__('Motif')}}</th>
                                    <th scope="col">{{__('Début congé')}}</th>
                                    <th scope="col">{{__('Fin congé')}}</th>
                                    <th scope="col">{{__('statut')}}</th>
                                    <th scope="col">{{__('Action')}}</th>
                                    
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($leaveRequesteds as $leaveRequested)
                                <tr>
                                    <td>{{ $leaveRequested->employe->first_name }}</td>
                                    <td>{{ $leaveRequested->leaveType->Libelle }}</td>
                                    <td>{{ $leaveRequested->company->name }}</td>
                                    <td>{{ $leaveRequested->Leave_reason }}</td>
                                    <td>{{ \App\Helpers\Date::formatDateFr($leaveRequested->start_date) }}</td>
                                    <td>{{ \App\Helpers\Date::formatDateFr($leaveRequested->end_date) }}</td>
                                    <td>{{ $leaveRequested->statut }}</td>
                                    <td>
                                        @can('edit-leave-request')
                                        <button type="button" class="btn btn-raised btn-rounded btn-raised-primary" wire:click="showEdit('{{ $leaveRequest->id }}')"><i class="nav-icon i-Pen-2 font-weight-bold"></i></button>
                                        @endcan
                                        @can('delete-leave-request')
                                        <button type="button" class="btn btn-raised btn-rounded btn-raised-danger" wire:click="deleteLeaveRequestConfirmation({{ $leaveRequest->id }})" data-toggle="modal" data-target="#deleteConfirmationModal"> <i class="nav-icon i-Close-Window font-weight-bold"></i></button>
                                        @endcan
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <div class="d-flex justify-content-center">
                            {{ $leaveRequesteds->links() }}
                        </div>
                        @endif
                        <!-- Delete Confirmation Modal -->
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
                                        <p>{{__('Are you sure you want to delete this employee?')}}</p>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal"> {{__('Cancel')}}</button>
                                        <button type="button" class="btn btn-danger" wire:click="deleteLeaveRequestConfirmed">{{__('Delete')}}</button>
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
