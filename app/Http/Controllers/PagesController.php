<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PagesController extends Controller
{
    public function userPage()
    {
        return view('Admin.users.page');
    }

    public function rolePage()
    {
        return view('Admin.role.page');
    }

    public function permissionPage()
    {
        return view('Admin.permission.page');
    }

    public function companyPage()
    {
        return view('Admin.company.page');
    }

    public function clientPage()
    {
        return view('Admin.client.page');
    }

    public function employePage()
    {
        return view('Admin.employe.page');
    }

    public function technologyPage()
    {
        return view('Admin.technology.page');
    }

    public function contractPage()
    {
        return view('Admin.contract.page');
    }

    public function typeLeavePage()
    {
        return view('Admin.typeLeave.page');
    }
}
