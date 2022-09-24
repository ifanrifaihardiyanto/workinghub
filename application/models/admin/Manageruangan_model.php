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
        $sql = "select a.id_gedung, b.id_ruangan, a.nama_gedung, b.nama_ruangan, jg.jenis_gedung, b.ukuran, b.kapasitas, 
        b.harga_jam, b.harga_harian, b.harga_mingguan, b.harga_bulanan, b.deskripsi, b.pengaktifan, b.pemberhentian, 
        group_concat(f.fasilitas separator ', ') as fasilitas
        from gedung a
        left outer join ruangan b
        on a.id_gedung = b.gedung_id_gedung
        left outer join jenis_gedung jg
        on a.jenis_id_jenis = jg.id_jenis_gedung 
        left outer join fasilitas f 
        on b.id_ruangan = f.id_ruangan
        where b.pengaktifan = '0'
        group by a.id_gedung, b.id_ruangan, a.nama_gedung, b.nama_ruangan, jg.jenis_gedung, b.ukuran, b.kapasitas, 
        b.harga_jam, b.harga_harian, b.harga_mingguan, b.harga_bulanan, b.deskripsi, b.pengaktifan, b.pemberhentian";

        return $this->db->query($sql)->result();
    }

    public function activation_ruangan($id)
    {
        $sql = "update ruangan set pengaktifan='1' where id_ruangan='$id'";

        $this->db->query($sql);
    }

    public function non_activation_ruangan($penolakan, $id, $user_id)
    {
        $sql = "update ruangan set pengaktifan='2' where id_ruangan='$id'";

        $this->db->query($sql);

        $insert_alasan = "insert into penolakan_sewa (alasan, id_user, id_ruangan) values ('$penolakan','$user_id','$id')";
        $this->db->query($insert_alasan);
    }
}