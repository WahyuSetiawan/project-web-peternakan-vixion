<?php


class DetailPenjualanAyamModel extends CI_Model {

    var $table = "detail_penjualan_ayam";

    public function __construct() {
        parent::__construct();
    }

    function get($limit = null, $offset = null, $id_pembelian_ayam = null) {
        if ($limit != null && $offset != null) {
            $this->db->limit($limit, $offset);
        }

        if ($id_pembelian_ayam != null) {
            $this->db->where('id_detail_penjualan_ayam', $id_pembelian_ayam);
        }

        return $this->db->get($this->table)->result();
    }

    function set($data) {
        $this->db->set("id_detail_penjualan_ayam", $this->newId());
        $this->db->insert($this->table, $data);
    }

    function put($id, $data) {
        $this->db->where('id_detail_penjualan_ayam', $id);
        $this->db->update($this->table, $data);
    }

    function remove($id) {
        $this->db->where('id_detail_penjualan_ayam', $id);
        $this->db->delete($this->table);
    }

    function countAll() {
        return $this->db->count_all($this->table);
    }

    function newId() {
        $this->db->select('function_id_detail_penjualan_ayam() as id');
        $data = $this->db->get()->row();
        return $data->id;
    }

}