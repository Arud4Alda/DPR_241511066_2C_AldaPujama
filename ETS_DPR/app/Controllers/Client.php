<?php namespace App\Controllers;
use App\Models\PenggunaModel;
use App\Models\AnggotaModel;
use App\Models\KomponenGajiModel;
use App\Models\PenggajianModel;

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
//dpr
    public function dpr()
    {
        $anggotaModel = new AnggotaModel();
        $data['anggota'] = json_encode($anggotaModel->findAll());

        $pagedata = [
            'title'=>'Daftar Anggota DPR',
            'content'=>view('client/displayDataAnggotaDPR',$data)
        ];
        return view('displayTemplate',$pagedata);
   }
}
