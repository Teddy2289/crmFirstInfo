<div>
    {{-- If your happiness depends on money, you will never be happy with yourself. --}}
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
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Utilisateurs</h5>
                        {{-- Add user --}}
                        @can('create-user')
                            <button class="btn btn-primary btn-rounded mb-3" wire:click="adduser">
                                <span wire:loading.remove wire:target="adduser">{{__('Creer un nouvel Utilisateur ')}}</span>
                            </button>
                            @if ($form == 'adduser')
                                <div class="card">
                                    <div class="card-body">
                                        <form wire:submit.prevent="store">
                                            <div class="row mb-3">
                                                <label for="name" class="col-sm-2 col-form-label">Name</label>
                                                <div class="col-sm-10">
                                                    <input type="text" class="form-control" id="name"
                                                           wire:model.defer="getusername.name">
                                                    @error('getusername.name')
                                                    <div class="text-danger">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="row mb-3">
                                                <label for="email" class="col-sm-2 col-form-label">Email</label>
                                                <div class="col-sm-10">
                                                    <input type="email" class="form-control" id="email"
                                                           wire:model.defer="getusername.email">
                                                    @error('getusername.email')
                                                    <div class="text-danger">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="row mb-3">
                                                <label for="password" class="col-sm-2 col-form-label">Password</label>
                                                <div class="col-sm-10">
                                                    <input type="password" class="form-control" id="password"
                                                           wire:model.defer="password">
                                                    @error('password')
                                                    <div class="text-danger">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="row mb-3">
                                                <label for="password_confirmation" class="col-sm-2 col-form-label">Confirm
                                                    Password</label>
                                                <div class="col-sm-10">
                                                    <input type="password" class="form-control"
                                                           id="password_confirmation"
                                                           wire:model.defer="password_confirmation">
                                                    @error('password_confirmation')
                                                    <div class="text-danger">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>

                                            <!-- Fields for user role -->
                                            @can('add-permission')
                                                <fieldset class="row mb-3">
                                                    <legend class="col-form-label col-sm-2 pt-0">Role</legend>
                                                    <div class="col-sm-10">
                                                        @foreach ($anyrole as $item)
                                                            <div class="form-check">
                                                                <input class="form-check-input" type="checkbox"
                                                                       id="role_{{ $item->id }}" value="{{ $item->id }}"
                                                                       wire:model.defer="roles">
                                                                <label class="form-check-label"
                                                                       for="role_{{ $item->id }}">
                                                                    {{ $item->name }}
                                                                </label>
                                                            </div>
                                                        @endforeach
                                                    </div>
                                                </fieldset>
                                            @endcan

                                        <!-- Fields for user permissions -->
                                            @can('givepermission-user')
                                                <fieldset class="row mb-3">
                                                    <legend class="col-form-label col-sm-2 pt-0">Permissions</legend>
                                                    <div class="col-sm-10">
                                                        @foreach ($permissions as $item)
                                                            <div class="form-check">
                                                                <input class="form-check-input" type="checkbox"
                                                                       id="permission_{{ $item->id }}"
                                                                       value="{{ $item->id }}"
                                                                       wire:model.defer="userPermissions">
                                                                <label class="form-check-label"
                                                                       for="permission_{{ $item->id }}">
                                                                    {{ $item->name }}
                                                                </label>
                                                            </div>
                                                        @endforeach
                                                    </div>
                                                </fieldset>
                                        @endcan

                                        <!-- Submit button -->
                                            <div class="row mb-3">
                                                <div class="col-sm-10">
                                                    <button type="submit"
                                                            class="btn btn-primary">{{__('Enregister')}}</button>
                                                    <button type="button" class="btn btn-danger"
                                                            wire:click="resetAll()">{{__('Annuler')}}</button>
                                                </div>
                                            </div>
                                        </form>


                                    </div>
                                </div>
                            @endif
                        @endcan

                        {{-- Edit user --}}
                        @can('edit-user')
                            @if ($form == 'edituser')
                                <div class="card">
                                    <div class="card-body">
                                        <form method="POST" wire:submit.prevent="update({{ $idedit }})">
                                            <div class="row mb-3">
                                                <label for="inputText" class="col-sm-2 col-form-label">Name</label>
                                                <div class="col-sm-10">
                                                    <input type="text" class="form-control" name="name"
                                                           wire:model.defer="getusername.name" disabled>
                                                </div>
                                            </div>
                                            <div class="row mb-3">
                                                <label for="email" class="col-sm-2 col-form-label">Email</label>
                                                <div class="col-sm-10">
                                                    <input type="email" class="form-control" id="email" name="email"
                                                           wire:model.defer="getusername.email">
                                                    @error('getusername.email')
                                                    <div class="text-danger">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="row mb-3">
                                                <label for="password" class="col-sm-2 col-form-label">Password</label>
                                                <div class="col-sm-10">
                                                    <input type="password" class="form-control" id="password"
                                                           name="password" wire:model.defer="password">
                                                    @error('password')
                                                    <div class="text-danger">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                            @can('add-permission')
                                                <fieldset class="row mb-3">
                                                    <legend class="col-form-label col-sm-2 pt-0">Role</legend>
                                                    <div class="col-sm-10">
                                                        @foreach ($anyrole as $item)
                                                            <div class="form-check">
                                                                <input class="form-check-input" type="checkbox"
                                                                       id="role_{{ $item->id }}" value="{{ $item->id }}"
                                                                       wire:model.defer="getroleuseredit">
                                                                <label class="form-check-label"
                                                                       for="role_{{ $item->id }}">
                                                                    {{ $item->name }}
                                                                </label>
                                                            </div>
                                                        @endforeach
                                                    </div>
                                                </fieldset>
                                            @endcan
                                            @can('givepermission-user')
                                                <fieldset class="row mb-3">
                                                    <legend class="col-form-label col-sm-2 pt-0">Permission</legend>
                                                    <div class="col-sm-10">
                                                        @foreach ($permissions as $item)
                                                            <div class="form-check">
                                                                <input class="form-check-input" type="checkbox"
                                                                       id="permission_{{ $item->id }}"
                                                                       value="{{ $item->id }}"
                                                                       wire:model.defer="userPermissions">
                                                                <label class="form-check-label"
                                                                       for="permission_{{ $item->id }}">
                                                                    {{ $item->name }}
                                                                </label>
                                                            </div>
                                                        @endforeach
                                                    </div>
                                                </fieldset>
                                            @endcan

                                            <div class="row mb-3">
                                                <div class="col-sm-10">
                                                    <button type="submit"
                                                            class="btn btn-primary">{{__('Enregistrer')}}</button>
                                                    <button type="button" class="btn btn-danger"
                                                            wire:click="resetAll()">{{__('Annuler')}}</button>
                                                </div>
                                            </div>

                                        </form>
                                    </div>
                                </div>
                                <!-- End General Form Elements -->
                            @endif
                        @endcan
                        <div class="mt-3">
                            <!-- Table with stripped rows -->
                            <table class="table table-striped table-hover">
                                <thead class="thead-dark">
                                <tr>
                                    <th scope="col">Name</th>
                                    <th scope="col">Email</th>
                                    <th scope="col">Role</th>
                                    <th scope="col">Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach ($users as $user)
                                    <tr>
                                        <td>{{ $user->name }}</td>
                                        <td>{{ $user->email }}</td>
                                        <td>
                                            @foreach ($user->roles as $role)
                                                <span class="badge badge-primary">{{ $role->name }}</span>
                                            @endforeach
                                        </td>
                                        <td>
                                            @can('edit-user')
                                                <button type="button"
                                                        class="btn btn-raised btn-rounded btn-raised-primary"
                                                        wire:click="edit({{ $user->id }})">
                                                    <i class="nav-icon i-Pen-2 font-weight-bold"></i>
                                                </button>
                                            @endcan
                                            @can('delete-user')
                                                <button type="button"
                                                        class="btn btn-raised btn-rounded btn-raised-danger"
                                                        wire:click="delete({{ $user->id }})">
                                                    <i class="nav-icon i-Close-Window font-weight-bold"></i>
                                                </button>
                                            @endcan
                                                <a href="{{ route('download.pdf', ['user' => $user->id]) }}" class="btn btn-raised btn-rounded btn-raised-light">
                                                    <i class="nav-icon i-File-Download"></i>
                                                </a>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>

                        <!-- Pagination -->
                        <div class="d-flex justify-content-center">
                            {{ $users->links() }}
                        </div>

                    </div><!-- end card body -->
                </div><!-- end card -->

            </div><!-- end col -->
        </div><!-- end row -->
    </section>
</div>
