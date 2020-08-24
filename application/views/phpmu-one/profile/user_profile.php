<?php
$username = $this->uri->segment(2);
if (trim($profile['foto']) == '') {
    $pp = 'blank.png';
} else {
    $pp = $profile['foto'];
}
?>
<section id="content" class="profile-page">
    <div class="container">
        <div class="row">
            <div class="col-4 text-center">
                <img style='border:1px solid #cecece' width='150px' height="150px" src='<?= base_url(); ?>asset/foto_user/<?= $pp; ?>' class='rounded-circle'>
            </div>
            <div class="col-8 my-auto">
                <h4 class="font-weight-light">@<?= $profile['username'] ?></h4>
                <h5><?= $profile['nama_lengkap'] ?></h5>
                <button class="btn px-0 py-0">
                    <h6>posts <?= $post->num_rows(); ?></h6>
                </button>
                <button class="btn px-3 py-0" id="btn-following-action" data-username="<?= $username ?>" data-urls="<?= current_url() ?>">
                    <h6>following <?= $following->num_rows() ?></h6>
                </button>
                <button class="btn px-3 py-0" id="btn-follower-action" data-username="<?= $username ?>" data-urls="<?= current_url() ?>">
                    <h6>followers <?= $follower->num_rows() ?></h6>
                </button>
            </div>

        </div>
        <hr>
        <div class="row">
            <?php
            //var_dump($following->result_array());
            foreach ($post->result_array() as $post) {
                if (trim($post['foto']) == '') {
                    $foto_following = 'blank.png';
                } else {
                    $foto_following = $post['foto'];
                }
            ?>
                <div class="col-4 p-1">
                    <div class="card my-2" style="height: 350px;width: 350px">
                        <img class="card-img-top" style="height: 350px;width: 350px" src='<?= base_url() ?>asset/img_post/<?= $post['img'] ?>'>
                        <div class="card-body p-0">


                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>
</section><!-- End #content -->