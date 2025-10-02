<?php namespace App\Controllers;

use App\Models\UserModel;

class Admin extends BaseController
{
    public function dashboard()
    {
        $pagedata = [
            'title'   => 'Dashboard Admin',
            'content' => view('admin/displayDashboard')
        ];
        return view('displayTemplate',$pagedata);
    }
}