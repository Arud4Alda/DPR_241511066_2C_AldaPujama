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
}
