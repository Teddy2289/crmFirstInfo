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

        <h4 class="card-title mb-3">{{ __('Liste des facture') }}</h4>
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <button class="btn btn-primary btn-rounded mb-3" wire:click="addInvoice">
                        <span>{{__('Créer facture')}}</span>
                    </button>
                    @if ($form == 'addInvoice')
                    <form wire:submit.prevent="saveInvoice" class="mb-3">
                        <div class="card">
                            <div class="card-body">
                                <div class="card mb-4">
                                    <div class="card-header">
                                        Details facture
                                    </div>
                                    <div class="card-body">
                                        @foreach ($details as $index => $detail)
                                        <div class="col-md-12 row mb-3">
                                            <div class="col-md-3">
                                                <div class="mb-3">
                                                    <label for="date" class="form-label">{{__('label')}}<span class="text-danger">(*)</span></label>
                                                    <input type="text" class="form-control" id="label" name="label" wire:model="details.{{ $index }}.label">
                                                    @error('label')
                                                    <div class="alert alert-danger" role="alert">
                                                        {{ $message }}
                                                    </div>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="mb-3">
                                                    <label for="quantity" class="form-label">{{__('quantity')}}<span class="text-danger">(*)</span></label>
                                                    <input type="number" class="form-control" id="quantity" name="quantity" wire:model="details.{{ $index }}.quantity">
                                                    @error('quantity')
                                                    <div class="alert alert-danger" role="alert">
                                                        {{ $message }}
                                                    </div>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="mb-3">
                                                    <label for="price" class="form-label">{{__('price')}}<span class="text-danger">(*)</span></label>
                                                    <input type="number" class="form-control" id="price" name="price" wire:model="details.{{ $index }}.price">
                                                    @error('price')
                                                    <div class="alert alert-danger" role="alert">
                                                        {{ $message }}
                                                    </div>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-md-2">

                                                <!-- <label for="fee" class="form-label">{{__('fee')}}<span class="text-danger">(*)</span></label>
                                                    <input type="checkbox" class="form-control" id="fee" name="fee" wire:model="details.{{ $index }}.fee">
                                                    @error('fee')
                                                    <div class="alert alert-danger" role="alert">
                                                        {{ $message }}
                                                    </div>
                                                    @enderror -->
                                                <label class="checkbox checkbox-primary">
                                                    <input type="checkbox" id="fee" name="fee" wire:model="details.{{ $index }}.fee" value="1" wire:init="setDefaultFeeValue">
                                                    <span>{{__('fee')}}</span>
                                                    <span class="checkmark"></span>
                                                    @error('details.{{ $index }}.fee')
                                                    <div class="alert alert-danger" role="alert">
                                                        {{ $message }}
                                                    </div>
                                                    @enderror
                                                </label>



                                            </div>
                                            <div class="col-md-1">
                                                <button type="button" class="btn btn-danger " wire:click.prevent="removeDetail({{ $index }})">
                                                    <i class="nav-icon i-Close-Window "></i>
                                                </button>
                                            </div>
                                        </div>
                                        <hr>

                                        @endforeach
                                        <button class="btn btn-primary btn-rounded" wire:click.prevent="addDetail">ajout details</button>
                                    </div>
                                </div>

                                <div class="row col-md-12">
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label for="date" class="form-label">{{__('date')}}<span class="text-danger">(*)</span></label>
                                            <input type="date" class="form-control" id="date" name="date" wire:model.lazy="date">
                                            @error('date')
                                            <div class="alert alert-danger" role="alert">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label for="month" class="form-label">{{__('month')}}<span class="text-danger">(*)</span></label>
                                            <select class="form-control" id="month" name="month" wire:model.lazy="month">
                                                <option value="">Select a month</option>
                                                @foreach($monthsEn as $index => $monthName)
                                                <option value="{{ $index + 1 }}">{{ $monthName }}</option>
                                                @endforeach
                                            </select>
                                            @error('month')
                                            <div class="alert alert-danger" role="alert">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label for="year" class="form-label">{{ __('year') }}<span class="text-danger">(*)</span></label>
                                            <select class="form-control" id="year" name="year" wire:model.lazy="year">
                                                <option value="">Select a year</option>
                                                @for ($year = date('Y'); $year >= date('Y') - 100; $year--)
                                                <option value="{{ $year }}">{{ $year }}</option>
                                                @endfor
                                            </select>
                                            @error('year')
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

                                            <label for="number" class="form-label">{{ __('number') }}</label>
                                            <input type="text" class="form-control" id="number" name="number" value="{{$number}}" wire:model.lazy="number" readonly>
                                            @error('number')
                                            <div class="alert alert-danger" role="alert">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label for="day_count" class="form-label">{{__('day_count')}}</label>
                                            <input type="text" class="form-control" id="day_count" name="day_count" wire:model.lazy="day_count">
                                            @error('day_count')
                                            <div class="alert alert-danger" role="alert">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label for="payement_id" class="form-label">{{__('status')}}<span class="text-danger">(*)</span></label>
                                            <select class="form-control" id="payement_id" name="payement_id" wire:model.lazy="payement_id">
                                                <option value="">{{__('Sélectionner une status payement')}}</option>
                                                @foreach($payements as $payement)
                                                <option value="{{ $payement->id }}">{{ $payement->label }}</option>
                                                @endforeach
                                            </select>
                                            @error('payement_id')
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
                                            <label for="contract_id" class="form-label">{{__('Contract')}}<span class="text-danger">(*)</span></label>
                                            <select class="form-control" id="contract_id" name="contract_id" wire:model.lazy="contract_id">
                                                <option value="">{{__('Sélectionner un contrat')}}</option>
                                                @foreach($contracts as $contract)
                                                <option value="{{ $contract->id }}">{{ $contract->label }}</option>
                                                @endforeach
                                            </select>
                                            @error('contract_id')
                                            <div class="alert alert-danger" role="alert">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label for="note" class="form-label">{{__('note')}}</label>
                                            <input type="text" class="form-control" id="note" name="note" wire:model.lazy="note">
                                            @error('note')
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
                                            <label for="montant_ht" class="form-label">{{__('montant_ht')}}</label>
                                            <input type="text" class="form-control" id="montant_ht" name="montant_ht" wire:model.lazy="montant_ht">
                                            @error('montant_ht')
                                            <div class="alert alert-danger" role="alert">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label for="montant_ttc" class="form-label">{{__('montant_ttc')}}</label>
                                            <input type="text" class="form-control" id="montant_ttc" name="montant_ttc" wire:model.lazy="montant_ttc">
                                            @error('montant_ttc')
                                            <div class="alert alert-danger" role="alert">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label for="date_sent" class="form-label">{{__('date_sent')}}</label>
                                            <input type="date" class="form-control" id="date_sent" name="date_sent" wire:model.lazy="date_sent">
                                            @error('date_sent')
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
                                            <label for="date_paid" class="form-label">{{__('date_paid')}}</label>
                                            <input type="date" class="form-control" id="date_paid" name="date_paid" wire:model.lazy="date_paid">
                                            @error('date_paid')
                                            <div class="alert alert-danger" role="alert">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12 mt-3 mb-3">
                                    <button type="submit" class="btn btn-primary" wire:loading.attr="disabled">
                                        <span wire:loading wire:target="saveInvoice" class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                                        {{__('Enregistrer')}}</button>
                                    <button type="button" class="btn btn-danger" wire:click="cancel">{{__('Annuler')}}</button>
                                </div>
                            </div>
                        </div>
                    </form>
                    @endif
                    {{-- edit  --}}
                    @can('edit-invoice')
                    @if ($form == 'editInvoice')
                    <form class="mb-3">
                        <div class="card">
                            <div class="card-body">
                                <div class="card mb-4">
                                    <div class="card-header">
                                        Details facture
                                    </div>
                                    <div class="card-body">
                                        @foreach ($details as $index => $detail)
                                        <div class="col-md-12 row mb-3">
                                            <div class="col-md-3">
                                                <div class="mb-3">
                                                    <label for="edit_label" class="form-label">{{__('label')}}<span class="text-danger">(*)</span></label>
                                                    <input type="text" class="form-control" id="edit_label" name="edit_label" wire:model="details.{{ $index }}.label">
                                                    @error('label')
                                                    <div class="alert alert-danger" role="alert">
                                                        {{ $message }}
                                                    </div>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="mb-3">
                                                    <label for="edit_quantity" class="form-label">{{__('quantity')}}<span class="text-danger">(*)</span></label>
                                                    <input type="number" class="form-control" id="edit_quantity" name="edit_quantity" wire:model="details.{{ $index }}.quantity">
                                                    @error('quantity')
                                                    <div class="alert alert-danger" role="alert">
                                                        {{ $message }}
                                                    </div>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="mb-3">
                                                    <label for="price" class="form-label">{{__('price')}}<span class="text-danger">(*)</span></label>
                                                    <input type="number" class="form-control" id="edit_price" name="edit_price" wire:model="details.{{ $index }}.price">
                                                    @error('price')
                                                    <div class="alert alert-danger" role="alert">
                                                        {{ $message }}
                                                    </div>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-md-2">


                                                <label class="checkbox checkbox-primary">
                                                    <input type="checkbox" id="edit_fee" name="edit_fee" wire:model="details.{{ $index }}.fee" value="1" wire:init="setDefaultFeeValue">
                                                    <span>{{__('fee')}}</span>
                                                    <span class="checkmark"></span>
                                                </label>
                                                @error("details.$index.fee")
                                                <div class="alert alert-danger" role="alert">
                                                    {{ $message }}
                                                </div>
                                                @enderror
                                            </div>
                                            <div class="col-md-1">
                                                <button type="button" class="btn btn-danger " wire:click.prevent="removeDetail({{ $index }})">
                                                    <i class="nav-icon i-Close-Window "></i>
                                                </button>
                                            </div>
                                        </div>
                                        <hr>
                                        @endforeach
                                        <button class="btn btn-primary btn-rounded" wire:click.prevent="addDetail">ajout details</button>
                                    </div>
                                </div>

                                <div class="row col-md-12">
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label for="edit_date" class="form-label">{{__('date')}}<span class="text-danger">(*)</span></label>
                                            <input type="date" class="form-control" id="edit_date" name="edit_date" wire:model.lazy="date">
                                            @error('date')
                                            <div class="alert alert-danger" role="alert">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label for="edit_month" class="form-label">{{__('month')}}<span class="text-danger">(*)</span></label>
                                            <select class="form-control" id="edit_month" name="edit_month" wire:model.lazy="month">
                                                <option value="">Select a month</option>
                                                @foreach($monthsEn as $index => $monthName)
                                                <option value="{{ $index + 1 }}">{{ $monthName }}</option>
                                                @endforeach
                                            </select>
                                            @error('month')
                                            <div class="alert alert-danger" role="alert">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label for="edit_year" class="form-label">{{ __('year') }}<span class="text-danger">(*)</span></label>
                                            <select class="form-control" id="edit_year" name="edit_year" wire:model.lazy="year">
                                                <option value="">Select a year</option>
                                                @for ($year = date('Y'); $year >= date('Y') - 100; $year--)
                                                <option value="{{ $year }}">{{ $year }}</option>
                                                @endfor
                                            </select>
                                            @error('year')
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

                                            <label for="edit_number" class="form-label">{{ __('number') }}</label>
                                            <input type="text" class="form-control" id="edit_number" name="edit_number" value="{{$number}}" wire:model.lazy="number" readonly>
                                            @error('number')
                                            <div class="alert alert-danger" role="alert">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label for="edit_day_count" class="form-label">{{__('day_count')}}</label>
                                            <input type="text" class="form-control" id="edit_day_count" name="edit_day_count" wire:model.lazy="day_count">
                                            @error('day_count')
                                            <div class="alert alert-danger" role="alert">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label for="edit_payement_id" class="form-label">{{__('status')}}<span class="text-danger">(*)</span></label>
                                            <select class="form-control" id="edit_payement_id" name="edit_payement_id" wire:model.lazy="payement_id">
                                                <option value="">{{__('Sélectionner une status payement')}}</option>
                                                @foreach($payements as $payement)
                                                <option value="{{ $payement->id }}">{{ $payement->label }}</option>
                                                @endforeach
                                            </select>
                                            @error('payement_id')
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
                                            <label for="edit_contract_id" class="form-label">{{__('Contract')}}<span class="text-danger">(*)</span></label>
                                            <select class="form-control" id="edit_contract_id" name="edit_contract_id" wire:model.lazy="contract_id">
                                                <option value="">{{__('Sélectionner un contrat')}}</option>
                                                @foreach($contracts as $contract)
                                                <option value="{{ $contract->id }}">{{ $contract->label }}</option>
                                                @endforeach
                                            </select>
                                            @error('contract_id')
                                            <div class="alert alert-danger" role="alert">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label for="edit_note" class="form-label">{{__('note')}}</label>
                                            <input type="text" class="form-control" id="edit_note" name="edit_note" wire:model.lazy="note">
                                            @error('note')
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
                                            <label for="edit_montant_ht" class="form-label">{{__('montant_ht')}}</label>
                                            <input type="text" class="form-control" id="edit_montant_ht" name="edit_montant_ht" wire:model.lazy="montant_ht">
                                            @error('montant_ht')
                                            <div class="alert alert-danger" role="alert">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label for="edit_montant_ttc" class="form-label">{{__('montant_ttc')}}</label>
                                            <input type="text" class="form-control" id="edit_montant_ttc" name="edit_montant_ttc" wire:model.lazy="montant_ttc">
                                            @error('montant_ttc')
                                            <div class="alert alert-danger" role="alert">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label for="edit_date_sent" class="form-label">{{__('date_sent')}}</label>
                                            <input type="date" class="form-control" id="edit_date_sent" name="edit_date_sent" wire:model.lazy="date_sent">
                                            @error('date_sent')
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
                                            <label for="edit_date_paid" class="form-label">{{__('date_paid')}}</label>
                                            <input type="date" class="form-control" id="edit_date_paid" name="edit_date_paid" wire:model.lazy="date_paid">
                                            @error('date_paid')
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
                                                <span wire:loading wire:target="updateInvoiceConfirmed" class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
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
                                        <button type="submit" class="btn btn-danger" wire:click="updateInvoiceConfirmed">{{__('Confirmer')}}</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                    @endif
                    @endcan

                    {{-- fin edit --}}

                    <!-- Vue Livewire -->
                    <div>
                        @if ($invoices->isEmpty())
                        <div class="alert alert-info" role="alert">
                            {{ __('Aucun facture disponible.') }}
                        </div>
                        @else
                        <table class="table table-striped table-hover">
                            <thead>
                                <tr>
                                    <th scope="col">{{__('Date')}}</th>
                                    <th scope="col">{{__('Status')}}</th>
                                    <th scope="col">{{__('Contract')}}</th>
                                    <th scope="col">{{__('Montant_ttc')}}</th>
                                    <th scope="col">{{__('Date_sent')}}</th>
                                    <th scope="col">{{__('Date_paid')}}</th>
                                    <th scope="col">{{__('Action')}}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($invoices as $invoice)
                                <tr>
                                    <td>{{ \App\Helpers\Date::formatDateFr($invoice->date) }}</td>
                                    <td>{{ $invoice->statusPayement->label }}</td>
                                    <td>{{ $invoice->contract->label }}</td>
                                    <td>{{ number_format($invoice->montant_ttc, 2, '.', ',') }} $</td>
                                    <td>{{ \App\Helpers\Date::formatDateFr($invoice->date_sent) }}</td>
                                    <td>{{ \App\Helpers\Date::formatDateFr($invoice->date_paid) }}</td>
                                    <td>
                                        @can('edit-invoice')
                                        <button type="button" class="btn btn-raised btn-rounded btn-raised-primary" wire:click="showEdit('{{ $invoice->id }}')">
                                            <i class="nav-icon i-Pen-2 font-weight-bold"></i>
                                        </button>
                                        @endcan
                                        @can('delete-invoice')
                                        <button type="button" class="btn btn-raised btn-rounded btn-raised-danger" wire:click="deleteInvoiceConfirmation({{ $invoice->id }})" data-toggle="modal" data-target="#deleteConfirmationModal">
                                            <i class="nav-icon i-Close-Window font-weight-bold"></i>
                                        </button>
                                        @endcan
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <div class="d-flex justify-content-center">
                            {{ $invoices->links() }}
                        </div>
                        @endif
                        <div wire:ignore.self class="modal fade" id="deleteConfirmationModal" tabindex="-1" role="dialog" aria-labelledby="deleteConfirmationModalLabel" aria-hidden="true">
                            <!-- Modal content here -->
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="deleteConfirmationModalLabel">{{__('Confirm Delete')}}</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                            <!-- ... -->
                                    </div>
                                    <div>
                                        <div class="modal-body">
                                            <p>{{__('Are you sure you want to delete this employee?')}}</p>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal"> {{__('Cancel')}}</button>
                                        <button type="button" class="btn btn-danger" wire:click="deleteInvoiceConfirmed">{{__('Delete')}}</button>

                                    </div>
                                </div>
                            </div>
                            <!-- End Default Table Example -->
                        </div>
                    </div>
                </div>
    </section>
</div>