<?php
$username = $this->uri->segment(2);
$id = $this->session->userdata('id_konsumen');
?>
<section id="content" class="modal-following">
    <div class="container">
        <div class="row">
            <div class="w-100 mx-auto">
                <ul class="list-group">
                    <?php
                    //var_dump($follower->result_array());
                    foreach ($following->result_array() as $following) {
                        if (trim($following['foto']) == '') {
                            $foto_follower = 'blank.png';
                        } else {
                            $foto_follower = $following['foto'];
                        }
                        $sql = $this->db->query("SELECT * FROM tb_followers a JOIN tb_user b ON a.id_konsumen=b.id_konsumen WHERE a.id_following='" . $following['id_konsumen'] . "' AND b.username='$username' ")->num_rows();
                        //var_dump($sql);
                        //var_dump($following['id_konsumen']);
                        if ($sql == 1) {
                            $are_follow = '(mengikuti anda)';
                            $btn = 'unfollow';
                            $b = 'btn-danger';
                        } else {
                            $are_follow = '';
                            $btn = 'follow';
                            $b = 'btn-warning';
                        }
                    ?>
                        <!--<div class="col-6 pad-5">
                    <div class="card my-2">
                        <div class="card-header">
                            <img style='border:1px solid #cecece' width='30px' height="30px" src='<?= base_url(); ?>asset/foto_user/<?= $foto_follower; ?>' class='rounded-circle'> <?= $post['username']; ?>
                        </div>
                        <img class="card-img-top" src='<?= base_url() ?>asset/img_post/<?= $following['img'] ?>'>
                        <div class="card-body">
                            <h6 class="card-title"><a href='<?= base_url() ?>produk/detail/<?= $following['produk_seo'] ?>'><?= $following['judul_post']; ?></a></h6>

                        </div>
                    </div>-->

                    <li class="list-group-item list-group-item-action d-flex align-items-start">
                            <div class="d-flex w-100 justify-content-start">
                                <img width='40px' height="40px" class='rounded-circle' src='<?= base_url() ?>asset/foto_user/<?= $foto_follower ?>'>
                                <div class="flex-column">
                                    <div class="d-flex">
                                        <h6 class="my-0 mx-2"><a href="<?= base_url() ?>user/<?= $following['username'] ?>">@<?= $following['username'] ?></a></h6>
                                        <small class="font-italic"><?= $are_follow ?></small>
                                    </div>
                                    <small class="text-muted mx-2 my-0"><?= $following['nama_lengkap'] ?></small>
                                </div>
                            </div>
                            <button id="unfollow" class='btn btn-danger btn-sm ml-3 my-0' data-btn-target="<?= $following['id_konsumen'] ?>" data-btn-ourid="<?= $id ?>">unfollow</button>
                        </li>

                        <!-- </div> -->
                    <?php } ?>
                </ul>
            </div>
        </div>
    </div>
</section><!-- End #content -->