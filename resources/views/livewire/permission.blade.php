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
        <h4 class="card-title mb-3">{{ __('Liste des permissions') }}</h4>
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    @can('add-permission')
                        <button class="btn btn-primary btn-rounded mb-3" wire:click="addPermission">
                            <span>{{__('Créer une permission')}}</span>
                        </button>
                        @if ($form == 'addPermission')
                            <form wire:submit.prevent="storePermission" class="mb-3">
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
                                                    <label for="guard_name"
                                                           class="form-label">{{__('Guard Name')}}</label>
                                                    <input type="text" class="form-control" id="guard_name"
                                                           name="guard_name" wire:model.lazy="guard_name">
                                                    @error('guard_name')
                                                    <div class="alert alert-danger" role="alert">
                                                        {{ $message }}
                                                    </div>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-12 mt-3 mb-3">
                                            <button type="submit" class="btn btn-primary" wire:loading.attr="disabled">
                                                <span wire:loading wire:target="storePermission"
                                                      class="spinner-border spinner-border-sm" role="status"
                                                      aria-hidden="true"></span>
                                                {{__('Enregistrer')}}</button>
                                            <button type="button" class="btn btn-danger"
                                                    wire:click="cancel"> {{__('Annuler')}}</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        @endif
                    @endcan

                    @can('edit-permission')
                        @if ($form == 'editPermission')
                            <form class="mb-3">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="row col-md-12">
                                            <div class="col-md-4">
                                                <div class="mb-3">
                                                    <label for="edit_name"
                                                           class="form-label">{{__('Nom')}}</label>
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
                                                    <label for="edit_guard_name"
                                                           class="form-label">{{__('Guard Name')}}</label>
                                                    <input readonly="readonly" type="text" class="form-control" id="edit_guard_name"
                                                           name="edit_guard_name" wire:model.lazy="guard_name">
                                                    @error('guard_name')
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
                                                <span wire:loading wire:target="updatePermissionConfirmed"
                                                      class="spinner-border spinner-border-sm" role="status"
                                                      aria-hidden="true"></span>
                                                {{__('Enregistrer')}}</button>
                                            <button type="button" class="btn btn-danger"
                                                    wire:click="cancel"> {{__('Annuler')}}</button>
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
                                                        data-dismiss="modal"> {{__('Annuler')}}</button>
                                                <button type="submit" class="btn btn-primary"
                                                        wire:click="updatePermissionConfirmed">{{__('Confirmer')}}</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        @endif
                    @endcan

                    <div>
                        @if($permissions->isEmpty())
                            <div class="alert alert-info" role="alert">
                                {{ __('Aucune permission disponible.') }}
                            </div>
                        @else
                        <table class="table table-striped table-hover">
                            <thead class="thead-dark">
                            <tr>
                                <th scope="col">{{__('Nom')}}</th>
                                <th scope="col">{{__('Guard Name')}}</th>
                                <th scope="col">{{__('created_at')}}</th>
                                <th scope="col">{{__('Action')}}</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($permissions as $permission)
                                <tr>
                                    <td>{{ $permission->name }}</td>
                                    <td>{{ $permission->guard_name }}</td>
                                    <td>{{ \App\Helpers\Date::formatDateFr($permission->created_at)}}</td>
                                    <td>
                                        @can('edit-permission')
                                            <button type="button" class="btn btn-raised btn-rounded btn-raised-primary"
                                                    wire:click="showEdit('{{ $permission->id }}')"><i
                                                    class="nav-icon i-Pen-2 font-weight-bold"></i></button>
                                        @endcan
                                        @can('delete-permission')
                                            <button type="button" class="btn btn-raised btn-rounded btn-raised-danger"
                                                    wire:click="deletePermissionConfirmation({{ $permission->id }})"
                                                    data-toggle="modal" data-target="#deleteConfirmationModal"><i
                                                    class="nav-icon i-Close-Window font-weight-bold"></i></button>
                                        @endcan
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        <div class="d-flex justify-content-center">
                            {{ $permissions->links() }}
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </section>

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
                    <p>{{__('Êtes-vous sûr de vouloir supprimer cette permission ?')}}</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary"
                            data-dismiss="modal"> {{__('Annuler')}}</button>
                    <button type="button" class="btn btn-danger"
                            wire:click="deletePermissionConfirmed">{{__('Supprimer')}}</button>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
        <script>
            Livewire.on('success', () => {
                // Fermer la modal de confirmation de suppression
                $('#deleteConfirmationModal').modal('hide');
            });

            Livewire.on('close-delete-confirmation-modal', () => {
                // Fermer la modal de confirmation de suppression
                $('#deleteConfirmationModal').modal('hide');
            });
        </script>
    @endpush
</div>
