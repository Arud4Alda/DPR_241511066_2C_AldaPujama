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
        return redirect()->to('/admin/dpr')->with('success', 'Anggota berhasil diperbaharui.');
    }

    public function hapusdpr($id)
    {
        $anggotaModel = new AnggotaModel();
        $anggotaModel->delete($id);
        return redirect()->to('/admin/dpr')->with('success', 'Data anggota berhasil dihapus.');
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
        return redirect()->to('/admin/gaji')->with('success', 'KOmoponen Gaji berhasil ditambahkan.');
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
        return redirect()->to('/admin/gaji')->with('success', 'komponen gaji berhasil diperbaharui.');
    }

    public function hapusgaji($id)
    {
        $gajiModel = new KomponenGajiModel();
        $gajiModel->delete($id);
        return redirect()->to('/admin/gaji')->with('success', 'Data komponen gaji berhasil dihapus.');
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

        // Validasi komponen khusus (tunjangan keluarga)
        if ($komponen['nama_komponen'] === 'Tunjangan Istri/Suami') {
            if ($anggota['status_pernikahan'] !== 'Kawin') {
                return redirect()->back()->with('error', 'Tunjangan Istri/Suami hanya untuk anggota yang sudah Kawin!');
            }
        }

        // Validasi komponen khusus (tunjangan anak)
        if ($komponen['nama_komponen'] === 'Tunjangan Anak') {
            if ($anggota['status_pernikahan'] == 'Belum Kawin') {
                return redirect()->back()->with('error', 'Tunjangan Anak hanya untuk anggota yang sudah pernah Kawin!');
            }

            // Hitung sudah berapa kali anggota ini dapat tunjangan anak
            $jumlahTunjanganAnak = $penggajianModel->where('id_anggota', $id_anggota)
                                                ->where('id_komponen_gaji', $id_komponen)
                                                ->countAllResults();

            if ($jumlahTunjanganAnak >= 2) {
                return redirect()->back()->with('error', 'Tunjangan Anak maksimal hanya bisa 2 kali!');
            }
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
            'content' => view('admin/detailPenggajian', $data)
        ];
        return view('displayTemplate', $pagedata);
    }

    public function editpenggajian($id_anggota)
    {
        $penggajianModel = new PenggajianModel();
        $komponenModel   = new KomponenGajiModel();
        $anggotaModel    = new AnggotaModel();

        $data['anggota'] = $anggotaModel->find($id_anggota);

        $data['daftar_komponen'] = $penggajianModel
            ->select('penggajian.*, komponen_gaji.nama_komponen, komponen_gaji.kategori')
            ->join('komponen_gaji', 'komponen_gaji.id_komponen_gaji = penggajian.id_komponen_gaji')
            ->where('penggajian.id_anggota', $id_anggota)
            ->findAll();

        $data['semua_komponen'] = $komponenModel->findAll();
        if (!$data['anggota']) {
            return redirect()->to('/admin/penggajian')->with('error', 'Data anggota tidak ditemukan.');
        }
        $pagedata = [
            'title'   => 'edit Penggajian',
            'content' => view('admin/formEditPenggajian', $data)
        ];
        return view('displayTemplate', $pagedata);
    }

    public function updatepenggajian()
    {
        $penggajianModel = new PenggajianModel();

        $id_anggota         = $this->request->getPost('id_anggota');
        $id_komponen_lama   = $this->request->getPost('id_komponen_lama');
        $id_komponen_baru   = $this->request->getPost('id_komponen_baru');

        // Cek dulu kalau sudah ada komponen gaji yang sama → hindari duplikat
        $cek = $penggajianModel->where('id_anggota', $id_anggota)
                            ->where('id_komponen_gaji', $id_komponen_baru)
                            ->first();
        if ($cek) {
            return redirect()->back()->with('error', 'Komponen gaji sudah ada pada anggota ini!');
        }

        // Update data
        $penggajianModel->where([
            'id_anggota'      => $id_anggota,
            'id_komponen_gaji' => $id_komponen_lama
        ])->set([
            'id_komponen_gaji' => $id_komponen_baru
        ])->update();

        return redirect()->to('/admin/penggajian')->with('success', 'Komponen gaji berhasil diubah.');
    }

    public function hapuspenggajian($id)
    {
        $penggajianModel = new PenggajianModel();
        $penggajianModel->where('id_anggota', $id)->delete();
        return redirect()->to('/admin/penggajian')->with('success', 'Data penggajian berhasil dihapus.');
    }

}
