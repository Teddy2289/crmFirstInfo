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

        <h4 class="card-title mb-3">{{ __('Liste des employées') }}</h4>
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    @can('add-employe')
                    <button class="btn btn-primary btn-rounded mb-3" wire:click="addEmployee">
                        <span>{{__('Créer employé')}}</span>
                    </button>
                    @if ($form == 'addEmployee')
                    <form wire:submit.prevent="storeEmployee" class="mb-3">
                        <div class="card">
                            <div class="card-body">
                                <div class="row col-md-12">
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label for="last_name" class="form-label">{{__('Nom')}}<span class="text-danger">(*)</span></label>
                                            <input type="text" class="form-control" id="last_name" name="last_name" wire:model.lazy="last_name">
                                            @error('last_name')
                                            <div class="alert alert-danger" role="alert">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label for="first_name" class="form-label">{{__('Prenom')}}<span class="text-danger">(*)</span></label>
                                            <input type="text" class="form-control" id="first_name" name="first_name" wire:model.lazy="first_name">
                                            @error('first_name')
                                            <div class="alert alert-danger" role="alert">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label for="phone_number" class="form-label">{{__('Numéro de téléphone')}}<span class="text-danger">(*)</span></label>
                                            <input type="text" class="form-control" id="phone_number" name="phone_number" wire:model.lazy="phone_number">
                                            @error('phone_number')
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
                                            <label for="address" class="form-label">{{__('Adresse')}}</label>
                                            <input type="text" class="form-control" id="address" name="address" wire:model.lazy="address">
                                            @error('address')
                                            <div class="alert alert-danger" role="alert">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label for="street_number" class="form-label">{{__('Numéro de rue')}}</label>
                                            <input type="text" class="form-control" id="street_number" name="street_number" wire:model.lazy="street_number">
                                            @error('street_number')
                                            <div class="alert alert-danger" role="alert">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label for="company_id" class="form-label">{{__('Entreprise')}}<span class="text-danger">(*)</span></label>
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
                                </div>
                                <div class="row col-md-12">
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label for="country_id" class="form-label">{{__('Pays')}}<span class="text-danger">(*)</span></label>
                                            <select class="form-control" id="country_id" name="country_id" wire:model.lazy="country_id">
                                                <option value="">{{__('Sélectionner un pays')}}</option>
                                                @foreach($countries as $country)
                                                <option value="{{ $country->id }}">{{ $country->name }}</option>
                                                @endforeach
                                            </select>
                                            @error('country_id')
                                            <div class="alert alert-danger" role="alert">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label for="user_id" class="form-label">{{__('Utilisateur')}}<span class="text-danger">(*)</span></label>
                                            <select class="form-control" id="user_id" name="user_id" wire:model.lazy="user_id">
                                                <option value="">{{__('Sélectionner un utilisateur')}}</option>
                                                @foreach($users as $user)
                                                <option value="{{ $user->id }}">{{ $user->name }}</option>
                                                @endforeach
                                            </select>
                                            @error('user_id')
                                            <div class="alert alert-danger" role="alert">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label for="social_security_number" class="form-label">{{__('Numéro de sécurité sociale')}}</label>
                                            <input type="text" class="form-control" id="social_security_number" name="social_security_number" wire:model.lazy="social_security_number">
                                            @error('social_security_number')
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
                                            <label for="city" class="form-label">{{__('Ville')}}</label>
                                            <input type="text" class="form-control" id="city" name="city" wire:model.lazy="city">
                                            @error('city')
                                            <div class="alert alert-danger" role="alert">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label for="postal_code" class="form-label">{{__('Code postal')}}</label>
                                            <input type="text" class="form-control" id="postal_code" name="postal_code" wire:model.lazy="postal_code">
                                            @error('postal_code')
                                            <div class="alert alert-danger" role="alert">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label for="birth_name" class="form-label">{{__('Nom de naissance')}}</label>
                                            <input type="text" class="form-control" id="birth_name" name="birth_name" wire:model.lazy="birth_name">
                                            @error('birth_name')
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
                                            <label for="date_of_birth" class="form-label">{{__('Date de naissance')}}</label>
                                            <input type="date" class="form-control" id="date_of_birth" name="date_of_birth" wire:model.lazy="date_of_birth">
                                            @error('date_of_birth')
                                            <div class="alert alert-danger" role="alert">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label for="birth_postal_code" class="form-label">{{__('Code postal de naissance')}}</label>
                                            <input type="text" class="form-control" id="birth_postal_code" name="birth_postal_code" wire:model.lazy="birth_postal_code">
                                            @error('birth_postal_code')
                                            <div class="alert alert-danger" role="alert">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label for="birth_city" class="form-label">{{__('Ville de naissance')}}</label>
                                            <input type="text" class="form-control" id="birth_city" name="birth_city" wire:model.lazy="birth_city">
                                            @error('birth_city')
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
                                            <label for="gender" class="form-label">{{__('Genre')}}</label>
                                            <select class="form-control" id="gender" name="gender" wire:model.lazy="gender">
                                                <option value="">{{__('Sélectionner un genre')}}</option>
                                                <option value="male">{{__('Homme')}}</option>
                                                <option value="female">{{__('Femme')}}</option>
                                            </select>
                                            @error('gender')
                                            <div class="alert alert-danger" role="alert">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label for="nationality" class="form-label">{{__('Nationalité')}}</label>
                                            <input type="text" class="form-control" id="nationality" name="nationality" wire:model.lazy="nationality">
                                            @error('nationality')
                                            <div class="alert alert-danger" role="alert">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12 mt-3 mb-3">
                                    <button type="submit" class="btn btn-primary" wire:loading.attr="disabled">
                                        <span wire:loading wire:target="storeEmployee" class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                                        {{__('Enregistrer')}}</button>
                                    <button type="button" class="btn btn-danger" wire:click="cancel">{{__('Annuler')}}</button>
                                </div>
                            </div>
                        </div>
                    </form>
                    @endif
                    @endcan


                    @can('edit-employe')
                    @if ($form == 'editEmploye')
                    <form class="mb-3">
                        <div class="card">
                            <div class="card-body">
                                <div class="row col-md-12">
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label for="last_name" class="form-label">{{__('Nom')}}<span class="text-danger">(*)</span></label>
                                            <input type="text" class="form-control" id="last_name" name="edit_last_name" wire:model.lazy="last_name">
                                            @error('last_name')
                                            <div class="alert alert-danger" role="alert">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label for="first_name" class="form-label">{{__('Prenom')}}<span class="text-danger">(*)</span></label>
                                            <input type="text" class="form-control" id="first_name" name="edit_first_name" wire:model.lazy="first_name">
                                            @error('first_name')
                                            <div class="alert alert-danger" role="alert">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label for="edit_phone_number" class="form-label">{{__('Numéro de téléphone')}}</label>
                                            <input type="text" class="form-control" id="edit_phone_number" name="edit_phone_number" wire:model.lazy="phone_number">
                                            @error('phone_number')
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
                                            <label for="edit_address" class="form-label">{{__('Adresse')}}</label>
                                            <input type="text" class="form-control" id="edit_address" name="edit_address" wire:model.lazy="address">
                                            @error('address')
                                            <div class="alert alert-danger" role="alert">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label for="edit_street_number" class="form-label">{{__('Numéro de rue')}}</label>
                                            <input type="text" class="form-control" id="edit_street_number" name="edit_street_number" wire:model.lazy="street_number">
                                            @error('street_number')
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
                                </div>
                                <div class="row col-md-12">
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label for="edit_country_id" class="form-label">{{__('Pays')}}</label>
                                            <select class="form-control" id="edit_country_id" name="edit_country_id" wire:model.lazy="country_id">
                                                <option value="">{{__('Sélectionner un pays')}}</option>
                                                @foreach($countries as $country)
                                                <option value="{{ $country->id }}">{{ $country->name }}</option>
                                                @endforeach
                                            </select>
                                            @error('country_id')
                                            <div class="alert alert-danger" role="alert">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label for="edit_user_id" class="form-label">{{__('Utilisateur')}}</label>
                                            <select class="form-control" id="edit_user_id" name="edit_user_id" wire:model.lazy="user_id">
                                                <option value="">{{__('Sélectionner un utilisateur')}}</option>
                                                @foreach($users as $user)
                                                <option value="{{ $user->id }}">{{ $user->name }}</option>
                                                @endforeach
                                            </select>
                                            @error('user_id')
                                            <div class="alert alert-danger" role="alert">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label for="edit_social_security_number" class="form-label">{{__('Numéro de sécurité sociale')}}</label>
                                            <input type="text" class="form-control" id="edit_social_security_number" name="edit_social_security_number" wire:model.lazy="social_security_number">
                                            @error('social_security_number')
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
                                            <label for="edit_city" class="form-label">{{__('Ville')}}</label>
                                            <input type="text" class="form-control" id="edit_city" name="edit_city" wire:model.lazy="city">
                                            @error('city')
                                            <div class="alert alert-danger" role="alert">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label for="edit_postal_code" class="form-label">{{__('Code postal')}}</label>
                                            <input type="text" class="form-control" id="edit_postal_code" name="edit_postal_code" wire:model.lazy="postal_code">
                                            @error('postal_code')
                                            <div class="alert alert-danger" role="alert">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label for="edit_birth_name" class="form-label">{{__('Nom de naissance')}}</label>
                                            <input type="text" class="form-control" id="edit_birth_name" name="edit_birth_name" wire:model.lazy="birth_name">
                                            @error('birth_name')
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
                                            <label for="edit_date_of_birth" class="form-label">{{__('Date de naissance')}}</label>
                                            <input type="date" class="form-control" id="edit_date_of_birth" name="edit_date_of_birth" wire:model.lazy="date_of_birth">
                                            @error('date_of_birth')
                                            <div class="alert alert-danger" role="alert">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label for="edit_birth_postal_code" class="form-label">{{__('Code postal de naissance')}}</label>
                                            <input type="text" class="form-control" id="edit_birth_postal_code" name="edit_birth_postal_code" wire:model.lazy="birth_postal_code">
                                            @error('birth_postal_code')
                                            <div class="alert alert-danger" role="alert">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label for="edit_birth_city" class="form-label">{{__('Ville de naissance')}}</label>
                                            <input type="text" class="form-control" id="edit_birth_city" name="edit_birth_city" wire:model.lazy="birth_city">
                                            @error('birth_city')
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
                                            <label for="edit_gender" class="form-label">{{__('Genre')}}</label>
                                            <select class="form-control" id="edit_gender" name="edit_gender" wire:model.lazy="gender">
                                                <option value="">{{__('Sélectionner un genre')}}</option>
                                                <option value="male">{{__('Homme')}}</option>
                                                <option value="female">{{__('Femme')}}</option>
                                            </select>
                                            @error('gender')
                                            <div class="alert alert-danger" role="alert">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label for="edit_nationality" class="form-label">{{__('Nationalité')}}</label>
                                            <input type="text" class="form-control" id="edit_nationality" name="edit_nationality" wire:model.lazy="nationality">
                                            @error('nationality')
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
                                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#editConfirmationModal" wire:loading.attr="disabled">
                                                <span wire:loading wire:target="updateEmployeConfirmed" class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
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
                                        <button type="submit" class="btn btn-primary" wire:click="updateEmployeConfirmed">{{__('Confirmer')}}</button>
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
                    @if ($employees->isEmpty())
                            <div class="alert alert-info" role="alert">
                                {{ __('Aucun employé disponible.') }}
                            </div>
                        @else
                        <table class="table table-striped table-hover">
                            <thead class="thead-dark">
                                <tr>
                                <th scope="col">{{__('Nom')}}</th>
                                    <th scope="col">{{__('Numéro de téléphone')}}</th>
                                    <th scope="col">{{__('Adresse')}}</th>
                                    <th scope="col">{{__('Entreprise')}}</th>
                                    <th scope="col">{{__('Pays')}}</th>
                                    <th scope="col">{{__('Utilisateur')}}</th>
                                    <th scope="col">{{__('Actions')}}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($employees as $employe)
                                <tr>
                                    <td>{{ $employe->first_name }}</td>
                                    <td>{{ $employe->phone_number }}</td>
                                    <td>{{ $employe->address }}</td>
                                    <td>{{ $employe->company->name }}</td>
                                    <td>{{ $employe->country->name }}</td>
                                    <td>{{ $employe->user->name }}</td>
                                    <td>
                                        @can('edit-employe')
                                        <button type="button" class="btn btn-raised btn-rounded btn-raised-primary" wire:click="showEdit('{{ $employe->id }}')"><i class="nav-icon i-Pen-2 font-weight-bold"></i></button>
                                        @endcan
                                        @can('delete-employe')
                                        <button type="button" class="btn btn-raised btn-rounded btn-raised-danger" wire:click="deleteEmployeConfirmation({{ $employe->id }})" data-toggle="modal" data-target="#deleteConfirmationModal"> <i class="nav-icon i-Close-Window font-weight-bold"></i></button>
                                        @endcan
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <div class="d-flex justify-content-center">
                            {{ $employees->links() }}
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
                                        <button type="button" class="btn btn-danger" wire:click="deleteEmployeConfirmed">{{__('Delete')}}</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- End Default Table Example -->
                </div>
            </div>
        </div>
    </section>
</div>
