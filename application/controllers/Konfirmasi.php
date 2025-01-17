<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Konfirmasi extends CI_Controller {
	function index(){
		$id = $this->uri->segment(3);
		if (isset($_POST['submit'])){
			$config['upload_path'] = 'asset/bukti_transfer/';
            $config['allowed_types'] = 'gif|jpg|png|jpeg';
            $config['max_size'] = '10000'; // kb
            $this->load->library('upload', $config);
            $this->upload->do_upload('f');
            $hasil=$this->upload->data();
            if ($hasil['file_name']==''){
				$data = array('id_penjualan'=>$this->input->post('id'),
			        		  'total_transfer'=>$this->input->post('b'),
			        		  'id_rekening'=>$this->input->post('c'),
			        		  'nama_pengirim'=>$this->input->post('d'),
			        		  'tanggal_transfer'=>$this->input->post('e'),
			        		  'waktu_konfirmasi'=>date('Y-m-d H:i:s'));
				$this->model_app->insert('tb_konfirmasi',$data);
			}else{
				$data = array('id_penjualan'=>$this->input->post('id'),
			        		  'total_transfer'=>$this->input->post('b'),
			        		  'id_rekening'=>$this->input->post('c'),
			        		  'nama_pengirim'=>$this->input->post('d'),
			        		  'tanggal_transfer'=>$this->input->post('e'),
			        		  'bukti_transfer'=>$hasil['file_name'],
			        		  'waktu_konfirmasi'=>date('Y-m-d H:i:s'));
				$this->model_app->insert('tb_konfirmasi',$data);
			}
				$data1 = array('proses'=>'2');
				$where = array('id_penjualan' => $this->input->post('id'));
				$this->model_app->update('tb_penjualan', $data1, $where);
				echo $this->session->set_flashdata('message', '<div class="alert alert-info"><center>Success Melakukan Konfirmasi pembayaran... <br>
                                                                          akan segera kami cek dan proses!</center></div>');
			redirect('konfirmasi/index');
		}else{
			$data['title'] = 'Konfirmasi Orderan anda';
			if (isset($_POST['submit1'])){
				$kode_transaksi = filter($this->input->post('a'));
				$row = $this->db->query("SELECT id_penjualan FROM `tb_penjualan` where kode_transaksi='$kode_transaksi'")->row_array();
				$data['record'] = $this->model_app->view('tb_rekening');

				$data['total'] = $this->db->query("SELECT a.kode_transaksi, a.kurir, a.service, a.proses, a.ongkir, sum((b.harga_jual*b.jumlah)-(c.diskon*b.jumlah)) as total, sum(c.berat*b.jumlah) as total_berat FROM `tb_penjualan` a JOIN tb_penjualan_detail b ON a.id_penjualan=b.id_penjualan JOIN tb_produk c ON b.id_produk=c.id_produk where a.id_penjualan='$row[id_penjualan]'")->row_array();
				$data['rows'] = $this->model_app->view_where('tb_penjualan',array('id_penjualan'=>$row['id_penjualan']))->row_array();
				$data['ksm'] = $this->model_app->view_where('tb_user',array('id_konsumen'=>$this->session->id_konsumen))->row_array();
				$this->template->load('phpmu-one/template','phpmu-one/pengunjung/view_konfirmasi_pembayaran',$data);
			}else{
				$this->template->load('phpmu-one/template','phpmu-one/pengunjung/view_konfirmasi_pembayaran',$data);
			}
		}
	}

	function tracking(){
		if (isset($_POST['submit1']) OR $this->uri->segment(3)!=''){
			if ($this->uri->segment(3)!=''){
				$kode_transaksi = filter($this->uri->segment(3));
			}else{
				$kode_transaksi = filter($this->input->post('a'));
			}

			$cek = $this->model_app->view_where('tb_penjualan',array('kode_transaksi'=>$kode_transaksi));
			if ($cek->num_rows()>=1){
				$data['title'] = 'Tracking Order '.$kode_transaksi;
				$data['kode_transaksi'] = $kode_transaksi;
				$data['rows'] = $this->db->query("SELECT * FROM tb_penjualan a JOIN tb_user b ON a.id_pembeli=b.id_konsumen JOIN tb_kota c ON b.kota_id=c.kota_id where a.kode_transaksi='$kode_transaksi'")->row_array();
				$data['record'] = $this->db->query("SELECT a.kode_transaksi, b.*, c.nama_produk, c.satuan, c.berat, c.diskon, c.produk_seo FROM `tb_penjualan` a JOIN tb_penjualan_detail b ON a.id_penjualan=b.id_penjualan JOIN tb_produk c ON b.id_produk=c.id_produk where a.kode_transaksi='".$kode_transaksi."'");
				$data['total'] = $this->db->query("SELECT a.resi, a.kode_transaksi, a.kurir, a.service, a.proses, a.ongkir, sum((b.harga_jual*b.jumlah)-(c.diskon*b.jumlah)) as total, sum(c.berat*b.jumlah) as total_berat FROM `tb_penjualan` a JOIN tb_penjualan_detail b ON a.id_penjualan=b.id_penjualan JOIN tb_produk c ON b.id_produk=c.id_produk where a.kode_transaksi='".$kode_transaksi."'")->row_array();
				$this->template->load('phpmu-one/template','phpmu-one/pengunjung/view_tracking_view',$data);
			}else{
				redirect('konfirmasi/tracking');
			}
		}else{
			$data['title'] = 'Tracking Order';
			$this->template->load('phpmu-one/template','phpmu-one/pengunjung/view_tracking',$data);
		}
	}
}
