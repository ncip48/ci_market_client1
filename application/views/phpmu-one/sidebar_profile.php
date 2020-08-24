<?php
$id = $this->session->userdata('id_konsumen');
if ($id != null) {
    $sql = $this->db->query("SELECT * FROM tb_user WHERE id_konsumen=" . $id);
    $check = $sql->num_rows();
    $result = $sql->row_array();
    $penjual = $this->db->query("SELECT * FROM tb_penjual WHERE id_konsumen=" . $id);
    $cek_p = $penjual->num_rows();
    $res_p = $penjual->row_array();
    if (trim($result['foto']) == '') {
        $foto_user = 'blank.png';
    } else {
        $foto_user = $result['foto'];
    }
    if (trim($res_p['foto']) == '') {
        $foto_penjual = 'blank.png';
    } else {
        $foto_penjual = $res_p['foto'];
    }

    $following = $this->db->query("SELECT COUNT(*) AS jumlah FROM tb_followers WHERE id_following=" . $id)->row_array();
    $follower = $this->db->query("SELECT COUNT(*) AS jumlah FROM tb_followers WHERE id_konsumen=" . $id)->row_array();
    $post = $this->db->query("SELECT COUNT(*) AS jumlah FROM tb_post WHERE id_konsumen=" . $id)->row_array();
}
?>

<?php if ($id == null) { ?>
    <div class="card">
        <div class="card-body">
            <h6 class="card-title text-center"><i class="icon-user-fill"></i> <a href="<?= base_url() ?>login" class="">login</a>/register</h6>
            <p class="card-text">masuk atau daftar untuk membeli atau menjual</p>
        </div>
    </div>
<?php } else { ?>
    <div class="card">
        <div class="card-body">
            <h6 class="card-title text-center">
                <img style='border:1px solid #cecece' width='30px' height="30px" src='<?= base_url(); ?>asset/foto_user/<?= $foto_user; ?>' class='rounded-circle'>
                halo, <a href="<?= base_url() ?>user/<?= $result['username'] ?>"><?= $result['username']; ?></a>
            </h6>
            <hr>
            <div class="row">
                <div class="col-md-4 text-center">
                    <button class="btn px-0 py-0" id="btn-following-action" data-username="<?= $result['username'] ?>" data-urls="<?= current_url() ?>">
                        <span>Following </span>
                        <h6><?= $following['jumlah'] ?></h6>
                    </button>
                </div>
                <div class="col-md-4 text-center">
                    <button class="btn px-0 py-0" id="btn-follower-action" data-username="<?= $result['username'] ?>" data-urls="<?= current_url() ?>">
                        <span>Followers</span>
                        <h6><?= $follower['jumlah'] ?></h6></a>
                    </button>
                </div>
                <div class="col-md-4 text-center">
                    <a href="<?= base_url() ?>user/<?= $result['username'] ?>">Post
                        <h6><?= $post['jumlah'] ?></h6></a>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4">
                    ORDERS
                </div>
                <div class="col-md-5">
                    PENDING
                </div>
                <div class="col-md-3">
                    <a href="<?= base_url() ?>members/logout" class="btn bg-utama"><i class="icon-login"></i></a>
                </div>
            </div>

        </div>
    </div>
    <?php if ($cek_p == 0) { ?>
        <div class="card mt-3">
            <div class="card-body">
                <h6 class="card-title text-center">Status Toko</h6>
                <hr>
                <p class="card-text">anda belum mendaftarkan toko anda</p>
                <a href="<?= base_url() ?>members/logout" class="btn btn-block bg-utama">Daftar Toko</a>
            </div>
        </div>
    <?php } else { ?>
        <div class="card mt-3">
            <div class="card-body">
                <h6 class="card-title text-center">Status Toko</h6>
                <hr>
                <p class="card-text">Halo, <?= $res_p['nama_toko']; ?></p>
                <a href="<?= base_url() ?>members/logout" class="btn btn-block bg-utama">Dashboard Toko</a>
            </div>
        </div>
    <?php } ?>
<?php } ?>