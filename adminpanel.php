<?php include('server.php') ?>
<?php include('errors.php') ?>
<?php
session_start();

if (!isset($_SESSION['username'])) {
    $_SESSION['msg'] = "You must log in first";
    header('location: login.php');
}
if (isset($_GET['logout'])) {
    unset($_SESSION['username']);
    unset($_SESSION['acc_ID']);
    session_destroy();
    header("location: login.php");
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="/BMS/fast logo.png" type="image/x-icon">
    <title>Admin Panel</title>
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: sans-serif;
            background-image: url('img.jpg');
            background-size: cover;
        }

        .login-box {
            width: 280px;
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            color: #191970;
        }

        .login-box h1 {
            float: left;
            font-size: 40px;
            border-bottom: 4px solid #191970;
            margin-bottom: 50px;
            padding: 13px;
        }

        .textbox {
            width: 100%;
            overflow: hidden;
            font-size: 20px;
            padding: 8px 0;
            margin: 8px 0;
            border-bottom: 1px solid #191970;
        }

        .fa {
            width: px;
            float: left;
            text-align: center;
        }

        .textbox input {
            border: none;
            outline: none;
            background: none;
            font-size: 18px;
            float: left;
            margin: 0 10px;
        }

        .button {
            width: 100%;
            padding: 8px;
            color: #ffffff;
            background: none #191970;
            border: none;
            border-radius: 6px;
            font-size: 18px;
            cursor: pointer;
            margin: 12px 0;
        }

        .footer {
            position: fixed;
            bottom: 0;
            width: 100%;
            /* Set the fixed height of the footer here */
            height: 60px;
            color: black;
        }

        table {
            font-family: arial, sans-serif;
            border-collapse: collapse;
            width: 100%;
            text-align: center;
        }

        th {
            background-color: #dddddd;
        }

        td,
        th {
            border: 1px solid #dddddd;
            text-align: center;
            padding: 8px;
        }

        tr:hover {
            background-color: #dddddd;
        }
    </style>
</head>

<body>
    <?php if (isset($_SESSION['success']) && isset($_SESSION['username'])) : ?>
        <div class="error success" style="text-align:center;border-style:solid">
            <h3>
                <?php
                echo $_SESSION['success'];
                ?>
                <p style="color:black">Welcome <strong><?php echo $_SESSION['username']; ?></strong></p>
                <p> <a href="adminpanel.php?logout='1'" style="color: red;">logout</a> </p>
            </h3>
        </div>
    <?php endif ?>
    <div class="container">
        <table>
            <tr>
                <th>Customer name</th>
                <th>Phone</th>
                <th>Balance</th>
                <th>Account type</th>
                <th>Branch</th>
                <th>Bank Name</th>
                <th>Operation</th>
            </tr>
            <?php
            $query = "SELECT * FROM `alldata`";
            $result = mysqli_query($db, $query);
            $total = mysqli_num_rows($result);
            ?>
            <?php
            if ($total != 0)
                while ($data = mysqli_fetch_assoc($result)) {
                    echo "<tr>
                    <td>" . $data['customer_name'] . "</td>
                    <td>" . $data['phone'] . "</td>
                    <td>" . $data['balance'] . "</td>
                    <td>" . $data['acc_type'] . "</td>
                    <td>" . $data['branch_ID'] . "</td>
                    <td>" . $data['bank_Name'] . "</td>
                    <td> <a href='delete.php?rn=$data[branch_ID]'>Delete</a> </td>
                </tr> <br>";
                }
            ?>
        </table>
    </div>
    <script src=" https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous">
    </script>
    <footer class="footer">
        <div class="p-3 mb-2 bg-dark text-white">
            <p style="text-align:center">© 2022 Copyright</p>
        </div>
    </footer>
</body>

</html>