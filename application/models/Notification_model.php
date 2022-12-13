<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Notification_model extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
    }

    public function getData($id_user)
    {
        $sql = "select notification from notifications where id_user='$id_user'";

        return $this->db->query($sql)->result();
    }
}