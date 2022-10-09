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
        $sql = "select t.id_pemesanan, ps.name, ps.email, g.name, r.name, 
        py.total_pembayaran, py.status_bukti, py.aktivasi,
        p.kode_pemesanan, p.tgl_pemesanan, p.mulai_penyewaan, 
        p.selesai_penyewaan, p.tipe_durasi, p.jml_durasi, v.image as bukti_penerusan
        from transaksi t 
        join partner pt
        on t.id_penyedia = pt.id
        join pemesan ps
        on t.id_pemesan = ps.id 
        join pemesanan p 
        on t.id_pemesanan = p.id_pemesanan 
        join pembayaran py
        on t.id_pembayaran = py.id_pembayaran
        join gedung g 
        on t.id_gedung = g.id 
        join ruangan r 
        on t.id_ruangan = r.id 
        left outer join validasi v 
        on t.id_pemesanan = v.id_pemesanan
        where pt.id='$id_user'
        order by py.status_bukti desc, py.aktivasi desc";

        // print_r($sql);

        return $this->db->query($sql)->result();
    }
}