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
        // $sql = "select t.id_pemesanan, ps.name, ps.email, g.name, r.name, 
        // py.total_pembayaran, py.status_bukti, py.aktivasi,
        // p.kode_pemesanan, p.tgl_pemesanan, p.mulai_penyewaan, 
        // p.selesai_penyewaan, p.tipe_durasi, p.jml_durasi, v.image as bukti_penerusan
        // from transaksi t 
        // join partner pt
        // on t.id_penyedia = pt.id
        // join pemesan ps
        // on t.id_pemesan = ps.id 
        // join pemesanan p 
        // on t.id_pemesanan = p.id_pemesanan 
        // join pembayaran py
        // on t.id_pembayaran = py.id_pembayaran
        // join gedung g 
        // on t.id_gedung = g.id 
        // join ruangan r 
        // on t.id_ruangan = r.id 
        // left outer join validasi v 
        // on t.id_pemesanan = v.id_pemesanan
        // where pt.id='$id_user'
        // order by py.status_bukti desc, py.aktivasi desc";

        $sql = "
        select o.id as id_pemesanan, c.name, c.email, b.name, r.name, 
        p.total as total_pembayaran, p.transaction_status as status_bukti, p.activation as aktivasi,
        o.order_code as kode_pemesanan, o.order_date as tgl_pemesanan, o.start_date as mulai_penyewaan, 
        o.end_date as selesai_penyewaan, o.duration_type as tipe_durasi, o.amount_duration as jml_durasi
        from `order` o
        join partner pt
        on o.partner_id = pt.id
        join customer c
        on o.customer_id = c.id 
        join payment p
        on o.id = p.order_id
        join building b
        on o.building_id = b.id
        join room r  
        on o.room_id = r.id
        where pt.id='$id_user'
        order by p.activation desc";

        // print_r($sql);

        return $this->db->query($sql)->result();
    }
}