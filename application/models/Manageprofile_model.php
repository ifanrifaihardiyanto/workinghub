<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Manageprofile_model extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
    }

    public function edit($user_id, $nama, $tmptLahir, $tglLahir, $alamat, $nik, $noTelp, $rekBNI, $rekBRI, $rekMandiri, $rekBCA, $role)
    {
        if ($role === 'admin') {
            $sql = "update $role set nama='$nama', tempat_lahir='$tmptLahir', tanggal_lahir='$tglLahir', alamat='$alamat', nik_ktp='$nik', no_tlp='$noTelp' 
            where user_id_user = '$user_id'";
        } else {
            $sql = "update $role set nama='$nama', tempat_lahir='$tmptLahir', tanggal_lahir='$tglLahir', alamat='$alamat', 
            nik_ktp='$nik', no_tlp='$noTelp', rek_bni='$rekBNI', rek_bri='$rekBRI', rek_mandiri='$rekMandiri', rek_bca='$rekBCA' 
            where user_id_user = '$user_id'";
        }
        print_r($sql);
        $this->db->query($sql);
    }

    public function getDataAll($user_id, $role)
    {
        $sql = "select * from user left outer join $role on user.id_user = $role.user_id_user where user.id_user='$user_id'";

        return $this->db->query($sql)->result();
    }
}
