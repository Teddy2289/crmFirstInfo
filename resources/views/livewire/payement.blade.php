<div>
    {{-- Knowing others is intelligence; knowing yourself is true wisdom. --}}
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

        <h4 class="card-title mb-3">{{ __('Liste des payement') }}</h4>
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    @can('add-payement')
                        <button class="btn btn-primary btn-rounded mb-3" wire:click="addPayement">
                            <span>{{__('Créer un payement')}}</span>
                        </button>
                        @if ($form == 'addPayement')
                            <form wire:submit.prevent="storePayement" class="mb-3">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="row col-md-12">
                                            <div class="col-md-4">
                                                <div class="mb-3">
                                                    <label for="label" class="form-label">{{__('label')}}</label>
                                                    <input type="text" class="form-control" id="label" name="label"
                                                           wire:model.lazy="label">
                                                    @error('label')
                                                    <div class="alert alert-danger" role="alert">
                                                        {{ $message }}
                                                    </div>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-12 mt-3 mb-3">
                                            <button type="submit" class="btn btn-primary" wire:loading.attr="disabled">
                                                <span wire:loading wire:target="storePayement"
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

                    @can('edit-payement')
                        @if ($form == 'editPayement')
                            <form class="mb-3">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="row col-md-12">
                                            <div class="col-md-4">
                                                <div class="mb-3">
                                                    <label for="edit_label" class="form-label">{{__('label')}}</label>
                                                    <input type="text" class="form-control" id="edit_label"
                                                           name="edit_label" wire:model.lazy="label">
                                                    @error('label')
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
                                                <span wire:loading wire:target="updatePayementConfirmed"
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
                                                <button type="submit" class="btn btn-primary"
                                                        wire:click="updatePayementConfirmed">{{__('Confirmer')}}</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                    @endif
                @endcan

                <!-- Table -->
                    <div>
                        @if ($payements->isEmpty())
                            <div class="alert alert-info" role="alert">
                                {{ __('Aucun payement disponible.') }}
                            </div>
                        @else
                            <table class="table table-striped table-hover">
                                <thead>
                                <tr>
                                    <th scope="col">{{__('label')}}</th>
                                    <th scope="col">{{__('created_at')}}</th>
                                    <th scope="col">{{__('Action')}}</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach ($payements as $payement)
                                    <tr>
                                        <td>{{ $payement->label }}</td>
                                        <td>{{ $payement->created_at->formatLocalized('%d %B %Y') }}</td>
                                        <td>
                                            @can('edit-payement')
                                                <button type="button"
                                                        class="btn btn-raised btn-rounded btn-raised-primary"
                                                        wire:click="showEdit('{{ $payement->id }}')">
                                                    <i class="nav-icon i-Pen-2 font-weight-bold"></i>
                                                </button>
                                            @endcan
                                            @can('delete-payement')
                                                <button type="button"
                                                        class="btn btn-raised btn-rounded btn-raised-danger"
                                                        wire:click="deletePayementConfirmation({{ $payement->id }})"
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
                                {{ $payements->links() }}
                            </div>
                        @endif
                    </div>

                    <!-- Delete Modal -->
                    <div wire:ignore.self class="modal fade" id="deleteConfirmationModal" tabindex="-1" role="dialog"
                         aria-labelledby="deleteConfirmationModalLabel" aria-hidden="true">
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
                                    <p>{{__('Êtes-vous sûr de vouloir supprimer ce payement ?')}}</p>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary"
                                            data-dismiss="modal">{{__('Annuler')}}</button>
                                    <button type="button" class="btn btn-danger"
                                            wire:click="deletePayementConfirmed">{{__('Supprimer')}}</button>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </section>
</div>
</div>

</div>


</div>
