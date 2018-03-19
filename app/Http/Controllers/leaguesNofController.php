<?php

namespace App\Http\Controllers;

use App\Models\League_Nof;
use Illuminate\Http\Request;
use Auth;

class leaguesNofController extends Controller
{
    //

    public function create(Request $request){
        $leagueNof = new League_Nof();
        $admin = Auth::guard('admin')->user();
        $club = $admin->club;
        $leagueNof->name = $request->input('name');
        $leagueNof->category = $request->input('category');

        $club->leaguesNof()->save($leagueNof);

        return redirect()->action('adminController@leaguesNof');
    }
}
