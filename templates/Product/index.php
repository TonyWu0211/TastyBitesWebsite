<?php
//session_start();

// Start the session if it's not already started
if(session_status() !== PHP_SESSION_ACTIVE) {
    session_start();
}

// Check if a session exists before regenerating the session ID
if(isset($_SESSION)) {
    session_regenerate_id();
}


// Regenerate session ID to avoid using old sessions
session_regenerate_id();

// Check and initialize session variables
if (!isset($_SESSION['cartCount'])) {
    $_SESSION['cartCount'] = 0;
}
if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

if (isset($_GET['add_to_cart'])) {
    $productId = $_GET['product_id'];
    $productName = urldecode($_GET['product_name']);
    $productPrice = $_GET['product_price'];
    $productQuantity = isset($_GET['quantity']) ? (int) $_GET['quantity'] : 1; // Default quantity is 1 if not specified
    // Check if the product is already in the cart to update the quantity
    $isProductFound = false;
    foreach ($_SESSION['cart'] as &$item) {
        if ($item['id'] == $productId) {
            $item['quantity'] += $productQuantity; // Add the selected quantity
            $isProductFound = true;
            break;
        }
    }

    // If the product is new to the cart, add it with the selected quantity
    if (!$isProductFound) {
        $cartItem = [
            'id' => $productId,
            'name' => $productName,
            'price' => $productPrice,
            'quantity' => $productQuantity, // Use the selected quantity
        ];
        $_SESSION['cart'][] = $cartItem;
        $_SESSION['cartCount']++; // Optionally increment by the number of items added
    }

    // Redirect to clear the URL parameters
    header("Location: " . strtok($_SERVER["REQUEST_URI"], '?'));
    exit;
}


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>TastyBites</title>
    <!-- Favicon-->
    <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
    <!-- Bootstrap icons-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet" />
    <!-- Core theme CSS (includes Bootstrap)-->
    <link href="css/styles.css" rel="stylesheet" />


</head>
<body>
<!-- Navigation-->
<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container px-4 px-lg-5">
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
        <a href="javascript:void(0);" onclick="checkCart()" class="btn btn-outline-dark cart-button">
            <i class="bi-cart-fill me-1"></i>
            Cart
            <span class="badge bg-dark text-white ms-1 rounded-pill" id="cartCount"><?php echo $_SESSION['cartCount']; ?></span>
        </a>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0 ms-lg-4">

            </ul>
            </li>
            </ul>
        </div>
    </div>
</nav>


<!-- Navigation-->
<nav class="navbar navbar-expand-lg navbar-dark fixed-top" id="mainNav">
    <div class="container">
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
            Menu
            <i class="fas fa-bars ms-1"></i>
        </button>
        <!-- <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
            Login
            <i class="fas fa-bars ms-1"></i>
        </button> -->
        <div class="collapse navbar-collapse" id="navbarResponsive">
            <ul class="navbar-nav text-uppercase ms-auto py-4 py-lg-0">
                <li class="nav-item"><a class="nav-link" href="/team047-app_fit3047/TastyBitesProject/"  ?> Home</a></li>
                <li class="nav-item"><a class="nav-link" href="<?=$this->Url->build(['controller'=> 'Product','action'=>'index'])  ?> ">Menu</a></li>
                <li class="nav-item"><a class="nav-link" href="<?=$this->Url->build(['controller'=> 'Product','action'=>'add'])  ?> ">Admin</a></li>
            </ul>
        </div>
    </div>
</nav>


<script>
    function checkCart() {
        var cartCount = parseInt(document.getElementById('cartCount').textContent, 10);
        if (cartCount === 0) {
            alert("No menu items selected. Please select a minimum of one.");
        } else {
            window.location.href = '/team047-app_fit3047/TastyBitesProject/orders'; // Redirect to the cart page if not empty
        }
    }

</script>

<!-- Header-->
<header class="bg-dark py-5">
    <div class="container px-4 px-lg-5 my-5">
        <div class="text-center text-white">
            <h1 style="font-family: 'Arial', sans-serif; font-size: 28px; font-weight: 550; color: black;">Menu
                <p style="font-family: 'Arial', sans-serif; font-size: 14px; color: black;">Choose what you like!</p>
        </div>
    </div>
</header>
<!-- Section-->
<!-- Section-->
<?php
/**
 * @var \App\View\AppView $this
 * @var iterable<\App\Model\Entity\Product> $product
 */
?>

<section class="py-5">
    <div class="container px-4 px-lg-5 mt-5">
        <div class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4 justify-content-center">
            <?php foreach ($product as $product): ?>
                <div class="col mb-5">
                    <div class="card h-100">
                        <!-- Product image-->
                        <img class="card-img-top" src="<?= $this->Url->image('product_images/' . h($product->image_path)) ?>" alt="<?= h($product->name) ?>">

                        <!-- Product details-->
                        <div class="card-body p-4">
                            <div class="text-center">
                                <!-- Product name with dietary type-->
                                <h5 class="fw-custom"><?= h($product->name) ?> - <?= h($product->dietary_type) ?></h5>
                                <!-- Product availability-->
                                <p class="text-muted">
                                    <small> <?= h($product->availability) ?></small>
                                </p>
                                <!-- Product price-->
                                <p class="card-text">$<?= $this->Number->format($product->price) ?></p>
                            </div>
                        </div>
                        <!-- Product actions-->
                        <div class="card-footer p-4 pt-0 border-top-0 bg-transparent">
                            <div class="text-center">
                                <!-- Quantity Input -->
                                <input type="number" name="quantity" value="1" min="1" class="quantity-input" onchange="updateAddToCartLink(this, '<?= $product->id ?>', '<?= urlencode($product->name) ?>', '<?= $product->price ?>')" style="margin-bottom: 10px;">
                                <a class="btn btn-outline-dark mt-auto add-to-cart" data-product-id="<?= $product->id ?>"
                                   href="?add_to_cart=1&product_id=<?= $product->id ?>&product_name=<?= urlencode($product->name) ?>&product_price=<?= $product->price ?>&quantity=1">
                                    Add To Cart
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>


<!-- Edit menu button-->
<!-- <div class="text-right">
    <div>
    <a class="btn btn-primary btn-xl text-uppercase" href="<?=$this->Url->build(['controller'=> 'Product','action'=>'add'])  ?>">Edit menu</a>
    </div>
</div> -->

<!-- Footer-->
<footer class="py-5 bg-dark">
    <div class="container"><p class="m-0 text-center text-white">Tasty Bites Kitchen &copy; 2024</p></div>
</footer>
<!-- Bootstrap core JS-->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
<!-- Core theme JS-->
<script>
    function updateAddToCartLink(quantityInput, productId, productName, productPrice) {
        var quantity = quantityInput.value;
        var addToCartLink = document.querySelector('.add-to-cart[data-product-id="' + productId + '"]');
        var newHref = '?add_to_cart=1&product_id=' + productId + '&product_name=' + productName + '&product_price=' + productPrice + '&quantity=' + quantity;
        addToCartLink.href = newHref;
    }
</script>

</body>
</html>








