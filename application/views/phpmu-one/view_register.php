<?php
/*echo "<p class='sidebar-title'> Pendaftaran Members</p>
<div class='alert alert-info'><b>PENTING!</b> - Contact information </div>
<br>";
$attributes = array('id' => 'formku','class'=>'form-horizontal','role'=>'form');
echo form_open_multipart('auth/register',$attributes); 
  echo "<div class='form-group'>
            <label for='inputEmail3' class='col-sm-3 control-label'>Nama Lengkap</label>
            <div class='col-sm-9'>
            <div style='background:#fff;' class='input-group col-sm-12'>
                <input type='text' class='required form-control' name='c'>
            </div>
            </div>
        </div>

        <div class='form-group'>
            <label for='inputEmail3' class='col-sm-3 control-label'>No Telpon/Hp</label>
            <div class='col-sm-9'>
            <div style='background:#fff;' class='input-group col-sm-6'>
                <input type='number' class='required number form-control' name='j'  minlength='10'>
            </div>
            </div>
        </div>

        <div class='form-group'>
            <label for='inputPassword3' class='col-sm-3 control-label'>Alamat</label>
            <div class='col-sm-9'>
            <div style='background:#fff;' class='input-group col-lg-12'>
                <input type='text' class='required form-control' name='e'>
            </div></div>
        </div>

        <div class='form-group'>
            <label for='inputPassword3' class='col-sm-3 control-label'>Kota</label>
            <div class='col-sm-9'>
            <div style='background:#fff;' class='input-group col-lg-12'>
                <select class='form-control' name='h' required>
                    <option value=''>- Pilih -</option>";
                    foreach ($kota as $rows) {
                        echo "<option value='$rows[kota_id]'>$rows[nama_kota]</option>";
                    }
                echo "</select>
            </div></div>
        </div>

        <div class='form-group'>
            <label for='inputEmail3' class='col-sm-3 control-label'>Email</label>
            <div class='col-sm-9'>
            <div style='background:#fff;' class='input-group col-sm-12'>
                <input type='email' class='required email form-control' name='d'>
            </div>
            </div>
        </div>

        <div class='form-group'>
            <label for='inputEmail3' class='col-sm-3 control-label'>Username</label>
            <div class='col-sm-9'>
            <div style='background:#fff;' class='input-group col-sm-6'>
                <input type='text' class='required form-control' name='a' onkeyup=\"nospaces(this)\" required>
            </div>
            </div>
        </div>


        <div class='form-group'>
            <label for='inputEmail3' class='col-sm-3 control-label'>Password</label>
            <div class='col-sm-9'>
            <div style='background:#fff;' class='input-group col-sm-6'>
                <input type='password' class='required form-control' onkeyup=\"nospaces(this)\" name='b' required>
            </div>
            </div>
        </div>

        <br>
        <div class='form-group'>
            <div class='col-sm-offset-2'>
                <button type='submit' name='submit' class='btn btn-primary'>Daftar</button>
                <a  class='btn btn-default' href='".base_url()."auth/login'>Sudah Punya Akun?</a>
            </div>
        </div>
    </form>"; */
?>
<div class='container container-login'>
    <div class='center row justify-content-center'>
        <div class='col-md-12 login-form-2 panelregister'>
            <h3>Daftar</h3>
        </div>
        <div class='col-md-6 login-form-2 panelregister'>
            <?php
            $attributes = array('id' => 'frmRegister', 'class' => 'form-horizontal', 'role' => 'form');
            echo form_open_multipart('auth/aksiregister', $attributes); ?>
            <div class="form-group">
                <input type="text" name='c' class="form-control" placeholder="Nama Lengkap" value="" />
            </div>
            <div class="form-group">
                <input type="text" name='j' class="form-control" placeholder="No Telp / HP" value="" />
            </div>
            <div class="form-group">
                <input type="text" name='e' class="form-control" placeholder="Alamat" value="" />
            </div>
            <div class="form-group">
                <select class='form-control' name="provinsi" id="provinsi">
                    <option value=''>- Pilih Provinsi -</option>";
                    <?php foreach ($provinsi->result as $data) {
                        echo "<option value='" . $data->province_id . "'>" . $data->province . "</option>";
                    } ?>
                </select>
            </div>
            <div class="form-group">
                <select name="kota" id="kota" class='form-control'>
                    <option value="">Pilih Kota</option>
                </select>
            </div>
        </div>
        <div class="col-md-6 login-form-2 panelregister">
            <div class="form-group">
                <input type="email" class="email form-control" name='d' placeholder="Masukkan Email" value="" />
            </div>
            <div class="form-group">
                <input type="text" minlength="3" name="a" class="form-control" placeholder="Masukkan Username" value="" />
            </div>
            <div class="form-group">
                <input type="password" name='b' class="form-control" placeholder="Masukkan Password" value="" />
            </div>
            <div class="form-group">
                <input type="password" class="form-control" placeholder="Masukkan Password Kembali" value="" />
            </div>
        </div>
        <div class='col-md-12 login-form-2 panelregister'>
            <input type="submit" class="btnSubmit" value="Daftar" />
            <div id='loadingzz'></div>
        </div>
        </form>
        <div class='col-md-12 login-form-2'>
            <div id='aksiregister'></div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() { // Ketika halaman sudah siap (sudah selesai di load)
        // Kita sembunyikan dulu untuk loadingnya
        $("#loading").hide();

        $("#provinsi").change(function() { // Ketika user mengganti atau memilih data provinsi
            $("#kota").hide(); // Sembunyikan dulu combobox kota nya
            $("#loading").show(); // Tampilkan loadingnya
            var id_provinsi = $("#provinsi").val()
            $.ajax({
                type: "GET", // Method pengiriman data bisa dengan GET atau POST
                url: "http://api.shipping.esoftplay.com/city/" + id_provinsi, // Isi dengan url/path file php yang dituju
                //data: {id_provinsi : $("#provinsi").val()}, // data yang akan dikirim ke file yang dituju
                dataType: "json",
                success: function(response) { // Ketika proses pengiriman berhasil
                    var res = jQuery.parseJSON(JSON.stringify(response.result))
                    //console.log(res.result)
                    $("#loading").hide(); // Sembunyikan loadingnya
                    // set isi dari combobox kota
                    // lalu munculkan kembali combobox kotanya
                    res.forEach(function(item) {
                        // do something with `item`
                        //console.log(item.city_name)
                        //$("#kota").append(item.type + " " + item.city_name).show();
                        $("#kota").append("<option value='" + item.city_id + "'>" + item.type + " " + item.city_name + "</option>").show();
                    });
                },
                error: function(xhr, ajaxOptions, thrownError) { // Ketika ada error
                    alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError); // Munculkan alert error
                }
            });
        });
    });
</script>