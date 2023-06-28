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
    public $confirmingDeletePermission = false;
    public $confirmingUpdatePermission = false;
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
    public function addrole()
    {
        $this->form = 'addrole';
        $this->permission = Permission::all();
    }
    public function deleteRoleConfirmation($roleId)
    {
        $this->role_id = $roleId;
        $this->confirmingDelete = true;
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

    public function deleterole(ModelsRole $id)
    {
        $this->confirmingDelete = $id;
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


    public function showedit(ModelsRole $id)
    {
        $this->form = 'editrole';
        $this->confirmingUpdate = $id;
        $this->getidrole = $id->id;
        $this->getnamerole = $id->name;
        $this->getpermissionrole = $id->getAllPermissions()->pluck('name');
    }



    public function confirmUpdate($roleId)
    {
        $this->getidrole = $roleId;
        $this->confirmingUpdate = true;
    }


    public function updateRoleConfirmed()
    {
        if ($this->confirmingUpdate) {
            $role = ModelsRole::find($this->getidrole);
            $role->update([
                'name' => $this->getnamerole,
            ]);

            $role->syncPermissions($this->getpermissionrole);

            $this->resetall();
            $this->emit('success');
        }
    }

    public function updaterole(ModelsRole $id)
    {

        $this->validate([
            'getnamerole' => 'required|alpha_dash|unique:roles,name,' . $id->id
        ]);
        $id->update([
            'name' =>  $this->getnamerole,
        ]);

        $id->syncPermissions($this->getpermissionrole);

        $this->resetall();
        $this->emit('success');
    }

    public function addpermission()
    {
        $this->form = 'addpermission';
    }

    public function storepermission()
    {
        $this->validate([
            'namepermission' => 'required|alpha_dash|unique:permissions,name'
        ]);
        Permission::create([
            'name' => $this->namepermission,
            'guard_name' => 'web'
        ]);

        $this->resetall();
        $this->emit('success');
    }

    public function deletepermission(Permission $id)
    {
        $id->delete();
        $this->resetall();
        $this->emit('success');
    }

    public function editPermission(Permission $permission)
    {
        $this->form = 'editpermission';
        $this->confirmingUpdatePermission = $permission;
        $this->idpermission = $permission->id;
        $this->namepermission = $permission->name;
    }

    public function confirmUpdatePermission($permissionId)
    {
        $this->idpermission = $permissionId;
        $this->confirmingUpdatePermission = true;
    }

    public function updatePermissionConfirmed()
    {
        if ($this->confirmingUpdatePermission) {
            $permission = Permission::find($this->idpermission);
            $permission->update([
                'name' => $this->namepermission
            ]);
            $this->resetall();
            $this->emit('success');
        }
    }

    public function cancelPermission()
    {
        $this->resetall();
    }

    public function updatepermission(Permission $id)
    {
        $this->validate([
            'namepermission' => 'required|alpha_dash|unique:permissions,name,' . $id->id
        ]);
        $id->update([
            'name' => $this->namepermission
        ]);
        $this->resetall();
        $this->emit('success');
    }

    public function deletePermissionConfirmation($permissionId)
    {
        $this->permissionId = $permissionId;
        $this->confirmingDeletePermission = true;
    }

    public function deletePermissionConfirmed()
    {
        $permission = Permission::find($this->permissionId);
        if ($permission) {
            $permission->delete();
            $this->resetall();
            $this->emit('success');
            $this->dispatchBrowserEvent('close-delete-confirmation-modal');
        }
    }

    public function cancel()
    {
        $this->resetall();
    }
}
