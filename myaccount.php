<?php
include('server.php');
session_start();

if (!isset($_SESSION['username'])) {
    header('location: login.php');
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Account | Byoulib</title>
</head>
<style>
    * {
        margin: 0;
        padding: 0%;
        box-sizing: border-box;
        font-family: Courier New;
        text-align: center;
        color: white;
    }

    body {
        background-image: url('https://c.pxhere.com/photos/a6/62/life_beauty_scene_library_books_architecture_ornate_vintage-707871.jpg!d');
        background-repeat: no-repeat; 
        background-attachment: fixed; 
        background-size: cover;
        font-size: 135%;
    }

    .nav {
        width: 100%;
        height: 55px;
        background-color: #662200;
        display: flex;
        flex-direction: row;
        justify-content: space-between;
    }

    .right-group ul {
        padding: 15px 20px;
        display: flex;
    }

    .right-group ul li {
        list-style: none;
    }

    .right-group ul li a {
        text-decoration: none;
        color: #EFF0F3;
        padding: 30px 20px;
    }

    .left-group ul {
        padding: 15px 20px;
        display: flex;
    }

    .left-group ul li {
        list-style: none;
    }

    .left-group ul li a {
        text-decoration: none;
        color: #EFF0F3;
        padding: 30px 10px;
    }

    footer {
        position: absolute;
        bottom: 0;
        width: 100%;
        height: 30px;
    }

</style>

<body>
    <div class="nav">
        <div class="left-group">
            <ul>
                <li><a href="index.php">Home</a></li>
                <li><a href="#about">About</a></li>
            </ul>
        </div>
        <div class="right-group">
            <ul>
                <?php if (isset($_SESSION['username'])) : ?>
                    <li>
                        <p><a href="index.php?logout='1'" style="color: red;">Logout</a></p>
                    </li>
                <?php else : ?>
                    <li>
                        <p><a href="login.php">Login</a></p>
                    </li>
                <?php endif ?>
            </ul>
        </div>
    </div>
    <div class="content">
        <div class="heading">
            <br><h1>My Profile</h1><br>
        </div>

        <form method="post">
            <?php
            if (isset($_SESSION['username'])) {
                $username = mysqli_escape_string($conn, $_SESSION['username']);
                $query = "SELECT * FROM member WHERE userName = '$username'";
                $userquery = mysqli_query($conn, $query);
                $result = mysqli_fetch_array($userquery);
            } ?>

            <div><?php echo "Username : " . $result['userName']; ?></div>
            <div><?php echo "Full name : " . $result['fullName']; ?></div>
            <div><?php echo "Citizen ID : " . $result['citizenID']; ?></div>
            <div><?php echo "Email : " . $result['email']; ?></div>
            <div><?php echo "Phone number : " . $result['phone']; ?></div>

            <?php
            mysqli_close($conn);
            ?>
            <!-- <button type="submit" name="update" class="btn btn-primary" id="submit">Update Now </button> -->
        </form>
    </div>
    <div class="footer">
        <footer>&copy; Copyright 2021 Byoulibrary at CS251 Database</footer>
    </div>
</body>

</html>