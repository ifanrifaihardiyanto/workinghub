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
        $sql = "select distinct jenis_gedung from jenis_gedung";

        return $this->db->query($sql)->result();
    }

    public function find_lokasi()
    {
        $sql = "select distinct lokasi from gedung";

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
                $kapasitas = "b.kapasitas like '$kapAwal' and";
            } else {
                $kapasitas = "b.kapasitas like '$kapAwal' and";
            }
        } else {
            $kapasitas = "b.kapasitas between '$kapAwal' and '$kapAkhir' and";
        }

        $sql = "select a.id_gedung, b.id_ruangan, a.nama_gedung, a.lokasi, b.nama_ruangan, jg.jenis_gedung, b.ukuran, b.kapasitas, b.harga_jam, b.harga_harian, 
        b.harga_mingguan, b.harga_bulanan, b.deskripsi, f.fasilitas, g.gambar, d.durasi
        from gedung a 
        left outer join ruangan b 
        on a.id_gedung = b.gedung_id_gedung 
        left outer join jenis_gedung jg 
        on a.id_jenis = jg.id_jenis_gedung 
        left outer join view_fasilitas f 
        on b.id_ruangan = f.id_ruangan  
        left outer join view_gambar g 
        on f.id_ruangan = g.id_ruangan
        left outer join durasi d 
        on b.id_ruangan = d.id_ruangan
        where $kapasitas a.lokasi like '$lokasi' and b.pengaktifan = 1 and b.pemberhentian = 1 and d.durasi like '$durasi'";

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
                $kapasitas = "b.kapasitas like '$kapAwal' and";
            } else {
                $kapasitas = "b.kapasitas like '$kapAwal' and";
            }
        } else {
            $kapasitas = "b.kapasitas between '$kapAwal' and '$kapAkhir' and";
        }

        $sql = "select a.id_gedung, b.id_ruangan, a.nama_gedung, a.lokasi, b.nama_ruangan, jg.jenis_gedung, b.ukuran, b.kapasitas, b.harga_jam, b.harga_harian, 
        b.harga_mingguan, b.harga_bulanan, b.deskripsi, f.fasilitas, g.gambar, d.durasi
        from gedung a 
        left outer join ruangan b 
        on a.id_gedung = b.gedung_id_gedung 
        left outer join jenis_gedung jg 
        on a.id_jenis = jg.id_jenis_gedung 
        left outer join view_fasilitas f 
        on b.id_ruangan = f.id_ruangan  
        left outer join view_gambar g 
        on f.id_ruangan = g.id_ruangan
        left outer join durasi d 
        on b.id_ruangan = d.id_ruangan
        where $kapasitas a.lokasi like '$lokasi' and b.pengaktifan = 1 and b.pemberhentian = 1 and d.durasi like '$durasi'
        limit $limitation";

        // print_r($sql);

        return $this->db->query($sql)->result();
    }

    public function detail($id, $durasi)
    {
        $sql = "select a.id_gedung, a.id_penyedia, b.id_ruangan, a.nama_gedung, a.lokasi, b.nama_ruangan, jg.jenis_gedung, b.ukuran, b.kapasitas, b.harga_jam, b.harga_harian, 
        b.harga_mingguan, b.harga_bulanan, b.deskripsi, f.fasilitas, g.gambar, d.durasi
        from gedung a 
        left outer join ruangan b 
        on a.id_gedung = b.gedung_id_gedung 
        left outer join jenis_gedung jg 
        on a.id_jenis = jg.id_jenis_gedung 
        left outer join view_fasilitas f 
        on b.id_ruangan = f.id_ruangan  
        left outer join view_gambar g 
        on f.id_ruangan = g.id_ruangan
        left outer join durasi d 
        on b.id_ruangan = d.id_ruangan
        where b.id_ruangan='$id' and d.durasi='$durasi'";

        // print_r($sql);

        return $this->db->query($sql)->result();
    }

    public function harga($id, $durasi)
    {
        if ($durasi == 'Jam') {
            $harga = "b.harga_jam as harga";
        } elseif ($durasi == 'Hari') {
            $harga = "b.harga_harian as harga";
        } elseif ($durasi == 'Minggu') {
            $harga = "b.harga_mingguan as harga";
        } else {
            $harga = "b.harga_bulanan as harga";
        }

        $sql = "select $harga
        from gedung a 
        left outer join ruangan b 
        on a.id_gedung = b.gedung_id_gedung 
        left outer join jenis_gedung jg 
        on a.id_jenis = jg.id_jenis_gedung 
        left outer join view_fasilitas f 
        on b.id_ruangan = f.id_ruangan  
        left outer join view_gambar g 
        on f.id_ruangan = g.id_ruangan
        left outer join durasi d 
        on b.id_ruangan = d.id_ruangan
        where b.id_ruangan='$id' and d.durasi='$durasi'";

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
        join pembayaran py
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
        $sql = "select a.id_gedung, a.id_penyedia, b.id_ruangan, a.nama_gedung, a.lokasi, b.nama_ruangan, jg.jenis_gedung, b.ukuran, b.kapasitas, b.harga_jam, b.harga_harian, 
        b.harga_mingguan, b.harga_bulanan, b.deskripsi, f.fasilitas, g.gambar, d.durasi, p.kode_pemesanan, p.tgl_pemesanan, p.mulai_penyewaan, p.selesai_penyewaan, p.tipe_durasi, 
        p.jml_durasi, py.metode_pembayaran, py.total_pembayaran, py.bukti_pembayaran, py.status_bukti, py.aktivasi
        from gedung a 
        left outer join ruangan b 
        on a.id_gedung = b.gedung_id_gedung 
        left outer join jenis_gedung jg 
        on a.id_jenis = jg.id_jenis_gedung 
        left outer join view_fasilitas f 
        on b.id_ruangan = f.id_ruangan  
        left outer join view_gambar g 
        on f.id_ruangan = g.id_ruangan
        left outer join durasi d 
        on b.id_ruangan = d.id_ruangan
        left outer join transaksi t 
        on b.id_ruangan = t.id_ruangan
        left outer join pemesanan p 
        on t.id_pemesanan = p.id_pemesanan 
        left outer join pembayaran py
        on t.id_pembayaran = py.id_pembayaran
        where p.id_pemesan='$id_pemesan' and p.id_pemesanan='$id_pemesanan' and d.durasi='$durasi'";

        return $this->db->query($sql)->result();
    }

    public function addBuktiPembayaran($nama, $img, $kode_pemesanan)
    {
        $sql = "update pembayaran set nama_bukti='$nama', bukti_pembayaran='$img', status_bukti='1' where kode_pemesanan='$kode_pemesanan'";

        $this->db->query($sql);
    }
}