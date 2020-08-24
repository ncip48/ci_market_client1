<div class="modal fade" id="rekening" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h5 class="modal-title" id="myModalLabel">No Rekening Perusahaan</h5>
      </div>
      <div class="modal-body">
        <?php
        echo "<table class='table table-hover table-condensed'>
                  <tr bgcolor=#cecece>
                    <th>No</th>
                    <th>Nama Bank</th>
                    <th>No Rekening</th>
                    <th>Atas Nama</th>
                    <th></th>
                  </tr>";
        $no = 1;
        $rekening = $this->db->query("SELECT * FROM tb_rekening");
        foreach ($rekening->result_array() as $row) {
          echo "<tr>
                        <td>$no</td>
                        <td>$row[nama_bank]</td>
                        <td>$row[no_rekening]</td>
                        <td>$row[pemilik_rekening]</td>
                      </tr>";
          $no++;
        }
        echo "</table>";
        ?>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="lupass" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h5 class="modal-title" id="myModalLabel">Lupa Password?</h5>
      </div>
      <center>
        <div class="modal-body">
          <?php
          $attributes3 = array('id' => 'formku', 'class' => 'form-horizontal', 'role' => 'form');
          echo form_open_multipart('auth/lupass', $attributes3);
          ?>
          <div class="form-group">
            <center style='color:red'>Masukkan Email yang dipakai saat pendaftaran</center><br>
            <label for="inputEmail3" class="col-sm-2 control-label">Email</label>
            <div class='col-sm-9'>
              <div style='background:#fff;' class="input-group col-sm-10">
                <input style='text-transform:lowercase;' type="email" class="required form-control" name="a" required>
              </div>
            </div>
          </div>

          <div class="form-group">
            <div class="col-sm-offset-3">
              <button type="submit" name='lupa' class="btn btn-primary">Kirim</button>
              &nbsp; &nbsp; &nbsp;<a data-dismiss="modal" aria-hidden="true" data-toggle='modal' href='#login' data-target='#login' title="Lupa Password Members">Kembali Login?</a>
            </div>
          </div>
          </form>
          <div style='clear:both'></div>
        </div>
      </center>
    </div>
  </div>
</div>

<div class="modal fade" id="uploadfoto" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h5 class="modal-title" id="myModalLabel">Ganti Foto Profile anda?</h5>
      </div>
      <center>
        <div class="modal-body">
          <?php
          $attributes = array('class' => 'form-horizontal', 'role' => 'form');
          echo form_open_multipart('members/foto', $attributes); ?>

          <div class="form-group">
            <center style='color:#8a8a8a'>Recomended (200 Kb atau 600 x 600) </center><br>
            <label for="inputEmail3" class="col-sm-3 control-label">Pilih Foto</label>
            <div style='background:#fff;' class="input-group col-sm-7">
              <span class="input-group-addon"><i class='fa fa-image fa-fw'></i></span>
              <input style='text-transform:lowercase;' type="file" class="form-control" name="userfile">
            </div>
          </div>

          <div class="form-group">
            <div class="col-sm-offset-1">
              <button type="submit" name='submit' class="btn btn-primary">Update Foto</button>
            </div>
          </div>

          </form>
          <div style='clear:both'></div>
        </div>
      </center>
    </div>
  </div>
</div>

<div class="modal fade" id="uploadfotoreseller" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h5 class="modal-title" id="myModalLabel">Ganti Foto Profile anda?</h5>
      </div>
      <center>
        <div class="modal-body">
          <?php
          $attributes = array('class' => 'form-horizontal', 'role' => 'form');
          echo form_open_multipart('reseller/foto', $attributes); ?>

          <div class="form-group">
            <center style='color:#8a8a8a'>Recomended (200 Kb atau 600 x 600) </center><br>
            <label for="inputEmail3" class="col-sm-3 control-label">Pilih Foto</label>
            <div style='background:#fff;' class="input-group col-sm-7">
              <span class="input-group-addon"><i class='fa fa-image fa-fw'></i></span>
              <input style='text-transform:lowercase;' type="file" class="form-control" name="userfile">
            </div>
          </div>

          <div class="form-group">
            <div class="col-sm-offset-1">
              <button type="submit" name='submit' class="btn btn-primary">Update Foto</button>
            </div>
          </div>

          </form>
          <div style='clear:both'></div>
        </div>
      </center>
    </div>
  </div>
</div>

<div id="theModal" class="modal fade text-center">
  <div class="modal-dialog">
    <div class="modal-content">

    </div>
  </div>
</div>

<div id="modal-following" class="modal">
  <div class="modal-dialog modal-popup mx-0 my-0" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h6 class="modal-title">Following</h6>
        <button class="btn px-0 py-0" id="tutup-modal" data-url="<?= current_url() ?>">X</button>
      </div>
      <div class="modal-body" id="modal-body" style="max-height:550px; height:550px; width:400px">
        <section id="content" class="modal-following">
          <div class="container">
            <div class="row">
              <div class="w-100 mx-auto">
                <ul class="list-group">
                  <li class="list-group-item list-group-item-action d-flex align-items-start">
                    <div class="d-flex w-100 justify-content-start">
                      <img width='40px' height="40px" class='rounded-circle' src='<?= base_url() ?>asset/foto_user/foto'>
                      <div class="flex-column">
                        <div class="d-flex">
                          <h6 class="my-0 mx-2">username</h6>
                          <small class="font-italic">tidak</small>
                        </div>
                        <small class="text-muted mx-2 my-0">nama</small>
                      </div>
                    </div>
                    <button id="unfollow" class='btn btn-primary btn-sm ml-5 my-0'>unfollow</button>
                  </li>
                </ul>
              </div>
            </div>
          </div>
        </section><!-- End #content -->
      </div>
    </div>
  </div>
</div>

<div id="modal-follower" class="modal">
  <div class="modal-dialog modal-popup mx-0 my-0" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h6 class="modal-title">Follower</h6>
        <button class="btn px-0 py-0" id="tutup-modal" data-url="<?= current_url() ?>">X</button>
      </div>
      <div class="modal-body" id="modal-body-follower" style="max-height:550px; height:550px; width:400px">
        <section id="content" class="modal-follower">
          <div class="container">
            <div class="row">
              <div class="w-100 mx-auto">
                <ul class="list-group">
                  <li class="list-group-item list-group-item-action d-flex align-items-start">
                    <div class="d-flex w-100 justify-content-start">
                      <img width='40px' height="40px" class='rounded-circle' src='<?= base_url() ?>asset/foto_user/foto'>
                      <div class="flex-column">
                        <div class="d-flex">
                          <h6 class="my-0 mx-2">username</h6>
                        </div>
                        <small class="text-muted mx-2 my-0">nama</small>
                      </div>
                    </div>
                  </li>
                </ul>
              </div>
            </div>
          </div>
        </section><!-- End #content -->
      </div>
    </div>
  </div>
</div>