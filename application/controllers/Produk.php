<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Produk extends CI_Controller {
	function index(){
		$jumlah= $this->model_app->view('tb_produk')->num_rows();
			$config['base_url'] = base_url().'produk/index';
			$config['total_rows'] = $jumlah;
			$config['per_page'] = 12; 	
			if ($this->uri->segment('3')==''){
				$dari = 0;
			}else{
				$dari = $this->uri->segment('3');
			}
			if (is_numeric($dari)) {
				$data['iklantengah'] = $this->model_iklan->iklan_tengah();
				if ($this->input->post('cari')!=''){
					$data['title'] = title();
					$data['judul'] = "Hasil Pencarian keyword - ".filter($this->input->post('cari'));
					$data['record'] = $this->model_app->cari_produk(filter($this->input->post('cari')));
				}else{
					$data['title'] = title();
					$data['judul'] = 'Semua Produk';
					$data['record'] = $this->model_app->view_ordering_limit('tb_produk','id_produk','DESC',$dari,$config['per_page']);
					$this->pagination->initialize($config);
				}
					$this->template->load('phpmu-one/template','phpmu-one/view_home',$data);
			}else{
				redirect('main');
			}
	}

	public function indexs(){
		$type = $_GET['type'];
		$page = $_GET['page'];
		$search = $_GET['search'];
		$id_kategori = $_GET['id_kategori'];
		if($type == 'json'){
			if($search != ''){
				//if($this->db->query("SELECT id_produk,nama_produk,gambar,harga_konsumen,diskon FROM tb_produk WHERE nama_produk LIKE '%$search%' ORDER BY id_produk DESC LIMIT $page")->num_rows=='1'){
					$produk = $this->db->query("SELECT * FROM tb_produk WHERE nama_produk LIKE '%$search%' ORDER BY id_produk DESC LIMIT $page")->result();
					//$hasil = '1';
					//$prod = $produk->result();
				//}else{
					//$hasil = '0';
				//}
			}else{
			//$record = $this->model_app->view_ordering_limit('tb_produk','id_produk','DESC','0',$page)->result_array();
				if($id_kategori != ''){
					$produk = $this->db->query("SELECT * FROM tb_produk WHERE id_kategori_produk = $id_kategori ORDER BY id_produk DESC LIMIT 6")->result();
				}else{
					$produk = $this->db->query("SELECT * FROM tb_produk ORDER BY id_produk DESC LIMIT $page")->result();
				}
				//$hasil = '1';
				//$prod = $produk->result();
			}
			$j = $this->db->query("SELECT id_produk, CASE WHEN SUM(jumlah) = 0 THEN '0' ELSE SUM(jumlah) END as jual FROM `tb_penjualan` a JOIN tb_penjualan_detail b ON a.id_penjualan=b.id_penjualan where a.proses!='0' GROUP BY b.id_produk");
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
			$data = array(
				'hasil' => $hasil,
				'produk' => $produk,
			);
			echo json_encode($produk);
		}else{
			$jumlah= $this->model_app->view('tb_produk')->num_rows();
			$config['base_url'] = base_url().'produk/index';
			$config['total_rows'] = $jumlah;
			$config['per_page'] = 12; 	
			if ($this->uri->segment('3')==''){
				$dari = 0;
			}else{
				$dari = $this->uri->segment('3');
			}
	
			if (is_numeric($dari)) {
				$data['iklantengah'] = $this->model_iklan->iklan_tengah();
				if ($this->input->post('cari')!=''){
					$data['title'] = title();
					$data['judul'] = "Hasil Pencarian keyword - ".filter($this->input->post('cari'));
					$data['record'] = $this->model_app->cari_produk(filter($this->input->post('cari')));
				}else{
					$data['title'] = title();
					$data['judul'] = 'Semua Produk';
					$data['record'] = $this->model_app->view_ordering_limit('tb_produk','id_produk','DESC',$dari,$config['per_page']);
					$this->pagination->initialize($config);
				}
					$this->template->load('phpmu-one/template','phpmu-one/view_home',$data);
			}else{
				redirect('main');
			}
		}
	}

	public function show(){
		//$category = array();
		//$produks = array();
		$kategori = $this->db->query("SELECT * FROM (SELECT a.*,b.produk FROM (SELECT * FROM `tb_kategori_produk`) as a LEFT JOIN
										(SELECT id_kategori_produk, COUNT(*) produk FROM tb_produk GROUP BY id_kategori_produk HAVING COUNT(id_kategori_produk)) as b on a.id_kategori_produk=b.id_kategori_produk ORDER BY RAND()) as c  ORDER BY c.id_kategori_produk DESC");
		foreach($kategori->result_array() as $kat){
			//echo $kat['nama_kategori'];
			echo "<b>".$kat[nama_kategori] . "</b><br>";
			//$kategori_push = array_push($array, $kat[nama_kategori]);
			//$json_decoded = json_decode($kat);
    		//$category[] = array('id_kategori' => $kat[id_kategori_produk], 'nama_kategori' => $kat[nama_kategori], produk => array());
			$category[] = array('id_kategori' => $kat[id_kategori_produk], 'nama_kategori' => $kat[nama_kategori], produk => $produks);
			$produk = $this->model_app->produk_perkategori(0,0,$kat['id_kategori_produk'],6);
			foreach($produk->result_array() as $prod){
				//$produks[] = array();
					//array_push($produks, array('produk' => $prod));
					echo $prod[nama_produk] . "<br>";
					//echo json_encode($prod);
					//echo $produk;
					
				}
				
		}
		//print_r($category);
		//echo json_encode($category);
		//echo json_encode($kategori->result_array());
		//echo json_encode($kategori->result_array());
	}

	public function show3(){
		$kategori = $this->db->query("SELECT * FROM (SELECT a.*,b.produk FROM (SELECT * FROM `tb_kategori_produk`) as a LEFT JOIN
										(SELECT id_kategori_produk, COUNT(*) produk FROM tb_produk GROUP BY id_kategori_produk HAVING COUNT(id_kategori_produk)) as b on a.id_kategori_produk=b.id_kategori_produk ORDER BY RAND()) as c  ORDER BY c.id_kategori_produk DESC");
		
		$kategori = $this->db->query("SELECT * FROM tb_kategori_produk ORDER BY id_kategori_produk DESC");	
		foreach($kategori->result_array() as $kat){
			$idk = $kat[id_kategori_produk];
			$ktg = $kat[nama_kategori];
			//echo "<b>".$kat[nama_kategori] . "</b><br>";
			//$category[] = array('id_kategori' => $kat[id_kategori_produk], 'nama_kategori' => $kat[nama_kategori], produk => $produks);
			$produk = $this->model_app->produk_perkategori(0,0,$kat['id_kategori_produk'],6);
			//$produk = $this->db->query("SELECT * FROM tb_produk WHERE id_kategori_produk=$kat[id_kategori_produk]");
			foreach($produk->result_array() as $prod){
				//echo $prod[nama_produk] . "<br>";
				//$prd = $prod;
				$arr[] = ["id_kategori" => $idk, "nama_kategori" => $ktg, "produk" => $prod];
				//$arr[] = ["nama_kategori" => $ktg, "produk" => $prd];
				//echo json_encode($prod);
				//array_push($prd, $prod);
			}	
		}
		echo json_encode($arr);
	}

	public function show4(){
		$data = array(array(
			'nama_kategori' => 'Pashmina Instan Tafea',
			'produk' => null
		),array(
			'nama_kategori' => 'Pashmina Instan Raisa Lava',
			'produk' => null
		),array(
			'nama_kategori' => 'Segitiga Instan Sasya',
			'produk' => null
		),array(
			'nama_kategori' => 'Segitiga Instan Lolina',
			'produk' => null
		),array(
			'nama_kategori' => 'Hijab Instan Tanika',
			'produk' => array(array(
				'nama_produk' => 'Pashmina Instan Diva Lava - DL85.5 Misty Sky'
			),
			array(
				'nama_produk' => 'Pashmina Instan Rafella - RLN1.3 Lilac'
			),
			array(
				'nama_produk' => 'Pashmina Instan Rafella - RLN1.1 Sweet Grey'
			),
			),
		),
		);
		echo json_encode($data);
	}

	public function show2(){
		$query = $this->db->query("SELECT * FROM tb_produk a JOIN tb_kategori_produk b ON a.id_kategori_produk=b.id_kategori_produk GROUP BY b.id_kategori_produk")->result();
		echo json_encode($query);
	}

	function kategori(){
		$type = $_GET['type'];
		$id = $_GET['id'];
		$page = $_GET['page'];
		if($type == 'json'){
			if($id == ''){
				$print = $this->model_app->view_ordering('tb_kategori_produk', 'nama_kategori', 'ASC');
				echo json_encode($print);
			}else{
				$print = $this->db->query("SELECT * FROM tb_produk a JOIN tb_kategori_produk b ON a.id_kategori_produk=b.id_kategori_produk WHERE b.id_kategori_produk = $id ORDER BY a.id_produk DESC LIMIT $page")->result_array();
				//$print = $this->model_app->view_where_ordering('tb_kategori_produk', array('id_kategori_produk'=>$id), 'nama_kategori', 'ASC');
				echo json_encode($print);
			}
		}else{
			$cek = $this->model_app->edit('tb_kategori_produk',array('kategori_seo'=>$this->uri->segment(3)))->row_array();
			$jumlah= $this->model_app->view_where('tb_produk',array('id_kategori_produk'=>$cek['id_kategori_produk']))->num_rows();
			$config['base_url'] = base_url().'main/kategori/'.$this->uri->segment(3);
			$config['total_rows'] = $jumlah;
			$config['per_page'] = 12; 	
			if ($this->uri->segment('4')==''){
				$dari = 0;
			}else{
				$dari = $this->uri->segment('4');
			}
	
			if (is_numeric($dari)) {
				$data['title'] = "Produk Kategori $cek[nama_kategori]";
				$data['judul'] = "Produk Kategori $cek[nama_kategori]";
				$data['iklantengah'] = $this->model_iklan->iklan_tengah();
				$data['record'] = $this->model_app->view_where_ordering_limit('tb_produk',array('id_kategori_produk'=>$cek['id_kategori_produk']),'id_produk','DESC',$dari,$config['per_page']);
				$this->pagination->initialize($config);
				$this->template->load('phpmu-one/template','phpmu-one/view_home',$data);
			}else{
				redirect('main');
			}
		}
	}

	function detail(){
		$query = $this->model_app->edit('tb_produk',array('produk_seo'=>$this->uri->segment(3)));
		if ($query->num_rows()>=1){
			$cek = $query->row_array();
			$data['title'] = "$cek[nama_produk]";
			$data['judul'] = "$cek[nama_produk]";
			$data['row'] = $this->model_app->view_where('tb_produk',array('id_produk'=>$cek['id_produk']))->row_array();
			$this->template->load('phpmu-one/template','phpmu-one/view_produk_detail',$data);
		}else{
			redirect('main');
		}
	}

	function keranjang(){
		$id_produk   = filter($this->input->post('id_produk'));
		$jumlah   = filter($this->input->post('jumlah'));
		$keterangan   = filter($this->input->post('keterangan'));
		$j = $this->model_app->jual_umum($id_produk)->row_array();
        $b = $this->model_app->beli_umum($id_produk)->row_array();
        $stok = $b['beli']-$j['jual'];

		if ($id_produk!=''){
			if ($stok < $this->input->post('jumlah') OR $stok <= '0'){
				$produk = $this->model_app->edit('tb_produk',array('id_produk'=>$id_produk))->row_array();
				$produk_cek = filter($produk['nama_produk']);
				echo "<script>window.alert('Maaf, Stok untuk pemesanan Produk - $produk_cek Tidak Mencukupi!');
                                  window.location=('".base_url()."produk/detail/$produk[produk_seo]')</script>";
			}else{
				$this->session->unset_userdata('produk');
				if ($this->session->idp == ''){
					$idp = 'TRX-'.date('YmdHis');
					$this->session->set_userdata(array('idp'=>$idp));
				}

				$cek = $this->model_app->view_where('tb_penjualan_temp',array('session'=>$this->session->idp,'id_produk'=>$id_produk))->num_rows();
				if ($cek >=1){
					$this->db->query("UPDATE tb_penjualan_temp SET jumlah=jumlah+$jumlah where session='".$this->session->idp."' AND id_produk='$id_produk'");
				}else{
					$harga = $this->model_app->view_where('tb_produk',array('id_produk'=>$id_produk))->row_array();
					$data = array('session'=>$this->session->idp,
				        		  'id_produk'=>$id_produk,
				        		  'jumlah'=>$jumlah,
				        		  'harga_jual'=>$harga['harga_konsumen'],
								  'satuan'=>$harga['satuan'],
								  'keterangan_order'=>$keterangan,
				        		  'waktu_order'=>date('Y-m-d H:i:s'));
					$this->model_app->insert('tb_penjualan_temp',$data);
				}
				redirect('produk/keranjang');
			}
		}else{
				$data['record'] = $this->model_app->view_join_rows('tb_penjualan_temp','tb_produk','id_produk',array('session'=>$this->session->idp),'id_penjualan_detail','ASC');
				$data['title'] = 'Keranjang Belanja';
				$this->template->load('phpmu-one/template','phpmu-one/pengunjung/view_keranjang',$data);

		}
	}

	function keranjang_delete(){
		$id = array('id_penjualan_detail' => $this->uri->segment(3));
		$this->model_app->delete('tb_penjualan_temp',$id);
		$isi_keranjang = $this->db->query("SELECT sum(jumlah) as jumlah FROM tb_penjualan_temp where session='".$this->session->idp."'")->row_array();
		if ($isi_keranjang['jumlah']==''){
			$this->session->unset_userdata('idp');
			$this->session->unset_userdata('reseller');
		}
		redirect('produk/keranjang');
	}

	function kurirdata(){
		$iden = $this->model_app->view_ordering_limit('identitas','id_identitas','DESC',0,1)->row_array();
		$this->load->library('rajaongkir');
		$tujuan=$this->input->get('kota');
		$dari=$iden['kota_id'];
		$berat=$this->input->get('berat');
		$kurir=$this->input->get('kurir');
		$dc=$this->rajaongkir->cost($dari,$tujuan,$berat,$kurir);
		$d=json_decode($dc,TRUE);
		$o='';
		if(!empty($d['rajaongkir']['results'])){
			$data['data']=$d['rajaongkir']['results'][0]['costs'];
			$this->load->view('phpmu-one/pengunjung/kurirdata',$data);			
		}else{
			$data['ongkir'] = 0;
			$this->load->view('phpmu-one/pengunjung/kurirdata',$data);	
		}
	}

	function checkouts(){
		if (isset($_POST['submit'])){
			if ($this->session->idp!=''){
				$this->load->library('email');
				$data = array('kode_transaksi'=>$this->session->idp,
			        		  'id_pembeli'=>$this->session->id_konsumen,
			        		  'diskon'=>$this->input->post('diskonnilai'),
			        		  'kurir'=>$this->input->post('kurir'),
			        		  'service'=>$this->input->post('service'),
			        		  'ongkir'=>$this->input->post('ongkir'),
			        		  'waktu_transaksi'=>date('Y-m-d H:i:s'),
			        		  'proses'=>'0');
				$this->model_app->insert('tb_penjualan',$data);
				$idp = $this->db->insert_id();

				$keranjang = $this->model_app->view_where('tb_penjualan_temp',array('session'=>$this->session->idp));
				foreach ($keranjang->result_array() as $row) {
					$dataa = array('id_penjualan'=>$idp,
				        		   'id_produk'=>$row['id_produk'],
								   'jumlah'=>$row['jumlah'],
								   'keterangan_order'=>$row['keterangan_order'],
				        		   'harga_jual'=>$row['harga_jual'],
				        		   'satuan'=>$row['satuan']);
					$this->model_app->insert('tb_penjualan_detail',$dataa);
				}
				$this->model_app->delete('tb_penjualan_temp',array('session'=>$this->session->idp));
				$kons = $this->model_app->view_join_where_one('tb_user','tb_kota','kota_id',array('id_konsumen'=>$this->session->id_konsumen))->row_array();

				$data['title'] = 'Transaksi Success';
				$data['email'] = $kons['email'];
				$data['orders'] = $this->session->idp;
				$data['total_bayar'] = rupiah($this->input->post('total')+$this->input->post('ongkir'));

				$iden = $this->model_app->view_where('identitas',array('id_identitas'=>'1'))->row_array();
				$data['rekening'] = $this->model_app->view('tb_rekening');

				$email_tujuan = $kons['email'];
				$tgl = date("d-m-Y H:i:s");

				$subject      = "$iden[nama_website] - Detail Orderan anda";
				$message      = "<html><body>Halooo! <b>$kons[nama_lengkap]</b> ... <br> Hari ini pada tanggal <span style='color:red'>$tgl</span> Anda telah order produk di $iden[nama_website].
					<br><table style='width:100%;'>
		   				<tr><td style='background:#337ab7; color:#fff; pading:20px' cellpadding=6 colspan='2'><b>Berikut Data Anda : </b></td></tr>
						<tr><td width='140px'><b>Nama Lengkap</b></td>  <td> : $kons[nama_lengkap]</td></tr>
						<tr><td><b>Alamat Email</b></td>			<td> : $kons[email]</td></tr>
						<tr><td><b>No Telpon</b></td>				<td> : $kons[no_hp]</td></tr>
						<tr><td><b>Alamat</b></td>					<td> : $kons[alamat_lengkap] </td></tr>
						<tr><td><b>Kabupaten/Kota</b></td>			<td> : $kons[nama_kota] </td></tr>
					</table><br>

					No. Invoice : <b>".$this->session->idp."</b><br>
					Berikut Detail Data Orderan Anda :
					<table style='width:100%;' class='table table-striped'>
				          <thead>
				            <tr bgcolor='#337ab7'>
				              <th style='width:40px'>No</th>
				              <th width='47%'>Nama Produk</th>
				              <th>Harga</th>
				              <th>Qty</th>
				              <th>Berat</th>
				              <th>Total</th>
				            </tr>
				          </thead>
				          <tbody>";

				          $no = 1;
				          $belanjaan = $this->model_app->view_join_where('tb_penjualan_detail','tb_produk','id_produk',array('id_penjualan'=>$idp),'id_penjualan_detail','ASC');
				          foreach ($belanjaan as $row){
				          $sub_total = (($row['harga_jual']-$row['diskon'])*$row['jumlah']);
				          if ($row['diskon']!='0'){ $diskon = "<del style='color:red'>".rupiah($row['harga_jual'])."</del>"; }else{ $diskon = ""; }
				          if (trim($row['gambar'])==''){ $foto_produk = 'no-image.png'; }else{ $foto_produk = $row['gambar']; }
				          $diskon_total = $diskon_total+$row['diskon']*$row['jumlah'];

				$message .= "<tr bgcolor='#e3e3e3'><td>$no</td>
				                    <td>$row[nama_produk]</td>
				                    <td>".rupiah($row['harga_jual']-$row['diskon'])." $diskon</td>
				                    <td>$row[jumlah]</td>
				                    <td>".($row['berat']*$row['jumlah'])." Gram</td>
				                    <td>Rp ".rupiah($sub_total)."</td>
				                </tr>";
				            $no++;
				          }
				          
				$message .= "<tr bgcolor='lightblue'>
				                  <td colspan='5'><b>Total Berat</b></td>
				                  <td><b>".$this->input->post('berat')." Gram</b></td>
				                </tr>

				                <tr bgcolor='lightblue'>
				                  <td colspan='5'><b>Ongkos Kirim</b></td>
				                  <td><b>".$this->input->post('ongkir')."</b></td>
				                </tr>

				                <tr bgcolor='lightgreen'>
				                  <td colspan='5'><b>Total Harga</b></td>
				                  <td><b>Rp ".rupiah($this->input->post('total')+$this->input->post('ongkir'))."</b></td>
				                </tr>

				        </tbody>
				      </table><br>

				      Silahkan melakukan pembayaran ke rekening :
				      <table style='width:100%;' class='table table-hover table-condensed'>
						<thead>
						  <tr bgcolor='#337ab7'>
						    <th width='20px'>No</th>
						    <th>Nama Bank</th>
						    <th>No Rekening</th>
						    <th>Atas Nama</th>
						  </tr>
						</thead>
						<tbody>";
						    $noo = 1;
						    $rekening = $this->model_app->view('tb_rekening');
						    foreach ($rekening->result_array() as $row){
				$message .= "<tr bgcolor='#e3e3e3'><td>$noo</td>
						              <td>$row[nama_bank]</td>
						              <td>$row[no_rekening]</td>
						              <td>$row[pemilik_rekening]</td>
						          </tr>";
						      $noo++;
						    }
				$message .= "</tbody>
					  </table><br><br>

				      Jika sudah melakukan transfer, jangan lupa konfirmasi transferan anda <a href='".base_url()."konfirmasi'>disini</a><br>
				      Salam. Admin, $iden[nama_website] </body></html> \n";
				
				$this->email->from($iden['email'], $iden['nama_website']);
				$this->email->to($email_tujuan);
				$this->email->cc('');
				$this->email->bcc('');

				$this->email->subject($subject);
				$this->email->message($message);
				$this->email->set_mailtype("html");
				$this->email->send();
				
				$config['protocol'] = 'sendmail';
				$config['mailpath'] = '/usr/sbin/sendmail';
				$config['charset'] = 'utf-8';
				$config['wordwrap'] = TRUE;
				$config['mailtype'] = 'html';
				$this->email->initialize($config);

				$this->session->unset_userdata('idp');
				$this->template->load('phpmu-one/template','phpmu-one/view_order_success',$data);
			}else{
				redirect('produk/keranjang');
			}
		}else{
				if ($this->session->id_konsumen){
					$cek = $this->model_app->view_where('tb_penjualan_temp',array('session'=>$this->session->idp));
					if ($cek->num_rows()>=1){
						$data['title'] = 'Data Pelanggan';
						$data['kota'] = $this->model_app->view_ordering('tb_kota','kota_id','ASC');
						$data['rows'] = $this->model_app->view_join_where_one('tb_user','tb_kota','kota_id',array('id_konsumen'=>$this->session->id_konsumen))->row_array();
						$data['record'] = $this->model_app->view_join_rows('tb_penjualan_temp','tb_produk','id_produk',array('session'=>$this->session->idp),'id_penjualan_detail','ASC');
						$this->template->load('phpmu-one/template','phpmu-one/view_checkouts',$data);
					}else{
						redirect('produk/keranjang'.$cek);
					}
				}else{
					redirect('auth/login');
				}
		}
	}

	function print_invoice(){
		$data['rows'] = $this->model_app->view_join_where_one('tb_user','tb_kota','kota_id',array('id_konsumen'=>$this->session->id_konsumen))->row_array();
		$data['record'] = $this->db->query("SELECT a.kode_transaksi, b.*, c.nama_produk, c.satuan, c.berat, c.diskon FROM `tb_penjualan` a JOIN tb_penjualan_detail b ON a.id_penjualan=b.id_penjualan JOIN tb_produk c ON b.id_produk=c.id_produk where a.kode_transaksi='".$this->uri->segment(3)."'");
		$this->load->view('phpmu-one/pengunjung/print_invoice',$data);
	}
}
