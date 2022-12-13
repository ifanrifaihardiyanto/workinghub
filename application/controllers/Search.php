<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

require APPPATH . '/libraries/BaseController.php';

class Search extends BaseController
{

    public function __construct()
    {
        parent::__construct();
        $this->load->helper('url');
        $this->load->library('form_validation');
        $this->load->library('upload');
        $this->load->model('Search_model', 'search');
        $this->load->model('Order_model', 'order');
        $this->load->library('pagination');
    }

    public function find()
    {
        $lokasi = $this->search->find_lokasi();
        $jenis_gedung = $this->search->find_jenis_gedung();

        $this->global['search'] = [
            'lokasi' => $lokasi,
            'jenis_gedung' => $jenis_gedung
        ];

        $nmLokasi = $this->input->post('lokasi');
        $kapasitas = $this->input->post('kapasitas');
        $durasi = $this->input->post('durasi');

        $this->session->set_userdata([
            'nama_lokasi' => $nmLokasi,
            'kapasitas' => $kapasitas,
            'durasi' => $durasi
        ]);

        $this->profile();

        $this->metadata->pageView = "booking/pencarian";

        $this->loadViews("includes/booking/main", $this->global);
    }

    public function get_Ruangan()
    {
        $nmLokasi = $this->input->post('lokasi');
        $kapasitas = $this->input->post('kapasitas');
        $durasi = $this->input->post('durasi');

        if ($nmLokasi != '' || $kapasitas != '') {
            $this->session->set_userdata([
                'nama_lokasi' => $nmLokasi,
                'kapasitas' => $kapasitas,
                'durasi' => $durasi
            ]);
        } else {
            if ($this->input->post('submit')) {
                $nmLokasi = $this->input->post('lokasi');
                $kapasitas = $this->input->post('kapasitas');
                $this->session->set_userdata([
                    'nama_lokasi' => $nmLokasi,
                    'kapasitas' => $kapasitas,
                    'durasi' => $durasi
                ]);
            } else {
                $nmLokasi = $this->session->userdata('nama_lokasi');
                $kapasitas = $this->session->userdata('kapasitas');
                $durasi = $this->session->userdata('durasi');
            }
        }

        if ($kapasitas == '%' || $kapasitas == '100') {
            $kapAwal    = $kapasitas;
            $kapAkhir   = "";
        } else {
            $kapasitasExp = explode(' - ', $kapasitas);
            $kapAwal    = $kapasitasExp[0];
            $kapAkhir   = $kapasitasExp[1];
        }

        $cntResult = $this->search->count_ruangan($nmLokasi, $kapAwal, $kapAkhir, $durasi);

        $link = 'http://localhost/workinghub/search/get_Ruangan';

        $config['base_url'] = $link;
        $config['total_rows'] = $cntResult;
        $config['per_page'] = 5;

        // customize pagination
        $config['full_tag_open'] = '<nav aria-label="Page navigation example" id="pagelist"><ul class="pagination pagination-rounded justify-content-end">';
        $config['full_tag_close'] = '</ul></nav>';

        $config['first_link'] = 'First';
        $config['first_tag_open'] = '<li class="page-item">';
        $config['first_tag_close'] = '</li>';

        $config['last_link'] = 'Last';
        $config['last_tag_open'] = '<li class="page-item">';
        $config['last_tag_close'] = '</li>';

        // $config['next_link'] = '&raquo';
        $config['next_link'] = 'Selanjutnya';
        $config['next_tag_open'] = '<li class="page-item">';
        $config['next_tag_close'] = '</li>';

        // $config['prev_link'] = '&laquo';
        $config['prev_link'] = 'Sebelumnya';
        $config['prev_tag_open'] = '<li class="page-item">';
        $config['prev_tag_close'] = '</li>';

        $config['cur_tag_open'] = '<li class="page-item active"><a class="page-link" href="#">';
        $config['cur_tag_close'] = '</a></li>';

        $config['num_tag_open'] = '<li class="page-item">';
        $config['num_tag_close'] = '</li>';

        $config['attributes'] = array('class' => 'page-link');

        $this->pagination->initialize($config);

        $segment = $this->uri->segment(SEGMENT);

        $result = $this->search->find_ruangan($nmLokasi, $config['per_page'], $segment, $kapAwal, $kapAkhir, $durasi);

        // print_r($result);

        // $tersewa = $this->search->tersewa();

        $this->global['result'] = (object) [
            'ruangan' => $result
        ];

        $this->loadViews("booking/list_ruangan", $this->global);
    }

