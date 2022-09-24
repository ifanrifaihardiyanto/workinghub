<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Manageruangan_model extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
    }

    public function getDataGedung_by_partner_id($id)
    {
        $sql = "select b.id_gedung, b.nama_gedung from partner a left outer join gedung b on a.id_penyedia = b.penyedia_id_penyedia where a.id_penyedia='$id'";

        $count = $this->db->query($sql);
        $count = $count->num_rows();
        
        if($count > 0){
			return $this->db->query($sql)->result();
		} else {
			return [(object) [
                'id_gedung' => "0",
                'nama_gedung' => "No Data"
            ]];
		}
    }

    public function getJenisGedung()
    {
        $sql = "select jenis_gedung from jenis_gedung";

        $count = $this->db->query($sql);
        $count = $count->num_rows();
        
        if($count > 0){
			return $this->db->query($sql)->result();
		} else {
			return [(object) ['jenis_gedung' => "Data tidak ditemukan, silahkan input jenis gedung!"]];
		}
    }

    public function insertJenisGedung($jnsGedung)
    {
        $sql = "insert into jenis_gedung (jenis_gedung) values ('$jnsGedung')";

        $this->db->query($sql);
    }

    public function getinsertJenisGedung($jnsGedung)
    {
        $sql = "select * from jenis_gedung where jenis_gedung='$jnsGedung'";

        return $this->db->query($sql)->result();
    }

    public function insertGedung($idJnsGedung, $nmGedung, $lokasi, $kota, $email, $noTelp, $user_id)
    {
        $sql = "insert into gedung (nama_gedung, lokasi, kota, email, no_tlp, penyedia_id_penyedia, jenis_id_jenis) 
        values 
        ('$nmGedung','$lokasi','$kota','$email','$noTelp','$user_id','$idJnsGedung')";

        $this->db->query($sql);
    }

    public function find_idgedung_by_id($nmGedung)
    {
        $sql = "select * from gedung where nama_gedung='$nmGedung'";

        return $this->db->query($sql)->result();
    }

    public function insertRuangan($id_gedung, $nmRuangan, $ukuran, $kapasitas, $hargaJam, $hargaHarian, $hargaMingguan, $hargaBulanan, $deskripsi, $pengaktifan, $pemberhentian, $user_id)
    {
        $sql = "insert into ruangan (nama_ruangan, ukuran, kapasitas, harga_jam, harga_harian, harga_mingguan, harga_bulanan, deskripsi, pengaktifan, pemberhentian, gedung_id_gedung, gedung_penyedia_id_penyedia) 
        values 
        ('$nmRuangan','$ukuran','$kapasitas','$hargaJam','$hargaHarian','$hargaMingguan','$hargaBulanan','$deskripsi','$pengaktifan','$pemberhentian','$id_gedung','$user_id')";

        $this->db->query($sql);
    }

    public function find_idruangan_by_id($nmRuangan, $idGedung)
    {
        $sql = "select * from ruangan where nama_ruangan='$nmRuangan' and gedung_id_gedung='$idGedung'";

        return $this->db->query($sql)->result();
    }

    public function insertFasilitas($fasilitas, $id_ruangan)
    {
        $sql = "insert into fasilitas (fasilitas, id_ruangan) values ('$fasilitas','$id_ruangan')";

        $this->db->query($sql);
    }

    public function insertDurasi($durasi, $id_ruangan)
    {
        $sql = "insert into durasi (durasi, id_ruangan) values ('$durasi','$id_ruangan')";

        $this->db->query($sql);
    }

    public function insertImage($name, $image, $type, $id_gedung, $id_ruangan, $id_user)
    {
        $sql = "insert into gambar (nama, gambar, type, ruangan_id_ruangan, ruangan_gedung_id_gedung, ruangan_gedung_penyedia_id_penyedia) 
        values ('$name','$image','$type','$id_ruangan','$id_gedung','$id_user')";

        $this->db->query($sql);
    }

    public function find_data_ruangan()
    {
        $sql = "select a.id_gedung, b.id_ruangan, a.nama_gedung, b.nama_ruangan, jg.jenis_gedung, b.ukuran, b.kapasitas, 
        b.harga_jam, b.harga_harian, b.harga_mingguan, b.harga_bulanan, b.deskripsi, b.pengaktifan, b.pemberhentian, 
        f.fasilitas, d.durasi, g.gambar
        from gedung a 
        left outer join ruangan b 
        on a.id_gedung = b.gedung_id_gedung 
        left outer join jenis_gedung jg 
        on a.jenis_id_jenis = jg.id_jenis_gedung 
        left outer join view_fasilitas f 
        on b.id_ruangan = f.id_ruangan 
        left outer join view_durasi d  
        on b.id_ruangan = d.id_ruangan 
        left outer join view_gambar g
        on f.id_ruangan = g.ruangan_id_ruangan
        order by a.nama_gedung asc, b.nama_ruangan asc, b.pemberhentian asc, b.pemberhentian asc";

        // print_r($sql);

        return $this->db->query($sql)->result();
    }

    public function find_fasilitas($id_ruangan)
    {
        $sql = "select * from fasilitas where id_ruangan='$id_ruangan'";

        return $this->db->query($sql)->result();
    }

    public function nonaktif($pemberhentian, $id, $user_id)
    {
        $sql = "update ruangan set pengaktifan='3', pemberhentian='0' where id_ruangan='$id'";

        $this->db->query($sql);

        $insert_alasan = "insert into pemberhentian_sewa (alasan, id_user, id_ruangan) values ('$pemberhentian','$user_id','$id')";
        $this->db->query($insert_alasan);
    }

    public function edit($id, $nmRuangan, $ukuran, $kapasitas, $hargaJam, $hargaHarian, $hargaMingguan, $hargaBulanan, $deskripsi, $nmUpload, $cntUpload)
    {
        $sql = "update ruangan set nama_ruangan='$nmRuangan', deskripsi='$deskripsi', ukuran='$ukuran', kapasitas='$kapasitas',
        harga_jam='$hargaJam', harga_harian='$hargaHarian', harga_mingguan='$hargaMingguan', harga_bulanan='$hargaBulanan'
        where id_ruangan='$id'";
        $this->db->query($sql);

        $delete_fas = "delete from fasilitas where id_ruangan='$id'";
        $this->db->query($delete_fas);

        $delete_durasi = "delete from durasi where id_ruangan='$id'";
        $this->db->query($delete_durasi);

        if ($cntUpload >= 1 && $nmUpload != '') {
            $delete_img = "delete from gambar where ruangan_id_ruangan='$id'";
            $this->db->query($delete_img);
        }
    }
}