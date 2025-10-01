<?php namespace App\Controllers;

class Client extends BaseController
{
    public function dashboard()
    {
       $pagedata = 
        [
            'title'=>'dashboard',
            'content'=>view('client/displayDashboardC')
        ];

        return view('displayTemplate',$pagedata);
    }
}
