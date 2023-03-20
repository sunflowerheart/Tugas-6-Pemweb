<?php
    include('connect.php');

    $status = '';
    $result = '';
    if ($_SERVER['REQUEST_METHOD'] === 'GET') {
        if (isset($_GET['id'])) {
            $customerNumber_update = $_GET['id'];
            $query = "SELECT * FROM customers WHERE customerNumber = $customerNumber_update";

            $result = mysqli_query(connection(),$query);
        }
    }

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $customerNumber = $_POST['customerNumber'];
        $customerName = $_POST['customerName'];
        $contactLastName = $_POST['contactLastName'];
        $contactFirstName = $_POST['contactFirstName'];
        $phone = $_POST['phone'];
        $addressLine1 = $_POST['addressLine1'];
        $addressLine2 = $_POST['addressLine2'];
        $city = $_POST['city'];
        $state = $_POST['state'];
        $postalCode = $_POST['postalCode'];
        $country = $_POST['country'];
        $salesRepEmployeeNumber = $_POST['salesRepEmployeeNumber'];
        $creditLimit = $_POST['creditLimit'];

        $sql = "UPDATE customers SET customerName='$customerName', contactLastName='$contactLastName', contactFirstName='$contactFirstName', phone='$phone',addressLine1='$addressLine1',addressLine2='$addressLine2',city='$city',state='$state',postalCode='$postalCode',country='$country',salesRempEmployeeNumber='$salesRepEmployeeNumber',creditLimit='$creditLimit' WHERE customerNumber=$customerNumber";

        $result = mysqli_query(connection(),$sql);
        if ($result) {
            $status = 'okay';
        } else {
            $status = 'error';
        }

        header('Location: index.php?status='.$status);
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/css/dashboard.css" rel="stylesheet">
    <title>Percontohan</title>
</head>
<body>
    <nav class = "navbar navbar-dark fixed-top bg-dark flex-md-nowrap p-0 shadow">
        <a class="navbar-brand col-sm-3 col-md-2 mr-0" href="#">Mas Muhammad Aqil Salim</a>
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
                        <a class="nav-link active" href="form.php">Tambah Data Customer</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="form Product.php">Tambah Data Product</a>
                    </li>
                    </ul>
                </div>
            </nav>
            <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
                <?php
                    if ($status == 'okay') {
                        echo '<br><br><div class="alert alert-success" role="alert">Data Customer berhasil disimpan</div>';
                    } elseif ($status == 'error') {
                        '<br><br><div class="alert alert-success" role="alert">Data Customer gagal disimpan</div>';
                    }
                ?>
                <h2 style="margin: 30px 0 30px;">Update Data Customer</h2>
                <form action="update.php" method="POST">
                    <?php while($data = mysqli_fetch_array($result)): ?>
                    <div class="form-group">
                        <label>Customer Number</label>
                        <input type="text" class="form-control" placeholder=">497" value="<?= $data['customerNumber'] ?>" name="customerNumber" required="required">
                    </div>
                    <div class="form-group">
                        <label>Customer Name</label>    
                        <input type="text" class="form-control" placeholder="Name..." value="<?= $data['customerName'] ?>" name="customerName" required="required">
                    </div>
                    <div class="form-group">
                        <label>Contact Last Name</label>
                        <input type="text" class="form-control" placeholder="Last Name..." value="<?= $data['contactLastName'] ?>" name="contactLastName" required="required">
                    </div>
                    <div class="form-group">
                        <label>Contact First Name</label>
                        <input type="text" class="form-control" placeholder="First Name..." value="<?= $data['contactFirstName'] ?>" name="contactFirstName" required="required">
                    </div>
                    <div class="form-group">
                        <label>Phone</label>
                        <input type="text" class="form-control" placeholder="089******255" value="<?= $data['phone'] ?>" name="phone" required="required">
                    </div>
                    <div class="form-group">
                        <label>Address Line 1</label>
                        <input type="text" class="form-control" placeholder="Jalan Street..." value="<?= $data['addressLine1'] ?>" name="addressLine1" required="required">
                    </div>
                    <div class="form-group">
                        <label>Address Line 2</label>
                        <input type="text" class="form-control" placeholder="Address Details..." value="<?= $data['addressLine2'] ?>" name="addressLine2" required="required">
                    </div>
                    <div class="form-group">
                        <label>City</label>
                        <input type="text" class="form-control" placeholder="Surabaya..." value="<?= $data['city'] ?>" name="city" required="required">
                    </div>
                    <div class="form-group">
                        <label>State</label>
                        <input type="text" class="form-control" placeholder="East Java..." value="<?= $data['state'] ?>" name="state" required="required">
                    </div>
                    <div class="form-group">
                        <label>Postal Code</label>
                        <input type="text" class="form-control" placeholder="612..." value="<?= $data['postalCode'] ?>" name="postalCode" required="required">
                    </div>
                    <div class="form-group">
                        <label>Country</label>
                        <input type="text" class="form-control" placeholder="Indonesia..." value="<?= $data['country'] ?>" name="country" required="required">
                    </div>

                    <!-- Select -->
                    <?php
                        $querySalesRep = "SELECT employeeNumber FROM employees";
                        $resultSalesRep = mysqli_query(connection(), $querySalesRep);
                    ?>
                    <div class="form-group">
                        <label>Sales Remp Employee Number</label>
                        <select class="custom-select" name="salesRepEmployeeNumber" required="required">
                            <option value="">Pilih Salah Satu!!</option>
                            <?php while($dataSalesRep = mysqli_fetch_array($resultSalesRep)): ?>
                                <option value="<?= $dataSalesRep['employeeNumber'] ?>" <?= $dataSalesRep['employeeNumber'] == $data['salesRepEmployeeNumber'] ? "selected" : "" ?>><?= $dataSalesRep['employeeNumber'] ?></option>
                            <?php endwhile ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Credit Limit</label>
                        <input type="text" class="form-control" placeholder="100000..." value="<?= $data['creditLimit'] ?>" name="creditLimit" required="required">
                    </div>
                    <?php endwhile ?>
                    <button type="submit" class="btn btn-primary">Save</button>
                </form>
            </main>
        </div>
    </div>
    <script src="assets/js/jquery.js"></script>
    <script src="assets/js/bootstrap.js"></script>
</body>
</html>