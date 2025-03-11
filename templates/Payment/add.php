<?php
// session_start();  // Ensure session is started

// If there is no cart or it's empty, redirect back to products page
if (!isset($_SESSION['cart']) || count($_SESSION['cart']) == 0) {
    header("Location: /tastybites/TastyBitesProject/product"); // Redirect if cart is empty
    exit;
}

function format_currency($amount) {
    return '$' . number_format($amount, 2);
}

/**
 * @var \App\View\AppView $this
 * @var iterable<\App\Model\Entity\Payment> $payment
 */
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Confirmation - TastyBites</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
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
            margin-bottom: 20px;
        }
        .container {
            width: 90%;
            max-width: 1200px; /* Adjusted max-width to accommodate side-by-side layout */
            margin: auto;
            padding: 20px;
            background-color: rgba(255, 255, 255, 0.9); /* Semi-transparent white for container */
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
            border-radius: 8px;
        }
        .order-details {
            width: 60%; /* Adjust width as needed */
            float: left;
            box-sizing: border-box;
        }
        .payment-details {
            width: 35%; /* Adjust width as needed */
            float: right;
            padding: 20px;
            background-color: #fff3cd; /* Light yellow background */
            border-radius: 8px;
            box-sizing: border-box;
        }
        .table {
            width: 100%;
            margin-bottom: 20px;
        }
        th, td {
            padding: 12px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }
        th {
            background-color: #fff3cd; /* Light yellow header */
            color: #333;
        }
        tbody tr:hover {
            background-color: #f1f1f1;
        }
        .btn-container {
            padding-top: 20px;
            text-align: right;
            clear: both; /* Clear floats */
        }
        .btn-outline-dark {
            border: 1px solid #ffc107;
            color: black;
        }
        .btn-primary {
            background-color: #ffc107;
            color: black;
        }
        .paginator ul {
            padding-left: 0;
            list-style-type: none;
            text-align: center;
        }
        .paginator li {
            display: inline;
            margin-right: 5px;
        }
        .paginator a {
            color: #007bff;
            text-decoration: none;
        }
    </style>
</head>
<body>
<div class="header">
    <h1>Order Confirmation</h1>
</div>
<div class="container">
    <div class="order-details">
        <h3><?= __('Your order has been saved!') ?></h3>
        <table class="table table-responsive">
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
            foreach ($_SESSION['cart'] as $item) {
                $subtotal = $item['price'] * $item['quantity'];
                $total += $subtotal;
                ?>
                <tr>
                    <td><?= htmlspecialchars($item['name']); ?></td>
                    <td><?= format_currency($item['price']); ?></td>
                    <td><?= $item['quantity']; ?></td>
                    <td><?= format_currency($subtotal); ?></td>
                </tr>
            <?php } ?>
            </tbody>
            <tfoot>
            <tr>
                <td colspan="3">Total:</td>
                <td><?= format_currency($total); ?></td>
            </tr>
            </tfoot>
        </table>
    </div>

    <div class="payment-details">
        <h4><?= __('Here are the payment details:') ?></h4>
        <p><?= __('BSB: 012339') ?></p>
        <p><?= __('Account Number: 30889945') ?></p>
        <p><?= __('Once we have received your payment we will start your order.') ?></p>
    </div>

    <div class="btn-container">
        <?= $this->Html->link(__('Back to Products'), ['controller' => 'Product', 'action' => 'index'], ['class' => 'btn btn-primary']) ?>
    </div>
</div>
</body>
</html>
