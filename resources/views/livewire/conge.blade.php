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
        <h4 class="card-title mb-3">{{ __('Congés') }}</h4>
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    @can('add-conge')
                        <button class="btn btn-primary btn-rounded mb-3" wire:click="addConge">
                            <span>{{__('Créer un congé')}}</span>
                        </button>
                        @if ($form == 'addConge')
                            <form wire:submit.prevent="storeConge" class="mb-3">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="col-md-4">
                                                <div class="mb-3">
                                                    <label for="employe_id" class="form-label">{{__('Employe')}}<span
                                                            class="text-danger">(*)</span></label>
                                                    <select class="form-control" id="employe_id" name="employe_id"
                                                            wire:model.lazy="employe_id">
                                                        <option value="">{{__('Select Employe')}}</option>
                                                        @foreach($employes as $employe)
                                                            <option
                                                                value="{{ $employe->id }}">{{ $employe->birth_name }}</option>
                                                        @endforeach
                                                    </select>
                                                    @error('employe_id')
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
                                                    <label for="start_date" class="form-label">{{__('Start Date')}}<span
                                                            class="text-danger">(*)</span></label>
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
                                                    <label for="end_date" class="form-label">{{__('End Date')}}<span
                                                            class="text-danger">(*)</span></label>
                                                    <input type="date" class="form-control" id="end_date"
                                                           name="end_date" wire:model.lazy="end_date">
                                                    @error('end_date')
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
                                                    <label for="label" class="form-label">{{__('Type')}}<span
                                                            class="text-danger">(*)</span></label>
                                                    <input type="text" class="form-control" id="type" name="type"
                                                           wire:model.lazy="Type">
                                                    @error('Type')
                                                    <div class="alert alert-danger" role="alert">
                                                        {{ $message }}
                                                    </div>
                                                    @enderror
                                                </div>
                                            </div>
                                          <div class="row col-md-12">
                                       <div class="col-md-4">
                                    <div class="mb-3">
                                       <label for="status" class="form-label">{{__('Status')}}<span class="text-danger">(*)</span></label>
                                         <select class="form-control" id="status" name="status" wire:model.lazy="status">
                                           <option value="">{{__('Select Status')}}</option>
                                            <option value="accept">{{__('Accept')}}</option>
                                            <option value="refuser">{{__('Refuser')}}</option>
                                      </select>
                                         @error('status')
                                   <div class="alert alert-danger" role="alert">
                                        {{ $message }}
                                    </div>
                                         @enderror
                                       </div>
                                   </div>
                                </div>
                                        <div class="col-md-12 mt-3 mb-3">
                                            <button type="submit" class="btn btn-primary" wire:loading.attr="disabled">
                                                <span wire:loading wire:target="storeConge"
                                                      class="spinner-border spinner-border-sm" role="status"
                                                      aria-hidden="true"></span>
                                                {{__('Enregister')}}</button>
                                            <button type="button" class="btn btn-danger"
                                                    wire:click="cancel"> {{__('Annuler')}}</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        @endif
                    @endcan
                    {{-- Edit Conge Form --}}
                    @can('edit-conge')
                        @if ($form == 'editConge')
                            <form class="mb-3">
                                <div class="card">
                                   <div class="card-body">
    {{-- Form fields for editing a congé --}}
                             <form action="{{ route('conge.update', $conge->id) }}" method="POST">
                                 @csrf
                                @method('PUT')

                           <div class="form-group">
                             <label for="start_date">Start Date:</label>
                            <input type="date" name="start_date" id="start_date" value="{{ $conge->start_date }}" class="form-control">
                             </div>

        <div class="form-group">
            <label for="end_date">End Date:</label>
            <input type="date" name="end_date" id="end_date" value="{{ $conge->end_date }}" class="form-control">
        </div>

        <div class="form-group">
            <label for="type">Type:</label>
            <input type="text" name="type" id="type" value="{{ $conge->type }}" class="form-control">
        </div>

        <div class="form-group">
            <label for="status">Status:</label>
            <select name="status" id="status" class="form-control">
                <option value="pending" @if ($conge->status === 'pending') selected @endif>Pending</option>
                <option value="approved" @if ($conge->status === 'approved') selected @endif>Approved</option>
                <option value="rejected" @if ($conge->status === 'rejected') selected @endif>Rejected</option>
            </select>
                      </div>

                  <button type="submit" class="btn btn-primary">Update Congé</button>
                           </form>
                            </div>

                                </div>
                            </form>
                        @endif
                    @endcan

                    {{-- Conge Table --}}
                    <div>
                        <table class="table table-striped table-hover">
                            <thead>
                                <tr>
                                    <th scope="col">{{__('Employee')}}</th>
                                    <th scope="col">{{__('Start Date')}}</th>
                                    <th scope="col">{{__('End Date')}}</th>
                                    <th scope="col">{{__('Type')}}</th>
                                    <th scope="col">{{__('Status')}}</th>
                                    <th scope="col">{{__('Action')}}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($conges as $conge)
                                    <tr>
                                        <td>{{ $conge->employe->birth_name }}</td>
                                        <td>{{ formatDateFr($conge->start_date) }}</td>
                                        <td>{{ formatDateFr($conge->end_date) }}</td>
                                        <td>{{ $conge->type }}</td>
                                        <td>{{ $conge->status }}</td>
                                        <td>
                                            {{-- Edit Conge Button --}}
                                            @can('edit-conge')
                                                <button type="button" class="btn btn-raised btn-rounded btn-raised-primary"
                                                    wire:click="showEdit('{{ $conge->id }}')">
                                                    <i class="nav-icon i-Pen-2 font-weight-bold"></i>
                                                </button>
                                            @endcan

                                            {{-- Delete Conge Button --}}
                                            @can('delete-conge')
                                                <button type="button" class="btn btn-raised btn-rounded btn-raised-danger"
                                                    wire:click="deleteCongeConfirmation({{ $conge->id }})"
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
                            {{ $conges->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
