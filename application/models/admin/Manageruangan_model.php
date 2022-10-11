<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Manageruangan_model extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
    }

    public function find_data_ruangan()
    {
        $sql = "select a.id, b.id, a.name, b.name, jg.type, b.size, b.capacity, 
        b.hourly_price, b.daily_price, b.weekly_price, b.monthly_price, b.description, b.activation, b.discontinue, 
        group_concat(f.facility separator ', ') as fasilitas
        from building a
        left outer join room b
        on a.id = b.id_gedung
        left outer join building_type jg
        on a.id_jenis = jg.id
        left outer join facilities f 
        on b.id = f.id_ruangan
        where b.activation = '0'
        group by a.id, b.id, a.name, b.name, jg.type, b.size, b.capacity, 
        b.hourly_price, b.daily_price, b.weekly_price, b.monthly_price, b.description, b.activation, b.discontinue";

        return $this->db->query($sql)->result();
    }

    public function activation_ruangan($id)
    {
        $sql = "update room set activation='1' where id='$id'";

        $this->db->query($sql);
    }

    public function non_activation_ruangan($penolakan, $id, $user_id)
    {
        $sql = "update room set activation='2' where id='$id'";

        $this->db->query($sql);

        $insert_alasan = "insert into penolakan_sewa (alasan, id_user, id_ruangan) values ('$penolakan','$user_id','$id')";
        $this->db->query($insert_alasan);
    }
}