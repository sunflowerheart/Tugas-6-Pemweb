<?php
    include('connect.php');

    $status = '';
    $result = '';

    if ($_SERVER['REQUEST_METHOD'] === 'GET') {
        if (isset($_GET['id'])) {
            $productCode_update = $_GET['id'];
            $query = "SELECT * FROM products WHERE productCode = '$productCode_update'";

            $result = mysqli_query(connection(),$query);
        }
    }

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $productCode = $_POST['productCode'];
        $productName = $_POST['productName'];
        $productLine = $_POST['productLine'];
        $productScale = $_POST['productScale'];
        $productVendor = $_POST['productVendor'];
        $productDescription = $_POST['productDescription'];
        $quantityInStock = $_POST['quantityInStock'];
        $buyPrice = $_POST['buyPrice'];
        $MSRP = $_POST['MSRP'];

        $sql = "UPDATE products SET productName='$productName', productLine='$productLine', productScale='$productScale',productVendor='$productVendor',productDescription='$productDescription',quantityInStock='$quantityInStock', buyPrice='$buyPrice',MSRP='$MSRP' WHERE productCode='$productCode'";

        $result = mysqli_query(connection(),$query);
        if ($result) {
            $status = 'okay';
        } else {
            $status = 'error';
        }

        header('Location: product.php?status='.$status);
    }
?>
<!DOCTYPE html>
<html>
  <head>
    <title>Percontohan Product</title>
    <link href="assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/css/dashboard.css" rel="stylesheet">
  </head>

  <body>
    <nav class="navbar navbar-dark fixed-top bg-dark flex-md-nowrap p-0 shadow">
      <a class="navbar-brand col-sm-3 col-md-2 mr-0" href="#">Yafi Arya Maulana</a>
    </nav>

    <div class="container-fluid">
      <div class="row">
        <nav class="col-md-2 d-none d-md-block bg-light sidebar">
          <div class="sidebar-sticky">
            <ul class="nav flex-column" style="margin-top:100px;">
              <li class="nav-item">
                <a class="nav-link" href="Index.php">Data Customers</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="product.php">Data Products</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="form.php">Tambah Data Customer</a>
              </li>
              <li class="nav-item">
                <a class="nav-link active" href="form Product.php">Tambah Data Product</a>
              </li>
            </ul>
          </div>
        </nav>

        <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
          
          <?php 
              if ($status=='okay') {
                echo '<br><br><div class="alert alert-success" role="alert">Data Product berhasil disimpan</div>';
              }
              elseif ($status=='error'){
                echo '<br><br><div class="alert alert-danger" role="alert">Data Product gagal disimpan</div>';
              }
           ?>

          <h2 style="margin: 30px 0 30px 0;">Update Data Form Products</h2>
          <form action="update Product.php" method="POST">
            <?php while($data = mysqli_fetch_array($result)): ?>
            <div class="form-group">
              <label>Product Code</label>
              <input type="text" class="form-control" placeholder="Product Code" value="<?= $data['productCode'] ?>" name="productCode" required="required">
            </div>
            <div class="form-group">
              <label>Product Name</label>
              <input type="text" class="form-control" placeholder="Product Name" value="<?= $data['producName'] ?>" name="productName" required="required">
            </div>
            <!-- Select -->
            <?php 
                  $query = "SELECT productLine FROM productlines";
                  $resultL = mysqli_query(connection(),$queryL);
                 ?>
            <div class="form-group">
              <label>Product Line</label>
              <select class="custom-select" name="productLine" required="required">
                <option value="">Pilih Salah Satu</option>
                <?php while($data = mysqli_fetch_array($resultL)): ?>
                    <option value="<?= $dataLine['productLine'] ?>" <?= $dataLine['productLine'] == $data['productLine'] ? "selected" : "" ?>><?= $dataLine['productLine'] ?></option>
                <?php endwhile;?>
              </select>
            </div>
            <div class="form-group">
              <label>Product Scale</label>
              <input type="text" class="form-control" placeholder="Product Scale" value="<?= $data['productScale'] ?>" name="productScale" required="required">
            </div>
            <div class="form-group">
              <label>Product Vendor</label>
              <input type="text" class="form-control" placeholder="Product Vendor" value="<?= $data['productVendor'] ?>" name="productVendor" required="required">
            </div>
            <div class="form-group">
              <label>Product Description</label>
              <input type="text" class="form-control" placeholder="Product Description" value="<?= $data['productDescription'] ?>" name="productDescription" required="required">
            </div>
            <div class="form-group">
              <label>Quantity In Stock</label>
              <input type="text" class="form-control" placeholder="Quantity In Stock" value="<?= $data['quntityInStock'] ?>" name="quantityInStock" required="required">
            </div>
            <div class="form-group">
              <label>Buy Price</label>
              <input type="text" class="form-control" placeholder="Buy Price" value="<?= $data['buyPrice'] ?>" name="buyPrice" required="required">
            </div>
            <div class="form-group">
              <label>MSRP</label>
              <input type="text" class="form-control" placeholder="MSRP" value="<?= $data['MSRP'] ?>" name="MSRP" required="required">
            </div>
             
            <?php endwhile;?>
            <button type="submit" class="btn btn-primary">Save</button>
          </form>
        </main>
      </div>
    </div>

    <script src="assets/js/jquery.js"></script>
    <script src="assets/js/bootstrap.js"></script>
  </body>
</html>