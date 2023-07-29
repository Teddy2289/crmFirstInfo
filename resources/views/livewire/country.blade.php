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

        <h4 class="card-title mb-3">{{ __('Liste des pays') }}</h4>
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    @can('add-country')
                        <button class="btn btn-primary btn-rounded mb-3" wire:click="addCountry">
                            <span>{{__('Créer un pays')}}</span>
                        </button>
                        @if ($form == 'addCountry')
                            <form wire:submit.prevent="storeCountry" class="mb-3">
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
                                                <label for="code" class="form-label">{{__('Code')}}</label>
                                                <input type="text" class="form-control" id="code" name="code"
                                                       wire:model.lazy="code">
                                                @error('code')
                                                <div class="alert alert-danger" role="alert">
                                                    {{ $message }}
                                                </div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="mb-3">
                                                <label for="nationality"
                                                       class="form-label">{{__('Nationalité')}}</label>
                                                <input type="text" class="form-control" id="nationality"
                                                       name="nationality" wire:model.lazy="nationality">
                                                @error('nationality')
                                                <div class="alert alert-danger" role="alert">
                                                    {{ $message }}
                                                </div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-12 mt-3 mb-3">
                                            <button type="submit" class="btn btn-primary" wire:loading.attr="disabled">
                                                <span wire:loading wire:target="storeCountry"
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

                    @can('edit-country')
                        @if ($form == 'editCountry')
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
                                        <div class="col-md-4">
                                            <div class="mb-3">
                                                <label for="edit_code" class="form-label">{{__('Code')}}</label>
                                                <input type="text" class="form-control" id="edit_code" name="edit_code"
                                                       wire:model.lazy="code">
                                                @error('code')
                                                <div class="alert alert-danger" role="alert">
                                                    {{ $message }}
                                                </div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="mb-3">
                                                <label for="edit_nationality"
                                                       class="form-label">{{__('Nationalité')}}</label>
                                                <input type="text" class="form-control" id="edit_nationality"
                                                       name="edit_nationality" wire:model.lazy="nationality">
                                                @error('nationality')
                                                <div class="alert alert-danger" role="alert">
                                                    {{ $message }}
                                                </div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-12 mt-3 mb-3">
                                            <button type="button" class="btn btn-primary" data-toggle="modal"
                                                    data-target="#editConfirmationModal" wire:loading.attr="disabled">
                                                <span wire:loading wire:target="updateCountryConfirmed"
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
                                                        wire:click="updateCountryConfirmed">{{__('Confirmer')}}</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                    @endif
                @endcan

                <!-- Table -->
                    <div>
                        @if ($countries->isEmpty())
                            <div class="alert alert-info" role="alert">
                                {{ __('Aucun pays disponible.') }}
                            </div>
                        @else
                            <table class="table table-striped table-hover">
                                <thead>
                                <tr>
                                    <th scope="col">{{__('Nom')}}</th>
                                    <th scope="col">{{__('Code')}}</th>
                                    <th scope="col">{{__('Nationalité')}}</th>
                                    <th scope="col">{{__('created_at')}}</th>
                                    <th scope="col">{{__('Action')}}</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach ($countries as $country)
                                    <tr>
                                        <td>{{ $country->name }}</td>
                                        <td>{{ $country->code }}</td>
                                        <td>{{ $country->nationality }}</td>
                                        <td>{{ formatDateFr($country->created_at) }}</td>
                                        <td>
                                            @can('edit-country')
                                                <button type="button"
                                                        class="btn btn-raised btn-rounded btn-raised-primary"
                                                        wire:click="showEdit('{{ $country->id }}')">
                                                    <i class="nav-icon i-Pen-2 font-weight-bold"></i>
                                                </button>
                                            @endcan
                                            @can('delete-country')
                                                <button type="button"
                                                        class="btn btn-raised btn-rounded btn-raised-danger"
                                                        wire:click="deleteCountryConfirmation({{ $country->id }})"
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
                                {{ $countries->links() }}
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
                                    <p>{{__('Êtes-vous sûr de vouloir supprimer ce pays ?')}}</p>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary"
                                            data-dismiss="modal">{{__('Annuler')}}</button>
                                    <button type="button" class="btn btn-danger"
                                            wire:click="deleteCountryConfirmed">{{__('Supprimer')}}</button>
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

