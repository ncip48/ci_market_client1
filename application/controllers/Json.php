<?php

defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . '/libraries/REST_Controller.php';
use Restserver\Libraries\REST_Controller;

class json extends REST_Controller {

    function __construct($config = 'rest') {
        parent::__construct($config);
        $this->load->database();
    }

    //Menampilkan data kontak
    function produk_get() {
        $type = $_GET['type'];
		$page = $_GET['page'];
			$record = $this->model_app->view_ordering_limit('tb_produk','id_produk','DESC','0',$page)->result_array();
			$produk = $this->db->query("SELECT id_produk,nama_produk,harga_konsumen,diskon FROM tb_produk ORDER BY id_produk DESC LIMIT $page")->result_object();
			$j = $this->db->query("SELECT id_produk, CASE WHEN SUM(jumlah) = 0 THEN '0' ELSE SUM(jumlah) END as jual FROM `tb_penjualan` a JOIN tb_penjualan_detail b ON a.id_penjualan=b.id_penjualan where a.proses!='0' GROUP BY b.id_produk")->result();
			$b = $this->db->query("SELECT id_produk, sum(jumlah_pesan) as beli FROM `tb_pembelian_detail` GROUP BY id_produk")->result();
			$stok = $this->db->query("SELECT b.id_produk, (SUM(c.jumlah_pesan)-SUM(b.jumlah)) AS stok FROM tb_penjualan a JOIN tb_penjualan_detail b ON a.id_penjualan=b.id_penjualan JOIN tb_pembelian_detail c ON b.id_produk=c.id_produk WHERE a.proses!='0' GROUP BY b.id_produk")->result();
			//$j = $this->model_app->jual_umum($row['id_produk'])->row_array();
			//$b = $this->model_app->beli_umum($row['id_produk'])->row_array();
			//$stok = $b['beli']-$j['jual'];
			/*foreach($record as $row){
				$j = $this->model_app->jual_umum($row['id_produk'])->row_array();
				$b = $this->model_app->beli_umum($row['id_produk'])->row_array();
				$stok = $b['beli']-$j['jual'];
				$data = array(
					'produk' => $row[id_produk]
				);
				echo json_encode($data);
			}*/
			//$produk = $this->db->query("SELECT * FROM tb_produk a JOIN tb_penjualan_detail b ON b.id_produk=a.id_produk JOIN tb_penjualan c ON b.id_penjualan=c.id_penjualan ORDER BY a.id_produk DESC LIMIT $page")->result();
            $data = [];
            $data = array(
				'produk' => $produk,
				'jual' => $j,
				'beli' => $b,
				'stok' => $stok
			);
        $this->response($data, REST_Controller::HTTP_OK);
    }

    //Masukan function selanjutnya disini
}
?>