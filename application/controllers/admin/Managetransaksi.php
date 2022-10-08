<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . '/libraries/BaseController.php';

class Managetransaksi extends BaseController {
    
    public function __construct()
	{
		parent::__construct();
		//Do your magic here
        $this->load->model('Auth_model', 'auth');
        $this->load->library('form_validation');
        $this->load->model('user_model', 'user');
        $this->load->model('admin/Managetransaksi_model', 'manage_transaksi');
	}

    public function data_penyewaan()
    {
        $data_penyewaan = $this->manage_transaksi->data_penyewaan_on_admin();

        $this->global['penyewaan'] = [
            'data_penyewaan' => $data_penyewaan
        ];

        $this->profile();

        $this->metadata->pageView = "dashboard/admin/data_penyewaan";

        $this->loadViews("includes/dashboard/main", $this->global);
    }

    public function validasi()
    {
        $data_penyewaan = $this->manage_transaksi->data_penyewaan_on_admin();

        $this->global['penyewaan'] = [
            'data_penyewaan' => $data_penyewaan
        ];

        $this->profile();

        $this->metadata->pageView = "dashboard/admin/validasi_pembayaran";

        $this->loadViews("includes/dashboard/main", $this->global);
    }

    public function valid($id_pemesanan, $kode_pemesanan)
    {
        $perihal    = $this->input->post('perihal');
        $validasi   = $this->input->post('validasi');

        $upload = $_FILES['bukti_forward']['name'];
        if ($upload[0] != '') {
            if ($upload) {
                $files = $_FILES['bukti_forward'];
                $config['allowed_types'] = 'png|jpg|jpeg';
                $config['max_size'] = 2048;
                $config['upload_path'] = '././assets/upload/';
                $this->load->library('upload', $config);
                
                $_FILES['bukti_forward']['name'] = $files['name'];
                $_FILES['bukti_forward']['type'] = $files['type'];
                $_FILES['bukti_forward']['tmp_name'] = $files['tmp_name'];
                $_FILES['bukti_forward']['error'] = $files['error'];
                $_FILES['bukti_forward']['size'] = $files['size'];
    
                $this->upload->initialize($config);
                if ($this->upload->do_upload('bukti_forward')) {
                    $data = $this->upload->data();
                    $imagePath['bukti_forward'] = $data['full_path'];
                    $fullPath = file_get_contents($data['full_path']);
                    $file_encode = base64_encode($fullPath);
                    $imageName = $data['file_name'];
                    $insertImage['bukti_forward'] = $imageName;
                    $insertFullPath['bukti_forward'] = $file_encode;
                    $type['bukti_forward'] = $data['file_type'];
                }
                $this->manage_transaksi->valid($perihal, $validasi, $insertImage['bukti_forward'], $insertFullPath['bukti_forward'], $id_pemesanan, $kode_pemesanan);
                unlink($imagePath['bukti_forward']);

                $this->session->set_flashdata('success', 'Bukti pembayaran berhasil diupload!');
            }
        }

        redirect('admin/managetransaksi/validasi');
    }
    
    public function invalid($id_pemesanan, $kode_pemesanan)
    {
        $perihal    = $this->input->post('perihal');
        $validasi   = $this->input->post('validasi');

        $upload = $_FILES['bukti_pembalikkan']['name'];
        if ($upload[0] != '') {
            if ($upload) {
                $files = $_FILES['bukti_pembalikkan'];
                $config['allowed_types'] = 'png|jpg|jpeg';
                $config['max_size'] = 2048;
                $config['upload_path'] = '././assets/upload/';
                $this->load->library('upload', $config);
                
                $_FILES['bukti_pembalikkan']['name'] = $files['name'];
                $_FILES['bukti_pembalikkan']['type'] = $files['type'];
                $_FILES['bukti_pembalikkan']['tmp_name'] = $files['tmp_name'];
                $_FILES['bukti_pembalikkan']['error'] = $files['error'];
                $_FILES['bukti_pembalikkan']['size'] = $files['size'];
    
                $this->upload->initialize($config);
                if ($this->upload->do_upload('bukti_pembalikkan')) {
                    $data = $this->upload->data();
                    $imagePath['bukti_pembalikkan'] = $data['full_path'];
                    $fullPath = file_get_contents($data['full_path']);
                    $file_encode = base64_encode($fullPath);
                    $imageName = $data['file_name'];
                    $insertImage['bukti_pembalikkan'] = $imageName;
                    $insertFullPath['bukti_pembalikkan'] = $file_encode;
                    $type['bukti_pembalikkan'] = $data['file_type'];
                }
                $this->manage_transaksi->invalid($perihal, $validasi, $insertImage['bukti_pembalikkan'], $insertFullPath['bukti_pembalikkan'], $id_pemesanan, $kode_pemesanan);
                unlink($imagePath['bukti_pembalikkan']);

                $this->session->set_flashdata('success', 'Bukti pembayaran berhasil diupload!');
            }
        }

        redirect('admin/managetransaksi/validasi');
    }
}