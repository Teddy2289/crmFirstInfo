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
        <h4 class="card-title mb-3">{{ __('Liste des rôles et des permissions') }}</h4>

        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Role</h5>
                        @can('add-role')
                        <button class="btn btn-primary btn-rounded" wire:click="addrole">
                            <span>{{__('Créer rôle')}}</span>
                        </button>
                        @if ($form == 'addrole')
                        <form wire:submit.prevent='storerole'>
                            <div class="card">
                                <div class="card-body">
                                    <div class="mb-3">
                                        <label for="namerole" class="form-label">Name Role</label>
                                        <input type="text" class="form-control" id="namerole" name="name" wire:model='name'>
                                    </div>
                                    <div class="mb-3">
                                        @foreach ($permissions as $item)
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value="{{ $item->name }}" id="flexCheckDefault{{ $loop->index }}" wire:model='permissionselect.{{ $loop->index }}' name="permissionselect[]">
                                            <label class="form-check-label" for="flexCheckDefault{{ $loop->index }}">
                                                {{ $item->name }}
                                            </label>
                                        </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12 mt-3">
                                <button type="submit" class="btn btn-primary">Submit</button>
                                <button type="button" class="btn btn-danger" wire:click="resetall">Cancel</button>
                            </div>
                        </form>
                        @endif
                        @endcan

                        @can('edit-role')
                        @if ($form == 'editrole')
                        <form wire:submit.prevent="updaterole('{{ $getidrole }}')">
                            <div class="card">
                                <div class="card-body">
                                    <div class="mb-3">
                                        <label for="editnamerole" class="form-label">Name Role</label>
                                        <input type="text" class="form-control" id="editnamerole" name="getnamerole" wire:model='getnamerole'>
                                        @error('getnamerole')
                                        <div class="alert alert-danger" role="alert">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                    @foreach ($permissions as $item)
                                    <div class="form-check">
                                        <input wire:model='getpermissionrole' class="form-check-input" type="checkbox" value="{{ $item->name }}" id="editCheckDefault{{ $item->id }}">
                                        <label class="form-check-label" for="editCheckDefault{{ $item->id }}">
                                            {{ $item->name }}
                                        </label>
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                            <div class="col-md-12 mt-3 mb-3">
                                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#confirmationModal">Submit</button>
                                <button type="button" class="btn btn-danger" wire:click='resetall'>Cancel</button>
                            </div>

                            <!-- MODAL Edit -->
                            <div class="modal fade" id="confirmationModal" tabindex="-1" aria-labelledby="confirmationModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="confirmationModalLabel">Confirmation</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <p>Are you sure you want to submit this form?</p>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                            <button type="submit" class="btn btn-primary" onclick="document.querySelector('#editnamerole').form.submit()">Confirm</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!--End MODAL -->
                        </form>
                        @endif
                        @endcan


                        <!-- Vue Livewire -->
                        <!-- Vue Blade -->
                        <div>
                            <table class="table table-striped table-hover">
                                <thead>
                                    <tr>
                                        <th scope="col">Name</th>
                                        <th scope="col">{{ __('Guard')}}</th>
                                        <th scope="col">{{ __('Date d\'enregistrement')}}</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($roles as $item)
                                    <tr>
                                        <td>
                                            <p>{{ $item->name }}</p>
                                        <td>{{ $item->guard_name }}</td>
                                        <td>{{ $item->created_at->format('d, M Y') }}</td>
                                        </td>
                                        <td>
                                            @can('edit-role')
                                            <button type="button" class="btn btn-raised btn-rounded btn-raised-primary" wire:click="showedit('{{ $item->id }}')"><i class="nav-icon i-Pen-2 font-weight-bold"></i></button>
                                            @endcan
                                            @can('delete-role')
                                            <button type="button" class="btn btn-raised btn-rounded btn-raised-danger" wire:click="deleteRoleConfirmation({{ $item->id }})" data-toggle="modal" data-target="#deleteConfirmationModal"> <i class="nav-icon i-Close-Window font-weight-bold"></i></button>
                                            @endcan
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <div class="d-flex justify-content-center">
                                {{ $roles->links() }}
                            </div>

                            <div wire:ignore.self class="modal fade" id="deleteConfirmationModal" tabindex="-1" role="dialog" aria-labelledby="deleteConfirmationModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="deleteConfirmationModalLabel">Confirm Delete</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <p>Are you sure you want to delete this role?</p>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                            <button type="button" class="btn btn-danger" wire:click="deleteRoleConfirmed">Delete</button>
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
        </div>
    </section>
</div>
