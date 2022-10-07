<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Managetransaksi_model extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
    }

    public function data_penyewaan_on_admin()
    {
        $sql = "select ps.nama, ps.email, g.nama_gedung, r.nama_ruangan, 
        py.total_pembayaran, py.status_bukti, py.aktivasi,
        p.kode_pemesanan, p.tgl_pemesanan, p.mulai_penyewaan, 
        p.selesai_penyewaan, p.tipe_durasi, p.jml_durasi, p.id_pemesanan, py.id_pembayaran, py.bukti_pembayaran
        from transaksi t 
        join partner pt
        on t.id_penyedia = pt.id_penyedia 
        join pemesan ps
        on t.id_pemesan = ps.id_pemesan 
        join pemesanan p 
        on t.id_pemesanan = p.id_pemesanan 
        join pembayaran py
        on t.id_pembayaran = py.id_pembayaran
        join gedung g 
        on t.id_gedung = g.id_gedung 
        join ruangan r 
        on t.id_ruangan = r.id_ruangan
        order by py.status_bukti desc";

        return $this->db->query($sql)->result();
    }

    public function valid($perihal, $alasan, $nama_img, $image, $id_pemesanan, $kode_pemesanan)
    {
        $aktivasi = "update pembayaran set aktivasi='1' where kode_pemesanan='$kode_pemesanan'";
        $this->db->query($aktivasi);

        $sql = "insert into validasi (perihal, alasan, nama_img, image, id_pemesanan) values 
        ('$perihal', '$alasan', '$nama_img', '$image', '$id_pemesanan')";

        $this->db->query($sql);
    }

    public function invalid($perihal, $alasan, $nama_img, $image, $id_pemesanan, $kode_pemesanan)
    {
        $aktivasi = "update pembayaran set aktivasi='2' where kode_pemesanan='$kode_pemesanan'";
        $this->db->query($aktivasi);

        $sql = "insert into validasi (perihal, alasan, nama_img, image, id_pemesanan) values 
        ('$perihal', '$alasan', '$nama_img', '$image', '$id_pemesanan')";

        $this->db->query($sql);
    }
}