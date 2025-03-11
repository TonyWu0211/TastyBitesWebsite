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
    <title>Payment - TastyBites</title>
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
            max-width: 800px;
            margin: auto;
            padding: 20px;
            background-color: rgba(255, 255, 255, 0.9); /* Semi-transparent white for container */
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
            border-radius: 8px;
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
<div class="payment index content">
    <h3><?= __('Your Cart Items') ?></h3>
    <?= $this->Form->create(null, ['url' => ['controller' => 'Payment', 'action' => 'add']]) ?>  <!-- Ensure the form is properly started -->
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
    <div class="btn-container">
        <button type="submit" class="btn btn-primary">Save Order</button>
    </div>
    <?= $this->Form->end() ?>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        var form = document.getElementById('orderForm');
        form.addEventListener('submit', function(event) {
            event.preventDefault(); // Prevent form from submitting to see the toast
            showToast("Your order has been confirmed!!!");

            // If you want to actually submit the form uncomment below line
            // form.submit();
        });
    });

    function showToast(message) {
        var toast = document.createElement('div');
        toast.textContent = message;
        toast.style.position = 'fixed';
        toast.style.bottom = '20px';
        toast.style.left = '50%';
        toast.style.transform = 'translateX(-50%)';
        toast.style.backgroundColor = 'rgba(0,0,0,0.7)';
        toast.style.color = 'white';
        toast.style.padding = '10px 20px';
        toast.style.borderRadius = '5px';
        toast.style.zIndex = '1000';
        document.body.appendChild(toast);

        // Remove the toast after 3 seconds
        setTimeout(function() {
            toast.remove();
        }, 3000);
    }
</script>
</body>
</html>
