<?php
    error_reporting(0);
    include '../../config/koneksi.php';
    if(@$_SESSION['username']==""){
    echo "<script>alert('Silahkan login terlebih dahulu !');document.location.href='../../index.php'</script>";
  }
  if(isset($_POST['simpan'])){
    $sql = mysqli_query($con, "INSERT INTO user VALUES ('', '$_POST[nama]', '$_POST[username]', '$_POST[password]', '$_POST[akses]')");
    if ($sql) {
      echo "<script>alert('Data berhasil masuk');
      document.location.href='?menu=account'</script>";
    }else{
      echo "<script>alert('Data gagal masuk');
      document.location.href='?menu=account'</script>";
    }
  }
  if(isset($_GET['edit'])) {
    $sql = mysqli_query($con, "SELECT * FROM user WHERE id = '$_GET[id]'");
    $isi = mysqli_fetch_array($sql);
  }
  if (isset($_POST['update'])) {
    $sql = mysqli_query($con, "UPDATE user SET nama = '$_POST[nama]', username = '$_POST[username]', password = '$_POST[password]', akses = '$_POST[akses]' WHERE id = '$_GET[id]'");
    if ($sql) {
      echo "<script>alert('Data berhasil diubah');document.location.href='?menu=account';</script>";
    }else{
      echo "<script>alert('Data gagal diubah');document.location.href='?menu=account';</script>";
    }
  }
  if (isset($_POST['clear'])) {
    echo "<script>alert('Data dibersihkan');document.location.href='?menu=account';</script>";
  }else{
    mysqli_error($con);
  }

  if(isset($_GET['hapus'])){
    $sql = mysqli_query($con, "DELETE FROM user WHERE id = '$_GET[id]'");
    if($sql){
      echo "<script>alert('Data berhasil dihapus');
      document.location.href='?menu=account'</script>";
    }else{
      echo "<script>alert('Data gagal dihapus');
      document.location.href='?menu=account'</script>";
    }
  }
 ?>
          <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">Account</h6>
            </div>
            <div class="card-body">
            <form method="post">
            <div class="form-group">
                <div class="row">
                    <div class="col">
                    <input type="text" name="nama" class="form-control" placeholder="Nama" value="<?php echo $isi['nama']?>">
                    </div>
                    <div class="col">
                    <select name="akses" class="form-control">
                      <?php if ($isi['akses'] === 'Administrator') { ?>
                                <option value="Administrator">Administrator</option>
                            <?php }else if ($isi['akses'] === 'Peserta Didik') { ?>
                                <option value="Peserta Didik">Peserta Didik</option>
                            <?php }else if ($isi['akses'] === 'Orang Tua') { ?>
                                <option value="Orang Tua">Orang Tua</option>
                            <?php }else if ($isi['akses'] === 'Guru') { ?>
                                <option value="Guru">Guru</option>
                            <?php }else { ?>
                                <option value="" disabled selected>Akses</option>
                      <?php } ?>
                        <option value="Administrator">Administrator</option>
                        <option value="Peserta Didik">Peserta Didik</option>
                        <option value="Orang Tua">Orang Tua</option>
                        <option value="Guru">Guru</option>
                    </select>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <div class="row">
                    <div class="col">
                    <input type="text" name="username" class="form-control" placeholder="Username" value="<?php echo $isi['username']?>">
                    </div>
                    <div class="col">
                    <input type="text" name="password" class="form-control" placeholder="Password" value="<?php echo $isi['password']?>">
                    </div>
                </div>
            </div>
            <?php if (isset($_GET['edit'])) {?>
                <td><input class="btn btn-warning" type="submit" name="update" value="UPDATE"></td>
              <?php }else{ ?>
                <td><input class="btn btn-primary" type="submit" name="simpan" value="SIMPAN"></td>
            <?php } ?>
            <button class="btn btn-secondary" name="clear">CLEAR</button>
            </form>
            <br><br>
              <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>ID User</th>
                      <th>Nama</th>
                      <th>Akses</th>
                      <th>Username</th>
                      <th>Password</th>
                      <th colspan="2" >Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php 
                      $no=0;
                      $sql = mysqli_query($con,"SELECT * FROM user");
                      while($r=mysqli_fetch_array($sql)){
                      $no++;
                     ?>
                     <tr>
                       <td><?php echo $no; ?></td>
                       <td><?php echo $r['nama'] ?></td>
                       <td><?php echo $r['akses'] ?></td>
                       <td><?php echo $r['username'] ?></td>
                       <td><?php echo $r['password'] ?></td>
                       <td><a class="btn btn-success" href="?menu=account&edit&id=<?php echo $r['id'] ?>">Edit</a></td>
                       <td><a class="btn btn-danger" href="?menu=account&hapus&id=<?php echo $r['id'] ?>">Hapus</a></td>
                     </tr>
                    <?php } ?>
                  </tbody>
                </table>
              </div>
            </div>
          </div>

    