<?php

namespace App\Http\Livewire;

use App\Models\PostEmployee as ModelsPostEmployee;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithPagination;

class PostEmploye extends Component
{

    use WithPagination;

    public $name, $role, $start_date, $end_date, $userId;
    public $form = '';
    public $confirmingDelete = false;
    public $confirmingUpdate = false;
    public $notification = false;
    public $loading = false;
    public $notificationMessage;
    public $selectedContractType;
    public $type_contrat = [];

    protected $paginationTheme = 'bootstrap';
    protected $listeners = [
        'success' => 'showNotification',
        'clearNotification' => 'clearNotification',
    ];

    public function render()
    {
        $this->type_contrat = DB::select(DB::raw('SHOW COLUMNS FROM post_employees WHERE Field = "type_contrat"'))[0]->Type;
        preg_match('/^enum\((.*)\)$/', $this->type_contrat, $matches);
        $enumValues = explode(',', $matches[1]);
        $this->type_contrat = array_map(function ($value) {
            return trim($value, "'");
        }, $enumValues);
        $postEmployees = ModelsPostEmployee::paginate(3);
        $users = User::all();
        return view('livewire.post-employe', [
            'postEmployees' => $postEmployees,
            'users' => $users
        ]);
    }

    public function resetAll()
    {
        $this->name = '';
        $this->role = '';
        $this->type_contrat = 'CDI';
        $this->start_date = '';
        $this->end_date = '';
        $this->form = '';
        $this->confirmingDelete = false;
        $this->confirmingUpdate = false;

    }

    public function showNotification()
    {
        $this->notification = true;
    }

    public function clearNotification()
    {
        $this->notification = false;
        $this->notificationMessage = '';
    }

    public function addPostEmployee()
    {
        $this->resetValidation();
        $this->reset();
        $this->form = 'addPostEmployee';
    }

    public function storePostEmployee()
    {
        $this->validate([
            'name' => 'required',
            'role' => 'required',
            'type_contrat' => 'required',
            'start_date' => 'required|date',
            'end_date' => 'nullable|date|after:start_date',
        ]);

        ModelsPostEmployee::create([
            'name' => $this->name,
            'role' => $this->role,
            'type_contrat' => $this->selectedContractType,
            'start_date' => $this->start_date,
            'end_date' => $this->end_date,
            'user_id' => $this->userId,
        ]);

        $this->resetAll();
        $this->notificationMessage = 'Poste d\'employé(e) ajouté(e) avec succes.';
        $this->emit('success');
    }

    public function showEdit($postEmployeeId)
    {
        $postEmployee = ModelsPostEmployee::find($postEmployeeId);
        if ($postEmployee) {
            $this->form = 'editPostEmployee';
            $this->confirmingUpdate = true;
            $this->postId = $postEmployeeId;
            $this->name = $postEmployee->name;
            $this->role = $postEmployee->role;
            $this->type_contrat = $postEmployee->selectedContractType;
            $this->start_date = $postEmployee->start_date;
            $this->end_date = $postEmployee->end_date;
            $this->userId = $postEmployee->user_id;
        }
    }

    public function updatePostEmployeeConfirmed()
    {
        $this->loading = true;
        if ($this->confirmingUpdate) {
            $postEmployee = ModelsPostEmployee::find($this->postId);
            if ($postEmployee) {
                $postEmployee->update([
                    'name' => $this->name,
                    'role' => $this->role,
                    'type_contrat' => $this->selectedContractType,
                    'start_date' => $this->start_date,
                    'end_date' => $this->end_date,
                    'user_id' => $this->userId,
                ]);
                $this->resetAll();
                $this->notificationMessage = 'Poste d\'employé(e) mise à jour avec succes.';
                $this->emit('success');
                $this->confirmingUpdate = false;
                $this->loading = false;
            }
        }
    }

    public function deletePostEmployeeConfirmed()
    {
        $postEmployee = ModelsPostEmployee::find($this->postId);
        if ($postEmployee) {
            $postEmployee->delete();
            $this->resetAll();
            $this->notificationMessage = 'Poste d\'employé(e) supprimé(e) avec succes.';
            $this->emit('success');
        }
    }

    public function deletePostEmployeeConfirmation($postEmployeeId)
    {
        $this->postId = $postEmployeeId;
        $this->confirmingDelete = true;
    }

    public function deletePostEmployee()
    {
        $postEmployee = ModelsPostEmployee::find($this->postId);
        if ($postEmployee) {
            $postEmployee->delete();
            $this->resetAll();
            $this->emit('success');
        }
    }

    public function cancel()
    {
        $this->resetAll();
    }
}
