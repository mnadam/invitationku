<?php

namespace App\Controllers;

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use App\Models\UserTamuModel;


class Home extends BaseController

{

    protected $UserTamuModel;

    public function __construct()
    {
        $this->UserTamuModel = new UserTamuModel();
    }


    public function index()
    {
        return view('welcome_message');
    }

    public function admin()
    {
        return view('admin/template/v_dashboard');
    }

    public function user_tamu()
    {
        $user =  $this->UserTamuModel->findAll();

        $data = [
            'user' => $user

        ];



        return view('admin/template/v_user_tamu', $data);
    }


    public function tambah_tamu()
    {
        $user =  $this->UserTamuModel->findAll();

        $data = [
            'user' => $user

        ];



        return view('admin/template/v_tambah_tamu', $data);
    }



    public function prosesExcel()
    {

        random_string('alnum', 16);
        $file_excel = $this->request->getFile('fileexcel');
        $ext = $file_excel->getClientExtension();
        if ($ext == 'xls') {
            $render = new \PhpOffice\PhpSpreadsheet\Reader\Xls();
        } else {
            $render = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
        }
        $spreadsheet = $render->load($file_excel);

        $data = $spreadsheet->getActiveSheet()->toArray();
        foreach ($data as $x => $row) {
            if ($x == 0) {
                continue;
            }

            $id = $row[0];
            $uniq_code = $row[1];
            $nama = $row[2];
            $no_telp = $row[3];
            $alamat = $row[4];

            $user =  $this->UserTamuModel->findAll();

            $cekuser = $this->UserTamuModel->where('uniq_code', $uniq_code)->findAll();
            // $cekuser = $builder->getWhere(['uniq_code' => $uniq_code]);
            if (count($cekuser) > 0) {
                session()->setFlashdata('message', '<b style="color:red">Data Gagal di Import Uniq_code ada yang sama</b>');
            } else {

                $simpandata = [
                    'id' => $id, 'uniq_code' => random_string('alnum', 16), 'nama_tamu' => $nama, 'no_telp' => $no_telp, 'alamat' => $alamat
                ];

                $this->UserTamuModel->insert($simpandata);
                session()->setFlashdata('message', 'Berhasil import excel');
            }
        }

        return redirect()->to(base_url('tambah_tamu'));
    }


    // public function delete_all()
    // {
    //     //model initialize
    //     $this->UserTamuModel->purgeDeleted();

    //     return redirect()->to(base_url('tambah_tamu'));
    // }


    public function prosesTambahTamu()
    {

        $user =  $this->UserTamuModel->findAll();
        $id = '';
        $uniq_code = $this->request->getVar('kode_unik');
        $nama = $this->request->getVar('nama');
        $no_telp = $this->request->getVar('no_telp');
        $alamat = $this->request->getVar('alamat');

        $simpandata = [
            'id' => $id,
            'uniq_code' => $uniq_code,
            'nama_tamu' => $nama,
            'no_telp' => $no_telp,
            'alamat' => $alamat
        ];

        $this->UserTamuModel->insert($simpandata);
        session()->setFlashdata('message', 'Berhasil Disimpan');

        return redirect()->to(base_url('tambah_tamu'));
    }



    public function prosesUpdate($id)
    {

        $uniq_code = $this->request->getPost('kode_unik');
        $nama = $this->request->getPost('nama');
        $no_telp = $this->request->getPost('no_telp');
        $alamat = $this->request->getPost('alamat');

        // $simpandata = ($id, [
        //     'uniq_code' => $uniq_code,
        //     'nama_tamu' => $nama,
        //     'no_telp' => $no_telp,
        //     'alamat' => $alamat
        // ]);

        $this->UserTamuModel->update($id, [
            'uniq_code' => $uniq_code,
            'nama_tamu' => $nama,
            'no_telp' => $no_telp,
            'alamat' => $alamat
        ]);

        session()->setFlashdata('message', 'Berhasil Diedit');

        return redirect()->to(base_url('tambah_tamu'));



        // print_r($id);
        // print_r($uniq_code);
        // print_r($nama);
        // print_r($no_telp);
        // print_r($alamat);
    }

    public function prosesHapusTamu()
    {

        $id = $this->request->getPost('id');

        $this->UserTamuModel->delete($id);
        session()->setFlashdata('message', 'Berhasil Disimpan');

        return redirect()->to(base_url('tambah_tamu'));
    }
}
