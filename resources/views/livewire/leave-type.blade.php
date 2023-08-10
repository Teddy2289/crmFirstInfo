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
        <h4 class="card-title mb-3">{{ __('Liste des types de congé') }}</h4>
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    @can('add-leave-type')
                        <button class="btn btn-primary btn-rounded mb-3" wire:click="addLeaveType">
                            <span>{{__('Créer un type de congé')}}</span>
                        </button>
                        @if ($form == 'addLeaveType')
                            <!-- Form to add a new leave type -->
                            <form wire:submit.prevent="storeLeaveType" class="mb-3">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="row col-md-12">
                                            <div class="col-md-4">
                                                <div class="mb-3">
                                                    <label for="libelle" class="form-label">{{ __('Libelle') }}</label>
                                                    <input type="text" class="form-control" id="libelle" name="libelle"
                                                           wire:model.defer="libelle">
                                                    @error('libelle')
                                                    <div class="alert alert-danger" role="alert">
                                                        {{ $message }}
                                                    </div>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="mb-3">
                                                <label for="description" class="form-label">{{ __('Description') }}</label>
                                                <textarea class="form-control" id="description" name="description"
                                                          wire:model.defer="description"></textarea>
                                                @error('description')
                                                <div class="alert alert-danger" role="alert">
                                                    {{ $message }}
                                                </div>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="col-md-12 mt-3 mb-3">
                                            <button type="submit" class="btn btn-primary" wire:loading.attr="disabled">
                                                <span wire:loading wire:target="storeLeaveType" class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                                                {{ __('Enregistrer') }}
                                                </button>
                                                <button type="button" class="btn btn-danger" wire:click="cancel">{{__('Annuler')}}</button>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        @endif
                    @endcan

                    <!-- Form to edit the selected leave type -->
@can('edit-leave-type')
    @if ($form == 'editLeaveType')
        <form wire:submit.prevent="updateLeaveTypeConfirmed" class="mb-3">
            <div class="card">
                <div class="card-body">
                    <div class="row col-md-12">
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label for="libelle" class="form-label">{{ __('Libelle') }}</label>
                                <input type="text" class="form-control" id="libelle" name="libelle"
                                    wire:model.defer="libelle">
                                @error('libelle')
                                    <div class="alert alert-danger" role="alert">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="mb-3">
                            <label for="description" class="form-label">{{ __('Description') }}</label>
                            <textarea class="form-control" id="description" name="description"
                                wire:model.defer="description"></textarea>
                            @error('description')
                                <div class="alert alert-danger" role="alert">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>

                        <div class="col-md-12 mt-3 mb-3">
                                <button type="submit" class="btn btn-primary" wire:loading.attr="disabled">
                                    <span wire:loading wire:target="updateLeaveTypeConfirmed" class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                                    {{ __('Enregistrer') }}
                                </button>
                                <button type="button" class="btn btn-danger" wire:click="cancelEdit">{{ __('Annuler') }}</button>
                                 </div>  

                                </div>
                                </div>
                            </form>
                        @endif
                    @endcan

                    <div>
                        @if($leaveTypes->isEmpty())
                            <div class="alert alert-info" role="alert">
                                {{ __('Aucun type de congé disponible.') }}
                            </div>
                        @else
                            <!-- Leave type table -->
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
                                 <!-- ... (other parts of the view) ... -->
                       @foreach ($leaveTypes as $leaveType)
                            <tr>
                                <td>{{ $leaveType->Libelle }}</td>
                                <td>{{ $leaveType->description }}</td>
                                <td>{{ $leaveType->created_at->format('d/m/Y H:i:s') }}</td>
                                <td>
                                    @can('edit-leave-type')
                                        <button type="button" class="btn btn-raised btn-rounded btn-raised-primary" wire:click="showEdit('{{ $leaveType->id }}')">
                                            <i class="nav-icon i-Pen-2 font-weight-bold"></i>
                                        </button>
                                    @endcan

                                    @can('delete-leave-type')
                                        <button type="button" class="btn btn-raised btn-rounded btn-raised-danger" wire:click="deleteLeaveTypeConfirmation({{ $leaveType->id }})" data-toggle="modal" data-target="#deleteConfirmationModal">
                                            <i class="nav-icon i-Close-Window font-weight-bold"></i>
                                        </button>
                                    @endcan
                                </td>
                            </tr>
                        @endforeach

                        <!-- Delete Modal for Leave Type -->
                        @can('delete-leave-type')
                            <div wire:ignore.self class="modal fade" id="deleteConfirmationModal" tabindex="-1" role="dialog" aria-labelledby="deleteConfirmationModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="deleteConfirmationModalLabel">{{__('Confirmer la suppression')}}</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <p>{{__('Êtes-vous sûr de vouloir supprimer ce type de congé ?')}}</p>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">{{__('Annuler')}}</button>
                                            <button type="button" class="btn btn-danger" wire:click="deleteLeaveTypeConfirmed">{{__('Supprimer')}}</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endcan     
                      </tbody>
                    </table>
                @endif
                </div>
                    
                </div>
            </div>
        </div>
    </section>
