<?php namespace App\Controllers;

use App\Models\CourseModel;
use App\Models\TakeModel;

class Mahasiswa extends BaseController
{
    public function dashboard()
    {
       $pagedata = 
        [
            'title'=>'dashboard',
            'content'=>view('user/displayDashboard')
        ];

        return view('displayTemplate',$pagedata);
    }
}
