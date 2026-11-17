<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Watchlist - MediShop</title>
    <link rel="stylesheet" href="style.css" />
    <link rel="stylesheet" href="bootstrap.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.2/font/bootstrap-icons.css">
    <link rel="icon" href="resource/logo.jpg" />
</head>

<body>

    <div class="container-fluid">
        <div class="row">
            <?php
            include "header.php";

            if (isset($_SESSION["user"])) {
            ?>

                <div class="col-12">
                    <div class="row">
                        <div class="col-12 border-top border-bottom border-warning border-2 pt-3" style="background-color: #4863A0;">
                            <h1 class="header-txt text-warning text-center fs-2 text-lg-start ps-4 ps-lg-2 text-uppercase">Watchlist</h1>
                        </div>
                        <!-- side panel -->
                        <div class="col-12 col-lg-2 p-2" style="background-color: #1974D2;">
                            <div class="col-12 col-lg-12 offset-lg-0 d-grid pt-3">
                                <nav aria-label="breadcrumb" class="ps-5 ps-lg-3">
                                    <ol class="breadcrumb">
                                        <li class="breadcrumb-item"><a href="home.php" class="text-decoration-none header-txt" style="color: #e4c61e;">Home</a></li>
                                        <li class="breadcrumb-item active text-white header-txt" style="margin-top: 2px;" aria-current="page">Watchlist</li>
                                    </ol>
                                </nav>
                            </div>
                            <div class="col-8 offset-2 col-lg-12 offset-lg-0 d-grid pt-3">
                                <button class="def-ad-btn-active text-center text-lg-start header-txt rounded pt-2 pb-2 ps-3">Watchlist</button>
                            </div>
                            <div class="col-8 offset-2 col-lg-12 offset-lg-0 d-grid pt-3">
                            <button class="def-ad-btn header-txt text-center text-lg-start rounded pt-2 pb-2 ps-3"><a href="cart.php" style="color: black;">Cart</a></button>
                            </div>
                        </div>
                        <!-- side panel -->
                        <div class="col-12 col-lg-10 p-2">
                            <div class="row g-1" id="watchlistLoader">
                                <div class="col-10 offset-1 p-1 pt-2 pt-lg-4 pb-lg-3">
                                    <div class="row g-1">
                                        <div class="col-10 d-grid">
                                            <input type="text" class="def-input" placeholder="Search in Watchlist..." id="watchlist-text"/>
                                        </div>
                                        <div class="col-2 d-grid">
                                            <button class="btn btn-warning header-txt fw-bold pt-1" style="box-shadow: 0px 1px 3px 1px rgba(0, 0, 0, 0.05);font-family: 'josefin';" onclick="watchlistBasicSearch(0);">SEARCH</button>
                                        </div>
                                    </div>
                                </div>
                                <?php
                                $watchlistResultset = Database::search("SELECT * FROM `watchlist` WHERE `user_email`='" . $_SESSION["user"]["email"] . "'");
                                $watchlistRownumber = $watchlistResultset->num_rows;
                                if ($watchlistRownumber == 0) {
                                ?>
                                    <!-- def watchlist message -->
                                    <div class="col-12 p-2 mt-3">
                                        <div class="row g-1">
                                            <div class="col-12 text-center def-input pt-5 pb-5" style="background-color: #fbffc7;">
                                                <div class="row">
                                                    <div class="col-12 text-center p-3">
                                                        <img src="resource/7295015_like_love_heart_favorite_valentines_icon.svg" class="img-fluid" style="height: 120px;opacity: 0.6;" />
                                                    </div>
                                                    <div class="col-12">
                                                        <span class="fs-5 header-txt">You have no item in your Watchlist yet</span>
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
                                    <!-- watchlist products load -->
                                    <div class="col-12 p-2 mt-3">
                                        <div class="row">
                                            <?php
                                            for ($x = 0; $x < $watchlistRownumber; $x++) {
                                                $watchData = $watchlistResultset->fetch_assoc();
                                            ?>
                                                <!-- card -->
                                                <div class="col-10 offset-1 offset-md-0 offset-lg-0 col-md-6 col-lg-4">
                                                    <div class="card mb-3" style="box-shadow: 0px 1px 3px 1px rgba(0, 0, 0, 0.05);">
                                                        <div class="row g-0">
                                                            <div class="col-md-4 d-flex flex-row justify-content-center align-items-center">
                                                                <?php
                                                                $imageResultset = Database::search("SELECT * FROM `images` WHERE `product_id`='" . $watchData["product_id"] . "'");
                                                                $imageData = $imageResultset->fetch_assoc();
                                                                ?>
                                                                <img src="<?php echo ($imageData["code"]); ?>" class="img-fluid rounded-start" style="background-size: contain;height: 195px;" />
                                                            </div>
                                                            <div class="col-md-8">
                                                                <div class="card-body">
                                                                    <?php
                                                                    $productResultset = Database::search("SELECT * FROM `product` WHERE `id`='" . $watchData["product_id"] . "'");
                                                                    $productData = $productResultset->fetch_assoc();
                                                                    ?>
                                                                    <h5 class="card-title fs-6 fw-bold text-uppercase" style="height: 25px;"><?php echo ($productData["title"]); ?></h5>
                                                                    <p class="card-text fw-bold fs-4 pt-2">RS. <?php echo ($productData["price"]); ?> .00</p>
                                                                    <div class="col-12">
                                                                        <div class="row g-1">
                                                                            <?php
                                                                            if ($productData["qty"] > 0) {
                                                                            ?>
                                                                                <div class="col-12 d-grid">
                                                                                    <button class="btn btn-warning fw-bold rounded p-1"  onclick="addToCart(<?php echo($productData['id']); ?>);">ADD TO CART</button>
                                                                                </div>
                                                                                <div class="col-12 d-grid pt-1">
                                                                                    <button class="def-btn-dark fw-bold rounded p-1 text-decoration-none text-center" onclick="removeFromWatchlist(<?php echo ($watchData['id']); ?>);">REMOVE</button>
                                                                                </div>
                                                                            <?php
                                                                            } else {
                                                                            ?>
                                                                                <div class="col-12 d-grid">
                                                                                    <button class="btn btn-warning fw-bold rounded p-1 disabled">ADD TO CART</button>
                                                                                </div>
                                                                                <div class="col-12 d-grid pt-1">
                                                                                    <button class="def-btn-dark fw-bold rounded p-1 text-decoration-none text-center">REMOVE</button>
                                                                                </div>
                                                                            <?php
                                                                            }
                                                                            ?>

                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- card -->
                                            <?php
                                            }
                                            ?>
                                        </div>
                                    </div>
                                    <!-- watchlist products load -->
                                <?php
                                }
                                ?>
                            </div>
                        </div>
                    </div>
                </div>

                <?php include "footer.php"; ?>
            <?php
            } else {
                header("Location:home.php");
            }

            ?>
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

    <script src="script.js"></script>
</body>

</html>