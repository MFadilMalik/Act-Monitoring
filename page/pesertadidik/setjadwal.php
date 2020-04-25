<?php
    session_start();
    error_reporting(0);
    include '../../config/koneksi.php';
    if(@$_SESSION['username']==""){
    echo "<script>alert('Silahkan login terlebih dahulu !');document.location.href='../../index.php'</script>";
    }
  if(isset($_POST['simpan'])){
    $sql = mysqli_query($con, "INSERT INTO detail_jadwal VALUES ('','$_SESSION[username]', '$_POST[hari]', '$_POST[tanggal]', '$_POST[mulai]', '$_POST[akhir]', '$_POST[aktifitas]', '$_POST[mapel]', '')");
    if ($sql) {
      echo "<script>alert('Data berhasil masuk');
      document.location.href='?menu=setjadwal'</script>";
    }else{
      echo "<script>alert('Data gagal masuk');
      document.location.href='?menu=setjadwal'</script>";
    }
  }

  if(isset($_GET['hapus'])){
    $sql = mysqli_query($con, "DELETE FROM detail_jadwal WHERE idKegiatan = '$_GET[id]'");
    if($sql){
      echo "<script>alert('Data berhasil dihapus');
      document.location.href='?menu=setjadwal'</script>";
    }else{
      echo "<script>alert('Data gagal dihapus');
      document.location.href='?menu=setjadwal'</script>";
    }
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
                    <select name="hari" class="form-control">
                        <option value="Senin">Senin</option>
                        <option value="Selasa">Selasa</option>
                        <option value="Rabu">Rabu</option>
                        <option value="Kamis">Kamis</option>
                        <option value="Jumat">Jumat</option>
                        <option value="Sabtu">Sabtu</option>
                        <option value="Minggu">Minggu</option>
                    </select>
                    </div>
                    <div class="col">
                    <input type="text" name="tanggal" class="form-control" placeholder="Tanggal" onfocus="(this.type='date')" onblur="(this.type='text')" value="<?php echo $isi['password']?>">
                    </div>
                </div>
            </div>
            <h6>Waktu</h6>
            <div class="form-group">
            	<div class="row">
            		<div class="col">
            			<input type="text" name="mulai" class="form-control" placeholder="Mulai" onfocus="(this.type='time')" onblur="(this.type='text')">
            		</div>
            		<div class="col">
            			<input type="text" name="akhir" class="form-control" placeholder="Akhir" onfocus="(this.type='time')" onblur="(this.type='text')">
            		</div>
            		<div class="col">
            			<input type="text" name="aktifitas" placeholder="Aktifitas" class="form-control">
            		</div>
            		<div class="col">
            			<input type="text" name="mapel" placeholder="Implementasi Mapel" class="form-control">
            		</div>
            	</div>
            </div>
            <button class="btn btn-primary" name="simpan">SUBMIT</button>
            <button class="btn btn btn-secondary" name="clear">CLEAR</button>
            </form>
            <br><br>
              <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      
                     
                      <th>Hari</th>
                      <th>Tanggal</th>
                      <th>Jam Mulai</th>
                      <th>Jam Akhir</th>
                      <th>Aktifitas</th>
                      <th>Implementasi Mapel</th>
                      <th colspan="2">Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php 
                        $sql = mysqli_query($con,"SELECT * FROM detail_jadwal WHERE nis = '$_SESSION[username]'");
                      while($r=mysqli_fetch_array($sql)){
                     ?>
                     <tr>
                       
                       <td><?php echo $r['hari'] ?></td>
                       <td><?php echo $r['tanggal'] ?></td>
                       <td><?php echo $r['jam_mulai'] ?></td>
                       <td><?php echo $r['jam_akhir'] ?></td>
                       <td><?php echo $r['aktifitas'] ?></td>
                       <td><?php echo $r['mapel'] ?></td>
                       <td><a class="btn btn-danger" href="?menu=setjadwal&hapus&id=<?php echo $r['idKegiatan'] ?>">DELETE</a></td>
                     </tr>
                    <?php } ?>
                  </tbody>
                </table>
              </div>
            </div>
          </div>