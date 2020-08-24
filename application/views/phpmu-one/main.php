<?php
$slider = $this->db->query("SELECT * FROM tb_slide");
$jumlahslide =  $this->db->query("SELECT count(*) as jumlah FROM slide")->row_array();
if (trim($prod['foto']) == '') {
    $foto_penjual = 'users.gif';
} else {
    $foto_penjual = $prod['foto'];
}
?>
<section id="content">
    <div class="container">
        <div class="row">
            <div class="col-md-7 col-xs-12">
                <div id="slider-rev-container">
                    <div id="my-carousel" class="carousel slide animate-ease" data-ride="carousel">
                        <ol class="carousel-indicators">
                            <li data-target="#my-carousel" data-slide-to="0" class="active"></li>
                            <?php
                            for ($i = 1; $i < $jumlahslide[jumlah]; $i++) {
                                echo "<li data-target='#my-carousel' data-slide-to='$i'></li>";
                            }
                            ?>
                        </ol>
                        <div class="carousel-inner">
                            <div class="carousel-item active">
                                <img class="d-block w-100" src="<?= base_url() ?>asset/slider/<?= $slider->row_array()[gambar] ?>" id='ban1'>
                            </div>
                            <?php
                            $temp_row = array_slice($slider->result_array(), 1);
                            $a = 1;
                            foreach ($temp_row as $row) {
                                $a = $a + 1;
                                echo "<div class='carousel-item'>
                                                      <img class='d-block w-100' src='" . base_url() . "asset/slider/" . $row[gambar] . "' id='ban" . $a . "'>
                                                  </div>";
                            }
                            ?>
                        </div>
                    </div>
                </div>
                <div class="product-mobile card-product">
                    <div class="row mt-2">
                        <?php
                        //var_dump($produk);
                        foreach ($produk as $prod) {
                            if (trim($prod['gambar']) == '') {
                                $foto_produk = 'no-image.png';
                            } else {
                                $foto_produk = $prod['gambar'];
                            }
                        ?>
                            <div class="col-6 pad-5">
                                <div class="card my-2">
                                    <div class="card-header">
                                        <img style='border:1px solid #cecece' width='30px' height="30px" src='<?= base_url(); ?>asset/foto_user/<?= $foto_penjual; ?>' class='rounded-circle'> 
                                        <a href="<?= base_url() ?>store/<?= $prod['id_penjual'] ?>"><?= $prod['nama_toko']; ?></a> <br> by: <?= $prod['username'] ?>
                                    </div>
                                    <img class="card-img-top" height="200px" width="200px" src='<?= base_url() ?>asset/foto_produk/<?= $foto_produk ?>'>
                                    <div class="card-body">
                                        <h6 class="card-title"><a href='<?= base_url() ?>produk/detail/<?= $prod['produk_seo']?>'><?= $prod['nama_produk']; ?></a></h6>
                                        <?php if ($prod['diskon'] == '0') {
                                            echo "<span style='color:green;'>Rp " . rupiah($prod['harga_konsumen']) . "</span><br>";
                                        } else {
                                            echo "<span style='color:green;'>Rp " . rupiah($prod['harga_konsumen'] - $prod['diskon']) . "</span>
                                         <span style='color:#8a8a8a;'><del>" . rupiah($prod['harga_konsumen']) . "</del></span><br>";
                                        } ?>

                                    </div>
                                </div>
                            </div>
                        <?php } ?>

                        <?php
                        //var_dump($post);
                        foreach ($post as $post) {
                            if (trim($post['foto']) == '') {
                                $foto_following = 'users.gif';
                            } else {
                                $foto_following = $post['foto'];
                            }
                        ?>
                            <div class="col-6 pad-5">
                                <div class="card my-2">
                                    <div class="card-header">
                                        <img style='border:1px solid #cecece' width='30px' height="30px" src='<?= base_url(); ?>asset/foto_user/<?= $foto_following; ?>' class='rounded-circle'> 
                                        <a href="<?= base_url() ?>user/<?= $post['username'] ?>"><?= $post['username']; ?></a>
                                    </div>
                                    <img class="card-img-top" src='<?= base_url() ?>asset/img_post/<?= $post['img'] ?>'>
                                    <div class="card-body">
                                        <h6 class="card-title"><a href='<?= base_url() ?>produk/detail/<?= $post['produk_seo']?>'><?= $post['judul_post']; ?></a></h6>

                                    </div>
                                </div>
                            </div>
                        <?php } ?>
                    </div>
                </div>
            </div>
            <div class="col-md-5 col-xs-12">
                <div class="position-fixed user-sidebar">
                    <?php include('sidebar_profile.php') ?>
                </div><!-- End .home-banners -->
            </div>
        </div>
    </div>
</section><!-- End #content -->