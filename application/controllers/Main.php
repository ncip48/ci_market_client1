<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Main extends CI_Controller
{
	function index()
	{
		$id = $this->session->userdata('id_konsumen');
		$data['title'] = title();
		$data['iden'] = $this->db->query("SELECT * FROM identitas where id_identitas='1'")->row_array();
		$data['kategori'] = $this->model_app->view('tb_kategori_produk');
		if($id != null){
			$data['produk'] = $this->db->query("SELECT * FROM tb_produk a JOIN tb_penjual b ON a.id_penjual=b.id_penjual JOIN tb_followers c ON b.id_konsumen=c.id_konsumen JOIN tb_user d ON c.id_konsumen=d.id_konsumen WHERE c.id_following = $id ")->result_array();
			$data['post'] = $this->db->query("SELECT * FROM tb_post a JOIN tb_user b ON a.id_konsumen=b.id_konsumen JOIN tb_followers c ON b.id_konsumen=c.id_konsumen WHERE c.id_following = $id")->result_array();
		}
		$this->template->load('phpmu-one/template', 'phpmu-one/main', $data);
		//redirect(base_url());

	}
}
