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
            <p class="card-text"><a href="http://localhost/php-mysqli/list-purchase-order.php" style="text-decoration: none; color: #000;">Purchase Orders</a></p>
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
          <!-- start untuk menampilkan data -->
          <div class="card">
            <div class="card-header bg-success text-white">
              <div class="d-flex justify-content-between">
                <h4>List of Purchase Order</h4>
                <a href="http://localhost/php-mysqli/new-purchase-order.php"><button type="button" class="btn btn-block btn-primary m-1">Tambah + </button></a>
              </div>
            </div>
          </div>

          <div class="card-body">
            <table class="table w-full">
              <tr>
                <th scope="col">Tanggal Masuk</th>
                <th scope="col">ID Order</th>
                <th scope="col">Kuantitas</th>
                <th scope="col">Harga</th>
                <th scope="col">Customer</th>
                <th scope="col">PO</th>
                <th scope="col">PO Expired</th>
                <th scope="col">Keterangan</th>
                <th scope="col">Action</th>
              </tr>
              <tbody>
                <?php
                $sql2 = "select * from po order by idtransaksi desc";
                $q2 = mysqli_query($koneksi, $sql2);
                $urut = 1;
                while ($r2 = mysqli_fetch_array($q2)) {
                  $tanggalmasuk = $r2['tanggalmasuk'];
                  $idorderanmasuk = $r2['idorderanmasuk'];
                  $kuantitas = $r2['kuantitas'];
                  $harga = $r2['harga'];
                  $customer = $r2['customer'];
                  $po = $r2['po'];
                  $poexpired = $r2['poexpired'];
                  $keterangan = $r2['keterangan'];

                ?>
                  <tr>
                    <td scope="row"><?php echo $tanggalmasuk ?></td>
                    <td scope="row"><?php echo $idorderanmasuk ?></td>
                    <td scope="row"><?php echo $kuantitas ?></td>
                    <td scope="row"><?php echo $harga ?></td>
                    <td scope="row"><?php echo $customer ?></td>
                    <td scope="row"><?php echo $po ?></td>
                    <td scope="row"><?php echo $poexpired ?></td>
                    <td scope="row"><?php echo $keterangan ?></td>
                    <td scope="row">
                      <a href="new-purchase-order.php?op=edit&idorderanmasuk=<?php echo $idorderanmasuk ?>"><button type="button" class="btn btn-block btn-warning m-1">Rubah</button></a>
                      <a href="list-purchase-order.php?op=delete&idorderanmasuk=<?php echo $idorderanmasuk; ?>" onclick="return confirm('yakin mau delete data?')"><button type="button" class="btn btn-block btn-danger m-1">Hapus</button></a>
                    </td>
                  </tr>
                <?php

                }
                ?>
              </tbody>
            </table>
          </div>
          <!-- end untuk menampilkan data -->




        </div>
      </main>
    </div>
  </div>
  </div>
</body>

</html>