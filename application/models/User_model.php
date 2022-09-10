<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User_model extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
    }

    public function getUser($id)
    {
        $sql = "select * from user where id_user='$id'";

        return $this->db->query($sql)->result();
    }
}