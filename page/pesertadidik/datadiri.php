<?php
    session_start();
    error_reporting(0);
    include '../../config/koneksi.php';
    if(@$_SESSION['username']==""){
    echo "<script>alert('Silahkan login terlebih dahulu !');document.location.href='../../index.php'</script>";
    }
  if(isset($_GET['edit'])) {
    $sql = mysqli_query($con, "SELECT * FROM data_siswa WHERE id = '$_GET[id]'");
    $isi = mysqli_fetch_array($sql);
  }
  if (isset($_POST['update'])) {
    $sql = mysqli_query($con, "UPDATE data_siswa SET password = '$_POST[password]' WHERE id = '$_GET[id]'");
    if ($sql) {
      echo "<script>alert('Data berhasil diubah');document.location.href='?menu=data_diri';</script>";
    }else{
      echo "<script>alert('Data gagal diubah');document.location.href='?menu=data_diri';</script>";
    }
  }
  if (isset($_POST['clear'])) {
    echo "<script>alert('Data dibersihkan');document.location.href='?menu=data_diri';</script>";
  }else{
    mysqli_error($con);
  }
 ?>
 <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary" align="center"><?php echo $_SESSION['nama'] ?></h6>
            </div>
            <div class="card-body">
            <form method="post">
            <div class="form-group">
                <div class="row"> 
                    <div class="col">
                    <input type="text" name="password" class="form-control" placeholder="Password" value="<?php echo $isi['password']?>">
                    </div>
                </div>
            </div>
            <?php if (isset($_GET['edit'])) {?>
                <td><input class="btn btn-warning" type="submit" name="update" value="UPDATE"></td>
              <?php }else{ ?>
                <td><input class="btn btn-primary" type="submit" name="update" value="UPDATE" disabled></td>
            <?php } ?>
            <button class="btn btn-secondary" name="clear">CLEAR</button>
            </form>
            <br><br>
              <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>Nama</th>
                      <th>Username</th>
                      <th>Password</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php 
                        $sql = mysqli_query($con,"SELECT * FROM data_siswa WHERE username = '$_SESSION[username]'");
                      while($r=mysqli_fetch_array($sql)){
                     ?>
                     <tr>
                       <td><?php echo $r['nama'] ?></td>
                       <td><?php echo $r['username'] ?></td>
                       <td><?php echo $r['password'] ?></td>
                       <td><a class="btn btn-success" href="?menu=datadiri&edit&id=<?php echo $r['id'] ?>">Ubah Password</a></td>
                     </tr>
                    <?php } ?>
                  </tbody>
                </table>
              </div>
            </div>
          </div>