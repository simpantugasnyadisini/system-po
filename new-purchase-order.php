<?php
$host = "localhost";
$user = "root";
$pass = "";
$db = "suburjaya";

$koneksi = mysqli_connect($host, $user, $pass, $db);
//cek koneksi
if (!$koneksi) {
  die("tidak bisa terkoneksi ke database");
}
$tanggalmasuk = "";
$idorderanmasuk = "";
$kuantitas = "";
$harga = "";
$customer = "";
$po = "";
$poexpired = "";
$keterangan = "";
$sukses = "";
$error = "";

if (isset($_GET['op'])) {
  $op = $_GET['op'];
} else {
  $op = "";
}

if ($op == 'delete') {
  $idorderanmasuk = $_GET['idorderanmasuk'];
  $sql1 = "DELETE from po WHERE idorderanmasuk = '$idorderanmasuk'";
  $q1 = mysqli_query($koneksi, $sql1);
  if ($q1) {
    $sukses = "berhasil hapus data";
  } else {
    $error = "gagal melakukan delete data";
  }
}

if ($op == 'edit') {
  $idorderanmasuk = $_GET['idorderanmasuk'];
  $sql1 = "SELECT * FROM po WHERE idorderanmasuk = ?";
  $stmt = mysqli_prepare($koneksi, $sql1);

  if ($stmt) {
    // Binding parameter dan mengeksekusi statement
    mysqli_stmt_bind_param($stmt, "s", $idorderanmasuk);
    mysqli_stmt_execute($stmt);

    // Mengambil hasil query
    $result = mysqli_stmt_get_result($stmt);

    if ($row = mysqli_fetch_assoc($result)) {
      // Mengisi nilai-nilai dari database ke variabel
      $tanggalmasuk = $row['tanggalmasuk'];
      $idorderanmasuk = $row['idorderanmasuk'];
      $kuantitas = $row['kuantitas'];
      $harga = $row['harga'];
      $customer = $row['customer'];
      $po = $row['po'];
      $poexpired = $row['poexpired'];
      $keterangan = $row['keterangan'];
    } else {
      $error = "Data tidak ditemukan";
    }
  } else {
    $error = "Gagal membuat statement SQL";
  }
}


