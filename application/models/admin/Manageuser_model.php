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
        select id_user, role, aktivasi, name, place_birth, date_birth, address, nik, email, no_tlp, rek_bni, rek_bri, rek_mandiri, rek_bca from
        (
            select a.id as id_user, a.role as role, a.activation as aktivasi, b.name, b.place_birth, b.date_birth, b.address, b.nik, b.email, b.no_tlp, b.rek_bni, b.rek_bri, b.rek_mandiri, b.rek_bca 
            from user a left outer join customer b on a.id = b.id_user where a.role='Customer'
            union all
            select a.id as id_user, a.role as role, a.activation as aktivasi, b.name, b.place_birth, b.date_birth, b.address, b.nik, b.email, b.no_tlp, b.rek_bni, b.rek_bri, b.rek_mandiri, b.rek_bca 
            from user a left outer join partner b on a.id = b.id_user where a.role='Partner'
            union all
            select a.id as id_user, a.role as role, a.activation as aktivasi, b.name, b.place_birth, b.date_birth, b.address, b.nik, b.email, b.no_tlp, '0' as rek_bni, '0' as rek_bri, '0' as rek_mandiri, '0' as rek_bca 
            from user a left outer join admin b on a.id = b.id_user where a.role='Admin'
        ) data_user";

        return $this->db->query($sql)->result();
    }

    public function nonaktif($id)
    {
        $sql = "update user set activation='0' where id='$id'";

        $this->db->query($sql);
    }

    public function get_id_user($email, $role, $nama)
    {
        $sql = "select * from user where role='$role' and username='$email' order by id desc limit 1";

        return $this->db->query($sql)->result();
    }
}