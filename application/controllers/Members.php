<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Members extends CI_Controller {
	function foto(){
		cek_session_members();
		if (isset($_POST['submit'])){
			$this->model_members->modupdatefoto();
			redirect('members/profile');
		}else{
			redirect('members/profile');
		}
	}

	function profile(){
		cek_session_members();
		$data['title'] = 'Profile Anda';
		$data['row'] = $this->model_app->profile_konsumen($this->session->id_konsumen)->row_array();
		$this->template->load('phpmu-one/template','phpmu-one/pengunjung/view_profile',$data);
	}

	function profile_member(){
		$username = $this->uri->segment(2);
		$data['post'] = $this->db->query("SELECT * FROM tb_post a JOIN tb_user b ON a.id_konsumen=b.id_konsumen WHERE b.username='$username'");
		$data['following'] = $this->db->query("SELECT * FROM tb_followers a JOIN tb_user b ON a.id_following=b.id_konsumen WHERE b.username='$username'");
		$data['follower'] = $this->db->query("SELECT * FROM tb_followers a JOIN tb_user b ON a.id_konsumen=b.id_konsumen WHERE b.username='$username'");
		$data['profile'] = $this->db->query("SELECT * FROM tb_user WHERE username='$username'")->row_array();
		//var_dump($follower);
		$this->template->load('phpmu-one/template','phpmu-one/profile/user_profile',$data);
	}

	function following_member(){
		$username = $this->uri->segment(2);
		//$data['following'] = $this->db->query("SELECT * FROM tb_followers a JOIN tb_user b ON a.id_following=b.id_konsumen WHERE b.username='$username'");
		$data['following'] = $this->db->query("SELECT a.id_konsumen, c.username, c.nama_lengkap, c.foto FROM tb_followers a JOIN tb_user b ON a.id_following=b.id_konsumen JOIN tb_user c ON a.id_konsumen=c.id_konsumen WHERE b.username='$username'");
		//$data['following'] = $this->db->query("SELECT a.id_konsumen, c.username, c.nama_lengkap, c.foto FROM tb_followers a JOIN tb_user b ON a.id_konsumen=b.id_konsumen JOIN tb_user c ON a.id_following=c.id_konsumen WHERE b.username='$username'");
		//$fol = $this->db->query("SELECT * FROM tb_user a JOIN tb_followers b ON a.id_konsumen=b.id_konsumen WHERE b.id_following='2'");
		//$fol2 = $this->db->query("SELECT a.id_konsumen, c.username, c.nama_lengkap, c.foto FROM tb_followers a JOIN tb_user b ON a.id_following=b.id_konsumen JOIN tb_user c ON a.id_konsumen=c.id_konsumen WHERE b.username='$username'");
		//var_dump($fol2->result_array());
		$this->template->load('phpmu-one/template','phpmu-one/profile/user_following',$data);
	}

	function follower_member(){
		$username = $this->uri->segment(2);
		//$data['following'] = $this->db->query("SELECT * FROM tb_followers a JOIN tb_user b ON a.id_following=b.id_konsumen WHERE b.username='$username'");
		$data['follower'] = $this->db->query("SELECT c.id_konsumen, c.username, c.nama_lengkap, c.foto FROM tb_followers a JOIN tb_user b ON a.id_konsumen=b.id_konsumen JOIN tb_user c ON a.id_following=c.id_konsumen WHERE b.username='$username'");
		//$data['follower'] = $this->db->query("SELECT a.id_konsumen, c.username, c.nama_lengkap, c.foto FROM tb_followers a JOIN tb_user b ON a.id_following=b.id_konsumen JOIN tb_user c ON a.id_konsumen=c.id_konsumen WHERE b.username='$username'");
		//$data['username'] = $username;
		//$fol = $this->db->query("SELECT * FROM tb_user a JOIN tb_followers b ON a.id_konsumen=b.id_konsumen WHERE b.id_following='2'");
		//$fol2 = $this->db->query("SELECT a.id_konsumen, c.username, c.nama_lengkap, c.foto FROM tb_followers a JOIN tb_user b ON a.id_following=b.id_konsumen JOIN tb_user c ON a.id_konsumen=c.id_konsumen WHERE b.username='$username'");
		//var_dump($fol2->result_array());
		$this->template->load('phpmu-one/template','phpmu-one/profile/user_follower',$data);
	}

	function edit_profile(){
		cek_session_members();
		$id = $this->uri->segment(3);
		if (isset($_POST['submit'])){
			$this->model_members->profile_update($this->session->id_konsumen);
			redirect('members/profile');
		}else{
			$data['title'] = 'Edit Profile Anda';
			$data['row'] = $this->model_app->profile_konsumen($this->session->id_konsumen)->row_array();
			$row = $this->model_app->profile_konsumen($this->session->id_konsumen)->row_array();
			$data['kota'] = $this->model_app->view('tb_kota');
			$this->template->load('phpmu-one/template','phpmu-one/pengunjung/view_profile_edit',$data);
		}
	}

    function history(){
		cek_session_members();
		$data['title'] = 'History Orderan anda';
		$data['record'] = $this->model_app->view_where_ordering('tb_penjualan',array('id_pembeli'=>$this->session->id_konsumen),'id_penjualan','DESC');
		$this->template->load('phpmu-one/template','phpmu-one/pengunjung/view_orders_report',$data);
	}

	function logout(){
		cek_session_members();
		$this->session->sess_destroy();
		redirect('main');
	}



	public function username_check(){
        // allow only Ajax request    
        if($this->input->is_ajax_request()) {
	        // grab the email value from the post variable.
	        $username = $this->input->post('a');

            if(!$this->form_validation->is_unique($username, 'tb_user.username')) {          
	         	$this->output->set_content_type('application/json')->set_output(json_encode(array('messageusername' => 'Maaf, Username ini sudah terdaftar,..')));
            }

        }
    }

    public function email_check(){
        // allow only Ajax request    
        if($this->input->is_ajax_request()) {
	        // grab the email value from the post variable.
	        $email = $this->input->post('d');

	        if(!$this->form_validation->is_unique($email, 'tb_user.email')) {          
	         	$this->output->set_content_type('application/json')->set_output(json_encode(array('message' => 'Maaf, Email ini sudah terdaftar,..')));
            }
        }
    }
}
