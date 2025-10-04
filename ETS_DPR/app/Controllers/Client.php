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

   // ---------------- Penggajian DPR ----------------
   public function penggajian()
{
    $db = \Config\Database::connect();

    $builder = $db->table('anggota')
        ->select("
            anggota.id_anggota,
            CONCAT_WS(' ', anggota.gelar_depan, anggota.nama_depan, anggota.nama_belakang, anggota.gelar_belakang) AS nama_lengkap,
            anggota.jabatan,
            SUM(komponen_gaji.nominal) AS take_home_pay
        ")
        ->join('penggajian', 'penggajian.id_anggota = anggota.id_anggota')
        ->join('komponen_gaji', 'komponen_gaji.id_komponen_gaji = penggajian.id_komponen_gaji')
        ->groupBy('anggota.id_anggota, anggota.gelar_depan, anggota.nama_depan, anggota.nama_belakang, anggota.gelar_belakang, anggota.jabatan');

     $data['penggajian'] = json_encode($builder->get()->getResultArray());

    $pagedata = [
        'title'   => 'Daftar Penggajian',
        'content' => view('client/displayPenggajianDPR', $data)
    ];
    return view('displayTemplate', $pagedata);
}

}
