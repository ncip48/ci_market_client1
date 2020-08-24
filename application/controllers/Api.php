<?php

defined('BASEPATH') or exit('No direct script access allowed');

require APPPATH . '/libraries/REST_Controller.php';

use Restserver\Libraries\REST_Controller;

class Api extends REST_Controller
{

    function __construct($config = 'rest')
    {
        parent::__construct($config);
        $this->load->database();
    }

    //Menampilkan data kontak
    function produk_get()
    {
        $page = $_GET['page'];
        $search = $_GET['search'];
        $id_kategori = $_GET['id_kategori'];
        $data = [];
        if ($search != '') {
            //if($this->db->query("SELECT id_produk,nama_produk,gambar,harga_konsumen,diskon FROM tb_produk WHERE nama_produk LIKE '%$search%' ORDER BY id_produk DESC LIMIT $page")->num_rows=='1'){
            $query = $this->db->query("SELECT * FROM tb_produk WHERE nama_produk LIKE '%$search%' ORDER BY id_produk DESC LIMIT $page");
            if ($query->num_rows() > 0) {
                $produk = $query->result();
                $data = array(
                    'result' => '1',
                    'data' => $produk
                );
            } else {
                $produk = 'Maaf Produk Tidak Ditemukan';
                $data = array(
                    'result' => '0',
                    'message' => $produk
                );
            }
            //$prod = $produk->result();
            //}else{
            //$hasil = '0';
            //}
        } else {
            //$record = $this->model_app->view_ordering_limit('tb_produk','id_produk','DESC','0',$page)->result_array();
            if ($id_kategori != '') {
                $query = $this->db->query("SELECT * FROM tb_produk WHERE id_kategori_produk = $id_kategori ORDER BY id_produk DESC LIMIT 6");
                if ($query->num_rows() > 0) {
                    $produk = $query;
                    $data = array(
                        'result' => '1',
                        'data' => $produk->result()
                    );
                } else {
                    $produk = 'Maaf Produk Tidak Ditemukan di Kategori ini';
                    $data = array(
                        'result' => '0',
                        'message' => $produk
                    );
                }
            } else {
                $produk = $this->db->query("SELECT * FROM tb_produk ORDER BY id_produk DESC LIMIT $page");
                $data = array(
                    'result' => '1',
                    'data' => $produk->result()
                );
            }
            //$prod = $produk->result();
        }
        $this->response($data, REST_Controller::HTTP_OK);
    }

    function produk2_get()
    {
        $kategori = $this->db->query("SELECT * FROM (SELECT a.*,b.produk FROM (SELECT * FROM `tb_kategori_produk`) as a LEFT JOIN
										(SELECT id_kategori_produk, COUNT(*) produk FROM tb_produk GROUP BY id_kategori_produk HAVING COUNT(id_kategori_produk)) as b on a.id_kategori_produk=b.id_kategori_produk ORDER BY RAND()) as c  ORDER BY c.id_kategori_produk DESC");

        //$kategori = $this->db->query("SELECT * FROM tb_kategori_produk ORDER BY id_kategori_produk DESC");	
        foreach ($kategori->result_array() as $kat) {
            $idk = $kat[id_kategori_produk];
            //$ktg = array('nama_kategori' => $kat[nama_kategori]);
            $ktg = $kat[nama_kategori];
            //echo "<b>".$kat[nama_kategori] . "</b><br>";
            //echo json_encode($ktg);
            //$category[] = array('id_kategori' => $kat[id_kategori_produk], 'nama_kategori' => $kat[nama_kategori], produk => $produks);
            $produk = $this->model_app->produk_perkategori(0, 0, $kat['id_kategori_produk'], 6);
            //$produk = $this->db->query("SELECT * FROM tb_produk WHERE id_kategori_produk=$kat[id_kategori_produk]");
            foreach ($produk->result_array() as $prod) {
                //$prd = array('nama_produk' => $prod[nama_produk]);
                $prd = $prod[nama_produk];
                //echo $prod[nama_produk] . "<br>";
                //$prd = $prod;
                //$arr[] = ["id_kategori" => $idk, "nama_kategori" => $ktg, "produk" => $prod];
                //$arr[] = ["nama_kategori" => $ktg, "produk" => $prd];
                //echo json_encode($prd);
                //echo json_encode(array_merge(json_decode($ktg, true),json_decode($prd, true)));
                echo json_encode(array_merge([["nama_kategori" => $ktg], ["produk" => $prd]]));
                //$array3 = $ktg+$prd;
                //echo json_encode($array3);
                //array_push($prd, $prod);
            }
        }
        //echo json_encode($kategori->result());
    }

