<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

defined('BASEPATH') or exit('No direct script access allowed');

class Typegudang extends MY_Controller {

    public function __construct() {
        parent::__construct();

        $this->load->model(
                array(
                    'TypeGudangModel',
                    "DetailPembelianPersediaanModel",
                    'SupplierModel',
                    'DetailJenisSupplierModel',
                    "DetailPengeluaranGudangModel",
                    "ViewModel"
                )
        );
    }

    public function index() {
        $data = array();

        if (null !== ($this->input->post("submit"))) {
            $data = [
                'keterangan' => $this->input->post("keterangan"),
            ];

            $this->TypeGudangModel->set($data);

            redirect(current_url());
        }

        if (null !== ($this->input->post("put"))) {
            $data = [
                'keterangan' => $this->input->post("keterangan"),
            ];

            $this->TypeGudangModel->put($data, $this->input->post('id'));

            redirect(current_url());
        }

        if (null !== ($this->input->post("del"))) {

            $this->TypeGudangModel->del($this->input->post('id'));

            redirect(current_url());
        }

        $per_page = 3;

        $pagination = $this->getConfigPagination(site_url('typegudang/index'), $this->TypeGudangModel->countAll(), $per_page);
        $this->data['pagination'] = $this->pagination($pagination);

        $this->data['page'] = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
        $this->data['per_page'] = $per_page;
        $this->data['type_gudang'] = $this->TypeGudangModel->get($this->data['per_page'], $this->data['page']);



        $this->blade->view("page.type_gudang", $this->data);
    }

    public function pembelian() {
        $id_admin = null;
        $id_karyawan = null;

        if ($this->data['head']['type'] == "admin") {
            $id_admin = $this->data['head']['username']->id;
        } else {
            $id_karyawan = $this->data['head']['username']->id;
        }

        if (null !== ($this->input->post("submit"))) {
            $data = [
                'id_detail_pembelian_gudang' => $this->DetailPembelianPersediaanModel->newId(),
                "id_supplier" => $this->input->post("supplier"),
                "id_persediaan" => $this->input->post("persediaan"),
                "id_karyawan" => $id_karyawan,
                "id_admin" => $id_admin,
                "tanggal" => $this->input->post("tanggal"),
                "jumlah" => $this->input->post("jumlah"),
            ];

            $this->DetailPembelianPersediaanModel->set($data);

            redirect(current_url());
        }

        if (null !== ($this->input->post("put"))) {
            $data = [
                "id_supplier" => $this->input->post("supplier"),
                "id_persediaan" => $this->input->post("persediaan"),
                "update_by_karyawan" => $id_karyawan,
                "update_by_admin" => $id_admin,
                "tanggal" => $this->input->post("tanggal"),
                "jumlah" => $this->input->post("jumlah")
            ];

            $this->DetailPembelianPersediaanModel->put($this->input->post('id'), $data);

            redirect(current_url());
        }

        if (null !== ($this->input->post("del"))) {
            $this->DetailPembelianPersediaanModel->del($this->input->post('id'));

            redirect(current_url());
        }

        $per_page = 3;

        $pagination = $this->getConfigPagination(site_url('typegudang/pembelian'), $this->DetailPembelianPersediaanModel->countAll(), $per_page);
        $this->data['pagination'] = $this->pagination($pagination);

        $this->data['page'] = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
        $this->data['per_page'] = $per_page;
        $this->data['data'] = $this->DetailPembelianPersediaanModel->get($this->data['per_page'], $this->data['page']);

        $this->data['supplier'] = $this->SupplierModel->get();
        $this->data['type_gudang'] = $this->TypeGudangModel->get();

        $this->blade->view("page.transaksi.persediaan.pembelian", $this->data);
    }

    public function penjualan() {
        $id_admin = null;
        $id_karyawan = null;

        if ($this->data['head']['type'] == "admin") {
            $id_admin = $this->data['head']['username']->id;
        } else {
            $id_karyawan = $this->data['head']['username']->id;
        }

        if (null !== ($this->input->post("submit"))) {
            $data = [
                'id_detail_pengeluaran_gudang' => $this->DetailPengeluaranGudangModel->newId(),
                "id_persediaan" => $this->input->post("persediaan"),
                "id_karyawan" => $id_karyawan,
                "id_admin" => $id_admin,
                "tanggal" => $this->input->post("tanggal"),
                "jumlah" => $this->input->post("jumlah"),
                'keterangan' => $this->input->post("keterangan")
            ];

            $this->DetailPengeluaranGudangModel->set($data);

            redirect(current_url());
        }

        if (null !== ($this->input->post("put"))) {
            $data = [
                "id_persediaan" => $this->input->post("persediaan"),
                "id_karyawan" => $this->input->post("karyawan"),
                "tanggal" => $this->input->post("tanggal"),
                "jumlah" => $this->input->post("jumlah"),
                'keterangan' => $this->input->post("keterangan"),
                "update_by_admin" => $id_admin,
                "update_by_karyawan" => $id_karyawan
            ];

            $this->DetailPengeluaranGudangModel->put($this->input->post('id'), $data);

            redirect(current_url());
        }


        if (null !== $this->input->post("del")) {

            $this->DetailPengeluaranGudangModel->del($this->input->post("id"));
            redirect(current_url());
        }


        $per_page = 3;

        $pagination = $this->getConfigPagination(site_url('typegudang/penjualan'), $this->DetailPengeluaranGudangModel->countAll(), $per_page);
        $this->data['pagination'] = $this->pagination($pagination);

        $this->data['page'] = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
        $this->data['per_page'] = $per_page;
        $this->data['data'] = $this->DetailPengeluaranGudangModel->get($this->data['per_page'], $this->data['page']);

        $this->data['supplier'] = $this->SupplierModel->get();
        $this->data['type_gudang'] = $this->TypeGudangModel->get();
        $this->data['kandang'] = $this->KandangModel->get();

        $this->blade->view("page.transaksi.persediaan.penjualan", $this->data);
    }

    public function jumlah() {
        $per_page = 3;

        $pagination = $this->getConfigPagination(site_url('typegudang/jumlah'), $this->ViewModel->viewJumlahPersediaanCountAll(), $per_page);
        $this->data['pagination'] = $this->pagination($pagination);

        $this->data['page'] = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
        $this->data['per_page'] = $per_page;
        $this->data['data'] = $this->ViewModel->viewJumlahPersediaan($this->data['per_page'], $this->data['page']);

        $this->blade->view("page.kandang.jumlah_persediaan", $this->data);
    }

}