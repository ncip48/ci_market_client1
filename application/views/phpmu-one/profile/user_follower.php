<?php
$username = $this->uri->segment(2);
$id = $this->session->userdata('id_konsumen');
?>
<section id="content" class="modal-follower">
    <div class="container">
        <div class="row">
            <div class="w-100 mx-auto">
                <ul class="list-group">
                    <?php
                    foreach ($follower->result_array() as $follower) {
                        //var_dump($follower);
                        if (trim($follower['foto']) == '') {
                            $foto_following = 'blank.png';
                        } else {
                            $foto_following = $follower['foto'];
                        }
                        $sql = $this->db->query("SELECT * FROM tb_followers a JOIN tb_user b ON a.id_following=b.id_konsumen WHERE a.id_konsumen='" . $follower['id_konsumen'] . "' AND b.id_konsumen='$id' ")->num_rows();
                        //var_dump($sql);
                        //var_dump($following['id_konsumen']);
                        if ($sql == 1) {
                            $are_follow = '(mengikuti anda)';
                            $btn = 'unfollow';
                            $b = 'btn-danger';
                        } else {
                            $are_follow = '';
                            $btn = 'followback';
                            $b = 'btn-warning';
                        }
                    ?>
                        <li class="list-group-item list-group-item-action d-flex align-items-start">
                            <div class="d-flex w-100 justify-content-start">
                                <img width='40px' height="40px" class='rounded-circle' src='<?= base_url() ?>asset/foto_user/<?= $foto_following ?>'>
                                <div class="flex-column">
                                    <div class="d-flex">
                                        <h6 class="my-0 mx-2"><a href="<?= base_url() ?>user/<?= $follower['username'] ?>">@<?= $follower['username'] ?></a></h6>
                                    </div>
                                    <small class="text-muted mx-2 my-0"><?= $follower['nama_lengkap'] ?></small>
                                </div>
                            </div>
                            <button id="<?= $btn ?>" class='btn <?= $b ?> btn-sm ml-3 my-0' data-btn-target="<?= $follower['id_konsumen'] ?>" data-btn-ourid="<?= $id ?>"><?= $btn ?></button>
                        </li>
                    <?php } ?>
                </ul>
            </div>
        </div>
    </div>
</section><!-- End #content -->