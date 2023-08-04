<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use Spatie\Permission\Models\Permission as ModelsPermission;


class Permission extends Component
{
    use WithPagination;

    public $name, $guard_name;
    public $permissionId;
    public $form = '';
    public $confirmingDelete = false;
    public $confirmingUpdate = false;
    public $notification = false;
    public $loading = false;
    public $notificationMessage;

    protected $paginationTheme = 'bootstrap';
    protected $listeners = [
        'success' => 'showNotification',
        'clearNotification' => 'clearNotification',
    ];

    public function showNotification()
    {
        $this->notification = true;
    }

    public function clearNotification()
    {
        $this->notification = false;
        $this->notificationMessage = '';
    }

    public function render()
    {
        $permissions = ModelsPermission::paginate(10);
        return view('livewire.permission', [
            'permissions' => $permissions
        ]);
    }

    public function resetAll()
    {
        $this->name = '';
        $this->guard_name = 'web'; // Par défaut, la valeur est "web"
        $this->form = '';
        $this->confirmingDelete = false;
        $this->confirmingUpdate = false;
    }

    public function addPermission()
    {
        $this->resetValidation();
        $this->reset();
        $this->form = 'addPermission';
    }

    public function storePermission()
    {
        $this->validate([
            'name' => 'required',
            'guard_name' => 'required',
        ]);

        ModelsPermission::create([
            'name' => $this->name,
            'guard_name' => $this->guard_name,
        ]);

        $this->resetAll();
        $this->notificationMessage = 'Permission ajouté avec succes.';
        $this->emit('success');
    }

    public function showEdit($permission_id)
    {
        $permission = ModelsPermission::find($permission_id);
        if ($permission) {
            $this->form = 'editPermission';
            $this->confirmingUpdate = true;
            $this->permissionId = $permission_id;
            $this->name = $permission->name;
            $this->guard_name = $permission->guard_name;
        }
    }

    public function updatePermissionConfirmed()
    {
        $this->loading = true;
        if ($this->confirmingUpdate) {
            $permission = ModelsPermission::find($this->permissionId);
            if ($permission) {
                $permission->update([
                    'name' => $this->name,
                    'guard_name' => $this->guard_name,
                ]);
                $this->resetAll();
                $this->notificationMessage = 'Permission mis à jour avec succes.';
                $this->emit('success');
                $this->confirmingUpdate = false;
                $this->loading = false;
            }
        }
    }
    public function deletePermissionConfirmed()
    {
        $permission = ModelsPermission::find($this->permissionId);
        if ($permission) {
            $permission->delete();
            $this->resetAll();
            $this->notificationMessage = 'Permission supprimé avec succes.';
            $this->emit('success');
        }
    }

    public function deletePermissionConfirmation($permission_id)
    {
        $this->permissionId = $permission_id;
        $this->confirmingDelete = true;
    }

    public function deletePermission()
    {
        $permission = ModelsPermission::find($this->permissionId);
        if ($permission) {
            $permission->delete();
            $this->resetAll();
            $this->notificationMessage = 'Permission deleted successfully.';
            $this->emit('success');
        }
    }

    public function cancel()
    {
        $this->resetAll();
    }
}
