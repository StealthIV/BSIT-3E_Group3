<?php

require 'dbcon.php';
session_start();

// Check if the user is logged in
if (isset($_SESSION['username'])) {
    $username = $_SESSION['username'];
    $userID = $_SESSION['userID'];
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
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

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
                        <span></span> <?php echo $username; ?><span>
                    </b><br><b>
                        <small style="color: gray">Administrator</small></b>
                </div>
        </div>
        <ul>
            <li><a href="home.php" class="active">Reports</a></li>
            <!-- Change "Accounts" to "Employees" and add dropdown -->
            <li class="dropdown">
                <a class="dropdown-btn">Employees <span class="dropdown-icon">&#9662;</span></a>
                <div class="dropdown-container">
                    <a href="account.php">Employee List</a>
                    <a href="access.php">Access Rights</a>
                    <a href="time.php">Timecards</a>
                    <a href="totalhour.php">Total Hours Worked</a>
                </div>
            </li>
            <!-- Add a logout button -->
            <li><a href="logout.php" class="logout">Logout</a></li>
        </ul>
    </div>

    <script src="sample.js"></script>


    <div class="container">
        <div class="menu">
            <div class="menu-item">
                <p>Gross sales</p>
                <p class="bottom-align">₱20.0</p>
            </div>
            <div class="menu-item">
                <p>Refunds</p>
                <p class="bottom-align">₱20.0</p>
            </div>
            <div class="menu-item">
                <p>Discounts</p>
                <p class="bottom-align">₱20.0</p>
            </div>
            <div class="menu-item">
                <p>Net Sales</p>
                <p class="bottom-align">₱20.0</p>
            </div>
            <div class="menu-item">
                <p>Gross Profit</p>
                <p class="bottom-align">₱20.0</p>
            </div>

        </div>

        <p class="title">Gross Sales</p>

        <canvas id="salesChart" width="400" height="150"></canvas>


        <div class="table">
            <p>Recent Transactions</p>
            <table>
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Date Created</th>
                        <th>Product</th>
                        <th>Price</th>
                        <th>Category</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>1</td>
                        <td>2024-03-18</td>
                        <td>Blue Denim Jeans</td>
                        <td>$50</td>
                        <td>Jeans</td>
                    </tr>
                    <tr>
                        <td>2</td>
                        <td>2024-03-16</td>
                        <td>Red Plaid Shirt</td>
                        <td>$35</td>
                        <td>Shirts</td>
                    </tr>
                    <tr>
                        <td>3</td>
                        <td>2024-03-14</td>
                        <td>Black Leather Jacket</td>
                        <td>$120</td>
                        <td>Jackets</td>
                    </tr>
                </tbody>
            </table>
        </div>

        <script>
            // Get the context of the canvas element we want to select
            var ctx = document.getElementById('salesChart').getContext('2d');

            // Define the data for the chart
            var data = {
                labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun'],
                datasets: [{
                    label: 'Monthly Sales',
                    backgroundColor: 'rgba(75, 192, 192, 0.2)',
                    borderColor: 'rgba(75, 192, 192, 1)',
                    borderWidth: 1,
                    data: [1000, 1500, 1200, 5800, 40000, 1700] // Example sales data
                }]
            };

            // Configuration options
            var options = {
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero: true
                        }
                    }]
                }
            };

            // Create the bar chart
            var salesChart = new Chart(ctx, {
                type: 'bar',
                data: data,
                options: options
            });

            document.querySelector('.dropdown-btn').addEventListener('click', function (e) {
                e.preventDefault();
                var dropdown = this.parentNode;
                dropdown.classList.toggle('active');
            });


            document.addEventListener('DOMContentLoaded', function () {
                // Add click event listeners to the menu items
                document.querySelectorAll('.menu-item').forEach(function (item) {
                    item.addEventListener('click', function (event) {
                        // Prevent default click behavior
                        event.preventDefault();

                        // Get the text content of the clicked menu item
                        var menuItemTitle = this.querySelector('p').textContent;

                        // Update the title element with the clicked menu item's text content
                        document.querySelector('.title').textContent = menuItemTitle;
                    });
                });
            });

        </script>

</body>

</html>