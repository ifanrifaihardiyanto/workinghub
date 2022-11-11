<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth_model extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
    }

    public function getData($email)
    {
        $sql = "select * from user where username='$email'";

        return $this->db->query($sql)->row();
    }

    public function getDataAll($user_id, $role)
    {
        $sql = "select * from user left outer join $role on user.id = $role.id_user where user.id='$user_id'";

        return $this->db->query($sql)->result();
    }

    public function insertUser($email, $password, $role, $activation)
    {
        $sql = "insert into user (username, password, role, activation) values ('$email','$password','$role','$activation')";

        $this->db->query($sql);
    }

    public function completedData($user_id, $nama, $tmptLahir, $tglLahir, $alamat, $nik, $email, $noTelp, $rekBNI, $rekBRI, $rekMandiri, $rekBCA, $role)
    {
        if (strtolower($role) == 'admin') {
            $sql = "insert into $role (name, place_birth, date_birth, address, nik, email, no_tlp, id_user) 
        values ('$nama','$tmptLahir','$tglLahir','$alamat', '$nik','$email','$noTelp','$user_id')";
        } else {
            $sql = "insert into $role (name, place_birth, date_birth, address, nik, email, no_tlp, rek_bni, rek_bri, rek_mandiri, rek_bca, id_user) 
        values ('$nama','$tmptLahir','$tglLahir','$alamat', '$nik','$email','$noTelp','$rekBNI','$rekBRI','$rekMandiri','$rekBCA','$user_id')";
        }


        // var_dump($sql);

        $this->db->query($sql);
    }
}