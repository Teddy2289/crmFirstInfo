<?php

namespace App\Http\Livewire;

use App\Models\User;
use PDF;
use Livewire\Component;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\Hash;

class Users extends Component
{
    public $idedit, $getusername = ['name' => '', 'email' => ''], $getroleuseredit, $userPermissions = [];
    public $form = '', $anyrole = [], $roles = [];
    public $deleteId = '';
    public $permissions = [];
    public $password;
    public $password_confirmation;
    public $email;
    public $name;
    public $btnCreate = true;

    protected $listeners = [
        'success' => '$refresh'
    ];

    public function render()
    {
        $users = User::with('roles')->paginate(10);
        return view('livewire.users', compact('users'));
    }

    public function edit($id)
    {
        $finded = User::where('id', $id)->first();
        $this->form = 'edituser';
        $this->idedit = $finded->id;
        $this->getusername['name'] = $finded->name;
        $this->getusername['email'] = $finded->email;
        $this->getroleuseredit = $finded->getRoleNames()->toArray();
        $this->anyrole = Role::all();
        $this->permissions = Permission::all();
        $this->userPermissions = $finded->getAllPermissions()->pluck('id')->toArray();
    }

    public function update(User $user)
    {
        $user->syncRoles($this->getroleuseredit);
        $user->syncPermissions($this->userPermissions);
        $this->resetAll();
        $this->emit('success');
    }

    public function resetAll()
    {
        $this->anyrole = [];
        $this->form = '';
        $this->idedit = '';
        $this->getusername = ['name' => '', 'email' => '', 'password' => ''];
        $this->getroleuseredit = '';
        $this->permissions = [];
        $this->userPermissions = [];
    }

    public function adduser()
    {
        $this->form = 'adduser';
        $this->anyrole = Role::all();
        $this->permissions = Permission::all();
    }

    public function store()
    {
        $validatedData = $this->validate([
            'getusername.name' => 'required|string',
            'getusername.email' => 'required|email|unique:users,email',
            'password' => 'required|min:6|confirmed',
            'password_confirmation' => 'required',
            'roles' => 'required',
            'userPermissions' => 'nullable|array',
        ]);

        $user = User::create([
            'name' => $validatedData['getusername']['name'],
            'email' => $validatedData['getusername']['email'],
            'password' => Hash::make($validatedData['password']),
        ]);

        $user->assignRole($validatedData['roles']);

        if (isset($validatedData['userPermissions'])) {
            $permissions = Permission::whereIn('id', $validatedData['userPermissions'])->get();
            $user->givePermissionTo($permissions);
        }

        $this->resetAll();
        $this->emit('success');
    }

    public function delete(User $user)
    {
        $user->delete();
        $this->emit('success');
    }

    public function exportPDF($id)
    {
        $user = User::findOrFail($id);
        $employee = $user->employee;
        $posts = $user->posts;
        $company = null; // Define $company variable before the loop
        foreach ($user->employee as $employee) {
            $company = $employee->company;
        }
        $pdf = PDF::loadView('userPdf.user', compact('employee', 'posts', 'user', 'company'));
        $pdf->getDomPDF()->setHttpContext(
            stream_context_create([
                'ssl' => [
                    'allow_self_signed' => true,
                    'verify_peer' => false,
                    'verify_peer_name' => false,
                ]
            ])
        );
        return $pdf->download($user->name . '.pdf');
    }

}
