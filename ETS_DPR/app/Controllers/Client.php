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
                anggota.gelar_depan,
                anggota.nama_depan,
                anggota.nama_belakang,
                anggota.gelar_belakang,
                anggota.jabatan,
                SUM(CASE 
                    WHEN komponen_gaji.satuan = 'Bulan' THEN komponen_gaji.nominal
                    WHEN komponen_gaji.satuan = 'Tahun' THEN komponen_gaji.nominal / 12
                    WHEN komponen_gaji.satuan = 'Periode' THEN komponen_gaji.nominal / 60
                    ELSE 0
                END) AS take_home_pay
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

    public function detailpenggajian($id)
    {
        $db = \Config\Database::connect();
        $builder = $db->table('anggota')
            ->select("
                CONCAT_WS(' ', anggota.gelar_depan, anggota.nama_depan, anggota.nama_belakang, anggota.gelar_belakang) as nama_lengkap,
                GROUP_CONCAT(komponen_gaji.nama_komponen SEPARATOR ', ') as list_komponen,
                SUM(
                    CASE 
                        WHEN komponen_gaji.satuan = 'Bulan' THEN komponen_gaji.nominal
                        WHEN komponen_gaji.satuan = 'Tahun' THEN komponen_gaji.nominal / 12
                        WHEN komponen_gaji.satuan = 'Periode' THEN komponen_gaji.nominal / 60
                        ELSE 0
                    END
                ) as take_home_pay
            ")
            ->join('penggajian', 'penggajian.id_anggota = anggota.id_anggota')
            ->join('komponen_gaji', 'komponen_gaji.id_komponen_gaji = penggajian.id_komponen_gaji')
            ->where('anggota.id_anggota', $id)
            ->groupBy('anggota.id_anggota, anggota.gelar_depan, anggota.nama_depan, anggota.nama_belakang, anggota.gelar_belakang, anggota.jabatan')
            ->get()
            ->getRowArray();

        $data['penggajian'] = $builder;

        $pagedata = [
            'title'   => 'Detail Penggajian',
            'content' => view('client/detailPenggajianDPR', $data)
        ];
        return view('displayTemplate', $pagedata);
    }

}
