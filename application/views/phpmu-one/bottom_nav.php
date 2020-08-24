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
    $foto_user = 'users.gif';
    $icon_profile = "<img style='border:1px solid #cecece' width='25px' height='25px' src='".base_url()."asset/foto_user/".$foto_user."' class='rounded-circle'>";
  } else {
    $foto_user = $result['foto'];
    $icon_profile = "<img style='border:1px solid #cecece' width='25px' height='25px' src='".base_url()."asset/foto_user/".$foto_user."' class='rounded-circle'>";
  }
} else {
  $icon_profile = "<i class='icon-user-fill'></i>";
}
?>

<?php if($this->uri->segment_array()[1] == 'login' OR $this->uri->segment_array()[1] == 'daftar'){}else{ ?>

<nav class="fixed-bottom mobile-view">
  <div class="d-flex flex-column flex-1 align-items-center justify-content-center">
    <nav>
      <ul>
      <li>
          <a onclick="addClass(0)" href="#" class="d-flex justify-content-center align-items-center link">
            <i class="icon-camera"></i>
          </a>
        </li>
        <li>
          <a onclick="addClass(0)" href="#" class="d-flex justify-content-center align-items-center link">
            <i class="icon-grid-fill"></i>
          </a>
        </li>
        <li>
          <a onclick="addClass(0)" href="#" class="d-flex justify-content-center align-items-center link">
            <i class="icon-home-fill ic-sm"></i>
          </a>
        </li>
        <li>
          <a onclick="addClass(2)" href="#" class="d-flex justify-content-center align-items-center link">
            <i class="icon-envolope"></i>
          </a>
        </li>
        <li>
          <a onclick="addClass(3)" href="<?= base_url(); ?>members/profile" class="d-flex justify-content-center align-items-center link">
            <!-- <img style='border:1px solid #cecece' width='25px' height="25px" src='<?= base_url(); ?>asset/foto_user/<?= $foto_user; ?>' class='rounded-circle'> -->
            <!-- <i class="icon-user-fill"></i> -->
            <?= $icon_profile ?>
          </a>
        </li>
      </ul>
    </nav>
  </div>
</nav>
<?php } ?>