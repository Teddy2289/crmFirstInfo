<div>
    @if($notification)
        <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4">
            <div id="notification" wire:transition.fade.out.500ms>
                @if (session()->has('message'))
                    <div class="alert alert-success" role="alert">
                        <i class="icon-info1"></i>{{ session('message')}}
                    </div>
                @endif
            </div>
            <div wire:poll.5s="hideNotification"></div>
        </div>
    @endif
    <section class="section">

        <h4 class="card-title mb-3">{{ __('Liste des techno') }}</h4>
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    @can('add-technology')
                        <button class="btn btn-primary btn-rounded mb-3" wire:click="addTechnology">
                            <span>{{__('Créer une techno')}}</span>
                        </button>
                        @if ($form == 'addTechnology')
                            <form wire:submit.prevent="storeTechnology" class="mb-3">
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
                                        </div>

                                        <div class="col-md-4">
                                            <div class="mb-3">
                                                <label for="description"
                                                       class="form-label">{{__('Description')}}</label>
                                                <textarea class="form-control" id="description" name="description"
                                                          wire:model.lazy="description"></textarea>
                                                @error('description')
                                                <div class="alert alert-danger" role="alert">
                                                    {{ $message }}
                                                </div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-12 mt-3 mb-3">
                                            <button type="submit" class="btn btn-primary" wire:loading.attr="disabled">
                                                <span wire:loading wire:target="storeTechnology"
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

                    @can('edit-technology')
                        @if ($form == 'editTechnology')
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
                                        </div>
                                        <!-- Inside the "editTechnology" form -->
                                        <div class="col-md-4">
                                            <div class="mb-3">
                                                <label for="edit_description"
                                                       class="form-label">{{__('Description')}}</label>
                                                <textarea class="form-control" id="edit_description"
                                                          name="edit_description"
                                                          wire:model.lazy="description"></textarea>
                                                @error('description')
                                                <div class="alert alert-danger" role="alert">
                                                    {{ $message }}
                                                </div>
                                                @enderror
                                            </div>
                                        </div>


                                        <div class="col-md-12 mt-3 mb-3">
                                            <button type="button" class="btn btn-primary" data-toggle="modal"
                                                    data-target="#editConfirmationModal" wire:loading.attr="disabled">
                                                <span wire:loading wire:target="updateTechnologyConfirmed"
                                                      class="spinner-border spinner-border-sm" role="status"
                                                      aria-hidden="true"></span>
                                                {{__('Enregistrer')}}</button>
                                            <button type="button" class="btn btn-danger"
                                                    wire:click='cancel'> {{__('Annuler')}}</button>
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
                                                        wire:click="updateTechnologyConfirmed">{{__('Confirmer')}}</button>
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
                        <table class="table table-striped table-hover">
                            <thead>
                            <tr>
                                <th scope="col">{{__('Nom')}}</th>
                                <th scope="col">{{__('Description')}}</th>
                                <th scope="col">{{__('created_at')}}</th>
                                <th scope="col">{{__('Action')}}</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($technologies as $technology)
                                <tr>
                                    <td>{{ $technology->name }}</td>
                                    <td>{{ $technology->description }}</td>
                                    <td>{{ $technology->created_at->format('d/m/Y H:i:s') }}</td>
                                    <td>
                                        @can('edit-technology')
                                            <button type="button" class="btn btn-raised btn-rounded btn-raised-primary"
                                                    wire:click="showEdit('{{ $technology->id }}')"><i
                                                    class="nav-icon i-Pen-2 font-weight-bold"></i></button>
                                        @endcan
                                        @can('delete-technology')
                                            <button type="button" class="btn btn-raised btn-rounded btn-raised-danger"
                                                    wire:click="deleteTechnologyConfirmation({{ $technology->id }})"
                                                    data-toggle="modal" data-target="#deleteConfirmationModal"><i
                                                    class="nav-icon i-Close-Window font-weight-bold"></i></button>
                                        @endcan
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        <div class="d-flex justify-content-center">
                            {{ $technologies->links() }}
                        </div>

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
                                        <p>{{__('Êtes-vous sûr de vouloir supprimer cette technologie ?')}}</p>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary"
                                                data-dismiss="modal"> {{__('Annuler')}}</button>
                                        <button type="button" class="btn btn-danger"
                                                wire:click="deleteTechnologyConfirmed">{{__('Supprimer')}}</button>
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
                    <!-- Fin de l'exemple de tableau par défaut -->
                </div>
            </div>
        </div>
    </section>
</div>
{{-- In work, do what you enjoy. --}}
</div>