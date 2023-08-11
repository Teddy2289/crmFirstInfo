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
    public function countryPage()
    {
        return view('Admin.countrie.page');
    }
    public function postEmployePage()
    {
        return view('Admin.postEmploye.page');
    }

    public function invoicePage()
    {
        return view('Admin.invoice.page');
    }
    public function PayementPage()
    {
        return view('Admin.payement.page');
    }
    public function leaveRequestPage()
    {
        return view('Admin.leaveRequest.page');
    }
    
}
