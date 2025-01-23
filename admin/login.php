<?php
require "../koneksi.php";
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = md5($_POST['password']);
    $sql = "SELECT * FROM petugas WHERE username=? AND password=?";
    $row = $koneksi->execute_query($sql, [$username, $password])->fetch_assoc();

    if ($row) {
        session_start();
        $_SESSION['id'] = $row['id_petugas'];
        $_SESSION['level'] = $row['level'];
        header("location:index.php");
    } else {
        echo "<script>alert('Gagal Login!')</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Login</title>
    <style>
        /* Basic reset */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        /* Body styling */
        body {
            font-family: 'JetBrains Mono', monospace;
            background-color: #1e1e1e;
            /* Dark background */
            color: #f5f5f5;
            /* Light text */
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            display: flex;
            flex-direction: column;
        }

        /* Heading style */
        h1 {
            color: #ff3b30;
            /* JetBrains Red */
            font-size: 2.5rem;
            margin-bottom: 20px;
        }

        /* Form container */
        .form-login {
            background-color: #2d2d2d;
            /* Slightly lighter than background */
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.5);
            width: 300px;
        }

        /* Form item styling */
        .form-item {
            margin-bottom: 15px;
        }

        /* Label styling */
        label {
            display: block;
            color: #bbb;
            /* Light grey label */
            font-size: 1rem;
            margin-bottom: 5px;
        }

        /* Input field styling */
        input[type="text"],
        input[type="password"] {
            width: 100%;
            padding: 10px;
            background-color: #333;
            /* Dark input background */
            border: 1px solid #444;
            border-radius: 4px;
            color: #f5f5f5;
            /* Light text inside inputs */
            font-size: 1rem;
        }

        input[type="text"]:focus,
        input[type="password"]:focus {
            outline: none;
            border-color: #ff3b30;
            /* Red border on focus */
        }

        /* Button styling */
        button {
            width: 100%;
            padding: 12px;
            background-color: #ff3b30;
            /* JetBrains Red */
            color: #f5f5f5;
            border: none;
            border-radius: 4px;
            font-size: 1rem;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        button:hover {
            background-color: #e01b22;
            /* Darker red on hover */
        }

        /* Link styling */
        a {
            display: block;
            text-align: center;
            color: #ff3b30;
            margin-top: 15px;
            text-decoration: none;
            font-size: 1rem;
        }

        a:hover {
            color: #e01b22;
            /* Darker red on hover */
        }
    </style>
</head>

<body>
    <h1>Login</h1>
    <form action="" class="form-login" method="post">
        <p>Silahkan Login</p>
        <div class="form-item">
            <label for="username">Username</label>
            <input type="text" name="username" id="username">
        </div>
        <div class="form-item">
            <label for="password">Password</label>
            <input type="password" name="password" id="password">
        </div>
        <button type="submit">Login</button>
    </form>
    <a href="../login.php">Login sebagai masyarakat </a>
</body>

</html>