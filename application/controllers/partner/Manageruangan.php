<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . '/libraries/BaseController.php';

class Manageruangan extends BaseController {
    
    public function __construct()
	{
		parent::__construct();
		//Do your magic here
        $this->load->helper('url');
        $this->load->library('form_validation','upload');
        $this->load->model('user_model', 'user');
        $this->load->model('partner/Manageruangan_model', 'manage_ruangan');
	}

    public function index()
    {
        $this->profile();

        $this->metadata->pageView = "dashboard/partner/data_ruangan";

        $this->loadViews("includes/dashboard/main", $this->global);
    }

    public function addGedung()
    {
        $user = $this->session->userdata('user');
        $user_id  = $user[0]->id_penyedia;
        
        $checkGedung = $this->manage_ruangan->getJenisGedung();
        $this->global['gedung'] = [
            'jenis_gedung' => $checkGedung
        ];

        $this->form_validation->set_rules('nmGedung', 'Nama Gedung', 'required|trim');
        $this->form_validation->set_rules('jnsGedung', 'Jenis Gedung', 'required|trim');
        $this->form_validation->set_rules('lokasi', 'Lokasi', 'required|trim');
        $this->form_validation->set_rules('kota', 'Kota', 'required|trim');
        $this->form_validation->set_rules('email', 'Email', 'required|trim');
        $this->form_validation->set_rules('noTelp', 'Nomor Telepon', 'required|trim');

        if ($this->form_validation->run() == false) {
            $this->profile();

            $this->metadata->pageView = "dashboard/partner/gedung";

            $this->loadViews("includes/dashboard/main", $this->global);
        } else {
            $nmGedung   = $this->input->post('nmGedung');
            $jnsGedung  = $this->input->post('jnsGedung');
            $lokasi     = $this->input->post('lokasi');
            $kota       = $this->input->post('kota');
            $email      = $this->input->post('email');
            $noTelp     = $this->input->post('noTelp');
            $jamBuka    = $this->input->post('jamBuka');
            $jamTutup   = $this->input->post('jamTutup');

            $getJenisGedung = $this->manage_ruangan->getinsertJenisGedung($jnsGedung);
            if (empty($getJenisGedung)) {
                $this->manage_ruangan->insertJenisGedung($jnsGedung);
            }

            $getJenisGedung = $this->manage_ruangan->getinsertJenisGedung($jnsGedung);
            $idJnsGedung    = $getJenisGedung[0]->id_jenis_gedung;
            

            $this->manage_ruangan->insertGedung($idJnsGedung, $nmGedung, $lokasi, $kota, $email, $noTelp, $user_id);

            $this->session->set_flashdata('success', 'Data gedung berhasil ditambahkan!');

            redirect('index.php/partner/manageruangan/addRuangan');
        }
    }

