<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BIT_APEX</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }

        /* Header styles */
        header {
            background-color: #333;
            color: #fff;
            padding: 10px 20px;
            display: flex;
            justify-content: space-between;
           
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            position: relative;
        }

        .logo {
            font-size: 24px;
            font-weight: bold;
            order: 1; /* Place the logo at the beginning */
        }

        .user-info {
            display: flex;
            align-items: center;
            order: 3; /* Place the user info at the end */
        }

        .user-info span {
            margin-right: 10px;
            cursor: pointer;
        }

        .dropdown-content {
            display: none;
            position: absolute;
            background-color: #fff;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            z-index: 1;
            right: 0;
        }

        .dropdown-content a {
            display: block;
            padding: 10px 20px;
            color: #333;
            text-decoration: none;
        }

        .dropdown-content a:hover {
            background-color: #f4f4f4;
        }

        .user-info:hover .dropdown-content {
            display: block;
        }

        /* Container styles */
        .container {
            max-width: 800px;
            margin: 20px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h2 {
            margin-top: 0;
            color: #333;
        }

        form {
            margin-bottom: 20px;
        }

        form input[type="text"],
        form input[type="number"],
        form input[type="submit"],
        form input[type="button"] {
            margin-right: 10px;
            padding: 10px;
            font-size: 16px;
            border: none;
            border-radius: 5px;
            background-color: #f4f4f4;
            color: #333;
]            transition: background-color 0.3s ease;
        }

        form input[type="submit"] {
            background-color: #333;
            color: #fff;
            cursor: pointer;
        }

        form input[type="submit"]:hover {
            background-color: #555;
        }

        /* Product list styles */
        .product-list {
            border-top: 2px solid #ccc;
            padding-top: 20px;
        }

        .product-item {
            background-color: #f9f9f9;
            padding: 10px;
            margin-bottom: 10px;
            border-radius: 5px;
            box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
        }

        .product-item h3 {
            margin: 0;
            color: #333;
        }

        .product-item p {
            color: #666;
            margin: 5px 0;
        }

        /* Total amount styles */
        .total-amount {
            margin-top: 20px;
            font-size: 18px;
            color: #333;
        }

        /* Navigation bar styles */
        .navigation {
            position: fixed;
            top: 0;
            left: -200px;
            bottom: 0;
            background-color: #333;
            width: 200px;
            padding: 20px;
            color: #fff;
            overflow-y: auto;
            z-index: 999;
            transition: left 0.3s ease;
        }

        .navigation.active {
            left: 0;
        }

        .navigation ul {
            list-style-type: none;
            padding: 0;
        }

        .navigation ul li {
            margin-bottom: 10px;
        }

        .navigation a {
            color: #fff;
            text-decoration: none;
            font-size: 16px;
            transition: opacity 0.3s ease;
        }

        .navigation a:hover {
            opacity: 0.8;
        }

        .logout-btn {
            background-color: #ff6347;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .logout-btn:hover {
            background-color: #ff7f50;
        }

    </style>
</head>
<body>
    <header>
        <div class="logo">BIT_APEX</div>
        <div class="open-nav">
            &#9776;
        </div>
        <div class="user-info">
            <span>Welcome, <?php 
		$query = "SELECT * FORM login (username)" ?></span>
            <div class="dropdown-content">
                <a href="logout.php" class="logout-btn">Logout</a>
            </div>
        </div>
    </header>

    <div class="container">
        <h2>Add a Product</h2>
        <form action="" method="post">
            <input type="text" name="productName" placeholder="Product Name" required>
            <input type="text" name="description" placeholder="Description" required>
            <input type="number" name="productAmount" placeholder="Amount" required>
            <input type="number" name="quantity" placeholder="Quantity" required>
            <input type="number" name="days" placeholder="Days" required>
            <input type="text" name="link" placeholder="Link" required>
            <input type="submit" value="Add Item" name="addItem">
            <input type="button" value="Clear" onclick="clearForm()">
        </form>

        <?php
        include("config.php");

        if (isset($_POST['addItem'])) {
            $productName = mysqli_real_escape_string($con, $_POST['productName']);
            $description = mysqli_real_escape_string($con, $_POST['description']);
            $productAmount = mysqli_real_escape_string($con, $_POST['productAmount']);
            $quantity = mysqli_real_escape_string($con, $_POST['quantity']);
            $days = mysqli_real_escape_string($con, $_POST['days']);
            $link = mysqli_real_escape_string($con, $_POST['link']);
            $query = "INSERT INTO product (thing, description, amount, quantity, day, link) VALUES ('$productName', '$description', '$productAmount', '$quantity', '$days', '$link')";
            mysqli_query($con, $query) or die(mysqli_error($con));
        }

        $result = mysqli_query($con, "SELECT * FROM product");

        if (mysqli_num_rows($result) > 0) {
            echo '<div class="product-list">';
            $totalAmount = 0;
            while ($row = mysqli_fetch_assoc($result)) {
                echo '<div class="product-item">';
                echo '<h3>' . $row['thing'] . '</h3>';
                echo '<p>Description: ' . $row['description'] . '</p>';
                echo '<p>Amount: ' . $row['amount'] . '</p>';
                echo '<p>Quantity: ' . $row['quantity'] . '</p>';
                echo '<p>Days: ' . $row['day'] . '</p>';
                echo '<p>Link: <a href="' . $row['link'] . '">' . $row['link'] . '</a></p>';
                $totalAmount += $row['amount'];
                echo '</div>';
            }
            echo '</div>';
            echo '<p class="total-amount">Total Amount: ' . $totalAmount . '</p>';
        } else {
            echo '<p>No products added yet.</p>';
        }
        ?>
    </div>

    <div class="navigation">
        <ul>
            <li><a href="#">Settings</a></li>
            <li><a href="logout.php" class="logout-btn">Logout</a></li>
        </ul>
    </div>

    <script>
        function clearForm() {
            document.querySelector("form").reset();
        }

        document.querySelector(".open-nav").addEventListener("click", function() {
            document.querySelector(".navigation").classList.toggle("active");
        });
    </script>
</body>
</html>
