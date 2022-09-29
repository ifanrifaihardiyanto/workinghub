<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Managepenyewaan_model extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
    }

    public function data_penyewaan_on_dashboard($id_user)
    {
        $sql = "select ps.nama, ps.email, g.nama_gedung, r.nama_ruangan, 
        py.total_pembayaran, py.status_bukti, py.aktivasi,
        p.kode_pemesanan, p.tgl_pemesanan, p.mulai_penyewaan, 
        p.selesai_penyewaan, p.tipe_durasi, p.jml_durasi 
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
        where pt.id_penyedia='$id_user'";

        return $this->db->query($sql)->result();
    }
}