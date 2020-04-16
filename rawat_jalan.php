<!DOCTYPE html>
<html lang="en">

<head>
  <?php
  $page = "Rawat Jalan";
  session_start();
  include 'auth/connect.php';
  include "part/head.php";

  @$nama = $_POST['nama'];
  $cek = mysqli_query($conn, "SELECT * FROM pasien WHERE nama_pasien='$nama' OR id='$nama'");
  $cekrow = mysqli_num_rows($cek);
  $tokne = mysqli_fetch_array($cek);

  if (isset($_POST['jalan1'])) {
    if ($cekrow == 0) {
      mysqli_query($conn, "INSERT INTO pasien (nama_pasien, tinggi_badan, berat_badan) VALUES ('$nama', '0', '0')");
      echo '<script> location.reload(); </script>';
    } else {
      echo '<script>
				setTimeout(function() {
					swal({
						title: "Pasien Telah Terdaftar!",
						text: "Pasien yang bernama ' . ucwords($tokne['nama_pasien']) . ' sudah terdaftar, silahkan lanjutkan ke menu selanjutnya",
						icon: "success"
						});
					}, 500);
			</script>';
    }
  }

  if (isset($_POST['jalan2'])) {
    $namamu = $_POST['nama'];
    @$tgl = $_POST['tgl'];
    $berat = $_POST['berat'];
    $tinggi = $_POST['tinggi'];
    $alam = $_POST['alamat'];

    mysqli_query($conn, "UPDATE pasien SET alamat='$alam', tgl_lahir='$tgl', berat_badan='$berat', tinggi_badan='$tinggi' WHERE nama_pasien='$namamu'");
  }
  ?>
</head>

<body>
  <div id="app">
    <div class="main-wrapper main-wrapper-1">
      <div class="navbar-bg"></div>

      <?php
      include 'part/navbar.php';
      include 'part/sidebar.php';
      ?>

      <!-- Main Content -->
      <div class="main-content">
        <section class="section">
          <div class="section-header">
            <h1><?php echo $page; ?></h1>
          </div>

          <div class="section-body">
            <div class="row">
              <div class="col-12">
                <div class="card">
                  <div class="card-header">
                    <h4>Create New App</h4>
                  </div>
                  <div class="card-body">
                    <div class="row mt-4">
                      <div class="col-12 col-lg-8 offset-lg-1">
                        <div class="wizard-steps">
                          <div class="wizard-step wizard-step-active">
                            <div class="wizard-step-icon">
                              <i class="far fa-user"></i>
                            </div>
                            <div class="wizard-step-label">
                              Identitas Pasien
                            </div>
                          </div>
                          <div class="wizard-step wizard-step-active">
                            <div class="wizard-step-icon">
                              <i class="fas fa-server"></i>
                            </div>
                            <div class="wizard-step-label">
                              Informasi Umum
                            </div>
                          </div>
                          <div class="wizard-step">
                            <div class="wizard-step-icon">
                              <i class="fas fa-stethoscope"></i>
                            </div>
                            <div class="wizard-step-label">
                              Pemeriksaan
                            </div>
                          </div>
                          <div class="wizard-step">
                            <div class="wizard-step-icon">
                              <i class="fas fa-briefcase-medical"></i>
                            </div>
                            <div class="wizard-step-label">
                              Tindakan yang dilakukan
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>

                    <form class="wizard-content mt-2 needs-validation" novalidate="" method="POST" autocomplete="off">
                      <div class="wizard-pane">
                        <?php if (empty($_POST)) { ?>

                          <!-- PART 1 -->

                          <div class="form-group row align-items-center">
                            <label class="col-md-4 text-md-right text-left">Nama Lengkap / ID</label>
                            <div class="col-lg-4 col-md-6">
                              <input id="myInput" type="text" class="form-control" name="nama" placeholder="Nama / ID Calon Pasien">
                              <div class="invalid-feedback">
                                Mohon data diisi!
                              </div>
                            </div>
                          </div>
                          <div class="form-group row">
                            <div class="col-md-4"></div>
                            <div class="col-lg-4 col-md-6 text-right">
                              <button class="btn btn-icon icon-right btn-primary" name="jalan1">Selanjutnya <i class="fas fa-arrow-right"></i></button>
                            </div>
                          </div>
                        <?php }
                        if (isset($_POST['jalan1'])) { ?>

                          <!-- PART 2 -->

                          <div class="form-group row align-items-center">
                            <label class="col-md-4 text-md-right text-left">Nama Lengkap</label>
                            <div class="col-lg-4 col-md-6">
                              <input type="hidden" name="nama" class="form-control" required="" value="<?php echo $tokne['nama_pasien']; ?>">
                              <input type="text" class="form-control" required="" value="<?php echo $tokne['nama_pasien']; ?>" disabled>
                            </div>
                          </div>
                          <div class="form-group row">
                            <label class="col-md-4 text-md-right text-left">Tanggal lahir</label>
                            <div class="col-lg-4 col-md-6">
                              <input type="text" class="form-control datepicker" name="tgl" required="" value="<?php echo $tokne['tgl_lahir']; ?>">
                            </div>
                          </div>
                          <div class="form-group row">
                            <label class="col-md-4 text-md-right text-left col-form-label">Tinggi Badan</label>
                            <div class="input-group col-sm-6 col-lg-4">
                              <input type="number" class="form-control" name="tinggi" required="" value="<?php echo $tokne['tinggi_badan']; ?>">
                              <div class="invalid-feedback">
                                Mohon data diisi!
                              </div>
                              <div class="input-group-prepend">
                                <div class="input-group-text">
                                  cm
                                </div>
                              </div>
                            </div>
                          </div>
                          <div class="form-group row">
                            <label class="col-md-4 text-md-right text-left col-form-label">Berat Badan</label>
                            <div class="input-group col-sm-6 col-lg-4">
                              <input type="number" class="form-control" name="berat" required="" value="<?php echo $tokne['berat_badan']; ?>">
                              <div class="invalid-feedback">
                                Mohon data diisi!
                              </div>
                              <div class="input-group-prepend">
                                <div class="input-group-text">
                                  Kg
                                </div>
                              </div>
                            </div>
                          </div>
                          <div class="form-group row">
                            <label class="col-md-4 text-md-right text-left">Alamat</label>
                            <div class="col-lg-4 col-md-6">
                              <textarea type="number" class="form-control" name="alamat" required=""><?php echo $tokne['alamat']; ?></textarea>
                              <div class="invalid-feedback">
                                Mohon data diisi!
                              </div>
                            </div>
                          </div>
                          <div class="form-group row">
                            <div class="col-md-4"></div>
                            <div class="col-lg-4 col-md-6 text-right">
                              <button class="btn btn-icon icon-right btn-primary" name="jalan2">Selanjutnya <i class="fas fa-arrow-right"></i></button>
                            </div>
                          </div>
                        <?php }
                        if (isset($_POST['jalan2'])) { ?>
                        aahhww
                        <?php } ?>
                      </div>
                    </form>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </section>
      </div>

      <?php include 'part/footer.php'; ?>
    </div>
  </div>
  <?php include "part/all-js.php";
  include "part/autocomplete.php"; ?>
</body>

</html>