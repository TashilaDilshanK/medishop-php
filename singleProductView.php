<?php
require "connection.php";

if (isset($_GET["id"])) {
    $productId = $_GET["id"];

    $productResultset = Database::search("SELECT product.price,product.qty,product.description,product.title,product.status_id,product.condition_id,product.datetime_added,
    product.delivery_cost_id,category.name AS cname,product.category_id,product.brand_has_model_id,brand.name AS bname FROM `product` INNER JOIN `category` ON category.id=product.category_id INNER JOIN `brand_has_model` ON
    brand_has_model.id=product.brand_has_model_id INNER JOIN `brand` ON
    brand.id=brand_has_model.brand_id INNER JOIN `model` ON
    model.id=brand_has_model.model_id WHERE product.id='" . $productId . "'");

    $productRownumber = $productResultset->num_rows;
    if ($productRownumber == 1) {
        $productData = $productResultset->fetch_assoc();

?>
        <!DOCTYPE html>
        <html>

        <head>
            <meta charset="utf-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">

            <title><?php echo ($productData["title"]); ?> - MediShop</title>
            <link rel="stylesheet" href="style.css" />
            <link rel="stylesheet" href="bootstrap.css" />
            <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.2/font/bootstrap-icons.css">
            <link rel="icon" href="resource/logo.jpg" />
        </head>

        <body>

            <div class="container-fluid">
                <div class="row">
                    <?php include "header.php"; ?>
                    <div class="col-12">
                        <div class="row">
                            <div class="col-12 border-top border-bottom border-warning border-2 pt-3" style="background-color: #4863A0;">
                                <h1 class="header-txt text-warning text-center fs-2 text-lg-start ps-4 ps-lg-2 text-uppercase">GINI RAKSHA (FIRE DEMON) MASK</h1>
                            </div>
                            <!-- side panel -->
                            <div class="col-12 col-lg-2" style="background-color: #1974D2;">
                                <div class="row">
                                    <div class="col-12 col-lg-12 offset-lg-0 d-grid pt-3 pb-0 pb-lg-4">
                                        <nav aria-label="breadcrumb" class="ps-5 ps-lg-2">
                                            <ol class="breadcrumb">
                                                <li class="breadcrumb-item"><a href="home.php" class="text-decoration-none header-txt" style="color: #e4c61e;">Home</a></li>
                                                <li class="breadcrumb-item active text-white header-txt" style="margin-top: 2px;" aria-current="page">Single Product View</li>
                                            </ol>
                                        </nav>
                                    </div>
                                    <div class="col-6 col-lg-12 pt-3 ps-5 ps-lg-3 order-lg-0">
                                        <div class="row g-1">
                                            <div class="col-2"><i class="bi bi-lightning-charge-fill text-warning fs-4"></i></div>
                                            <div class="col-10 pt-1">
                                                <span class="text-warning header-txt">Selling Fast!<span class="text-white text-light header-txt">&nbsp;Only <?php echo ($productData["qty"]); ?> left</span></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-6 col-lg-12 pt-3 ps-5 ps-lg-3 order-lg-1">
                                        <div class="row g-1">
                                            <div class="col-2"><i class="bi bi-truck text-warning fs-4"></i></div>
                                            <div class="col-10 pt-1">
                                                <span class="text-warning header-txt">Arrives by<span class="text-white text-light header-txt">&nbsp;Nov 25-Dec 2</span>&nbsp;if you order today.</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-6 col-lg-12 pt-3 ps-5 ps-lg-3 order-lg-2">
                                        <div class="row g-1">
                                            <div class="col-2"><i class="bi bi-currency-dollar text-warning fs-4"></i></div>
                                            <div class="col-10 pt-1">
                                                <span class="text-warning header-txt">Delivery Cost</span><br />
                                                <span class="text-white header-txt fs-5"><?php echo ($productData["delivery_cost_id"]); ?></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-6 col-lg-12 pt-3 ps-5 ps-lg-3 order-4 order-lg-3">
                                        <div class="row g-1">
                                            <div class="col-12 pt-1">
                                                <div class="col-10 rounded bg-warning text-center">
                                                    <span class="text-black header-txt">Returns & Exchanges</span><br />
                                                    <span class="text-black fw-bold header-txt fs-4">Not Accepted</span><br />
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- side panel -->
                            <div class="col-12 col-lg-10 pt-2">
                                <div class="row g-1" id="">
                                    <!-- image viewer -->
                                    <div class="col-12 col-lg-6">
                                        <div class="row">
                                            <div class="col-12 col-lg-4 order-1 order-lg-0">
                                                <div class="row">
                                                    <ul class="list-unstyled">
                                                        <?php

                                                        $imageResultset = Database::search("SELECT * FROM `images` WHERE `product_id`='" . $productId . "'");
                                                        $imageRownumber = $imageResultset->num_rows;
                                                        $image = array();

                                                        if ($imageRownumber != 0) {
                                                            for ($x = 0; $x < $imageRownumber; $x++) {
                                                                $imageData = $imageResultset->fetch_assoc();
                                                                $image[$x] = $imageData["code"];
                                                        ?>

                                                                <li class="d-flex flex-column justify-content-center align-items-center border border-1 border-secondary mb-1 rounded">
                                                                    <img src="<?php echo ($image[$x]); ?>" id="productImg<?php echo ($x); ?>" onclick="loadMainImage(<?php echo ($x); ?>);" class="img-thumbnail border-0 mt-1 mb-1" />
                                                                </li>

                                                            <?php
                                                            }
                                                        } else {
                                                            ?>

                                                            <li class="d-flex flex-column justify-content-center align-items-center border border-1 border-secondary mb-1 rounded">
                                                                <img src="resource/empty.svg" class="img-thumbnail border-0 mt-1 mb-1 opacity-50" />
                                                            </li>
                                                            <li class="d-flex flex-column justify-content-center align-items-center border border-1 border-secondary mb-1 rounded">
                                                                <img src="resource/empty.svg" class="img-thumbnail border-0 mt-1 mb-1 opacity-50" />
                                                            </li>
                                                            <li class="d-flex flex-column justify-content-center align-items-center border border-1 border-secondary mb-1 rounded">
                                                                <img src="resource/empty.svg" class="img-thumbnail border-0 mt-1 mb-1 opacity-50" />
                                                            </li>

                                                        <?php
                                                        }

                                                        ?>

                                                    </ul>
                                                </div>
                                            </div>
                                            <div class="col-lg-7 order-2 order-lg-1 d-none d-lg-block">
                                                <div class="row">
                                                    <div class="col-12 align-items-center border border-1 border-secondary rounded">
                                                        <div class="main-img" id="main_image"></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- image viewer -->
                                    <!-- item details -->
                                    <div class="col-12 col-lg-6 p-1 mt-3 mt-lg-0 ps-4 ps-lg-0">
                                        <div class="row g-1">
                                            <div class="col-12 text-md-center text-lg-start">
                                                <h1 class="text-uppercase"><?php echo ($productData["title"]); ?></h1>
                                            </div>

                                            <?php

                                            $price = $productData["price"];
                                            $addingPrice = ($price / 100) * 20;
                                            $newPrice = $price + $addingPrice;
                                            $diffreence = $newPrice - $price;
                                            $precentage = ($diffreence / $price) * 100;

                                            ?>


                                            <div class="col-12 text-md-center text-lg-start mt-3">
                                                <div class="row">
                                                    <div class="col-5 col-md-3 offset-md-3 offset-lg-0 col-lg-4">
                                                        <h1 class="fs-2 fw-bold text-uppercase">RS. <?php echo ($price) ?>.00</h1>
                                                    </div>
                                                    <div class="col-7 col-md-3 col-lg-8">
                                                        <span class="text-muted text-decoration-line-through">RS. <?php echo ($newPrice) ?>.00</span><span class="text-muted">&nbsp;&nbsp;&nbsp;(<?php echo ($precentage) ?>% Off)</span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12 text-md-center text-lg-start mt-2">
                                                <div class="row">
                                                    <div class="col-12">
                                                        <span><i class="bi bi-star-fill text-warning"></i></span>
                                                        <span><i class="bi bi-star-fill text-warning"></i></span>
                                                        <span><i class="bi bi-star-fill text-warning"></i></span>
                                                        <span><i class="bi bi-star-fill text-warning"></i></span>
                                                        <span><i class="bi bi-star-half text-warning"></i></span>
                                                        <span class="fs-5 fw-bold">&nbsp;&nbsp;&nbsp;4.5 Stars</span>
                                                    </div>
                                                    <div class="col-12 pt-3">
                                                        <span class="text-muted">Local taxes included (where applicable)</span>
                                                    </div>

                                                    <div class="col-12 pt-3">
                                                        <div class="col-12">
                                                            <label class="form-label fw-bold fs-5">Quantity</label>
                                                        </div>
                                                        <div class="col-6 offset-md-3 offset-lg-0 d-grid">
                                                            <input type="number" class="def-input" id="qty_input" min="1" value="1" onkeyup='checkValue(<?php echo ($productData["qty"]); ?>);' />
                                                        </div>
                                                    </div>
                                                    <div class="col-12 pt-4">
                                                        <span class="fw-bold fs-5">Brand : </span><span class="badge bg-black fs-6 text-light"><?php echo ($productData["bname"]); ?></span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                        <span class="fw-bold fs-5">Model : </span><span class="badge bg-warning fs-6 text-black"><?php echo ($productData["cname"]); ?></span>
                                                    </div>
                                                    <div class="col-12 pt-5 pt-lg-5">
                                                        <div class="row g-2">
                                                            <div class="col-6 offset-md-3 offset-lg-0 col-lg-4 d-grid">
                                                                <button class="btn btn-warning fs-5 fw-bold" style="box-shadow: 0px 1px 3px 1px rgba(0, 0, 0, 0.07);" type="submit" id="payhere-payment" onclick="payNow(<?php echo ($productId); ?>);">Buy Now</button>
                                                            </div>
                                                            <div class="col-6 offset-md-3 offset-lg-0 col-lg-4 d-grid">
                                                                <button class="def-btn-dark fs-5 fw-bold rounded" style="box-shadow: 0px 1px 3px 1px rgba(0, 0, 0, 0.07);" onclick="addToCart(<?php echo ($productId); ?>);">Add To Cart</button>
                                                            </div>
                                                            <div class="col-6 offset-md-3 offset-lg-0 col-lg-4 d-grid d-flex flex-row justify-contentstart justify-content-md-center justify-content-lg-start align-items-center">
                                                                <?php
                                                                $mainWatchlistResultset = Database::search("SELECT * FROM `watchlist` WHERE `product_id`='" . $productId . "' AND `user_email`='" . $_SESSION["user"]["email"] . "'");
                                                                $mainWatchlistRownumber = $mainWatchlistResultset->num_rows;
                                                                if ($mainWatchlistRownumber == 1) {
                                                                ?>

                                                                    <button onclick="addToWatchlist(<?php echo ($productId); ?>);" class="bg-transparent border-0" id="heart<?php echo ($productId); ?>"><i class="bi bi-heart text-black fs-5" id="heart-icon<?php echo ($productId); ?>"></i></button>

                                                                <?php
                                                                } else {
                                                                ?>

                                                                    <button onclick="addToWatchlist(<?php echo ($productId); ?>);" class="bg-transparent border-0" id="heart<?php echo ($productId); ?>"><i class="bi bi-heart text-black fs-5" id="heart-icon<?php echo ($productId); ?>"></i></button>

                                                                <?php
                                                                }
                                                                ?>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-12 pt-4 pb-4">
                                                        <div class="col-12">
                                                            <label class="form-label fw-bold fs-5">Description</label>
                                                        </div>
                                                        <div class="col-12 col-md-8 col-lg-12 offset-0 offset-md-2 offset-lg-0 d-grid">
                                                            <textarea cols="30" rows="7" class="def-input disabled" id="description" disabled><?php echo ($productData["description"]); ?></textarea>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- item details -->
                                </div>
                            </div>
                        </div>
                        <!-- side panel -->
                    </div>
                </div>
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
                <?php include "footer.php"; ?>
            </div>
            </div>
            <script type="text/javascript" src="https://www.payhere.lk/lib/payhere.js"></script>
            <script src="script.js"></script>
        </body>

        </html>
<?php
    } else {
        echo ("Something went wrong");
    }
} else {
    echo ("Something went wrong");
}
?>