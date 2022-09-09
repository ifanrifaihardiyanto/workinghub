<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth_model extends CI_Model {

    public function __construct()
    {
        parent::__construct();
    }

    public function getData($email)
    {
		$sql = "select * from user left outer join pemesan on user.id_user = pemesan.user_id_user where user.username='$email'";

        return $this->db->query($sql)->result();
    }

    public function getDataAll($user_id, $role)
    {
		$sql = "select * from user left outer join $role on user.id_user = $role.user_id_user where user.id_user='$user_id'";

        return $this->db->query($sql)->result();
    }

    public function insertUser($email, $password, $role)
    {
        $sql = "insert into user (username, password, role) values ('$email','$password','$role')";

        $this->db->query($sql);
    }

    public function completedData($user_id, $nama, $tmptLahir, $tglLahir, $alamat, $nik, $email, $noTelp, $rekBNI, $rekBRI, $rekMandiri, $rekBCA, $role)
    {

        $sql = "insert into $role (nama, tempat_lahir, tanggal_lahir, alamat, nik_ktp, email, no_tlp, rek_bni, rek_bri, rek_mandiri, rek_bca, user_id_user) 
        values ('$nama','$tmptLahir','$tglLahir','$alamat', '$nik','$email','$noTelp','$rekBNI','$rekBRI','$rekMandiri','$rekBCA','$user_id')";

        // var_dump($sql);
        
        $this->db->query($sql);
    }
}