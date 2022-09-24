<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Authenticate extends CI_Controller {
    
  public function __construct()
	{
		parent::__construct();
		//Do your magic here
    $this->load->model('Auth_model', 'auth');
    $this->load->library('form_validation');
	}

  public function index()
  {
    $this->isLoggedIn();
  }

  public function isLoggedIn()
  {
    $isLoggedIn = $this->session->userdata('isLoggedIn');

    if (!isset($isLoggedIn) || $isLoggedIn != true) {
      $this->load->view('auth/booking/login');
    } else {
      redirect('/index.php/home');
    }
  }

  public function logging_in()
  {
    $this->form_validation->set_rules('email','Email','required|trim|valid_email');
    $this->form_validation->set_rules('password','Password','required|trim|min_length[8]');

    if ($this->form_validation->run() == false) {
      $this->index();
    } else {
      $email      = $this->input->post('email');
      $password   = $this->input->post('password');

      $result     = $this->auth->getData($email);

      if (!empty($result)) {
        $lowerRole  = strtolower($result[0]->role);
        $pass       = $result[0]->password;
        $user_id    = $result[0]->id_user;

        $getData    = $this->auth->getDataAll($user_id, $lowerRole);
        
        if (password_verify($password, $pass)) {
          $this->session->set_userdata([
            'user'        => $getData,
            'isLoggedIn'  => true,
          ]);
  
          redirect('/index.php/home');
        } else {
          $this->session->set_flashdata('error', 'Password yang anda masukkan salah!');

          $this->load->view('auth/booking/login');
        }
      } else {
        $this->session->set_flashdata('error', 'Email belum terdaftar!');

        $this->load->view('auth/booking/login');
      }
    }
  }

  public function logged_out()
  {
    $this->session->unset_userdata('user');
    $this->session->set_userdata('isLoggedIn', false);
    redirect('/');
  }

  public function register()
  {
    $this->form_validation->set_rules('email','Email','required|trim|valid_email|is_unique[user.username]',['is_unique' => 'Email sudah pernah digunakan!']);
    $this->form_validation->set_rules('password','Password','required|trim|min_length[8]');

    if ($this->form_validation->run() == false) {
      $this->load->view('auth/booking/register');
    } else {
      $isLoggedIn = $this->session->userdata('isLoggedIn');

      if (!isset($isLoggedIn) || $isLoggedIn != true) {
        $this->load->view('auth/booking/register');
      }

      $role    = $this->input->post('hideRole');
      $email    = $this->input->post('email');
      $password = password_hash($this->input->post('password'), PASSWORD_DEFAULT);
      $activation = 1;

      $this->auth->insertUser($email, $password, $role, $activation);
      $result = $this->auth->getData($email);

      $this->session->set_userdata([
        'user' => $result,
      ]);

      $this->session->set_flashdata('success', 'Akun berhasil dibuat. Silahkan login!');

      redirect('/index.php/authenticate/completed_data');
    }
  }

  public function partner_registration()
  {
    $this->form_validation->set_rules('email','Email','required|trim|valid_email|is_unique[user.username]',['is_unique' => 'Email sudah pernah digunakan!']);
    $this->form_validation->set_rules('password','Password','required|trim|min_length[8]');

    if ($this->form_validation->run() == false) {
      $this->load->view('auth/dashboard/partner/register');
    } else {
      $role     = $this->input->post('hideRole');
      $email    = $this->input->post('email');
      $password = password_hash($this->input->post('password'), PASSWORD_DEFAULT);
      $activation = 1;

      $this->auth->insertUser($email, $password, $role, $activation);
      $result = $this->auth->getData($email);

      $this->session->set_userdata([
        'user' => $result,
      ]);

      $this->session->set_flashdata('success', 'Akun berhasil dibuat. Silahkan login!');

      redirect('/index.php/authenticate/completed_data');
    }
  }

  public function completed_data()
  {
    $isLoggedIn = $this->session->userdata('isLoggedIn');

    if (!isset($isLoggedIn) || $isLoggedIn != true) {
      $this->load->view('auth/booking/completed_data');
    }
    
    $this->form_validation->set_rules('nama','Nama','required|trim');
    $this->form_validation->set_rules('nik','NIK','required|trim');
    $this->form_validation->set_rules('noTelp','Nomor Telepon','required|trim');
    $this->form_validation->set_rules('nama','Nama','required|trim');
    $this->form_validation->set_rules('tmptLahir','Tempat Lahir','required|trim');
    $this->form_validation->set_rules('tglLahir','Tanggal Lahir','required');
    $this->form_validation->set_rules('alamat','Alamat','required|trim');
    $this->form_validation->set_rules('rekBNI','Rekening BNI','required|trim');
    $this->form_validation->set_rules('rekBRI','Rekening BRI','required|trim');
    $this->form_validation->set_rules('rekMandiri','Rekening Mandiri','required|trim');
    $this->form_validation->set_rules('rekBCA','Rekening BCA','required|trim');

    $user = $this->session->userdata('user');
    $user_id  = $user[0]->id_user;
    $email  = $user[0]->username;
    $role     = strtolower($user[0]->role);

    if ($this->form_validation->run() == false) {
      $this->load->view('auth/booking/completed_data');
    } else {
      $nama       = $this->input->post('nama');
      $nik        = $this->input->post('nik');
      $noTelp     = $this->input->post('noTelp');
      $tmptLahir  = $this->input->post('tmptLahir');
      $tglLahir   = $this->input->post('tglLahir');
      $alamat     = $this->input->post('alamat');
      $rekBNI     = $this->input->post('rekBNI');
      $rekBRI     = $this->input->post('rekBRI');
      $rekMandiri = $this->input->post('rekMandiri');
      $rekBCA     = $this->input->post('rekBCA');
      
      $this->auth->completedData($user_id, $nama, $tmptLahir, $tglLahir, $alamat, $nik, $email, $noTelp, $rekBNI, $rekBRI, $rekMandiri, $rekBCA, $role);

      $this->session->set_flashdata('success', 'Akun berhasil dibuat. Silahkan login!');

      redirect('/index.php/authenticate/logging_in');
    }
  }
}