if (isset($_POST['simpan'])) { //untuk create data po
  $tanggalmasuk   = $_POST['tanggalmasuk'];
  $idorderanmasuk = $_POST['idorderanmasuk'];
  $kuantitas      = $_POST['kuantitas'];
  $harga          = $_POST['harga'];
  $customer       = $_POST['customer'];
  $po             = $_POST['po'];
  $poexpired      = $_POST['poexpired'];
  $keterangan     = $_POST['keterangan'];

  if ($tanggalmasuk && $idorderanmasuk && $kuantitas && $harga && $customer && $po && $poexpired && $keterangan) {
    if ($op == 'edit') { //untuk update
      $sql1 = "UPDATE po SET idorderanmasuk = '$idorderanmasuk', tanggalmasuk = '$tanggalmasuk', kuantitas = '$kuantitas', harga = '$harga', customer = '$customer', po = '$po', poexpired = '$poexpired', keterangan = '$keterangan' WHERE idorderanmasuk = '$idorderanmasuk'";
      $q1 = mysqli_query($koneksi, $sql1);
      if ($q1) {
        $sukses = "data berhasil diupdate";
      } else {
        $error = "data gagal diupdate";
      }
    } else { //untuk membuat data baru
      $sql1 = "insert into po(tanggalmasuk, idorderanmasuk, kuantitas, harga, customer, po, poexpired, keterangan) values ('$tanggalmasuk', '$idorderanmasuk', '$kuantitas', '$harga', '$customer', '$po', '$poexpired', '$keterangan')";
      $q1 = mysqli_query($koneksi, $sql1);
      if ($q1) {
        $sukses = "berhasil memasukkan data baru";
      } else {
        $error = "gagal memasukkan data";
      }
    }
  } else {
    $error = "silahkan masukkan semua data";
  }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Dashboard</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>

<body>
  <div class="container-fluid bg-primary-subtle">
    <div class="d-flex align-items-start mt-(-1)">
      <aside>
        <div class="card" style="width: 18rem; height: 100vh;">
          <div class="card-body bg-success text-white">
            <h3 class="card-title fw-bold"><a href="http://localhost/php-mysqli/index.php" style="text-decoration: none; color: #000;">System PO</a></h3>
            <br>
            <p class="card-text fw-bold border-bottom">Menu</p>
            <p class="card-text"><a href="http://localhost/php-mysqli/index.php" style="text-decoration: none; color: #000;">Dashboard</a></p>
            <p class="card-text"><a href="http://localhost/php-mysqli/list-purchase-order.php" style="text-decoration: none; color: #000;">Purchase Order</a></p>
            <p class="card-text">Supplier List</p>
            <p class="card-text">Item List</p>
            <br>
            <p class="card-text fw-bold border-bottom">Maintenance</p>
            <p class="card-text">User List</p>
            <p class="card-text">Setting</p>
          </div>
        </div>
      </aside>
      <main>
        <header class="bg-success border shadow p-1" style="width: 66rem; height: 10vh;">
          <div class="d-flex justify-content-between p-2">
            <p class="p-2">Purchase Order Management System CV. Subur Jaya</p>
            <p class="fw-bold"><img src="./images/user.svg" class="img-fluid rounded-start p-1" alt="user-jpg" style="height: 40px; width:auto">Akun Administrator</p>
          </div>
        </header>
        <div>
        <div class="card ">
      <div class="card-header bg-success text-white">
        <div class="d-flex justify-content-between">
          <h4>Buat Data PO</h4>
          <a href="http://localhost/php-mysqli/list-purchase-order.php"><button type="button" class="btn btn-block btn-primary m-1">Lihat Data PO</button></a>
        </div>
      </div>
      <div class="card-body">
        <?php
        if ($error) {
        ?>
          <div class="alert alert-danger" role="alert">
            <?php echo $error ?>
          </div>
        <?php
          header("refresh:10;url=new-purchase-order.php"); //10 : detik
        }
        ?>
        <?php
        if ($sukses) {
        ?>
          <div class="alert alert-success" role="alert">
            <?php echo $sukses ?>
          </div>
        <?php
          header("refresh:5;url=new-purchase-order.php");
        }
        ?>

        <form action="" method="POST">

          <div class="mb-3 row">
            <label for="tanggalmasuk" class="col-sm-2 col-form-label">Tanggal Masuk</label>
            <div class="col-sm-10">
              <input type="date" class="form-control" id="tanggalmasuk" name="tanggalmasuk" value="<?php echo $tanggalmasuk ?>">
            </div>
          </div>

          <div class="mb-3 row">
            <label for="idorderanmasuk" class="col-sm-2 col-form-label">ID Order</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" id="idorderanmasuk" name="idorderanmasuk" placeholder="e.g. 01-234-AB" value="<?php echo $idorderanmasuk ?>">
            </div>
          </div>

          <div class="mb-3 row">
            <label for="kuantitas" class="col-sm-2 col-form-label">Kuantitas</label>
            <div class="col-sm-10">
              <input type="number" class="form-control" id="kuantitas" name="kuantitas" placeholder="e.g. 100" value="<?php echo $kuantitas ?>">
            </div>
          </div>

          <div class="mb-3 row">
            <label for="harga" class="col-sm-2 col-form-label">Harga (Rp)</label>
            <div class="col-sm-10">
              <input type="number" class="form-control" id="harga" name="harga" placeholder="e.g. 100.000" value="<?php echo $harga ?>">
            </div>
          </div>

          <div class="mb-3 row">
            <label for="customer" class="col-sm-2 col-form-label">Customer</label>
            <div class="col-sm-10">
              <select class="form-control" name="customer" id="customer">
                <option value="">- Pilih Konsumen -</option>
                <option value="coopdesign" <?php if ($customer == "coopdesign") echo "selected" ?>>Coop Design</option>
                <option value="littlecoop" <?php if ($customer == "littlecoop") echo "selected" ?>>Little Coop</option>
              </select>
            </div>
          </div>

          <div class="mb-3 row">
            <label for="po" class="col-sm-2 col-form-label">PO</label>
            <div class="col-sm-10">
              <select class="form-control" name="po" id="po">
                <option value="">- Pilih PO atau Tidak -</option>
                <option value="Tidak" <?php if ($po == "Tidak") echo "selected" ?>>Tidak</option>
                <option value="Ya" <?php if ($po == "Ya") echo "selected" ?>>Ya</option>
              </select>
            </div>
          </div>


          <div class="mb-3 row">
            <label for="poexpired" class="col-sm-2 col-form-label">PO Expired</label>
            <div class="col-sm-10">
              <input type="date" class="form-control" id="poexpired" name="poexpired" value="<?php echo $poexpired ?>">
            </div>
          </div>

          <div class="mb-3 row">
            <label for="keterangan" class="col-sm-2 col-form-label">Keterangan</label>
            <div class="col-sm-10">
              <textarea class="form-control" id="keterangan" name="keterangan" placeholder="Tambah Keterangan" rows="5" cols="1000"><?php echo $keterangan ?></textarea>
            </div>
          </div>

          <div class="d-grid gap-2">
            <input type="submit" name="simpan" value="Simpan Data" class="btn btn-primary" />
          </div>

        </form>
      </div>
    </div>


        </div>
      </main>
    </div>
  </div>
  </div>
</body>

</html>