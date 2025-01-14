<?php

class DetailPenjualanAyamModel extends CI_Model
{

    public static $table = "tb_detail_penjualan_ayam";

    public function __construct()
    {
        parent::__construct();
    }

    public function select($id_pembelian_ayam = false, $params = [])
    {
        if (isset($params['kandang'])) {
            $this->db->where(self::$table.".id_kandang", $params['kandang']);
        }

        $this->db->select(self::$table . ".*, "
            . KandangModel::$table . ".nama as nama_kandang, "
            . 'DATE_FORMAT(tanggal, "%d-%m-%Y") as tanggal,'
            . KaryawanModel::$table . ".nama as nama_karyawan,"
            . AdminModel::$table . ".nama as nama_admin,"
            . "admin_update.nama as update_by_admin_nama, "
            . "karyawan_update.nama as update_by_karyawan_nama");

        if ($id_pembelian_ayam) {
            $this->db->where("id_detail_penjualan_ayam", $id_pembelian_ayam);
        }

        $this->db->join(KandangModel::$table, KandangModel::$table . ".id_kandang = ".self::$table.".id_kandang", "inner");
        $this->db->join(KaryawanModel::$table, KaryawanModel::$table . ".id_karyawan = ".self::$table.".id_karyawan", "left");
        $this->db->join(AdminModel::$table, AdminModel::$table . ".id = ".self::$table.".id_admin", "left");
        $this->db->join(AdminModel::$table . " as admin_update", "admin_update.id = ".self::$table.".update_by_admin", "left");
        $this->db->join(KaryawanModel::$table . " as karyawan_update", "karyawan_update.id_karyawan = ".self::$table.".update_by_karyawan", "left");
    }

    public function get($limit = false, $offset = false, $id_pembelian_ayam = false, $params = [])
    {
        $this->db->limit($limit, $offset);
        $this->select($id_pembelian_ayam, $params);
        return $this->db->get(self::$table)->result();
    }

    public function set($data)
    {
        $this->db->set("id_detail_penjualan_ayam", $this->newId());
        $this->db->insert(self::$table, $data);
    }

    public function put($id, $data)
    {
        $this->db->where("id_detail_penjualan_ayam", $id);
        $this->db->update(self::$table, $data);
    }

    public function remove($id)
    {
        $this->db->where("id_detail_penjualan_ayam", $id);
        $this->db->delete(self::$table);
    }

    public function countAll($params)
    {
        $this->select(false, $params);
        return count($this->db->get(self::$table)->result());
    }

    public function newId()
    {
        $this->db->select("function_id_detail_penjualan_ayam() as id");
        $data = $this->db->get()->row();
        return $data->id;
    }

}
