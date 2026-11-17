<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Cart - MediShop</title>

    <link rel="stylesheet" href="bootstrap.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css" />
    <link rel="stylesheet" href="style.css" />
    <link rel="icon" href="resource/logo.jpg" />
</head>

<body>

    <div class="container-fluid">
        <div class="row">

            <?php

            include "header.php";

            require_once "connection.php";
            if (isset($_SESSION["user"])) {
                $email = $_SESSION["user"]["email"];
                $total = 0;
                $subtotal = 0;
                $shipping = 0;
            ?>

            

                <!-- side panel -->
                <div class="col-12 col-lg-2 p-2" style="background-color: #1974D2;">
                    <div class="col-12 col-lg-12 offset-lg-0 d-grid pt-3">
                        <nav aria-label="breadcrumb" class="ps-5 ps-lg-3">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="home.php" class="text-decoration-none header-txt" style="color: #e4c61e;">Home</a></li>
                                <li class="breadcrumb-item active text-white header-txt" style="margin-top: 2px;" aria-current="page">Cart</li>
                            </ol>
                        </nav>
                    </div>
                    <div class="col-8 offset-2 col-lg-12 offset-lg-0 d-grid pt-3">
                        <button class="def-ad-btn-active text-center text-lg-start header-txt rounded pt-2 pb-2 ps-3">Cart</button>
                    </div>
                    <div class="col-8 offset-2 col-lg-12 offset-lg-0 d-grid pt-3">
                        <button class="def-ad-btn header-txt text-center text-lg-start rounded pt-2 pb-2 ps-3"><a href="watchlist.php" style="color: black;">Watchlist</a></button>
                    </div>
                </div>
                <!-- side panel -->

                <div class="col-12 col-lg-10">
                    <div class="row">

                        <div class="col-10 offset-1 p-1 pt-2 pt-lg-4 pb-lg-3">
                            <div class="row g-1">
                                <div class="col-10 d-grid">
                                    <input type="text" class="def-input" placeholder="Search in Watchlist..." id="watchlist-text" />
                                </div>
                                <div class="col-2 d-grid">
                                    <button class="btn btn-warning header-txt fw-bold pt-1" style="box-shadow: 0px 1px 3px 1px rgba(0, 0, 0, 0.05);font-family: 'josefin';" onclick="watchlistBasicSearch(0);">SEARCH</button>
                                </div>
                            </div>
                        </div>

                        <?php

                        $cartResultset = Database::search("SELECT * From `cart` WHERE `user_email`='" . $_SESSION["user"]["email"] . "'");
                        $cartRownumber = $cartResultset->num_rows;

                        if ($cartRownumber == 0) {
                        ?>

                            <!-- def watchlist message -->
                            <div class="col-12 mt-3">
                                <div class="row g-1">
                                    <div class="col-12 text-center def-input pt-5 pb-5" style="background-color: #fbffc7;">
                                        <div class="row">
                                            <div class="col-12 text-center p-3">
                                                <img src="resource/cartico.svg" class="img-fluid" style="height: 120px;opacity: 0.6;" />
                                            </div>
                                            <div class="col-12">
                                                <span class="fs-5 header-txt">There are no items in your cart yet</span>
                                            </div>
                                            <div class="col-4 offset-4 d-grid mt-2">
                                                <button class="btn btn-warning fw-bold header-txt p-1" style="box-shadow: 0px 1px 3px 1px rgba(0, 0, 0, 0.05);font-family: 'josefin';" onclick="window.location='home.php';">Start Shopping</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- def watchlist message -->

                        <?php
                        } else {

                        ?>

                            <!-- products -->
                            <div class="col-12 col-lg-9">
                                <div class="row">

                                    <?php

                                    for ($x = 0; $x < $cartRownumber; $x++) {
                                        $cartData = $cartResultset->fetch_assoc();

                                        $productResultset = Database::search("SELECT * FROM `product` WHERE `id`='" . $cartData["product_id"] . "'");
                                        $productData = $productResultset->fetch_assoc();

                                        $total = $total + ($productData["price"]) * $cartData["qty"];

                                        $addressResultset = Database::search("SELECT district.id AS did From `user_has_address` INNER JOIN `city` ON
                                        user_has_address.city_id=city.id INNER JOIN `district` ON city.district_id=district.id WHERE `user_email`='" . $email . "'");

                                        $addressData = $addressResultset->fetch_assoc();
                                        $ship = 0;

                                        $ship = $productData["delivery_cost_id"];
                                        $shipping = $shipping + $ship;

                                        $sellerResultset = Database::search("SELECT * FROM `admin` WHERE `email`='" . $productData["user_email"] . "'");
                                        $sellerData = $sellerResultset->fetch_assoc();
                                        $seller = $sellerData["fname"] . " " . $sellerData["lname"];
                                    ?>


                                        <div class="card mb-2 mx-5 col-11">
                                            <div class="row g-0">
                                                <div class="col-md-12 mt-3 mb-3">
                                                    <div class="row">
                                                        <div class="col-12">
                                                            <span class="fw-bold text-black-50 fs-5">Seller :</span>&nbsp;
                                                            <span class="fw-bold text-black fs-5"><?php echo ($seller); ?></span>&nbsp;
                                                        </div>
                                                    </div>
                                                </div>

                                                <hr>

                                                <div class="col-md-4">
                                                    <span class="d-inline-block" tabindex="0" data-bs-toggle="popover" data-bs-trigger="hover focus" data-bs-content="<?php echo ($productData["description"]); ?>" title="Product Details">

                                                        <?php
                                                        $imageResultset = Database::search("SELECT * FROM `images` WHERE `product_id`='" . $productData["id"] . "'");
                                                        $imageData = $imageResultset->fetch_assoc();
                                                        ?>

                                                        <img src="<?php echo ($imageData["code"]); ?>" class="img-fluid rounded-start" style="max-width: 200px;">
                                                    </span>
                                                </div>
                                                <div class="col-md-5">
                                                    <div class="card-body">

                                                        <h3 class="card-title"><?php echo ($productData["title"]); ?></h3>

                                                        <?php

                                                        $conditionResultset = Database::search("SELECT * FROM `condition` WHERE `id`='" . $productData["condition_id"] . "'");
                                                        $conditionData = $conditionResultset->fetch_assoc();

                                                        ?>


                                                        &nbsp; <span class="fw-bold text-black-50">Condition : <?php echo ($conditionData["name"]); ?></span>
                                                        <br>
                                                        <span class="fw-bold text-black-50 fs-5">Price :</span>&nbsp;
                                                        <span class="fw-bold text-black fs-5">Rs.<?php echo ($productData["price"]); ?>.00</span>
                                                        <br>
                                                        <span class="fw-bold text-black-50 fs-5">Quantity :</span>&nbsp;
                                                        <input type="number" class="def-input" id="qty_input" min="1" value="1" onkeyup='checkValue(<?php echo ($productData["qty"]); ?>);' />
                                                        <br><br>
                                                        <span class="fw-bold text-black-50 fs-5">Delivery Fee :</span>&nbsp;

                                                            <span class="fw-bold text-black fs-5">Rs.<?php echo ($productData["delivery_cost_id"]); ?>.00</span>
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="card-body d-grid">
                                                        <button class="btn btn-warning fs-5 fw-bold" style="box-shadow: 0px 1px 3px 1px rgba(0, 0, 0, 0.07);"onclick="window.location='<?php echo('singleProductView.php?id='.$productData['id']); ?>'">Buy Now</button>
                                                        <br />
                                                        <a class="btn btn-danger mb-2" onclick="deleteFormCart(<?php echo ($cartData['id']); ?>);">Remove</a>
                                                    </div>
                                                </div>

                                                <hr>

                                                <div class="col-md-12 mt-3 mb-3">
                                                    <div class="row">
                                                        <div class="col-6 col-md-6">
                                                            <span class="fw-bold fs-5 text-black-50">Requested Total <i class="bi bi-info-circle"></i></span>
                                                        </div>
                                                        <div class="col-6 col-md-6 text-end">
                                                            <span class="fw-bold fs-5 text-black-50">Rs.<?php echo (($productData["price"] * $cartData["qty"]) + $ship); ?>.00</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    <?php
                                    }

                                    ?>

                                </div>
                            </div>
                            <!-- products -->

                            <!-- summery -->
                            <div class="col-12 col-lg-3">
                                <div class="row">

                                    <div class="col-12">
                                        <label class="form-label fs-3 fw-bold">Summary</label>
                                    </div>

                                    <div class="col-12">
                                        <hr />
                                    </div>

                                    <div class="col-6 mb-3">
                                        <span class="fs-6 fw-bold">items (<?php echo ($cartRownumber); ?>)</span>
                                    </div>

                                    <div class="col-6 text-end mb-3">
                                        <span class="fs-6 fw-bold">Rs. <?php echo ($total); ?> .00</span>
                                    </div>

                                    <div class="col-6">
                                        <span class="fs-6 fw-bold">Shipping</span>
                                    </div>

                                    <div class="col-6 text-end">
                                        <span class="fs-6 fw-bold">Rs. <?php echo ($shipping); ?> .00</span>
                                    </div>

                                    <div class="col-12 mt-3">
                                        <hr />
                                    </div>

                                    <div class="col-6 mt-2">
                                        <span class="fs-4 fw-bold">Total</span>
                                    </div>

                                    <div class="col-6 mt-2 text-end">
                                        <span class="fs-4 fw-bold">Rs. <?php echo ($shipping + $total); ?> .00</span>
                                    </div>

                                    <div class="col-12 mt-3 mb-3 d-grid">
                                        <button class="btn btn-primary fs-5 fw-bold"  type="submit" id="payhere-payment" onclick="payNow(<?php echo ($cartData); ?>);">CHECKOUT</button>
                                    </div>

                                </div>
                            </div>
                            <!-- summery -->
                        <?php

                        }

                        ?>
                    </div>
                </div>

            <?php
            } else {
                echo ("Please sign In or Register");
            }

            ?>

            <?php include "footer.php"; ?>

            <!-- toast message -->
            <div class="col-12 d-none d-md-block d-lg-block">
                <div class="toast-container position-fixed bottom-0 end-0 p-3">
                    <div id="liveToast" class="toast" role="alert" aria-live="assertive" aria-atomic="true">
                        <div class="toast-header">
                            <div class="col-6 justify-content-start">
                                <i class="bi bi-x-circle-fill fs-4 text-warning justify-content-start" id="toast-icon"></i>
                            </div>
                            <div class="col-6 d-flex flex-row justify-content-end">
                                <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
                            </div>
                        </div>
                        <div class="toast-body fw-bold" id="toast-body"></div>
                    </div>
                </div>
            </div>
            <!-- toast message -->

        </div>
    </div>

    <script src="bootstrap.bundle.js"></script>
    <script src="script.js"></script>
    <script>
        var popoverTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="popover"]'))
        var popoverList = popoverTriggerList.map(function(popoverTriggerEl) {
            return new bootstrap.Popover(popoverTriggerEl)
        })
    </script>

</body>

</html>