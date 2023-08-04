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
        <h4 class="card-title mb-3">{{ __('Liste des employés') }}</h4>
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    @can('add-post-employee')
                        <button class="btn btn-primary btn-rounded mb-3" wire:click="addPostEmployee">
                            <span>{{__('Créer un employé')}}</span>
                        </button>
                        @if ($form == 'addPostEmployee')
                            <form wire:submit.prevent="storePostEmployee" class="mb-3">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="row col-md-12">
                                            <div class="col-md-4">
                                                <div class="mb-3">
                                                    <label for="name" class="form-label">{{__('Nom')}}</label>
                                                    <input type="text" class="form-control" id="name" name="name"
                                                           wire:model.lazy="name">
                                                    @error('name')
                                                    <div class="alert alert-danger" role="alert">
                                                        {{ $message }}
                                                    </div>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="mb-3">
                                                    <label for="role" class="form-label">{{__('Rôle')}}</label>
                                                    <input type="text" class="form-control" id="role" name="role"
                                                           wire:model.lazy="role">
                                                    @error('role')
                                                    <div class="alert alert-danger" role="alert">
                                                        {{ $message }}
                                                    </div>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="mb-3">
                                                    <label for="type_contrat"
                                                           class="form-label">{{__('Type de contrat')}}</label>
                                                    <select  class="form-control" wire:model="selectedContractType" id="type_contrat" name="type_contrat">
                                                        <option value="">Select Contract Type</option>
                                                        @foreach ($type_contrat as $type)
                                                            <option value="{{ $type }}">{{ $type }}</option>
                                                        @endforeach
                                                    </select>
                                                    @error('type_contrat')
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
                                                    <label for="start_date"
                                                           class="form-label">{{__('Date de début')}}</label>
                                                    <input type="date" class="form-control" id="start_date"
                                                           name="start_date" wire:model.lazy="start_date">
                                                    @error('start_date')
                                                    <div class="alert alert-danger" role="alert">
                                                        {{ $message }}
                                                    </div>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="mb-3">
                                                    <label for="end_date" class="form-label">{{__('Date de fin')}}</label>
                                                    <input type="date" class="form-control" id="end_date" name="end_date"
                                                           wire:model.lazy="end_date">
                                                    @error('end_date')
                                                    <div class="alert alert-danger" role="alert">
                                                        {{ $message }}
                                                    </div>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="mb-3">
                                                    <label for="user_id" class="form-label">{{__('User')}}</label>
                                                    <select class="form-control" id="user_id" name="user_id"
                                                            wire:model.lazy="userId">
                                                        <option value="">{{ __('Veuillez selectionez ') }}</option>
                                                        @foreach ($users as $user)
                                                            <option value="{{ $user->id }}">{{ $user->name }}</option>
                                                        @endforeach
                                                    </select>
                                                    @error('userId')
                                                    <div class="alert alert-danger" role="alert">
                                                        {{ $message }}
                                                    </div>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-12 mt-3 mb-3">
                                            <button type="submit" class="btn btn-primary" wire:loading.attr="disabled">
                                                <span wire:loading wire:target="storePostEmployee"
                                                      class="spinner-border spinner-border-sm" role="status"
                                                      aria-hidden="true"></span>
                                                {{__('Enregistrer')}}
                                            </button>
                                            <button type="button" class="btn btn-danger"
                                                    wire:click="cancel">{{__('Annuler')}}</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                    @endif
                @endcan

                @can('edit-post-employee')
                    @if ($form == 'editPostEmployee')
                        <!-- Form for editing a PostEmployee -->
                            <form class="mb-3">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="row col-md-12">
                                            <div class="col-md-4">
                                                <div class="mb-3">
                                                    <label for="edit_name" class="form-label">{{__('Nom')}}</label>
                                                    <input type="text" class="form-control" id="edit_name"
                                                           name="edit_name" wire:model.lazy="name">
                                                    @error('name')
                                                    <div class="alert alert-danger" role="alert">
                                                        {{ $message }}
                                                    </div>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="mb-3">
                                                    <label for="edit_role" class="form-label">{{__('Rôle')}}</label>
                                                    <input type="text" class="form-control" id="edit_role"
                                                           name="edit_role" wire:model.lazy="role">
                                                    @error('role')
                                                    <div class="alert alert-danger" role="alert">
                                                        {{ $message }}
                                                    </div>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="mb-3">
                                                    <label for="edit_type_contrat"
                                                           class="form-label">{{__('Type de contrat')}}</label>
                                                    <select  class="form-control" wire:model="selectedContractType" id="type_contrat" name="type_contrat">
                                                        <option value="">Select Contract Type</option>
                                                        @foreach ($type_contrat as $type)
                                                            <option value="{{ $type }}">{{ $type }}</option>
                                                        @endforeach
                                                    </select>
                                                    @error('type_contrat')
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
                                                    <label for="edit_start_date"
                                                           class="form-label">{{__('Date de début')}}</label>
                                                    <input type="date" class="form-control" id="edit_start_date"
                                                           name="edit_start_date" wire:model.lazy="start_date">
                                                    @error('start_date')
                                                    <div class="alert alert-danger" role="alert">
                                                        {{ $message }}
                                                    </div>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="mb-3">
                                                    <label for="edit_end_date"
                                                           class="form-label">{{__('Date de fin')}}</label>
                                                    <input type="date" class="form-control" id="edit_end_date"
                                                           name="edit_end_date" wire:model.lazy="end_date">
                                                    @error('end_date')
                                                    <div class="alert alert-danger" role="alert">
                                                        {{ $message }}
                                                    </div>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="mb-3">
                                                    <label for="user_id" class="form-label">{{__('User')}}</label>
                                                    <select class="form-control" id="user_id" name="user_id"
                                                            wire:model.lazy="userId">
                                                        <option value="">{{ __('Veuillez selectionez ') }}</option>
                                                        @foreach ($users as $user)
                                                            <option value="{{ $user->id }}">{{ $user->name }}</option>
                                                        @endforeach
                                                    </select>
                                                    @error('userId')
                                                    <div class="alert alert-danger" role="alert">
                                                        {{ $message }}
                                                    </div>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-12 mt-3 mb-3">
                                            <button type="button" class="btn btn-primary" data-toggle="modal"
                                                    data-target="#editConfirmationModal" wire:loading.attr="disabled">
                                                <span wire:loading wire:target="updatePostEmployeeConfirmed"
                                                      class="spinner-border spinner-border-sm" role="status"
                                                      aria-hidden="true"></span>
                                                {{__('Enregistrer')}}
                                            </button>
                                            <button type="button" class="btn btn-danger"
                                                    wire:click='cancel'>{{__('Annuler')}}</button>
                                        </div>
                                    </div>
                                </div>

                                <!-- Edit Modal -->
                                <div wire:ignore.self class="modal fade" id="editConfirmationModal" tabindex="-1"
                                     role="dialog" aria-labelledby="editConfirmationModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title"
                                                    id="editConfirmationModalLabel">{{__('Confirmation')}}</h5>
                                                <button type="button" class="close" data-dismiss="modal"
                                                        aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <p>{{__('Êtes-vous sûr de vouloir effectuer cette modification ?')}}</p>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary"
                                                        data-dismiss="modal">{{__('Annuler')}}</button>
                                                <button type="button" class="btn btn-primary"
                                                        wire:click="updatePostEmployeeConfirmed">{{__('Confirmer')}}</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                    @endif
                @endcan

                <!-- Display the table of PostEmployees -->
                    <div>
                        @if ($postEmployees->isEmpty())
                            <div class="alert alert-info" role="alert">
                                {{ __('Aucun post d\'employé disponible.') }}
                            </div>
                        @else
                            <table class="table table-striped table-hover">
                                <thead>
                                <tr>
                                    <th scope="col">{{__('Nom')}}</th>
                                    <th scope="col">{{__('Rôle')}}</th>
                                    <th scope="col">{{__('Type de contrat')}}</th>
                                    <th scope="col">{{__('Date de début')}}</th>
                                    <th scope="col">{{__('Date de fin')}}</th>
                                    <th scope="col">{{__('created_at')}}</th>
                                    <th scope="col">{{__('Action')}}</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach ($postEmployees as $postEmployee)
                                    <tr>
                                        <td>{{ $postEmployee->name }}</td>
                                        <td>{{ $postEmployee->role }}</td>
                                        <td>{{ $postEmployee->type_contrat }}</td>
                                        <td>{{ $postEmployee->start_date }}</td>
                                        <td>{{ $postEmployee->end_date }}</td>
                                        <td>{{ $postEmployee->created_at->format('d/m/Y H:i:s') }}</td>
                                        <td>
                                            @can('edit-post-employee')
                                                <button type="button"
                                                        class="btn btn-raised btn-rounded btn-raised-primary"
                                                        wire:click="showEdit('{{ $postEmployee->id }}')">
                                                    <i class="nav-icon i-Pen-2 font-weight-bold"></i>
                                                </button>
                                            @endcan
                                            @can('delete-post-employee')
                                                <button type="button"
                                                        class="btn btn-raised btn-rounded btn-raised-danger"
                                                        wire:click="deletePostEmployeeConfirmation({{ $postEmployee->id }})"
                                                        data-toggle="modal" data-target="#deleteConfirmationModal">
                                                    <i class="nav-icon i-Close-Window font-weight-bold"></i>
                                                </button>
                                            @endcan
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            <div class="d-flex justify-content-center">
                                {{ $postEmployees->links() }}
                            </div>
                        @endif

                    <!-- Delete Modal -->
                        <div wire:ignore.self class="modal fade" id="deleteConfirmationModal" tabindex="-1"
                             role="dialog" aria-labelledby="deleteConfirmationModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title"
                                            id="deleteConfirmationModalLabel">{{__('Confirmer la suppression')}}</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <p>{{__('Êtes-vous sûr de vouloir supprimer cet employé ?')}}</p>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary"
                                                data-dismiss="modal">{{__('Annuler')}}</button>
                                        <button type="button" class="btn btn-danger"
                                                wire:click="deletePostEmployeeConfirmed">{{__('Supprimer')}}</button>
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
                            </script>
                        @endpush
                    </div>
                    <!-- End of the PostEmployeeComponent view -->
                </div>
            </div>
        </div>
    </section>

</div>