    public function detail($id, $durasi)
    {
        $result = $this->search->detail($id, $durasi);
        $reviews = $this->search->reviews($id, $durasi);
        $isInvalidDate = $this->order->tersewa($id, $durasi);

        $this->global['result'] = (object) [
            'ruangan' => $result,
            'reviews' => $reviews,
            'durasi' => $durasi,
            'id_ruangan' => $id,
            'activeOrderDate' => $isInvalidDate,
        ];

        $this->profile();

        $this->metadata->pageView = "booking/detail";

        $this->loadViews("includes/booking/main", $this->global);
    }

    public function get_RincianHarga()
    {
        $id_ruangan = $this->input->post('id_ruangan');
        $durasi = $this->input->post('durasi');

        $result = $this->search->harga($id_ruangan, $durasi);

        return $this->response(200, [
            "message" => "Successfully get witels.",
            "data" => $result
        ]);
    }

    public function pemesanan($id, $durasi)
    {
        $isLoggedIn = $this->session->userdata('isLoggedIn');
        if (!isset($isLoggedIn) || $isLoggedIn != true) {
            $this->load->view('auth/booking/login');
        } else {
            $this->form_validation->set_rules('tglSewa', 'Tanggal', 'required|trim');
            $this->form_validation->set_rules('hidejmlDurasi', 'NIK', 'required|trim');
            $this->form_validation->set_rules('hidejmlHarga', 'Nomor Telepon', 'required|trim');

            $tglSewa   = $this->input->post('tglSewa');
            $exploadTgl = explode(" - ", $tglSewa);
            $tglPenyewaan = $exploadTgl[0];
            $hidejmlDurasi  = $this->input->post('hidejmlDurasi');
            $hidejmlHarga   = $this->input->post('hidejmlHarga');
            if ($durasi == 'Minggu') {
                $jmlDiff = ($hidejmlDurasi * 7);
                $tglEndPenyewaan = date('m/d/Y', strtotime('+' . $jmlDiff . ' day'));
            } elseif ($durasi == 'Bulan') {
                $jmlDiff = ($hidejmlDurasi * 30);
                $tglEndPenyewaan = date('m/d/Y', strtotime('+' . $jmlDiff . ' day'));
            } else {
                $tglEndPenyewaan = $exploadTgl[1];
            }

            $result = $this->search->detail($id, $durasi);

            if ($this->form_validation->run() == false) {
                $this->global['result'] = (object) [
                    'ruangan' => $result,
                    'durasi' => $durasi,
                    'id_ruangan' => $id,
                    'tglPenyewaan' => $tglPenyewaan,
                    'tglEndPenyewaan' => $tglEndPenyewaan,
                    'jmlDurasi' => $hidejmlDurasi,
                    'hidejmlHarga' => $hidejmlHarga,
                ];

                $this->profile();
                $this->metadata->pageView = "booking/detail";
                $this->loadViews("includes/booking/main", $this->global);
            } else {
                $this->global['result'] = (object) [
                    'ruangan' => $result,
                    'durasi' => $durasi,
                    'id_ruangan' => $id,
                    'tglPenyewaan' => $tglPenyewaan,
                    'tglEndPenyewaan' => $tglEndPenyewaan,
                    'hidejmlDurasi' => $hidejmlDurasi,
                    'hidejmlHarga' => $hidejmlHarga,
                ];

                $this->profile();
                $this->metadata->pageView = "booking/pemesanan";
                $this->loadViews("includes/booking/main", $this->global);
            }
        }
    }

