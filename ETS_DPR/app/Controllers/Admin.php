<?php namespace App\Controllers;

use App\Models\PenggunaModel;
use App\Models\AnggotaModel;
use App\Models\KomponenGajiModel;
use App\Models\PenggajianModel;

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

    // ---------------- DPR ----------------

    public function dpr()
    {
        $anggotaModel = new AnggotaModel();
        $data['anggota'] = json_encode($anggotaModel->findAll());

        $pagedata = [
            'title'=>'Daftar Anggota DPR',
            'content'=>view('admin/displayDataDPR',$data)
        ];
        return view('displayTemplate',$pagedata);
   }

   public function gaji()
   {
        $gajiModel = new KomponenGajiModel();
        $data['komponen_gaji'] = json_encode($gajiModel->findAll());

        $pagedata = [
            'title'=>'Daftar Gaji Anggota DPR',
            'content'=>view('admin/displayTunjanganGaji',$data)
        ];
        return view('displayTemplate',$pagedata);
   }
}
