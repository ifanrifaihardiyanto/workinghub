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

    public function count_ruangan($lokasi, $kapAwal, $kapAkhir)
    {
        if ($lokasi != '') {
            $lokasi = $lokasi;
        } else {
            $lokasi = "%";
        }

        if ($kapAkhir == '') {
            if ($kapAwal == '%') {
                $kapasitas = "b.kapasitas like '$kapAwal' and";
            } else {
                $kapasitas = "b.kapasitas like '$kapAwal' and";
            }
        } else {
            $kapasitas = "b.kapasitas between '$kapAwal' and '$kapAkhir' and";
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
        where $kapasitas a.lokasi like '$lokasi' and b.pengaktifan = 1 and b.pemberhentian = 1
        group by a.id_gedung, b.id_ruangan, a.nama_gedung, b.nama_ruangan, jg.jenis_gedung, b.ukuran, b.kapasitas, 
        b.harga_jam, b.harga_harian, b.harga_mingguan, b.harga_bulanan, b.deskripsi, b.pengaktifan, b.pemberhentian";

        // var_dump($sql);

        return $this->db->query($sql)->num_rows();
    }

    public function find_ruangan($lokasi, $limit, $start, $kapAwal, $kapAkhir)
    {
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

        if ($kapAkhir == '') {
            if ($kapAwal == '%') {
                $kapasitas = "b.kapasitas like '$kapAwal' and";
            } else {
                $kapasitas = "b.kapasitas like '$kapAwal' and";
            }
        } else {
            $kapasitas = "b.kapasitas between '$kapAwal' and '$kapAkhir' and";
        }

        $sql = "select a.id_gedung, b.id_ruangan, a.nama_gedung, a.lokasi, b.nama_ruangan, jg.jenis_gedung, b.ukuran, b.kapasitas, 
        b.harga_jam, b.harga_harian, b.harga_mingguan, b.harga_bulanan, b.deskripsi, f.fasilitas, d.durasi, g.gambar
        from gedung a
        left outer join ruangan b
        on a.id_gedung = b.gedung_id_gedung
        left outer join jenis_gedung jg
        on a.jenis_id_jenis = jg.id_jenis_gedung 
        left outer join view_fasilitas f 
        on b.id_ruangan = f.id_ruangan
        left outer join view_durasi d  
        on b.id_ruangan = d.id_ruangan 
        left outer join view_gambar g
        on f.id_ruangan = g.ruangan_id_ruangan
        where $kapasitas a.lokasi like '$lokasi' and b.pengaktifan = 1 and b.pemberhentian = 1
        limit $limitation";

        // print_r($sql);

        return $this->db->query($sql)->result();
    }

    public function detail($id)
    {
        $sql = "select a.id_gedung, b.id_ruangan, a.nama_gedung, a.lokasi, b.nama_ruangan, jg.jenis_gedung, b.ukuran, b.kapasitas, 
        b.harga_jam, b.harga_harian, b.harga_mingguan, b.harga_bulanan, b.deskripsi, f.fasilitas, d.durasi, g.gambar
        from gedung a
        left outer join ruangan b
        on a.id_gedung = b.gedung_id_gedung
        left outer join jenis_gedung jg
        on a.jenis_id_jenis = jg.id_jenis_gedung 
        left outer join view_fasilitas f 
        on b.id_ruangan = f.id_ruangan
        left outer join view_durasi d  
        on b.id_ruangan = d.id_ruangan 
        left outer join view_gambar g
        on f.id_ruangan = g.ruangan_id_ruangan
        where b.id_ruangan='$id'";

        // print_r($sql);

        return $this->db->query($sql)->result();
    }
}