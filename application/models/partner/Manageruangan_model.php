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
        $sql = "select b.id, b.name from partner a left outer join gedung b on a.id = b.id_penyedia where a.id='$id'";

        // print_r($sql);

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
        $sql = "select type from jenis_gedung";

        $count = $this->db->query($sql);
        $count = $count->num_rows();
        
        if($count > 0){
			return $this->db->query($sql)->result();
		} else {
			return [(object) ['type' => "Data tidak ditemukan, silahkan input jenis gedung!"]];
		}
    }

    public function insertJenisGedung($jnsGedung)
    {
        $sql = "insert into jenis_gedung (type) values ('$jnsGedung')";

        $this->db->query($sql);
    }

    public function getinsertJenisGedung($jnsGedung)
    {
        $sql = "select * from jenis_gedung where jenis_gedung='$jnsGedung'";

        return $this->db->query($sql)->result();
    }

    public function insertGedung($idJnsGedung, $nmGedung, $lokasi, $kota, $email, $noTelp, $user_id)
    {
        $sql = "insert into gedung (name, location, city, email, no_tlp, id_penyedia, id_jenis) 
        values 
        ('$nmGedung','$lokasi','$kota','$email','$noTelp','$user_id','$idJnsGedung')";

        $this->db->query($sql);
    }

    public function find_idgedung_by_id($nmGedung)
    {
        $sql = "select * from gedung where nama_gedung='$nmGedung'";

        return $this->db->query($sql)->result();
    }

    public function insertRuangan($id_gedung, $nmRuangan, $ukuran, $kapasitas, $hargaJam, $hargaHarian, $hargaMingguan, $hargaBulanan, $deskripsi, $activation, $pemberhentian, $user_id)
    {
        $sql = "insert into ruangan (name, size, capacity, hourly_price, daily_price, weekly_price, monthly_price, description, activation, discontinue, id_gedung, id_penyedia) 
        values 
        ('$nmRuangan','$ukuran','$kapasitas','$hargaJam','$hargaHarian','$hargaMingguan','$hargaBulanan','$deskripsi','$activation','$pemberhentian','$id_gedung','$user_id')";

        $this->db->query($sql);
    }

    public function find_idruangan_by_id($nmRuangan, $idGedung)
    {
        $sql = "select * from ruangan where name='$nmRuangan' and id_gedung='$idGedung'";

        return $this->db->query($sql)->result();
    }

    public function insertFasilitas($fasilitas, $id_ruangan)
    {
        $sql = "insert into fasilitas (facility, id_ruangan) values ('$fasilitas','$id_ruangan')";

        $this->db->query($sql);
    }

    public function insertDurasi($durasi, $id_ruangan)
    {
        $sql = "insert into durasi (duration, id_ruangan) values ('$durasi','$id_ruangan')";

        $this->db->query($sql);
    }

    public function insertImage($name, $image, $type, $id_gedung, $id_ruangan, $id_user)
    {
        $sql = "insert into gambar (name, image, type, id_ruangan, id_gedung, id_penyedia) 
        values ('$name','$image','$type','$id_ruangan','$id_gedung','$id_user')";

        $this->db->query($sql);
    }

    public function find_data_ruangan()
    {
        $sql = "select a.id as id_gedung, b.id as id_ruangan, a.name as nama_gedung, b.name as nama_ruangan, jg.type, b.size, b.capacity, 
        b.hourly_price, b.daily_price, b.weekly_price, b.monthly_price, b.description, b.activation, b.discontinue, 
        f.facility, d.duration, g.image
        from gedung a 
        left outer join ruangan b 
        on a.id = b.id_gedung 
        left outer join jenis_gedung jg 
        on a.id_jenis = jg.id
        left outer join view_fasilitas f 
        on b.id = f.id_ruangan 
        left outer join view_durasi d  
        on b.id = d.id_ruangan 
        left outer join view_gambar g
        on f.id_ruangan = g.id_ruangan
        order by a.name asc, b.name asc, b.activation asc, b.discontinue asc";

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
        $sql = "update ruangan set activation='3', discontinue='0' where id='$id'";

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
            $delete_img = "delete from gambar where id_ruangan='$id'";
            $this->db->query($delete_img);
        }
    }
}