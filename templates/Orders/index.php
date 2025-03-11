
<?php
//session_start();


// If the cart is not set or is empty, redirect to the product page
if (!isset($_SESSION['cart']) || count($_SESSION['cart']) == 0) {
    header("Location: /team047-app_fit3047/TastyBitesProject/product"); // Ensure this is the correct path to your product page.
    exit;
}

function format_currency($amount) {
    // Assuming you want to format the currency in US dollars.
    return '$' . number_format($amount, 2);
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Summary - TastyBites</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f0fffa; /* Light mint background */

            color: #333;
            margin: 0;
            padding: 20px;
        }
        .header {
            background-color: rgba(255, 193, 7, 0.8); /* Semi-transparent yellow */
            color: black;
            padding: 20px;
            text-align: center;


        }
        .container {
            width: 90%;
            max-width: 900px;
            margin: auto;
            padding: 20px;
            background-color: white;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
            border-radius: 8px;
        }
        .cart-table th, .cart-table td {
            padding: 15px;
            text-align: left;
            border-bottom: 1px solid #eee;
        }
        .cart-table th {
            background-color: #fff3cd;
            color: #333;
        }
        .cart-table tbody tr:hover {
            background-color: #f1f1f1;
        }
        .btn-container {
            padding-top: 20px;
            text-align: right;
        }
        .btn-outline-dark {
            border: 1px solid #ffc107;
            color: black;
        }
        .btn-primary {
            background-color: #ffc107;
            color: black;
        }
    </style>
</head>
<body>
<header class="header">
    <h1 style="font-weight: 700;">Order Summary</h1> <!-- Increased boldness with inline style -->
</header>

<div class="container">
    <table class="cart-table table">
        <thead>
        <tr>
            <th>Product Name</th>
            <th>Price</th>
            <th>Quantity</th>
            <th>Subtotal</th>
        </tr>
        </thead>
        <tbody>
        <?php
        $total = 0;
        foreach ($_SESSION['cart'] as $index => $item) {
            $subtotal = $item['price'] * $item['quantity'];
            $total += $subtotal;
            ?>
            <tr>
                <td><?= htmlspecialchars($item['name']); ?></td>
                <td><?= format_currency($item['price']); ?></td>
                <td>
                    <?= $item['quantity']; ?>
                </td>
                <td><?= format_currency($subtotal); ?></td>
            </tr>
            <?php
        }
        ?>
        </tbody>
        <tfoot>
        <tr>
            <td colspan="3" class="text-right"><strong>Total:</strong></td>
            <td><?= format_currency($total); ?></td>
        </tr>
        </tfoot>
    </table>

    <div class="btn-container">
        <a href="\team047-app_fit3047\TastyBitesProject\product" class="btn btn-outline-dark">Back to Menu Items</a>
        <a href="\team047-app_fit3047\TastyBitesProject\product" class="btn btn-outline-dark">Change Quantity For Items</a>

        <a href="<?=$this->Url->build(['controller'=> 'Payment','action'=>'index'])?>" class="btn btn-primary">Go to Checkout</a>
    </div>
</div>


</body>
</html>
