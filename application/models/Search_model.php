<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Search_model extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
    }

    public function find_jenis_gedung()
    {
        $sql = "select distinct type from building_type";

        return $this->db->query($sql)->result();
    }

    public function find_lokasi()
    {
        $sql = "select distinct location from building";

        return $this->db->query($sql)->result();
    }

    public function count_ruangan($lokasi, $kapAwal, $kapAkhir, $durasi)
    {
        if ($lokasi != '') {
            $lokasi = $lokasi;
        } else {
            $lokasi = "%";
        }

        if ($kapAkhir == '') {
            if ($kapAwal == '%') {
                $kapasitas = "b.capacity like '$kapAwal' and";
            } else {
                $kapasitas = "b.capacity like '$kapAwal' and";
            }
        } else {
            $kapasitas = "b.capacity between '$kapAwal' and '$kapAkhir' and";
        }

        $sql = "select a.id, b.id, a.name, a.location, b.name, jg.type, b.size, b.capacity, b.hourly_price, b.daily_price, 
        b.weekly_price, b.monthly_price, b.description, f.facility, g.image, d.duration
        from building a 
        left outer join room b 
        on a.id = b.id_gedung 
        left outer join building_type jg 
        on a.id_jenis = jg.id 
        left outer join view_fasilitas f 
        on b.id = f.id_ruangan  
        left outer join view_gambar g 
        on f.id_ruangan = g.id_ruangan
        left outer join durations d 
        on b.id = d.id_ruangan
        where $kapasitas a.location like '$lokasi' and b.activation = 1 and b.discontinue = 1 and d.duration like '$durasi'";

        // var_dump($sql);

        return $this->db->query($sql)->num_rows();
    }

    public function find_ruangan($lokasi, $limit, $start, $kapAwal, $kapAkhir, $durasi)
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
                $kapasitas = "b.capacity like '$kapAwal' and";
            } else {
                $kapasitas = "b.capacity like '$kapAwal' and";
            }
        } else {
            $kapasitas = "b.capacity between '$kapAwal' and '$kapAkhir' and";
        }

        $sql = "select a.id, b.id, a.name, a.location, b.name, jg.type, b.size, b.capacity, b.hourly_price, b.daily_price, 
        b.weekly_price, b.monthly_price, b.description, f.facility, g.image, d.duration
        from building a 
        left outer join room b 
        on a.id = b.id_gedung 
        left outer join building_type jg 
        on a.id_jenis = jg.id 
        left outer join view_fasilitas f 
        on b.id = f.id_ruangan  
        left outer join view_gambar g 
        on f.id_ruangan = g.id_ruangan
        left outer join durations d 
        on b.id = d.id_ruangan
        where $kapasitas a.location like '$lokasi' and b.activation = 1 and b.discontinue = 1 and d.duration like '$durasi'
        limit $limitation";

        // print_r($sql);

        return $this->db->query($sql)->result();
    }

    public function detail($id, $durasi)
    {
        $sql = "select a.id as id_gedung, a.id_penyedia, b.id as id_ruangan, d.id as id_durasi, a.name as name_gedung, a.location, 
        b.name as name_ruangan, jg.type, b.size, b.capacity, b.hourly_price, b.daily_price, 
        b.weekly_price, b.monthly_price, b.description, f.facility, g.image, d.duration
        from building a 
        left outer join room b 
        on a.id = b.id_gedung 
        left outer join building_type jg 
        on a.id_jenis = jg.id 
        left outer join view_fasilitas f 
        on b.id = f.id_ruangan  
        left outer join view_gambar g 
        on f.id_ruangan = g.id_ruangan
        left outer join durations d 
        on b.id = d.id_ruangan
        where b.id='$id' and d.duration='$durasi'";

        // print_r($sql);

        return $this->db->query($sql)->result();
    }

    public function harga($id, $durasi)
    {
        if ($durasi == 'Jam') {
            $harga = "b.hourly_price as harga";
        } elseif ($durasi == 'Hari') {
            $harga = "b.daily_price as harga";
        } elseif ($durasi == 'Minggu') {
            $harga = "b.weekly_price as harga";
        } else {
            $harga = "b.monthly_price as harga";
        }

        $sql = "select $harga
        from building a 
        left outer join room b 
        on a.id = b.id_gedung 
        left outer join building_type jg 
        on a.id_jenis = jg.id 
        left outer join view_fasilitas f 
        on b.id = f.id_ruangan  
        left outer join view_gambar g 
        on f.id_ruangan = g.id_ruangan
        left outer join durations d 
        on b.id = d.id_ruangan
        where b.id='$id' and d.duration='$durasi'";

        // print_r($sql);

        return $this->db->query($sql)->result();
    }

    public function pemesanan($kode_pemesanan, $tgl_pemesanan, $mulai_penyewaan, $selesai_penyewaan, $tipe_durasi, $jml_durasi, $id_ruangan, $id_gedung, $id_penyedia, $id_pemesan)
    {
        $sql = "insert into pemesanan (kode_pemesanan, tgl_pemesanan, mulai_penyewaan, selesai_penyewaan, tipe_durasi, jml_durasi, id_ruangan, id_gedung, id_penyedia, id_pemesan, updated_at, created_at)
        values ('$kode_pemesanan','$tgl_pemesanan','$mulai_penyewaan','$selesai_penyewaan','$tipe_durasi','$jml_durasi','$id_ruangan','$id_gedung','$id_penyedia','$id_pemesan',now(),now())";

        $this->db->query($sql);
    }

    public function pembayaran($kode_pemesanan, $metode_transfer, $nmPemilik, $nmrRekening, $harga)
    {
        $sql = "insert into pembayaran (kode_pemesanan, metode_pembayaran, nmr_rekening, nama_pemilik, total_pembayaran, status_bukti, aktivasi, updated_at, created_at) values 
        ('$kode_pemesanan','$metode_transfer','$nmrRekening','$nmPemilik','$harga','0','0',now(),now())";

        $this->db->query($sql);
    }

    public function selectPemesanan($kode_pemesanan)
    {
        $sql = "select p.id_pemesanan, p.id_ruangan, p.id_gedung, p.id_penyedia, p.id_pemesan, py.id_pembayaran
        from pemesanan p
        join payment py
        on p.kode_pemesanan = py.kode_pemesanan 
        where p.kode_pemesanan='$kode_pemesanan'";

        return $this->db->query($sql)->result();
    }

    public function insert_Transaksi($id_pemesanan, $id_ruangan, $id_gedung, $id_penyedia, $id_pemesan, $id_pembayaran)
    {
        $sql = "insert into transaksi (id_pemesanan, id_ruangan, id_gedung, id_penyedia, id_pemesan, id_pembayaran, pemesanan_id_pemesan) 
        values ('$id_pemesanan', '$id_ruangan', '$id_gedung', '$id_penyedia', '$id_pemesan','$id_pembayaran','0')";

        $this->db->query($sql);
    }

    public function detail_pemesanan($id_pemesan, $id_pemesanan, $durasi)
    {
        $sql = "select a.id, a.id_penyedia, b.id, a.name, a.location, b.name, jg.type, b.size, b.capacity, b.hourly_price, b.daily_price, 
        b.weekly_price, b.monthly_price, b.description, f.facility, g.image, d.duration, p.kode_pemesanan, p.tgl_pemesanan, p.mulai_penyewaan, p.selesai_penyewaan, p.tipe_durasi, 
        p.jml_durasi, py.metode_pembayaran, py.total_pembayaran, py.bukti_pembayaran, py.status_bukti, py.aktivasi
        from building a 
        left outer join room b 
        on a.id = b.id_gedung 
        left outer join building_type jg 
        on a.id_jenis = jg.id 
        left outer join view_fasilitas f 
        on b.id = f.id_ruangan  
        left outer join view_gambar g 
        on f.id_ruangan = g.id_ruangan
        left outer join durations d 
        on b.id = d.id_ruangan
        left outer join transaksi t 
        on b.id = t.id_ruangan
        left outer join order p 
        on t.id_pemesanan = p.id_pemesanan 
        left outer join payment py
        on t.id_pembayaran = py.id_pembayaran
        where p.id_pemesan='$id_pemesan' and p.id_pemesanan='$id_pemesanan' and d.duration='$durasi'";

        print_r($sql);

        return $this->db->query($sql)->result();
    }

    public function addBuktiPembayaran($nama, $img, $kode_pemesanan)
    {
        $sql = "update pembayaran set nama_bukti='$nama', bukti_pembayaran='$img', status_bukti='1' where kode_pemesanan='$kode_pemesanan'";

        $this->db->query($sql);
    }

    public function tersewa()
    {
        $tgl = date('Y-m-d', strtotime('+1 day'));
        $sql = "select o.room_id, o.start_date, o.end_date, o.duration_type 
        from `order` o  
        join payment py 
        on o.id = py.order_id 
        where py.activation='1'";

        print_r($sql);

        return $this->db->query($sql)->result();
    }
}