    public function addRuangan()
    {
        $user = $this->session->userdata('user');
        $user_id  = $user[0]->id_penyedia;
        
        $checkGedung = $this->manage_ruangan->getDataGedung_by_partner_id($user_id);
        if (empty($checkGedung[0]->nama_gedung) || $checkGedung[0]->nama_gedung == "No Data") {
            redirect('index.php/partner/manageruangan/addGedung');
        }

        $this->global['gedung'] = [
            'nm_gedung' => $checkGedung
        ];

        $this->form_validation->set_rules('nmGedung', 'Nama Gedung', 'required|trim');
        $this->form_validation->set_rules('nmRuangan', 'Nama Ruangan', 'required|trim');
        $this->form_validation->set_rules('ukuran', 'Ukuran', 'required|trim');
        $this->form_validation->set_rules('kapasitas', 'Kapasitas', 'required|trim');
        $this->form_validation->set_rules('fasilitas[]', 'Fasilitas', 'required|trim');
        $this->form_validation->set_rules('durasi[]', 'Durasi', 'required|trim');
        $this->form_validation->set_rules('hargaJam', 'Harga Jam', 'required|trim');
        $this->form_validation->set_rules('hargaHarian', 'Harga Harian', 'required|trim');
        $this->form_validation->set_rules('hargaMingguan', 'Harga Mingguan', 'required|trim');
        $this->form_validation->set_rules('hargaBulanan', 'Harga Bulanan', 'required|trim');
        $this->form_validation->set_rules('deskripsi', 'Deskripsi', 'required|trim');

        if ($this->form_validation->run() == false) {
            $this->profile();

            $this->metadata->pageView = "dashboard/partner/tambah_ruangan";

            $this->loadViews("includes/dashboard/main", $this->global);
        } else {
            $idGedung       = $this->input->post('nmGedung');
            $nmRuangan      = $this->input->post('nmRuangan');
            $ukuran         = $this->input->post('ukuran');
            $kapasitas      = $this->input->post('kapasitas');
            $hargaJam       = $this->input->post('hargaJam');
            $hargaHarian    = $this->input->post('hargaHarian');
            $hargaMingguan  = $this->input->post('hargaMingguan');
            $hargaBulanan   = $this->input->post('hargaBulanan');
            $deskripsi      = $this->input->post('deskripsi');
            $pengaktifan    = 0;
            $pemberhentian  = 1;

            $this->manage_ruangan->insertRuangan($idGedung, $nmRuangan, $ukuran, $kapasitas, $hargaJam, $hargaHarian, $hargaMingguan, $hargaBulanan, $deskripsi, $pengaktifan, $pemberhentian, $user_id);

            $getRuangan     = $this->manage_ruangan->find_idruangan_by_id($nmRuangan, $idGedung);
            $idRuangan    = $getRuangan[0]->id_ruangan;

            $cntFasilitas   = count($this->input->post('fasilitas'));

            for ($i = 0; $i < $cntFasilitas; $i++) {
                $fasilitas[$i] = $this->input->post('fasilitas['.$i.']');

                $this->manage_ruangan->insertFasilitas($fasilitas[$i], $idRuangan);
            }

            $cntdurasi   = count($this->input->post('durasi'));
            for ($i = 0; $i < $cntdurasi; $i++) {
                $durasi[$i] = $this->input->post('durasi['.$i.']');

                $this->manage_ruangan->insertdurasi($durasi[$i], $idRuangan);
            }

            $upload = $_FILES['image']['name'];
            if ($upload) {
                $numberOfFile = sizeof($upload);
                $files = $_FILES['image'];
                $config['allowed_types'] = 'png|jpg|jpeg';
                $config['max_size'] = 2048;
                $config['upload_path'] = '././assets/upload/';
                $this->load->library('upload', $config);
                
                for ($i=0; $i < $numberOfFile; $i++) {
                    $_FILES['image']['name'] = $files['name'][$i];
                    $_FILES['image']['type'] = $files['type'][$i];
                    $_FILES['image']['tmp_name'] = $files['tmp_name'][$i];
                    $_FILES['image']['error'] = $files['error'][$i];
                    $_FILES['image']['size'] = $files['size'][$i];

                    $this->upload->initialize($config);
                    if ($this->upload->do_upload('image')) {
                        $data = $this->upload->data();
                        $imagePath[$i]['image'] = $data['full_path'];
                        $fullPath = file_get_contents($data['full_path']);
                        $file_encode = base64_encode($fullPath);
                        $imageName = $data['file_name'];
                        $insertImage[$i]['image'] = $imageName;
                        $insertFullPath[$i]['image'] = $file_encode;
                        // var_dump($insertFullPath[$i]['image']);
                        // die;
                        $type[$i]['image'] = $data['file_type'];
                    }
                    $this->manage_ruangan->insertImage($insertImage[$i]['image'], $insertFullPath[$i]['image'], $type[$i]['image'], $idGedung, $idRuangan, $user_id);
                    unlink($imagePath[$i]['image']);
                }
            }

            $this->session->set_flashdata('success', 'Data ruangan berhasil ditambahkan!');

            redirect('index.php/partner/manageruangan/manage_data_ruangan');
        }
    }

    public function manage_data_ruangan()
    {
        $ruangan = $this->manage_ruangan->find_data_ruangan();

        $this->global['gedung'] = [
            'ruangan' => $ruangan
        ];
        
        $this->profile();

        $this->metadata->pageView = "dashboard/partner/data_ruangan";

        $this->loadViews("includes/dashboard/main", $this->global);
    }

    public function manage_penyewaan()
    {
        $this->profile();

        $this->metadata->pageView = "dashboard/partner/riwayat_penyewaan";

        $this->loadViews("includes/dashboard/main", $this->global);
    }

    public function nonaktif($id)
    {
        $user = $this->session->userdata('user');
        $user_id  = $user[0]->id_user;

        $pemberhentian = $this->input->post('pemberhentian');

        $this->manage_ruangan->nonaktif($pemberhentian, $id, $user_id);

        $this->session->set_flashdata('success', 'Data ruangan berhasil dinonaktifkan dari penyewaan!');

        redirect('index.php/partner/manageruangan/manage_data_ruangan');
    }

