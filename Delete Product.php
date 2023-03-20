<?php
    include('connect.php');

    $status = '';
    $result = '';

    if ($_SERVER['REQUEST_METHOD'] === 'GET') {
        if (isset($_GET['id'])) {
            $productCode = $_GET['id'];
            $query = "DELETE FROM products WHERE productCode = '$productCode'";

            $result = mysqli_query(connection(),$query);

            if ($result) {
                $status = 'okay';
            } else {
                $status = 'error';
            }

            header('Location: product.php?status='.$status);
        }
    }
?>