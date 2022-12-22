<?php
defined('BASEPATH') or exit('No direct script access allowed');

require APPPATH . '/libraries/BaseController.php';

class Manageruangan extends BaseController
{

    public function __construct()
    {
        parent::__construct();
        //Do your magic here
        $this->load->helper('url');
        $this->load->library('form_validation', 'upload');
        $this->load->model('user_model', 'user');
        $this->load->model('partner/Manageruangan_model', 'manage_ruangan');
        $this->load->library('form_validation');
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
        $user_id  = $user[0]->id;

        $checkGedung = $this->manage_ruangan->getJenisGedung();
        $this->global['gedung'] = [
            'jenis_gedung' => $checkGedung,
            'startHour' => array_map(function ($item) {
                if ($item < 10) {
                    $startHour = "0$item";
                } else {
                    $startHour = "$item";
                }
                return $startHour;
            }, range(8, 22)),
            'endHour' => array_map(function ($item) {
                if ($item < 10) {
                    $endHour = "0$item";
                } else {
                    $endHour = "$item";
                }
                return $endHour;
            }, range(8, 22)),
        ];

        $this->form_validation->set_rules('nmGedung', 'Nama Gedung', 'required|trim');
        $this->form_validation->set_rules('jnsGedung', 'Jenis Gedung', 'required|trim');
        $this->form_validation->set_rules('lokasi', 'Lokasi', 'required|trim');
        $this->form_validation->set_rules('kota', 'Kota', 'required|trim');
        $this->form_validation->set_rules('email', 'Email', 'required|trim');
        $this->form_validation->set_rules('noTelp', 'Nomor Telepon', 'required|trim');
        $this->form_validation->set_rules('startHour', 'Jam Buka', 'required|trim');
        $this->form_validation->set_rules('endHour', 'Jam Tutup', 'required|trim');

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
            $jamBuka    = $this->input->post('startHour');
            $jamTutup   = $this->input->post('endHour');

            $getJenisGedung = $this->manage_ruangan->getinsertJenisGedung($jnsGedung);
            if (empty($getJenisGedung)) {
                $this->manage_ruangan->insertJenisGedung($jnsGedung);
            }

            $getJenisGedung = $this->manage_ruangan->getinsertJenisGedung($jnsGedung);
            $idJnsGedung    = $getJenisGedung[0]->id;

            $this->manage_ruangan->insertGedung($idJnsGedung, $nmGedung, $lokasi, $kota, $email, $noTelp, $jamBuka, $jamTutup, $user_id);

            $this->session->set_flashdata('success', 'Data gedung berhasil ditambahkan!');

            redirect('partner/manageruangan/addRuangan');
        }
    }

    public function addRuangan()
    {
        $user = $this->session->userdata('user');
        $user_id  = $user[0]->id;

        $checkGedung = $this->manage_ruangan->getDataGedung_by_partner_id($user_id);
        if (empty($checkGedung[0]->name) || $checkGedung[0]->name == "No Data") {
            redirect('partner/manageruangan/addGedung');
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
            $idRuangan    = $getRuangan->id;

            $cntFasilitas   = count($this->input->post('fasilitas'));

            for ($i = 0; $i < $cntFasilitas; $i++) {
                $fasilitas[$i] = $this->input->post('fasilitas[' . $i . ']');

                $this->manage_ruangan->insertFasilitas($fasilitas[$i], $idRuangan);
            }

            $cntdurasi   = count($this->input->post('durasi'));
            for ($i = 0; $i < $cntdurasi; $i++) {
                $durasi[$i] = $this->input->post('durasi[' . $i . ']');

                $this->manage_ruangan->insertdurasi($durasi[$i], $idRuangan);
            }

            $upload = $_FILES['image']['name'];
            if ($upload) {
                $numberOfFile = sizeof($upload);
                $checkcntImage = $this->manage_ruangan->countImage($idRuangan);
                $files = $_FILES['image'];
                for ($i = 0; $i < $numberOfFile; $i++) {
                    $_FILES['image']['name'] = $files['name'][$i];
                    $_FILES['image']['type'] = $files['type'][$i];
                    $_FILES['image']['tmp_name'] = $files['tmp_name'][$i];
                    $_FILES['image']['error'] = $files['error'][$i];
                    $_FILES['image']['size'] = $files['size'][$i];

                    $newName = $idRuangan . '-' . $upload[$i];
                    $config['file_name'] = $newName;
                    $config['allowed_types'] = 'png|jpg|jpeg';
                    $config['max_size'] = 2048;
                    $config['upload_path'] = '././assets/upload/';
                    $this->load->library('upload', $config);

                    $this->upload->initialize($config);
                    if ($this->upload->do_upload('image')) {
                        if ($checkcntImage->jml_Image == '0') {
                            if ($numberOfFile > 5) {
                                $data = $this->upload->data();
                                $imagePath[$i]['image'] = $data['full_path'];

                                unlink($imagePath[$i]['image']);
                                $this->session->set_flashdata('error', 'Mohon maaf, jumlah image yang terupload kami batasi maksimal 5 image!');
                                redirect('partner/manageruangan/addRuangan');
                            } else {
                                $data = $this->upload->data();
                                $imagePath[$i]['image'] = $data['full_path'];
                                $imageName = $idRuangan . '-' . $data['file_name'];
                                $insertImage[$i]['image'] = $imageName;
                                $this->manage_ruangan->insertImage($insertImage[$i]['image'], $imagePath[$i]['image'], $idGedung, $idRuangan, $user_id);

                                $this->session->set_flashdata('success', 'Data ruangan berhasil ditambahkan!');
                                redirect('partner/manageruangan/manage_data_ruangan');
                            }
                        } else {
                            if ($checkcntImage->jml_Image == '5') {
                            } else {
                                $data = $this->upload->data();
                                $imagePath[$i]['image'] = $data['full_path'];
                                $imageName = $idRuangan . '-' . $data['file_name'];
                                $insertImage[$i]['image'] = $imageName;
                                $this->manage_ruangan->insertImage($insertImage[$i]['image'], $imagePath[$i]['image'], $idGedung, $idRuangan, $user_id);
                            }
                            $this->session->set_flashdata('success', 'Data ruangan berhasil ditambahkan!');
                            redirect('partner/manageruangan/manage_data_ruangan');
                        }
                    }
                }
            }
        }
    }

    public function list_image($id_ruangan)
    {
        $listImg = $this->manage_ruangan->list_images($id_ruangan);

        $checkcntImage = $this->manage_ruangan->countImage($id_ruangan);
        $checkcntImage = count($checkcntImage);
        $checkcntImage = 5 - $checkcntImage;

        $this->global['list'] = [
            'image' => $listImg,
            'id_ruangan' => $id_ruangan,
            'remaining_uploads' => $checkcntImage,
        ];

        $this->profile();

        $this->metadata->pageView = "dashboard/partner/list_image";

        $this->loadViews("includes/dashboard/main", $this->global);
    }

    public function insert_or_update_image($id_ruangan)
    {
        $user = $this->session->userdata('user');
        $user_id  = $user[0]->id;

        $checkcntImage = $this->manage_ruangan->countImage($id_ruangan);
        $checkcntImage = count($checkcntImage);
        $upload = $_FILES['image']['name'];
        if ($upload) {
            $numberOfFile = sizeof($upload);
            $files = $_FILES['image'];

            if ($checkcntImage < 5) {
                if ($numberOfFile > 6) {
                    $this->session->set_flashdata('error', 'Maksimal file image yang diupload sebanyak 5 image!');
                    redirect('partner/manageruangan/list_image/' . $id_ruangan);
                } else {
                    for ($i = 0; $i < $numberOfFile; $i++) {
                        $_FILES['image']['name'] = $files['name'][$i];
                        $_FILES['image']['type'] = $files['type'][$i];
                        $_FILES['image']['tmp_name'] = $files['tmp_name'][$i];
                        $_FILES['image']['error'] = $files['error'][$i];
                        $_FILES['image']['size'] = $files['size'][$i];

                        $newName = $id_ruangan . '-' . $upload[$i];
                        $config['file_name'] = $newName;
                        $config['allowed_types'] = 'png|jpg|jpeg';
                        $config['max_size'] = 2048;
                        $config['upload_path'] = '././assets/upload/';
                        $this->load->library('upload', $config);
                        $this->upload->initialize($config);

                        if ($this->upload->do_upload('image')) {
                            $data = $this->upload->data();
                            $imagePath[$i]['image'] = $data['full_path'];
                            $imageName = $data['file_name'];
                            $insertImage[$i]['image'] = $imageName;

                            $this->manage_ruangan->insertImage($insertImage[$i]['image'], $imagePath[$i]['image'], 0, $id_ruangan, $user_id);
                            $this->session->set_flashdata('success', 'Data ruangan berhasil ditambahkan!');
                        }
                    }
                    redirect('partner/manageruangan/list_image/' . $id_ruangan);
                }
            } else {
                $this->session->set_flashdata('error', 'Mohon maaf, jumlah image yang terupload sudah memnuhi batas!');
                redirect('partner/manageruangan/list_image/' . $id_ruangan);
            }
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

        redirect('partner/manageruangan/manage_data_ruangan');
    }

    public function edit($id)
    {
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
            $this->session->set_flashdata('error', 'Data gagal diubah!');

            redirect('partner/manageruangan/manage_data_ruangan');
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
                $fasilitas[$i] = $this->input->post('fasilitas[' . $i . ']');

                $this->manage_ruangan->insertFasilitas($fasilitas[$i], $id);
            }

            $cntdurasi   = count($this->input->post('durasi'));
            for ($i = 0; $i < $cntdurasi; $i++) {
                $durasi[$i] = $this->input->post('durasi[' . $i . ']');

                $this->manage_ruangan->insertdurasi($durasi[$i], $id);
            }

            $this->session->set_flashdata('success', 'Data berhasil diubah!');

            redirect('partner/manageruangan/manage_data_ruangan');
        }
    }
}