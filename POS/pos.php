<?php
require 'dbcon.php';
session_start();

// Check if the user is logged in
if (isset($_SESSION['Fullname'])) {
    $fullname = $_SESSION['Fullname']; // Retrieve Fullname from session
    $userID = $_SESSION['userID']; // Retrieve userID from session
} else {
    // Redirect to the login page if the user is not logged in
    header("Location: index.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://kit.fontawesome.com/efa820665e.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="style/dash.css">
    <title>HR Dashboard</title>

</head>

<body>


    <div class="navigator">
        <a href="pincode.php">
            <i class="fa-regular fa-clock icon"></i>
        </a>


        <div class="right-align">
            <img src="img/12.png" alt="">
            </b><br><b>
                <div><b>
                        <span></span> <?php echo $fullname; ?><span>
                    </b><br><b>
                        <small style="color: gray; padding-left: 17px;">Cashier</small>

                </div>
        </div>
        <ul>
            <li><a href="#" class="active">Product</a></li>
            <!-- Change "Accounts" to "Employees" and add dropdown -->
            <li><a href="logout.php">Logout</a></li>





            </li>
            <!-- Add a logout button -->
        </ul>
    </div>

    <script src="sample.js"></script>


    <!-- Adding POS section -->
    <div class="container">
        <!-- Product Catalog -->
        <div class="product-catalog">
            <h2>Product</h2>
            <div class="products">
                <div class="product">
                    <img src="img/app.png" alt="Product 1">
                    <h3>Eggs</h3>
                    <p>$10</p>
                </div>
                <div class="product">
                    <img src="img/drum.jpg" alt="Product 2">
                    <h3>Chicken</h3>
                    <p>$20</p>
                </div>
                <div class="product">
                    <img src="img/mar.jpg" alt="Product 1">
                    <h3>Butter</h3>
                    <p>$15</p>
                </div>
                <div class="product">
                    <img src="img/tyu.jpg" alt="Product 2">
                    <h3>Apple</h3>
                    <p>$5</p>
                </div>
                <div class="product">
                    <img src="img/bread.jpg" alt="Product 1">
                    <h3>Bread</h3>
                    <p>$2</p>
                </div>
                <div class="product">
                    <img src="img/app.png" alt="Product 1">
                    <h3>Eggs</h3>
                    <p>$10</p>
                </div>
                <div class="product">
                    <img src="img/drum.jpg" alt="Product 2">
                    <h3>Chicken</h3>
                    <p>$20</p>
                </div>
                <div class="product">
                    <img src="img/mar.jpg" alt="Product 1">
                    <h3>Butter</h3>
                    <p>$15</p>
                </div>
                <div class="product">
                    <img src="img/tyu.jpg" alt="Product 2">
                    <h3>Apple</h3>
                    <p>$5</p>
                </div>
                <div class="product">
                    <img src="img/bread.jpg" alt="Product 1">
                    <h3>Bread</h3>
                    <p>$2</p>
                </div>
                <div class="product">
                    <img src="img/app.png" alt="Product 1">
                    <h3>Eggs</h3>
                    <p>$10</p>
                </div>
                <div class="product">
                    <img src="img/drum.jpg" alt="Product 2">
                    <h3>Chicken</h3>
                    <p>$20</p>
                </div>
                <div class="product">
                    <img src="img/mar.jpg" alt="Product 1">
                    <h3>Butter</h3>
                    <p>$15</p>
                </div>
                <div class="product">
                    <img src="img/tyu.jpg" alt="Product 2">
                    <h3>Apple</h3>
                    <p>$5</p>
                </div>
                <div class="product">
                    <img src="img/bread.jpg" alt="Product 1">
                    <h3>Bread</h3>
                    <p>$2</p>
                </div>
               
                <!-- Add more products here -->
            </div>
        </div>

        <!-- Receipt -->
        <div class="receipt">
            <h2>Receipt</h2>
            <ul class="receipt-items">
                <!-- Items will be added dynamically using JavaScript -->
            </ul>
            <p>Total: <span class="receipt-total">$0</span></p>
        </div>

        <script>
            // JavaScript code for the POS functionality
            document.addEventListener('DOMContentLoaded', function () {
                const products = document.querySelectorAll('.product');
                const cartItems = document.querySelector('.cart-items');
                const totalDisplay = document.querySelector('.total');
                const checkoutBtn = document.querySelector('.checkout');
                const receiptItems = document.querySelector('.receipt-items');
                const receiptTotal = document.querySelector('.receipt-total');

                let cart = [];

                // Add to Cart button event listeners
                products.forEach(product => {
                    const addToCartBtn = product.querySelector('.add-to-cart');
                    addToCartBtn.addEventListener('click', () => {
                        const name = addToCartBtn.dataset.name;
                        const price = parseFloat(addToCartBtn.dataset.price);

                        addToCart(name, price);
                    });
                });

                // Function to add items to the cart
                function addToCart(name, price) {
                    const item = { name, price };
                    cart.push(item);
                    displayCart();
                }

                // Function to display cart items
                function displayCart() {
                    cartItems.innerHTML = '';
                    let totalPrice = 0;
                    cart.forEach((item, index) => {
                        const li = document.createElement('li');
                        li.textContent = `${item.name}: $${item.price}`;
                        cartItems.appendChild(li);
                        totalPrice += item.price;
                    });
                    totalDisplay.textContent = totalPrice.toFixed(2);
                }

                // Checkout button event listener
                checkoutBtn.addEventListener('click', () => {
                    displayReceipt();
                    cart = []; // Clear the cart after checkout
                    displayCart();
                });

                // Function to display receipt
                function displayReceipt() {
                    receiptItems.innerHTML = '';
                    let receiptTotalPrice = 0;
                    cart.forEach((item, index) => {
                        const li = document.createElement('li');
                        li.textContent = `${item.name}: $${item.price}`;
                        receiptItems.appendChild(li);
                        receiptTotalPrice += item.price;
                    });
                    receiptTotal.textContent = receiptTotalPrice.toFixed(2);
                    document.querySelector('.receipt').style.display = 'block';
                }
            });
        </script>

</body>

</html>