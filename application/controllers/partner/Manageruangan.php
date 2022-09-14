<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . '/libraries/BaseController.php';

class Manageruangan extends BaseController {
    
    public function __construct()
	{
		parent::__construct();
		//Do your magic here
        $this->load->library('form_validation');
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
            $pemberhentian  = 0;

            $this->manage_ruangan->insertRuangan($idGedung, $nmRuangan, $ukuran, $kapasitas, $hargaJam, $hargaHarian, $hargaMingguan, $hargaBulanan, $deskripsi, $pengaktifan, $pemberhentian, $user_id);

            $getRuangan     = $this->manage_ruangan->find_idruangan_by_id($nmRuangan);
            $idRuangan    = $getRuangan[0]->id_ruangan;

            $cntFasilitas   = count($this->input->post('fasilitas'));

            for ($i = 0; $i < $cntFasilitas; $i++) {
                $fasilitas[$i] = $this->input->post('fasilitas['.$i.']');
                // print_r($fasilitas[$i]);

                $this->manage_ruangan->insertFasilitas($fasilitas[$i], $idRuangan);
            }

            redirect('index.php/partner/manageruangan/addRuangan');
        }
    }

    public function manage_data_ruangan()
    {
        $ruangan = $this->manage_ruangan->find_data_ruangan();
        // print_r($ruangan);

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
        $this->manage_ruangan->nonaktif($id);

        $this->session->set_flashdata('success', 'Data berhasil dihapus!');

        redirect('index.php/partner/manageruangan/manage_data_ruangan');
    }

    public function edit($id)
    {
        $this->form_validation->set_rules('nmRuangan', 'Nama Ruangan', 'required|trim');
        $this->form_validation->set_rules('ukuran', 'Ukuran', 'required|trim');
        $this->form_validation->set_rules('kapasitas', 'Kapasitas', 'required|trim');
        $this->form_validation->set_rules('fasilitas[]', 'Fasilitas', 'required|trim');
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
            $nmRuangan      = $this->input->post('nmRuangan');
            $ukuran         = $this->input->post('ukuran');
            $kapasitas      = $this->input->post('kapasitas');
            $hargaJam       = $this->input->post('hargaJam');
            $hargaHarian    = $this->input->post('hargaHarian');
            $hargaMingguan  = $this->input->post('hargaMingguan');
            $hargaBulanan   = $this->input->post('hargaBulanan');
            $deskripsi      = $this->input->post('deskripsi');

            $this->manage_ruangan->edit($id, $nmRuangan, $ukuran, $kapasitas, $hargaJam, $hargaHarian, $hargaMingguan, $hargaBulanan, $deskripsi);

            $cntFasilitas   = count($this->input->post('fasilitas'));

            for ($i = 0; $i < $cntFasilitas; $i++) {
                $fasilitas[$i] = $this->input->post('fasilitas['.$i.']');
                // print_r($fasilitas[$i]);

                $this->manage_ruangan->insertFasilitas($fasilitas[$i], $id);
            }

            $this->session->set_flashdata('success', 'Data berhasil diubah!');

            redirect('index.php/partner/manageruangan/manage_data_ruangan');
        }
    }
}