<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function dashboard_partner()
    {
        $sql = "select roomAmt, roomAmt_menunggu, roomAmt_disewakan, roomAmt_dihentikan, roomAmt_ditolak, roomAmt_nonAktif 
        from
        (select case when coalesce(count(*),0) is null then 0 else coalesce(count(*),0) end roomAmt from room r where id_penyedia='2') a,
        (select case when coalesce(count(*),0) is null then 0 else coalesce(count(*),0) end roomAmt_menunggu from room r where id_penyedia='2' and activation='0' and discontinue='1') b,
        (select case when coalesce(count(*),0) is null then 0 else coalesce(count(*),0) end roomAmt_disewakan from room r where id_penyedia='2' and activation='1' and discontinue='1') c,
        (select case when coalesce(count(*),0) is null then 0 else coalesce(count(*),0) end roomAmt_dihentikan from room r where id_penyedia='2' and activation='1' and discontinue='0') d,
        (select case when coalesce(count(*),0) is null then 0 else coalesce(count(*),0) end roomAmt_ditolak from room r where id_penyedia='2' and activation='2') e,
        (select case when coalesce(count(*),0) is null then 0 else coalesce(count(*),0) end roomAmt_nonAktif from room r where id_penyedia='2' and activation='3') f";

        return $this->db->query($sql)->row();
    }

    public function dashboard_admin()
    {
        $sql = "select all_cust, cust_active, cust_nonactive, all_part, part_active, part_nonactive, all_orders, active, menunggu, pending, expired
        from
        (select case when coalesce(count(*),0) is null then 0 else coalesce(count(*),0) end all_cust from `user` u where `role`='Customer') a,
        (select case when coalesce(count(*),0) is null then 0 else coalesce(count(*),0) end cust_active from `user` u where `role`='Customer' and activation='1') b,
        (select case when coalesce(count(*),0) is null then 0 else coalesce(count(*),0) end cust_nonactive from `user` u where `role`='Customer' and activation='0') c,
        (select case when coalesce(count(*),0) is null then 0 else coalesce(count(*),0) end all_part from `user` u where `role`='Partner') d,
        (select case when coalesce(count(*),0) is null then 0 else coalesce(count(*),0) end part_active from `user` u where `role`='Partner' and activation='1') e,
        (select case when coalesce(count(*),0) is null then 0 else coalesce(count(*),0) end part_nonactive from `user` u where `role`='Partner' and activation='0') f,
        (select case when coalesce(count(*),0) is null then 0 else coalesce(count(*),0) end all_orders from `order` o join payment p on o.id = p.order_id) g,
        (select case when coalesce(count(*),0) is null then 0 else coalesce(count(*),0) end active from `order` o join payment p on o.id = p.order_id where p.status_code='200' and p.activation='1') h,
        (select case when coalesce(count(*),0) is null then 0 else coalesce(count(*),0) end menunggu from `order` o join payment p on o.id = p.order_id where p.status_code='200' and p.activation='0') i,
        (select case when coalesce(count(*),0) is null then 0 else coalesce(count(*),0) end pending from `order` o join payment p on o.id = p.order_id where p.status_code='201') j,
        (select case when coalesce(count(*),0) is null then 0 else coalesce(count(*),0) end expired from `order` o join payment p on o.id = p.order_id where p.status_code='202') k";

        return $this->db->query($sql)->row();
    }
}