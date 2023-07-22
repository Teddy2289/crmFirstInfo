<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role as ModelsRole;
use Livewire\WithPagination;

class Role extends Component
{
    use WithPagination;

    public $name, $permissionselect = [];
    public $getidrole, $getnamerole, $getpermissionrole;
    public $namepermission, $idpermission;
    public $form = '';
    public $confirmingDelete = false;
    public $confirmingUpdate = false;
    public $role_id;
    public $notification = false;

    //permission
    public $permissionId;

    protected $paginationTheme = 'bootstrap';
    protected $listeners = [
        'success' => '$refresh'
    ];

    public function render()
    {
        $role = ModelsRole::paginate(5);
        $permission = Permission::all();
        return view('livewire.role', [
            'roles' => $role,
            'permissions' => $permission,
        ]);
    }

    public function resetall()
    {
        $this->name = '';
        $this->permissionselect = '';
        $this->getidrole = '';
        $this->getnamerole = '';
        $this->getpermissionupdate = '';
        $this->namepermission = '';
        $this->idpermission = '';
        $this->form = '';
        $this->confirmingDelete = false;
        $this->confirmingUpdate = false;
    }

    public function addrole()
    {
        $this->form = 'addrole';
        $this->permission = Permission::all();
    }

    public function storerole()
    {
        $this->validate([
            'name' => 'required|unique:roles|alpha_dash',
        ]);
        $newrole = ModelsRole::create([
            'name' => $this->name,
            'guard_name' => 'web'
        ]);
        $newrole->givePermissionTo($this->permissionselect);

        $this->resetall();
        $this->emit('success');
    }

    public function showedit(ModelsRole $id)
    {
        $this->form = 'editrole';
        $this->confirmingUpdate = $id;
        $this->getidrole = $id->id;
        $this->getnamerole = $id->name;
        $this->getpermissionrole = $id->getAllPermissions()->pluck('name');
    }

    public function updaterole(ModelsRole $id)
    {

        $this->validate([
            'getnamerole' => 'required|alpha_dash|unique:roles,name,' . $id->id
        ]);
        $id->update([
            'name' => $this->getnamerole,
        ]);

        $id->syncPermissions($this->getpermissionrole);

        $this->resetall();
        $this->emit('success');
    }

    public function deleteRoleConfirmed()
    {
        $role = ModelsRole::find($this->role_id);
        if ($role) {
            $role->delete();
            $this->resetall();
            $this->emit('success');
            $this->dispatchBrowserEvent('close-delete-confirmation-modal');
        }
    }

    public function deleteRoleConfirmation($roleId)
    {
        $this->role_id = $roleId;
        $this->confirmingDelete = true;
    }

    public function cancel()
    {
        $this->resetall();
    }
}
