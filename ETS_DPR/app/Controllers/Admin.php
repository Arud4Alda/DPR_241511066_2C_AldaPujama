<?php namespace App\Controllers;

use App\Models\PenggunaModel;

class Admin extends BaseController
{
    public function dashboard()
    {
        $pagedata = [
            'title'   => 'Dashboard Admin',
            'content' => view('admin/displayDashboardA')
        ];
        return view('displayTemplate',$pagedata);
    }
}
