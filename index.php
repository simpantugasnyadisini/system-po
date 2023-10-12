<?php

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
  <div class="container bg-primary-subtle">
    <div class="d-flex align-items-start">
      <aside>
        <div class="card" style="width: 18rem; height: 100vh;">
          <div class="card-body bg-success text-white">
            <h3 class="card-title fw-bold"><a href="http://localhost/php-mysqli/index.php" style="text-decoration: none; color: #000;">System PO</a></h3>
            <br>
            <p class="card-text fw-bold border-bottom">Menu</p>
            <p class="card-text"><a href="http://localhost/php-mysqli/index.php" style="text-decoration: none; color: #000;">Dashboard</a></p>
            <p class="card-text">Supplier List</p>
            <p class="card-text">Item List</p>
            <p class="card-text"><a href="http://localhost/php-mysqli/purchase-order.php" style="text-decoration: none; color: #000;">Purchase Order</a></p>
            <br>
            <p class="card-text fw-bold border-bottom">Maintenance</p>
            <p class="card-text">User List</p>
            <p class="card-text">Setting</p>
          </div>
        </div>
      </aside>
      <main>
        <header class="bg-success border shadow p-1" style="width: 52rem; height: 10vh;">
          <div class="d-flex justify-content-between p-2">
            <p class="p-2">Purchase Order Management System CV. Subur Jaya</p>
            <p class="fw-bold"><img src="./images/user.svg" class="img-fluid rounded-start p-1" alt="user-jpg" style="height: 40px; width:auto">Akun Administrator</p>
          </div>
        </header>
        <div>
          <h2 class="p-2" >Welcome Administrator</h2>
          <div class="d-flex justify-content-start ">
          <div class="p-1">
            <div class="card p-2 m-1 shadow w-100 h-80">
              <div class="row g-1">
                <div class="col-md-4">
                  <img src="./images/list.svg" class="img-fluid rounded-start " alt="list-buyer-jpg" style="height: 60px; width:auto">
                </div>
                <div class="col-md-8">
                  <div class="">
                    <p class="card-title text-center ">Total Buyer</p>
                    <P class="card-text text-center fw-bold">100</P>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <div class="p-1">
            <div class="card p-2 m-1 shadow w-100 h-80">
              <div class="row g-1">
                <div class="col-md-4">
                  <img src="./images/boxes.svg" class="img-fluid rounded-start " alt="total-item-jpg" style="height: 60px; width:auto">
                </div>
                <div class="col-md-8">
                  <div class="">
                    <p class="card-title text-center ">Total Item</p>
                    <P class="card-text text-center fw-bold">200</P>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <div class="p-1">
            <div class="card p-2 m-1 shadow w-100 h-80">
              <div class="row g-1">
                <div class="col-md-4">
                  <img src="./images/check.svg" class="img-fluid rounded-start " alt="check-jpg" style="height: 60px; width:auto">
                </div>
                <div class="col-md-8">
                  <div class="">
                    <p class="card-title text-center ">PO Diterima</p>
                    <P class="card-text text-center fw-bold">10</P>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <div class="p-1">
            <div class="card p-2 m-1 shadow w-100 h-80">
              <div class="row g-1">
                <div class="col-md-4">
                  <img src="./images/x.svg" class="img-fluid rounded-start " alt="x-jpg" style="height: 60px; width:auto">
                </div>
                <div class="col-md-8">
                  <div class="">
                    <p class="card-title text-center ">PO Ditolak</p>
                    <P class="card-text text-center fw-bold">0</P>
                  </div>
                </div>
              </div>
            </div>
          </div>
          </div>

        </div>
      </main>
    </div>
  </div>
  </div>
</body>

</html>