<?php
    include('connect.php');

    $status = '';
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

        $query = "INSERT INTO customers VALUES ('$customerNumber','$customerName','$contactLastName','$contactFirstName','$phone','$addressLine1','$addressLine2','$city','$state','$postalCode','$country','$salesRepEmployeeNumber','$creditLimit')";
        echo $query;
        $result = mysqli_query(connection(),$query);
        if ($result) {
            $status = 'okay';
        } else {
            $status = 'error';
        }
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
    <title>Add Customer</title>
</head>
<body>
    <nav class = "navbar navbar-dark fixed-top bg-dark flex-md-nowrap p-0 shadow">
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
                    } else if ($status == 'error') {
                        '<br><br><div class="alert alert-success" role="alert">Data Customer gagal disimpan</div>';
                    }
                ?>
                <h2 style="margin: 30px 0 30px;">Formulir Customer</h2>
                <form action="form.php" method="POST">
                    <div class="form-group">
                        <label>Customer Number</label>
                        <input type="text" class="form-control" placeholder=">497" name="customerNumber" required="required">
                    </div>
                    <div class="form-group">
                        <label>Customer Name</label>
                        <input type="text" class="form-control" placeholder="Name..." name="customerName" required="required">
                    </div>
                    <div class="form-group">
                        <label>Contact Last Name</label>
                        <input type="text" class="form-control" placeholder="Last Name..." name="contactLastName" required="required">
                    </div>
                    <div class="form-group">
                        <label>Contact First Name</label>
                        <input type="text" class="form-control" placeholder="First Name..." name="contactFirstName" required="required">
                    </div>
                    <div class="form-group">
                        <label>Phone</label>
                        <input type="text" class="form-control" placeholder="089******255" name="phone" required="required">
                    </div>
                    <div class="form-group">
                        <label>Address Line 1</label>
                        <input type="text" class="form-control" placeholder="Jalan Street..." name="addressLine1" required="required">
                    </div>
                    <div class="form-group">
                        <label>Address Line 2</label>
                        <input type="text" class="form-control" placeholder="Address Details..." name="addressLine2" required="required">
                    </div>
                    <div class="form-group">
                        <label>City</label>
                        <input type="text" class="form-control" placeholder="Surabaya..." name="city" required="required">
                    </div>
                    <div class="form-group">
                        <label>State</label>
                        <input type="text" class="form-control" placeholder="East Java..." name="state" required="required">
                    </div>
                    <div class="form-group">
                        <label>Postal Code</label>
                        <input type="text" class="form-control" placeholder="612..." name="postalCode" required="required">
                    </div>
                    <div class="form-group">
                        <label>Country</label>
                        <input type="text" class="form-control" placeholder="Indonesia..." name="country" required="required">
                    </div>

                    <!-- Select -->
                    <?php
                        $queryS = "SELECT employeeNumber FROM employees";
                        $resultS = mysqli_query(connection(), $queryS);
                    ?>
                    <div class="form-group">
                        <label>Sales Rep Employee Number</label>
                        <select class="custom-select" name="salesRepEmployeeNumber" required="required">
                            <option value="">Pilih Salah Satu!!</option>
                            <?php while($data = mysqli_fetch_array($resultS)): ?>
                                <option value="<?= $data['employeeNumber'] ?>"><?= $data['employeeNumber'] ?></option>
                            <?php endwhile ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Credit Limit</label>
                        <input type="text" class="form-control" placeholder="100000..." name="creditLimit" required="required">
                    </div>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </form>
            </main>
        </div>
    </div>
    <script src="assets/js/jquery.js"></script>
    <script src="assets/js/bootstrap.js"></script>
</body>
</html>