    function anu_get()
    {
        $people = [
            ['id_kategori_produk' => 1, 'name' => 'Hayley'],
            ['id' => 2, 'name' => 'Jack', 'id_kat' => 1],
            ['id' => 3, 'name' => 'Linus', 'id_kat' => 4],
            ['id_kategori_produk' => 4, 'name' => 'Peter'],
            ['id' => 5, 'name' => 'Tom', 'id_kat' => 4],
        ];

        //$people = $this->db->query("SELECT * FROM tb_produk a JOIN tb_kategori_produk b ON a.id_kategori_produk = b.id_kategori_produk")->result_array();

        //$people = $this->db->query("SELECT * FROM tb_produk")->result_array();
        //$peoplee = $this->db->query("SELECT * FROM tb_kategori_produk")->result_array();

        // We set up an array with just the children
        function children($dad, $people)
        {
            $children = [];
            foreach ($people as $p) {
                if (!empty($p["id_kat"]) && $p["id_kat"] == $dad["id_kategori_produk"]) {
                    $children[] = $p;
                }
            }

            return $children;
        }

        $family = [];

        // We merge each child with its respective parent
        foreach ($people as $p) {
            $children = children($p, $people);
            if ($children != []) {
                $family[] = array_merge($p, ["children" => $children]);
            }
        }

        echo json_encode($people);
    }

    function produkperkategori_get()
    {
        $query = $this->db->query("SELECT id_kategori_produk,nama_kategori FROM tb_kategori_produk ORDER BY nama_kategori ASC");

        $mysql_result = $query->result_array();

        $rows = array();
        foreach($mysql_result as $r) {
            $rows[] = $r;
        }
        $json_personal_information = json_encode($rows);
        //echo $json_personal_information;



        $j = $this->db->query("SELECT * FROM tb_kategori_produk")->num_rows();
        $jumlah = $j * 6;
        $query = $this->db->query("SELECT nama_produk, satuan, harga_konsumen, berat, gambar, keterangan, id_kategori_produk as id_kat FROM tb_produk ORDER BY id_produk DESC LIMIT $jumlah");

        $mysql_result = $query->result_array();

        $rows = array();
        foreach($mysql_result as $r) {
            $rows[] = $r;
        }
        $json_doctor_information = json_encode($rows);
        //echo $json_doctor_information;

        //$hasil = json_encode(array_merge(json_decode($json_personal_information, true), json_decode($json_doctor_information, true)));
        $people = array_merge(json_decode($json_personal_information, true), json_decode($json_doctor_information, true));

        function children($dad, $people)
        {
            $children = [];
            foreach ($people as $p) {
                if (!empty($p["id_kat"]) && $p["id_kat"] == $dad["id_kategori_produk"]) {
                    $children[] = $p;
                }
            }

            return $children;
        }

        $family = [];

        // We merge each child with its respective parent
        foreach ($people as $p) {
            $children = children($p, $people);
            if ($children != []) {
                $family[] = array_merge($p, ["produk" => $children]);
            }
        }

        echo json_encode($family);
        //echo json_encode($family);
    }

    function produk3_get()
    {
        $kategori = $this->db->query("SELECT * FROM (SELECT a.*,b.produk FROM (SELECT * FROM `tb_kategori_produk`) as a LEFT JOIN
										(SELECT id_kategori_produk, COUNT(*) produk FROM tb_produk GROUP BY id_kategori_produk HAVING COUNT(id_kategori_produk)) as b on a.id_kategori_produk=b.id_kategori_produk ORDER BY RAND()) as c  ORDER BY c.id_kategori_produk DESC");
        $this->response($kategori->result(), REST_Controller::HTTP_OK);
    }

