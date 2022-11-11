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
        $sql = "
        select o.id as id_pemesanan, c.name, c.email, b.name, r.name, 
        p.total as total_pembayaran, p.transaction_status as status_bukti, p.activation as aktivasi,
        o.order_code as kode_pemesanan, o.order_date as tgl_pemesanan, o.start_date as mulai_penyewaan, 
        o.end_date as selesai_penyewaan, o.duration_type as tipe_durasi, o.duration_amount as jml_durasi
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

    public function pendapatan($id_user)
    {
        $sql = "select r.name, coalesce(sum(py.amount),0) total
        from `order` o 
        join payment py
        on o.id = py.order_id
        join partner p 
        on p.id = o.partner_id
        right join room r 
        on r.id_penyedia = o.partner_id 
        where py.status_code='200' and p.id='$id_user'
        group by 1";

        return $this->db->query($sql)->result();
    }
}