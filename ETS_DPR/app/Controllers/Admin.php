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

   public function tambahdpr()
    {
        $pagedata = [
            'title'=>'Tambah DPR',
            'content'=>view('admin/formTambahDPR')
        ];
        return view('displayTemplate',$pagedata);
    }

    public function simpantambahdpr()
    {
        $anggotaModel = new AnggotaModel();
        $anggotaModel->insert([
            'id_anggota'        => $this->request->getPost('id_anggota'),
            'nama_depan'        => $this->request->getPost('nama_depan'),
            'nama_belakang'     => $this->request->getPost('nama_belakang'),
            'gelar_depan'       => $this->request->getPost('gelar_depan') ?: null,
            'gelar_belakang'    => $this->request->getPost('gelar_belakang') ?: null,
            'jabatan'           => $this->request->getPost('jabatan') ?: null,
            'status_pernikahan' => $this->request->getPost('status_pernikahan') ?: null
        ]);
        return redirect()->to('/admin/dpr');
    }

    public function editdpr($id)
    {
        $anggotaModel = new AnggotaModel();
        $data['anggota'] = $anggotaModel->find($id);

        $pagedata = [
            'title'=>'Edit DPR',
            'content'=>view('admin/formEditDPR',$data)
        ];
        return view('displayTemplate',$pagedata);
    }

    public function updateeditdpr($id)
    {
        $anggotaModel = new AnggotaModel();
        $anggotaModel->update($id, [
            'id_anggota'        => $this->request->getPost('id_anggota'),
            'nama_depan'        => $this->request->getPost('nama_depan'),
            'nama_belakang'     => $this->request->getPost('nama_belakang'),
            'gelar_depan'       => $this->request->getPost('gelar_depan') ?: null,
            'gelar_belakang'    => $this->request->getPost('gelar_belakang') ?: null,
            'jabatan'           => $this->request->getPost('jabatan') ?: null,
            'status_pernikahan' => $this->request->getPost('status_pernikahan') ?: null
        ]);
        return redirect()->to('/admin/dpr');
    }

    public function hapusdpr($id)
    {
        $anggotaModel = new AnggotaModel();
        $anggotaModel->delete($id);
        return redirect()->to('/admin/dpr');
    }


   // ---------------- Komponen Gaji DPR ----------------
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

   public function tambahgaji()
    {
        $pagedata = [
            'title'=>'Tambah Komponen Gaji DPR',
            'content'=>view('admin/formTambahGaji')
        ];
        return view('displayTemplate',$pagedata);
    }

    public function simpantambahgaji()
    {
        $gajiModel = new KomponenGajiModel();
        $gajiModel->insert([
            'id_komponen_gaji'  => $this->request->getPost('id_komponen_gaji'),
            'nama_komponen'     => $this->request->getPost('nama_komponen'),
            'kategori'          => $this->request->getPost('kategori')?: null,
            'jabatan'           => $this->request->getPost('jabatan') ?: null,
            'nominal'           => $this->request->getPost('nominal'),
            'satuan'            => $this->request->getPost('satuan') 
        ]);
        return redirect()->to('/admin/gaji');
    }

    public function editgaji($id)
    {
        $gajiModel = new KomponenGajiModel();
        $data['gaji'] = $gajiModel->find($id);

        $pagedata = [
            'title'=>'Edit gaji',
            'content'=>view('admin/formEditGaji',$data)
        ];
        return view('displayTemplate',$pagedata);
    }

    public function updateeditgaji($id)
    {
        $gajiModel = new KomponenGajiModel();
        $gajiModel->update($id, [
            'id_komponen_gaji'  => $this->request->getPost('id_komponen_gaji'),
            'nama_komponen'     => $this->request->getPost('nama_komponen'),
            'kategori'          => $this->request->getPost('kategori')?: null,
            'jabatan'           => $this->request->getPost('jabatan') ?: null,
            'nominal'           => $this->request->getPost('nominal'),
            'satuan'            => $this->request->getPost('satuan') 
        ]);
        return redirect()->to('/admin/gaji');
    }

    public function hapusgaji($id)
    {
        $gajiModel = new KomponenGajiModel();
        $gajiModel->delete($id);
        return redirect()->to('/admin/gaji');
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
            'content' => view('admin/displayPenggajian', $data)
        ];
        return view('displayTemplate', $pagedata);
    }

    public function tambahpenggajian()
    {
        $anggotaModel = new AnggotaModel();
        $gajiModel = new KomponenGajiModel();

        $data['anggota'] = $anggotaModel->findAll();
        $data['komponen_gaji'] = $gajiModel->findAll();

        $pagedata = [
            'title'=>'Tambah penggajian DPR',
            'content'=>view('admin/formTambahPenggajian',$data)
        ];
        return view('displayTemplate',$pagedata);
    }

    public function simpantambahpenggajian()
    {
        $penggajianModel = new PenggajianModel();
        $anggotaModel = new AnggotaModel();
        $gajiModel = new KomponenGajiModel();

        $id_anggota = $this->request->getPost('id_anggota');
        $id_komponen = $this->request->getPost('id_komponen_gaji');

        // ambil data anggota & komponen
        $anggota = $anggotaModel->find($id_anggota);
        $komponen = $gajiModel->find($id_komponen);

        // Validasi jabatan
        if ($komponen['jabatan'] !== 'Semua' && $komponen['jabatan'] !== $anggota['jabatan']) {
            return redirect()->back()->with('error', 'Komponen gaji tidak sesuai jabatan anggota!');
        }

        // Validasi duplikat
        $cekDuplikat = $penggajianModel->where('id_anggota', $id_anggota)
                                    ->where('id_komponen_gaji', $id_komponen)
                                    ->first();
        if ($cekDuplikat) {
            return redirect()->back()->with('error', 'Komponen gaji sudah ditambahkan untuk anggota ini!');
        }

        // Simpan data
        $penggajianModel->insert([
            'id_anggota' => $id_anggota,
            'id_komponen_gaji' => $id_komponen
        ]);

        return redirect()->to('/admin/penggajian')->with('success', 'Data penggajian berhasil ditambahkan.');
    }

}
