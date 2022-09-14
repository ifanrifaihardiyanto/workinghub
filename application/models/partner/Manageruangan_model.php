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

    public function find_idruangan_by_id($nmRuangan)
    {
        $sql = "select * from ruangan where nama_ruangan='$nmRuangan'";

        return $this->db->query($sql)->result();
    }

    public function insertFasilitas($fasilitas, $id_ruangan)
    {
        $sql = "insert into fasilitas (fasilitas, id_ruangan) values ('$fasilitas','$id_ruangan')";

        $this->db->query($sql);
    }

    public function find_data_ruangan()
    {
        $sql = "select a.id_gedung, b.id_ruangan, a.nama_gedung, b.nama_ruangan, jg.jenis_gedung, b.ukuran, b.kapasitas, 
        b.harga_jam, b.harga_harian, b.harga_mingguan, b.harga_bulanan, b.deskripsi, b.pengaktifan, b.pemberhentian, 
        group_concat(f.fasilitas separator ', ') as fasilitas
        from gedung a
        left outer join ruangan b
        on a.id_gedung = b.gedung_id_gedung
        left outer join jenis_gedung jg
        on a.jenis_id_jenis = jg.id_jenis_gedung 
        left outer join fasilitas f 
        on b.id_ruangan = f.id_ruangan
        group by a.id_gedung, b.id_ruangan, a.nama_gedung, b.nama_ruangan, jg.jenis_gedung, b.ukuran, b.kapasitas, 
        b.harga_jam, b.harga_harian, b.harga_mingguan, b.harga_bulanan, b.deskripsi, b.pengaktifan, b.pemberhentian";

        return $this->db->query($sql)->result();
    }

    public function find_fasilitas($id_ruangan)
    {
        $sql = "select * from fasilitas where id_ruangan='$id_ruangan'";

        return $this->db->query($sql)->result();
    }

    public function nonaktif($id)
    {
        $sql = "update ruangan set pemberhentian='0' where id_ruangan='$id'";

        $this->db->query($sql);
    }

    public function edit($id, $nmRuangan, $ukuran, $kapasitas, $hargaJam, $hargaHarian, $hargaMingguan, $hargaBulanan, $deskripsi)
    {
        $sql = "update ruangan set nama_ruangan='$nmRuangan', deskripsi='$deskripsi', ukuran='$ukuran', kapasitas='$kapasitas',
        harga_jam='$hargaJam', harga_harian='$hargaHarian', harga_mingguan='$hargaMingguan', harga_bulanan='$hargaBulanan'
        where id_ruangan='$id'";
        $this->db->query($sql);

        $delete = "delete from fasilitas where id_ruangan='$id'";
        $this->db->query($delete);
    }
}