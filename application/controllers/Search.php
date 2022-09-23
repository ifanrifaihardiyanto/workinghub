<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

require APPPATH . '/libraries/BaseController.php';

class Search extends BaseController
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Search_model', 'search');
        $this->load->library('pagination');
    }
    
    public function find()
    {
        $kapasitas = $this->input->post('kapasitas');
        if ($kapasitas == '%' || $kapasitas == '100') {
            $kapAwal    = $kapasitas;
            $kapAkhir   = "";
        } else {
            $kapasitasExp = explode(' - ', $kapasitas);
            $kapAwal    = $kapasitasExp[0];
            $kapAkhir   = $kapasitasExp[1];
        }
        // print_r($kapAkhir);

        $lokasi = $this->search->find_lokasi();

        $this->global['search'] = [
            'lokasi' => $lokasi
        ];

        $nmLokasi = $this->input->post('lokasi');
        if ($nmLokasi != '') {
            $this->session->set_userdata([
                'nama_lokasi' => $nmLokasi,
                'kapasitas' => $kapasitas
            ]);
        } else {
            if ($this->input->post('submit')) {
                $nmLokasi = $this->input->post('lokasi');
                $this->session->set_userdata([
                    'nama_lokasi' => $nmLokasi,
                    'kapasitas' => $kapasitas
                ]);
            } else {
                $nmLokasi = $this->session->userdata('nama_lokasi');
            }
        }

        $test = $this->session->userdata('nama_lokasi');
        // print_r($test);
        // print_r($nmLokasi);

        $cntResult = $this->search->count_ruangan($nmLokasi, $kapAwal, $kapAkhir);

        $link = 'http://localhost/workinghub/index.php/search/find';

        $config['base_url'] = $link;
        $config['total_rows'] = $cntResult;
        $config['per_page'] = 5;

        // customize pagination
        $config['full_tag_open'] = '<nav aria-label="Page navigation example"><ul class="pagination pagination-rounded justify-content-end">';
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

        $result = $this->search->find_ruangan($nmLokasi, $config['per_page'], $segment, $kapAwal, $kapAkhir);

        $this->global['result'] = (object) [
            'ruangan' => $result
        ];

        $this->profile();

        $this->metadata->pageView = "booking/pencarian";

        $this->loadViews("includes/booking/main", $this->global);
    }

    public function detail($id)
    {
        $result = $this->search->detail($id);

        $this->global['result'] = (object) [
            'ruangan' => $result
        ];

        $this->profile();

        $this->metadata->pageView = "booking/detail";

        $this->loadViews("includes/booking/main", $this->global);
    }
}