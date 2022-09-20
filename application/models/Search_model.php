<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Search_model extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
    }

    public function find_lokasi()
    {
        $sql = "select distinct lokasi from gedung";

        return $this->db->query($sql)->result();
    }

    public function count_ruangan($lokasi)
    {
        if ($lokasi != '') {
            $lokasi = $lokasi;
        } else {
            $lokasi = "%";
        }

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
        where a.lokasi like '$lokasi' and b.pengaktifan = 1 and b.pemberhentian = 1
        group by a.id_gedung, b.id_ruangan, a.nama_gedung, b.nama_ruangan, jg.jenis_gedung, b.ukuran, b.kapasitas, 
        b.harga_jam, b.harga_harian, b.harga_mingguan, b.harga_bulanan, b.deskripsi, b.pengaktifan, b.pemberhentian";

        // var_dump($sql);

        return $this->db->query($sql)->num_rows();
    }

    public function find_ruangan($lokasi, $limit, $start)
    {
        // return $this->db->get('detail_ruangan', $limit, $start)->result();

        if ($start != '') {
            $limitation = "$limit offset $start";
        } else {
            $limitation = "$limit";
        }

        if ($lokasi != '') {
            $lokasi = $lokasi;
        } else {
            $lokasi = "%";
        }

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
        where a.lokasi like '$lokasi' and b.pengaktifan = 1 and b.pemberhentian = 1
        group by a.id_gedung, b.id_ruangan, a.nama_gedung, b.nama_ruangan, jg.jenis_gedung, b.ukuran, b.kapasitas, 
        b.harga_jam, b.harga_harian, b.harga_mingguan, b.harga_bulanan, b.deskripsi, b.pengaktifan, b.pemberhentian
        limit $limitation";

        // print_r($sql);

        return $this->db->query($sql)->result();
    }
}