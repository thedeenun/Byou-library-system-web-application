<?php
include('server.php');
session_start();
$strKeyword = null;

if (isset($_POST["txtKeyword"])) {
    $strKeyword = $_POST["txtKeyword"];
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Book Management</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

</head>
<style>
    * {
        margin: 0;
        padding: 0%;
        box-sizing: border-box;
        font-family: Courier New;
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

    form.search input[type=text] {
        padding: 10px;
        font-size: 17px;
        border: 1px solid grey;
        float: left;
        width: 80%;
        background: #f1f1f1;
        color: black;
    }

    form.search button {
        float: left;
        width: 20%;
        padding: 10px;
        background: #662200;
        color: black;
        font-size: 17px;
        border: 1px solid grey;
        border-left: none;
        cursor: pointer;
    }

    form.search button:hover {
        background: #0b7dda;
    }

    form.search::after {
        content: "";
        clear: both;
        display: table;
    }

    img {
        display: block;
        max-width: 180px;
        max-height: 180px;
        width: auto;
        height: auto;
    }

    table {
        width: 80%;
        margin-left: auto;
        margin-right: auto;
        background-color: #A0522D;
    }

    footer {
        margin-top: 10px;
        position: relative;
        text-align: center;
        bottom: 0;
        width: 100%;
        height: 50px;
    }
</style>

<body>
    <div class="nav">
        <div class="left-group">
            <ul>
                <li><a href="manage_book.php">Home</a></li>
                <li><a href="#about">About</a></li>
                <li><a href="manage_book.php">Management</a></li>
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
    <div class="header" align="center">
        <br>
        <h1>Book</h1><br>
    </div>
    <div class="input-group">
        <form class="search" method="post" action="search.php" style="margin:auto;max-width:500px">
            <input name="txtKeyword" type="text" id="txtKeyword" placeholder="Book name, ISBN, Author...">
            <button type="submit" name="search"><i class="fa fa-search"></i></button>
        </form>
    </div>
    <br>
    <div class="content">
        <table width="1200" border="1" align="center">
            <tr>
                <th width="200">
                    <div align="center">Book Cover</div>
                </th>
                <th width="500">
                    <div align="center">Book name</div>
                </th>
                <th width="198">
                    <div align="center">Category</div>
                </th>
                <th width="198">
                    <div align="center">Author</div>
                </th>
                <th width="198">
                    <div align="center">Status</div>
                </th>
                <th width="198">
                    <div align="center">Suggestion</div>
                </th>
                <th width="198">
                    <div align="center">Borrower ID</div>
                </th>

            </tr>
            <form method="post" action="book.php">
                <?php


                $query = "SELECT * FROM book WHERE bookName LIKE null OR bookName LIKE '%" . $strKeyword . "%' OR category LIKE '%" . $strKeyword . "%' OR isbn LIKE '%" . $strKeyword . "%' OR author LIKE '%" . $strKeyword . "%' ";
                $searchquery = mysqli_query($conn, $query);

                while ($result = mysqli_fetch_array($searchquery)) {
                ?>
                    <tr>
                        <td>
                            <div align="center"><?php
                                                echo "<div id='img_div'>";
                                                echo "<img src='images/" . $result['bookCover'] . "' >";
                                                echo "</div>"; ?><div>
                        </td>
                        <td>
                            <div align="center"><a href="book_manage2.php?id=<?php echo $result['bookID']; ?>"><?php echo $result["bookName"]; ?></a></div>
                        </td>
                        <td>
                            <div align="center"><?php echo $result["category"]; ?></div>
                        </td>
                        <td>
                            <div align="center"><?php echo $result["author"]; ?></div>
                        </td>
                        <td>
                            <div align="center"><?php echo $result["status"]; ?></div>
                        </td>
                        <td>
                            <div align="center"><?php echo $result["suggestion"]; ?></div>
                        </td>
                        <td>
                            <div align="center"><?php echo $result["borrowerID"]; ?></div>
                        </td>
                    </tr>
                <?php
                }
                ?>
            </form>
        </table>
    </div>
    <div class="footer">
        <footer>&copy; Copyright 2021 Byoulibrary at CS251 Database</footer>
    </div>
</body>

</html>