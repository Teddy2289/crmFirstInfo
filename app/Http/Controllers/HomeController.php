<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $monthlyUsers = DB::table('users')
            ->select(DB::raw('MONTH(created_at) as month, COUNT(*) as count'))
            ->groupBy('month')
            ->orderBy('month')
            ->get();

        $monthlyClients = Db::table('Clients')
        ->select(DB::raw('MONTH(created_at) as month, COUNT(*) as count'))
        ->groupBy('month')
        ->orderBy('month')
        ->get();
        $userDistribution = [
                ['label' => 'Active Users', 'count' => 50],
                ['label' => 'Inactive Users', 'count' => 30],
                ['label' => 'Blocked Users', 'count' => 20],
                // Add more data as needed for the pie chart
            ];
        return view('Admin.dashboard.home',compact('monthlyUsers','monthlyClients','userDistribution'));
    }
}
