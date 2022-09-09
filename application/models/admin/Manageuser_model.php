<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Manageuser_model extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
    }

    public function getDataAllUser()
    {
        $sql = "
        select id_user, role, nama, tempat_lahir, tanggal_lahir, alamat, nik_ktp, email, no_tlp, rek_bni, rek_bri, rek_mandiri, rek_bca from
        (
            select a.id_user as id_user, a.role as role, b.nama, b.tempat_lahir, b.tanggal_lahir, b.alamat, b.nik_ktp, b.email, b.no_tlp, b.rek_bni, b.rek_bri, b.rek_mandiri, b.rek_bca 
            from user a left outer join pemesan b on a.id_user = b.user_id_user where a.role='Pemesan'
            union all
            select a.id_user as id_user, a.role as role, b.nama, b.tempat_lahir, b.tanggal_lahir, b.alamat, b.nik_ktp, b.email, b.no_tlp, b.rek_bni, b.rek_bri, b.rek_mandiri, b.rek_bca 
            from user a left outer join partner b on a.id_user = b.user_id_user where a.role='Partner'
            union all
            select a.id_user as id_user, a.role as role, b.nama, b.tempat_lahir, b.tanggal_lahir, b.alamat, b.nik_ktp, b.email, b.no_tlp, '0' as rek_bni, '0' as rek_bri, '0' as rek_mandiri, '0' as rek_bca 
            from user a left outer join admin b on a.id_user = b.user_id_user where a.role='Admin'
        ) data_user";

        var_dump($sql);

        return $this->db->query($sql)->result();
    }
}