    public function edit($id, $idGedung)
    {
        $user = $this->session->userdata('user');
        $user_id  = $user[0]->id_penyedia;

        $this->form_validation->set_rules('nmRuangan', 'Nama Ruangan', 'required|trim');
        $this->form_validation->set_rules('ukuran', 'Ukuran', 'required|trim');
        $this->form_validation->set_rules('kapasitas', 'Kapasitas', 'required|trim');
        $this->form_validation->set_rules('fasilitas[]', 'Fasilitas', 'required|trim');
        $this->form_validation->set_rules('durasi[]', 'Durasi', 'required|trim');
        $this->form_validation->set_rules('hargaJam', 'Harga Jam', 'required|trim');
        $this->form_validation->set_rules('hargaHarian', 'Harga Harian', 'required|trim');
        $this->form_validation->set_rules('hargaMingguan', 'Harga Mingguan', 'required|trim');
        $this->form_validation->set_rules('hargaBulanan', 'Harga Bulanan', 'required|trim');
        $this->form_validation->set_rules('deskripsi', 'Deskripsi', 'required|trim');

        if ($this->form_validation->run() == false) {
            redirect('index.php/partner/manageruangan/manage_data_ruangan');
        } else {
            $upload = $_FILES['image']['name'];
            $nmUpload = $upload[0];
            $cntUpload = count($upload);
            
            $nmRuangan      = $this->input->post('nmRuangan');
            $ukuran         = $this->input->post('ukuran');
            $kapasitas      = $this->input->post('kapasitas');
            $hargaJam       = $this->input->post('hargaJam');
            $hargaHarian    = $this->input->post('hargaHarian');
            $hargaMingguan  = $this->input->post('hargaMingguan');
            $hargaBulanan   = $this->input->post('hargaBulanan');
            $deskripsi      = $this->input->post('deskripsi');

            $this->manage_ruangan->edit($id, $nmRuangan, $ukuran, $kapasitas, $hargaJam, $hargaHarian, $hargaMingguan, $hargaBulanan, $deskripsi, $nmUpload, $cntUpload);

            $cntFasilitas   = count($this->input->post('fasilitas'));
            for ($i = 0; $i < $cntFasilitas; $i++) {
                $fasilitas[$i] = $this->input->post('fasilitas['.$i.']');

                $this->manage_ruangan->insertFasilitas($fasilitas[$i], $id);
            }

            $cntdurasi   = count($this->input->post('durasi'));
            for ($i = 0; $i < $cntdurasi; $i++) {
                $durasi[$i] = $this->input->post('durasi['.$i.']');

                $this->manage_ruangan->insertdurasi($durasi[$i], $id);
            }

            if (count($upload) >= 1 && $upload[0] != '') {
                if ($upload) {
                    $numberOfFile = sizeof($upload);
                    $files = $_FILES['image'];
                    $config['allowed_types'] = 'png|jpg|jpeg';
                    $config['max_size'] = 2048;
                    $config['upload_path'] = '././assets/upload/';
                    $this->load->library('upload', $config);
                    
                    for ($i=0; $i < $numberOfFile; $i++) {
                        $_FILES['image']['name'] = $files['name'][$i];
                        $_FILES['image']['type'] = $files['type'][$i];
                        $_FILES['image']['tmp_name'] = $files['tmp_name'][$i];
                        $_FILES['image']['error'] = $files['error'][$i];
                        $_FILES['image']['size'] = $files['size'][$i];
    
                        $this->upload->initialize($config);
                        if ($this->upload->do_upload('image')) {
                            $data = $this->upload->data();
                            $imagePath[$i]['image'] = $data['full_path'];
                            $fullPath = file_get_contents($data['full_path']);
                            $file_encode = base64_encode($fullPath);
                            $imageName = $data['file_name'];
                            $insertImage[$i]['image'] = $imageName;
                            $insertFullPath[$i]['image'] = $file_encode;
                            $type[$i]['image'] = $data['file_type'];
                        }
                        $this->manage_ruangan->insertImage($insertImage[$i]['image'], $insertFullPath[$i]['image'], $type[$i]['image'], $idGedung, $id, $user_id);
                        unlink($imagePath[$i]['image']);
                    }
                }
            }

            $this->session->set_flashdata('success', 'Data berhasil diubah!');

            redirect('index.php/partner/manageruangan/manage_data_ruangan');
        }
    }
}