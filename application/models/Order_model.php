<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Order_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function data_tagihan($id_user)
    {
        $sql = "select a.id as id_gedung, a.id_penyedia, b.id as id_ruangan, a.name as nama_gedung, a.location as lokasi, b.name as nama_ruangan, 
        jg.`type` as jenis_gedung, b.`size` as ukuran, b.capacity as kapasitas, b.hourly_price as harga_jam, b.daily_price as harga_harian, 
        b.weekly_price as harga_mingguan, b.monthly_price as harga_bulanan, b.description as deskripsi, f.facility as fasilitas, g.image as gambar,
        o.order_code as kode_pemesanan, o.order_date as tgl_pemesanan, o.start_date as mulai_penyewaan, o.end_date as selesai_penyewaan, 
        o.duration_type as tipe_durasi, p.transaction_status as status_bukti, p.total as total_pembayaran, o.duration_amount as jml_durasi,
        p.status_code as kode_status
        from building a 
        left outer join room b 
        on a.id = b.id_gedung  
        left outer join building_type jg 
        on a.id_jenis = jg.id  
        left outer join view_fasilitas f 
        on b.id = f.id_ruangan 
        left outer join view_gambar g 
        on f.id_ruangan = g.id_ruangan 
        left outer join `order` o
        on b.id = o.room_id  
        left outer join payment p  
        on o.id = p.order_id  
        where o.customer_id='$id_user' order by o.order_date desc, p.activation desc";

        // print_r($sql);

        return $this->db->query($sql)->result();
    }

    public function detail_tagihan($kode_pemesanan)
    {
        $sql = "select a.id as id_gedung, a.id_penyedia, b.id as id_ruangan, a.name as nama_gedung, a.location as lokasi, b.name as nama_ruangan, 
        jg.`type` as jenis_gedung, b.`size` as ukuran, b.capacity as kapasitas, b.hourly_price as harga_jam, b.daily_price as harga_harian, 
        b.weekly_price as harga_mingguan, b.monthly_price as harga_bulanan, b.description as deskripsi, f.facility as fasilitas, g.image as gambar,
        o.order_code as kode_pemesanan, o.order_date as tgl_pemesanan, o.start_date as mulai_penyewaan, o.end_date as selesai_penyewaan, 
        o.duration_type as tipe_durasi, p.transaction_status as status_bukti, p.total as total_pembayaran, o.duration_amount as jml_durasi,
        p.status_code as kode_status, o.customer as nama, o.no_tlp, o.email, p.payment_type as metode_pembayaran
        from building a 
        left outer join room b 
        on a.id = b.id_gedung  
        left outer join building_type jg 
        on a.id_jenis = jg.id  
        left outer join view_fasilitas f 
        on b.id = f.id_ruangan 
        left outer join view_gambar g 
        on f.id_ruangan = g.id_ruangan 
        left outer join `order` o
        on b.id = o.room_id  
        left outer join payment p  
        on o.id = p.order_id  
        where o.order_code='$kode_pemesanan'";

        // print_r($sql);

        return $this->db->query($sql)->result();
    }
}