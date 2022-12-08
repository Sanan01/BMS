<?php
session_start();

if (!isset($_SESSION['username'])) {
    $_SESSION['msg'] = "You must log in first";
    header('location: login.php');
}
if (isset($_GET['logout'])) {
    unset($_SESSION['username']);
    unset($_SESSION['acc_ID']);
    unset($_SESSION['balance']);
    session_destroy();
    header("location: login.php");
}
?>
<?php include('server.php') ?>
<!DOCTYPE html>
<html>
<title>Update Details</title>

<head>
    <link rel="icon" href="/BMS/fast logo.png" type="image/x-icon">
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.4.1/css/all.css" integrity="sha384-5sAR7xN1Nv6T6+dT2mhtzEpVJvfS3NScPQTrOxhwjIuvcA67KV2R5Jz6kr4abQsz" crossorigin="anonymous">
    <style>
        html,
        body {
            display: flex;
            justify-content: center;
            font-family: Roboto, Arial, sans-serif;
            font-size: 15px;
        }

        form {
            border: 5px solid #f1f1f1;
        }

        input[type=text],
        input[type=password] {
            width: 100%;
            padding: 16px 8px;
            margin: 8px 0;
            display: inline-block;
            border: 1px solid #ccc;
            box-sizing: border-box;
        }

        .icon {
            font-size: 110px;
            display: flex;
            justify-content: center;
            color: #4286f4;
        }

        button {
            background-color: #4286f4;
            color: white;
            padding: 14px 0;
            margin: 10px 0;
            border: none;
            cursor: grab;
            width: 48%;
        }

        h1 {
            text-align: center;
            font-size: 18;
        }

        button:hover {
            opacity: 0.8;
        }

        .formcontainer {
            text-align: center;
            margin: 24px 50px 12px;
        }

        .container {
            padding: 16px 0;
            text-align: left;
        }

        span.psw {
            float: right;
            padding-top: 0;
            padding-right: 15px;
        }

        /* Change styles for span on extra small screens */
        @media screen and (max-width: 300px) {
            span.psw {
                display: block;
                float: none;
            }
        }
    </style>
</head>

<body>
    <form method="POST" action="edit.php">
        <?php include('errors.php'); ?>
        <h1>New Details</h1>
        <div class="icon">
            <i class="fas fa-user-circle"></i>
        </div>
        <div class="formcontainer">
            <div class="container">
                <label for="phone"><strong>Phone</strong></label>
                <input type="text" placeholder="Enter Phone" name="phone" required>
                <label for="email"><strong>E-mail</strong></label>
                <input type="text" placeholder="Enter E-mail" name="email" required>
                <label for="password"><strong>Password</strong></label>
                <input type="password" placeholder="Enter password to update" name="password" required>
            </div>
            <button type="submit" name="edit_details"><strong>SUBMIT</strong></button>
    </form>
</body>

</html>

<?php
if (isset($_POST['edit_details'])) {
    $phone = mysqli_real_escape_string($db, $_POST['phone']);
    $email = mysqli_real_escape_string($db, $_POST['email']);
    $password = mysqli_real_escape_string($db, $_POST['password']);
    if (empty($phone)) {
        array_push($errors, "Phone is required");
    }
    if (empty($email)) {
        array_push($errors, "Account No. is required");
    }
    if (empty($password)) {
        array_push($errors, "Amount is required");
    }
    if (count($errors) == 0) {
        $query = "UPDATE `customer` SET `phone` = $phone WHERE `customer`.`acc_ID` = $_SESSION[acc_ID]";
        $results = mysqli_query($db, $query);
        $query = "UPDATE `customer` SET `email` = $email WHERE `customer`.`acc_ID` = $_SESSION[acc_ID]";
        $results = mysqli_query($db, $query);
    }
}