    public function konfirmasi_pemesanan()
    {
        $this->form_validation->set_rules('jmlDurasi', 'Jumlah Durasi', 'required|trim');
        $this->form_validation->set_rules('durasi', 'Durasi', 'required|trim');
        $this->form_validation->set_rules('id_ruangan', 'ID Ruangan', 'required|trim');
        $this->form_validation->set_rules('tglSekarang', 'Tanggal Sekarang', 'required|trim');
        $this->form_validation->set_rules('tglPenyewaan', 'Tanggal Penyewaan', 'required|trim');
        $this->form_validation->set_rules('tglSelesai', 'Tanggal Selesai', 'required|trim');
        $this->form_validation->set_rules('harga', 'Harga', 'required|trim');
        $this->form_validation->set_rules('nama', 'Nama', 'required|trim');
        $this->form_validation->set_rules('nmrTlp', 'Nomor Telepon', 'required|trim');
        $this->form_validation->set_rules('email', 'Email', 'required|trim');

        $jmlDurasi          = $this->input->post('jmlDurasi');
        $durasi             = $this->input->post('durasi');
        $id_ruangan         = $this->input->post('id_ruangan');
        $tglPemesanan       = $this->input->post('tglSekarang');
        $mulaiPenyewaan     = $this->input->post('tglPenyewaan');
        $selesaiPenyewaan   = $this->input->post('tglSelesai');
        $harga              = $this->input->post('harga');
        $result             = $this->search->detail($id_ruangan, $durasi);

        if ($this->form_validation->run() == false) {
            $this->global['result'] = (object) [
                'ruangan' => $result,
                'durasi' => $durasi,
                'id_ruangan' => $id_ruangan,
                'tglPenyewaan' => $mulaiPenyewaan,
                'hidejmlDurasi' => $jmlDurasi,
                'hidejmlHarga' => $harga,
            ];

            $this->profile();
            $this->metadata->pageView = "booking/pemesanan";
            $this->loadViews("includes/booking/main", $this->global);
        } else {
            $this->global['result'] = (object) [
                'ruangan' => $result,
                'durasi' => $durasi,
                'id_ruangan' => $id_ruangan,
                'jmlDurasi' => $jmlDurasi,
                'tglPemesanan' => $tglPemesanan,
                'mulaiPenyewaan' => $mulaiPenyewaan,
                'selesaiPenyewaan' => $selesaiPenyewaan,
                'hidejmlHarga' => $harga,
            ];

            $this->profile();
            $this->metadata->pageView = "booking/konfirmasi_pemesanan";
            $this->loadViews("includes/booking/main", $this->global);
        }
    }

    public function terkonfirmasi()
    {
        $user = $this->session->userdata('user');
        $this->form_validation->set_rules('jmlDurasi', 'Jumlah Durasi', 'required|trim');
        $this->form_validation->set_rules('durasi', 'Durasi', 'required|trim');
        $this->form_validation->set_rules('id_ruangan', 'ID Ruangan', 'required|trim');
        $this->form_validation->set_rules('tglSekarang', 'Tanggal Sekarang', 'required|trim');
        $this->form_validation->set_rules('tglPenyewaan', 'Tanggal Penyewaan', 'required|trim');
        $this->form_validation->set_rules('tglSelesai', 'Tanggal Selesai', 'required|trim');
        $this->form_validation->set_rules('harga', 'Harga', 'required|trim');

        $jmlDurasi          = $this->input->post('jmlDurasi');
        $durasi             = $this->input->post('durasi');
        $id_ruangan         = $this->input->post('id_ruangan');
        $tglPemesanan       = $this->input->post('tglSekarang');
        $mulaiPenyewaan     = $this->input->post('tglPenyewaan');
        $selesaiPenyewaan   = $this->input->post('tglSelesai');
        $harga              = $this->input->post('harga');

        $result             = $this->search->detail($id_ruangan, $durasi);

        if ($this->form_validation->run() == false) {
            $this->global['result'] = (object) [
                'ruangan' => $result,
                'durasi' => $durasi,
                'id_ruangan' => $id_ruangan,
                'jmlDurasi' => $jmlDurasi,
                'tglPemesanan' => $tglPemesanan,
                'mulaiPenyewaan' => $mulaiPenyewaan,
                'selesaiPenyewaan' => $selesaiPenyewaan,
                'hidejmlHarga' => $harga,
            ];

            $this->profile();

            $this->metadata->pageView = "booking/konfirmasi_pemesanan";

            $this->loadViews("includes/booking/main", $this->global);
        } else {
            $this->global['result'] = (object) [
                'ruangan' => $result,
                'durasi' => $durasi,
                'id_ruangan' => $id_ruangan,
                'jmlDurasi' => $jmlDurasi,
                'tglPemesanan' => $tglPemesanan,
                'mulaiPenyewaan' => $mulaiPenyewaan,
                'selesaiPenyewaan' => $selesaiPenyewaan,
                'hidejmlHarga' => $harga,
            ];

            $this->profile();

            $this->metadata->pageView = "booking/metode_pembayaran";

            $this->loadViews("includes/booking/main", $this->global);
        }
    }

