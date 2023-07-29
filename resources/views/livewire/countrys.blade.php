<div>
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

        <h4 class="card-title mb-3">{{ __('Liste  Countries') }}</h4>
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    @can('add-country')
                    <button class="btn btn-primary btn-rounded mb-3" wire:click="addClient">
                        <span>{{__('Crée country')}}</span>
                    </button>
                    @if ($form == 'addContry')
                    <form wire:submit.prevent="storeCountry" class="mb-3">
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
                                            <label for="code" class="form-label">{{__('code')}}</label>
                                            <input type="text" class="form-control" id="code" name="code" wire:model.lazy="code">
                                            @error('code')
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
                                            <label for="Nationality" class="form-label">{{__('Nationality')}}<span class="text-danger">(*)</span></label>
                                            <input type="text" class="form-control" id="Nationality" name="Nationality" wire:model.lazy="Nationality">
                                            @error('Nationality')
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

                    <!-- @can('edit-country')
                    @if ($form == 'editCountry')
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
                                            <label for="edit_code" class="form-label">{{__('Code')}}</label>
                                            <input type="text" class="form-control" id="edit_code" name="edit_code" wire:model.lazy="code">
                                            @error('code')
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
                                            <label for="edit_nationality" class="form-label">{{__('Nationality')}}</label>
                                            <input type="text" class="form-control" id="edit_nationality" name="edit_nationality" wire:model.lazy="nationality">
                                            @error('Nationality')
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
                    @endcan -->
                    <!-- Vue Livewire -->
                    <!-- Vue Blade -->
                    <div>
                        <table class="table table-striped table-hover">
                            <thead>
                                <tr>
                                    <th scope="col">{{__('Id')}}</th>
                                    <th scope="col">{{__('Name')}}</th>
                                    <th scope="col">{{__('Code')}}</th>
                                    <th scope="col">{{__('Nationality')}}</th>
                                    <th scope="col">{{__('created_at')}}</th>
                                    <th scope="col">{{__('Action')}}</th>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach ($countries as $country)
                                @isset($country)
                                <tr>
                                    <td>{{ $country->id ?? '' }}</td>
                                    <td>{{ $country->name ?? '' }}</td>
                                    <td>{{ $country->code ?? '' }}</td>
                                    <td>{{ $country->nationality ?? '' }}</td>
                                    <td>{{ isset($country->created_at) ? formatDateFr($country->created_at) : '' }}</td>
                                    <td>
                                        @can('edit-country')
                                        <button type="button" class="btn btn-raised btn-rounded btn-raised-primary" wire:click="showEdit('{{ $country->id }}')"><i class="nav-icon i-Pen-2 font-weight-bold"></i></button>
                                        @endcan
                                        @can('delete-country')
                                        <button type="button" class="btn btn-raised btn-rounded btn-raised-danger" wire:click="deleteCountryConfirmation({{ $country->id }})" data-toggle="modal" data-target="#deleteConfirmationModal"> <i class="nav-icon i-Close-Window font-weight-bold"></i></button>
                                        @endcan
                                    </td>
                                </tr>
                                @endisset
                            @endforeach

        </tbody>
    </table>
    <div class="d-flex justify-content-center">
        {{ $countries->links() }}
    </div>
</div>


                        <!-- Delete  Modal -->
                        <!-- <div wire:ignore.self class="modal fade" id="deleteConfirmationModal" tabindex="-1" role="dialog" aria-labelledby="deleteConfirmationModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="deleteConfirmationModalLabel">{{__('Confirm Delete')}}</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <p>{{__('Are you sure you want to delete this country?')}}</p>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal"> {{__('Annuler')}}</button>
                                        <button type="button" class="btn btn-danger" wire:click="deleteCountryConfirmed">{{__('Delete')}}</button>
                                    </div>
                                </div>
                            </div>
                        </div> -->

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
</div>
