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
        $sql = "select ps.name, ps.email, g.name, r.name, 
        py.total as total_pembayaran, py.activation as aktivasi,
        o.order_code as kode_pemesanan, o.order_date as tgl_pemesanan, o.start_date as mulai_penyewaan, 
        o.end_date as selesai_penyewaan, o.duration_type as tipe_durasi, o.duration_amount as jml_durasi, 
        o.id as id_pemesanan, py.id as id_pembayaran
        from `order` o
        join partner pt
        on o.partner_id = pt.id 
        join customer ps
        on o.customer_id = ps.id 
        join payment py
        on py.order_id = o.id
        join building g 
        on o.building_id = g.id 
        join room r
        on o.room_id = r.id";

        return $this->db->query($sql)->result();
    }

    public function valid($perihal, $alasan, $nama_img, $image, $id_pemesanan, $kode_pemesanan)
    {
        $aktivasi = "update pembayaran set aktivasi='1' where kode_pemesanan='$kode_pemesanan'";
        $this->db->query($aktivasi);

        $sql = "insert into room_validation (perihal, alasan, nama_img, image, id_pemesanan) values 
        ('$perihal', '$alasan', '$nama_img', '$image', '$id_pemesanan')";

        $this->db->query($sql);
    }

    public function invalid($perihal, $alasan, $nama_img, $image, $id_pemesanan, $kode_pemesanan)
    {
        $aktivasi = "update pembayaran set aktivasi='2' where kode_pemesanan='$kode_pemesanan'";
        $this->db->query($aktivasi);

        $sql = "insert into room_validation (perihal, alasan, nama_img, image, id_pemesanan) values 
        ('$perihal', '$alasan', '$nama_img', '$image', '$id_pemesanan')";

        $this->db->query($sql);
    }
}