    public function tagihan()
    {
        $user = $this->session->userdata('user');

        $nmrRekening        = $this->input->post('nmrRekening');
        $nmPemilik          = $this->input->post('nmPemilik');
        $jmlDurasi          = $this->input->post('jmlDurasi');
        $durasi             = $this->input->post('durasi');
        $id_ruangan         = $this->input->post('id_ruangan');
        $tglPemesanan       = $this->input->post('tglSekarang');
        $mulaiPenyewaan     = $this->input->post('tglPenyewaan');
        $selesaiPenyewaan   = $this->input->post('tglSelesai');
        $harga              = $this->input->post('harga');
        $metode_transfer    = $this->input->post('metode_transfer');
        $id_pemesan         = $user[0]->id_pemesan;
        $kode_pemesanan     = $this->input->post('kode_pemesanan');

        $result             = $this->search->detail($id_ruangan, $durasi);
        $id_gedung          = $result[0]->id_gedung;
        $id_penyedia        = $result[0]->id_penyedia;

        $this->search->pemesanan($kode_pemesanan, $tglPemesanan, $mulaiPenyewaan, $selesaiPenyewaan, $durasi, $jmlDurasi, $id_ruangan, $id_gedung, $id_penyedia, $id_pemesan);

        $this->search->pembayaran($kode_pemesanan, $metode_transfer, $nmPemilik, $nmrRekening, $harga);

        $pemesanan      = $this->search->selectPemesanan($kode_pemesanan);
        $id_pemesanan   = $pemesanan[0]->id_pemesanan;
        $id_pembayaran   = $pemesanan[0]->id_pembayaran;

        $this->search->insert_Transaksi($id_pemesanan, $id_ruangan, $id_gedung, $id_penyedia, $id_pemesan, $id_pembayaran);

        $this->session->set_userdata([
            'id_pemesanan'  => $id_pemesanan,
            'durasi'  => $durasi,
        ]);

        redirect('search/detail_tagihan');
    }

    public function detail_tagihan()
    {
        $id_pemesanan   = $this->session->userdata('id_pemesanan');
        $durasi         = $this->session->userdata('durasi');
        $user           = $this->session->userdata('user');
        $id_pemesan     = $user[0]->id_pemesan;

        $detail_tagihan = $this->search->detail_pemesanan($id_pemesan, $id_pemesanan, $durasi);

        $this->global['result'] = (object) [
            'tagihan' => $detail_tagihan,
        ];

        $this->profile();

        $this->metadata->pageView = "booking/tagihan";

        $this->loadViews("includes/booking/main", $this->global);
    }

    public function uploadBuktiPembayaran()
    {
        $id_pemesanan   = $this->session->userdata('id_pemesanan');
        $durasi         = $this->session->userdata('durasi');
        $user           = $this->session->userdata('user');
        $id_pemesan     = $user[0]->id_pemesan;

        $detail_tagihan = $this->search->detail_pemesanan($id_pemesan, $id_pemesanan, $durasi);
        $kode_pemesanan = $detail_tagihan[0]->kode_pemesanan;

        $upload = $_FILES['bukti_pembayaran']['name'];
        if ($upload[0] != '') {
            if ($upload) {
                $files = $_FILES['bukti_pembayaran'];
                $config['allowed_types'] = 'png|jpg|jpeg';
                $config['max_size'] = 2048;
                $config['upload_path'] = '././assets/upload/';
                $this->load->library('upload', $config);

                $_FILES['bukti_pembayaran']['name'] = $files['name'];
                $_FILES['bukti_pembayaran']['type'] = $files['type'];
                $_FILES['bukti_pembayaran']['tmp_name'] = $files['tmp_name'];
                $_FILES['bukti_pembayaran']['error'] = $files['error'];
                $_FILES['bukti_pembayaran']['size'] = $files['size'];

                $this->upload->initialize($config);
                if ($this->upload->do_upload('bukti_pembayaran')) {
                    $data = $this->upload->data();
                    $imagePath['bukti_pembayaran'] = $data['full_path'];
                    $fullPath = file_get_contents($data['full_path']);
                    $file_encode = base64_encode($fullPath);
                    $imageName = $data['file_name'];
                    $insertImage['bukti_pembayaran'] = $imageName;
                    $insertFullPath['bukti_pembayaran'] = $file_encode;
                    $type['bukti_pembayaran'] = $data['file_type'];
                }
                $this->search->addBuktiPembayaran($insertImage['bukti_pembayaran'], $insertFullPath['bukti_pembayaran'], $kode_pemesanan);
                unlink($imagePath['bukti_pembayaran']);

                $this->session->set_flashdata('success', 'Bukti pembayaran berhasil diupload!');
            }
        }

        redirect('search/detail_tagihan');
    }
}