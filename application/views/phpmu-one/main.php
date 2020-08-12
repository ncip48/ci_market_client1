<?php
$slider = $this->db->query("SELECT * FROM slide");
$jumlahslide =  $this->db->query("SELECT count(*) as jumlah FROM slide")->row_array();
?>
<section id="content">
        	<div class="container">
                <div class="row">
                    <div class="col-md-8 col-xs-12">
                        <div id="slider-rev-container">
                            <div id="my-carousel" class="carousel slide" data-ride="carousel">
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
                                        <img class="d-block w-100" src="<?= base_url() ?>asset/slider/<?= $slider->row_array()[gambar]?>" id='ban1'>
                                    </div>
                                    <?php
                                        $temp_row = array_slice($slider->result_array(), 1);
                                        $a = 1;
                                        foreach ($temp_row as $row){
                                            $a = $a+1;
                                            echo "<div class='carousel-item'>
                                                      <img class='d-block w-100' src='".base_url()."asset/slider/".$row[gambar]."' id='ban".$a."'>
                                                  </div>";
                                        }
                                    ?>
                                </div>
                            </div>
                        </div>
                        
                    </div>
                    <div class="col-md-4 col-xs-12">
                        <div class="row home-banners">
                            <div class="col-md-12 col-sm-6 col-xs-6">
                                <a href="#"><img src="asset/images/middle-banner-1.png" alt="Home Big Banner 1" class="img-responsive img-140px"></a>
                            </div><!-- End .col-md-6 -->
                            
                            <div class="col-md-12 col-sm-6 col-xs-6">
                                <a href="#"><img src="asset/images/middle-banner-2.png" alt="Home Big Banner 2" class="img-responsive img-140px"></a>
                            </div><!-- End .col-md-4 -->
                        </div><!-- End .home-banners -->
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12 col-xs-12 scroll-home">
                        <div class="wrapper-category">
                            <div class="header-category">
                                KATEGORI
                            </div>
                            <div class="container-category">
                                <?php
                                foreach ($kategori->result_array() as $row) {
                                    echo "<a class='contentContainer btn btn-sm btn-block btn-primary' href='".base_url()."produk/kategori/$row[kategori_seo]'> $row[nama_kategori]</a>";
                                }
                                ?>
                            </div>
                            <div class="right"><i class="ri-arrow-right-s-line ri-xl"></i></div>
                            <div class="left"><i class="ri-arrow-left-s-line ri-xl"></i></div>
                        </div>
                      </ul>   
                    </div>
                </div>
            </div>
        </section><!-- End #content -->