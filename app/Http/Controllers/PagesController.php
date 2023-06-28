<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PagesController extends Controller
{
    public function userPage(){
        return view('Admin.users.page');
    }

    public function rolePage(){
        return view('Admin.role.page');
    }

    public function permissionPage(){
        return view('Admin.permission.page');
    }
}
