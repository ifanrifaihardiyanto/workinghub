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
        p.status_code as kode_status, p.activation as aktivasi
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
        p.status_code as kode_status, o.customer as nama, o.no_tlp, o.email, p.payment_type as metode_pembayaran, p.activation as aktivasi
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

    public function insert_cancel_rent($cancel_date, $duration, $order_code, $id_ruangan)
    {
        $sql = "insert into cancel_rent_date (cancel_date, order_code, duration_type, id_ruangan) 
        values ('$cancel_date','$order_code', '$duration', '$id_ruangan')";

        $this->db->query($sql);
    }

    public function cancel_rent($order_code)
    {
        $sql = "select cancel_date from cancel_rent_date where order_code='$order_code'";

        return $this->db->query($sql)->result();
    }

    public function tersewa($id, $durasi)
    {
        $sql = "select start_date, case when duration_type='Minggu' then duration_amount * 7
        when duration_type='Bulan' then duration_amount * 30 else duration_amount end as day_durations
        from `order` o where end_date > NOW() and room_id='$id' and duration_type='$durasi'";

        $canceldate = "select cancel_date from cancel_rent_date where id_ruangan='$id' and duration_type='$durasi'";

        $cancel = (object) $this->db->query($canceldate)->result();
        $isInvalidDate = (object) $this->db->query($sql)->result();

        $itemsCancel = array();
        foreach ($cancel as $key) {
            $cancelRentDate = date('m/d/Y', strtotime($key->cancel_date));
            $dateFormat =  '"' . $cancelRentDate . '"';
            $itemsCancel[] = $dateFormat;
            // echo $cancelRentDate . '<br>';
        }

        $items = array();
        foreach ($isInvalidDate as $d) {
            $durations = $d->day_durations;
            // echo $durations . '<br>';

            for ($i = 0; $i < $durations; $i++) {
                $invalidDate = date('m/d/Y', strtotime('+' . $i . ' day', strtotime($d->start_date)));
                $dateFormat =  '"' . $invalidDate . '"';
                // $dateFormat =  $invalidDate;
                $items[] = $dateFormat;
            }
        }

        $compare_date = array_diff($items, $itemsCancel);

        $data = [
            'isInvalidDate' => $compare_date
        ];

        return $data;
    }

    public function rentDate($id, $durasi)
    {
        $sql = "select start_date, case when duration_type='Minggu' then duration_amount * 7
        when duration_type='Bulan' then duration_amount * 30 else duration_amount end as day_durations
        from `order` o where end_date > NOW() and room_id='$id' and duration_type='$durasi'";

        $canceldate = "select cancel_date from cancel_rent_date where id_ruangan='$id' and duration_type='$durasi'";

        $cancel = (object) $this->db->query($canceldate)->result();
        $isInvalidDate = (object) $this->db->query($sql)->result();

        $itemsCancel = array();
        foreach ($cancel as $key) {
            $cancelRentDate = date('m/d/Y', strtotime($key->cancel_date));
            // $dateFormat =  '"' . $cancelRentDate . '"';
            $dateFormat =  $cancelRentDate;
            $itemsCancel[] = $dateFormat;
            // echo $cancelRentDate . '<br>';
        }

        $items = array();
        foreach ($isInvalidDate as $d) {
            $durations = $d->day_durations;
            // echo $durations . '<br>';

            for ($i = 0; $i < $durations; $i++) {
                $invalidDate = date('m/d/Y', strtotime('+' . $i . ' day', strtotime($d->start_date)));
                // $dateFormat =  '"' . $invalidDate . '"';
                $dateFormat =  $invalidDate;
                $items[] = $dateFormat;
            }
        }

        $compare_date = array_diff($items, $itemsCancel);

        $data = [
            'isInvalidDate' => $compare_date
        ];

        return $compare_date;
    }
}