    function produk4_get()
    {
        $id = $_GET['id'];
        $produk = $this->model_app->produk_perkategori(0, 0, $id, 6);
        $this->response($produk->result(), REST_Controller::HTTP_OK);
    }
    function kategori_get()
    {
        $id = $_GET['id'];
        $page = $_GET['page'];
        if ($id == '') {
            $produk = $this->model_app->view_ordering('tb_kategori_produk', 'nama_kategori', 'ASC');
            $data = array(
                'result' => '1',
                'data' => $produk
            );
            $this->response($data, REST_Controller::HTTP_OK);
        } else {
            $produk = $this->db->query("SELECT * FROM tb_produk a JOIN tb_kategori_produk b ON a.id_kategori_produk=b.id_kategori_produk WHERE b.id_kategori_produk = $id ORDER BY a.id_produk DESC LIMIT $page");
            //$print = $this->model_app->view_where_ordering('tb_kategori_produk', array('id_kategori_produk'=>$id), 'nama_kategori', 'ASC');
            if ($produk->num_rows() > 0) {
                $data = array(
                    'result' => '1',
                    'data' => $produk->result()
                );
                $this->response($data, REST_Controller::HTTP_OK);
            } else {
                $produk = 'Maaf Produk Tidak Ditemukan di Kategori ini';
                $data = array(
                    'result' => '0',
                    'message' => $produk
                );
                $this->response($data, REST_Controller::HTTP_OK);
            }
        }
    }

    function login_post()
    {
        $json = file_get_contents('php://input');
        $obj = json_decode($json, TRUE);
        $username = strip_tags($obj['username']);
        $email = strip_tags($obj['email']);
        $password = hash("sha512", md5(strip_tags($obj['password'])));
        //$username = strip_tags($this->input->post('username'));
        //$password = hash("sha512", md5(strip_tags($this->input->post('password'))));
        $query = $this->db->query("SELECT * FROM tb_user where username='" . $username . "' AND password='" . $password . "'");
        $check = $query->num_rows();

        if ($check > 0) {
            $data = [];
            $data = array(
                'result' => 1,
                'message' => "Login Berhasil",
                'data' => $query->result()
            );
            $this->response($data, REST_Controller::HTTP_OK);
        } else {
            $data = [];
            $data = array(
                'result' => 0,
                'message' => 'Username/Password Salah'
            );
            $this->response($data, REST_Controller::HTTP_OK);
        }
    }

    function cekuser_post()
    {
        $json = file_get_contents('php://input');
        $obj = json_decode($json, TRUE);
        $id_konsumen = strip_tags($obj['id_konsumen']);
        //$username = strip_tags($this->input->post('username'));
        //$password = hash("sha512", md5(strip_tags($this->input->post('password'))));
        $query = $this->db->query("SELECT * FROM tb_user where id_konsumen='" . $id_konsumen . "'");
        $check = $query->num_rows();

        if ($check > 0) {
            $data = [];
            $data = array(
                'result' => 1,
                'message' => "Login Berhasil",
                'data' => $query->result()
            );
            $this->response($data, REST_Controller::HTTP_OK);
        } else {
            $data = [];
            $data = array(
                'result' => 0,
                'message' => 'Username/Password Salah'
            );
            $this->response($data, REST_Controller::HTTP_OK);
        }
    }

    function cart_get()
    {
        $id_konsumen = $_GET['id_konsumen'];
        $query = $this->db->query("SELECT a.*, b.nama_produk,b.gambar,b.diskon FROM tb_penjualan_temp a JOIN tb_produk b ON a.id_produk=b.id_produk WHERE a.id_konsumen=$id_konsumen");
        //$query = $this->model_app->view_where('tb_penjualan_temp',array('id_konsumen'=>$id_konsumen));
        $cek = $query->num_rows();
        $result = $query->result();
        $this->response($result, REST_Controller::HTTP_OK);
    }




    //Masukan function selanjutnya disini
}
