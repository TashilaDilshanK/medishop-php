<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Home - MediShop</title>
    <link rel="stylesheet" href="style.css" />
    <link rel="stylesheet" href="bootstrap.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.2/font/bootstrap-icons.css">
    <link rel="icon" href="resource/logo.jpg" />
</head>

<body>

    <div class="container-fluid">
        <div class="row">

            <?php include "header.php"; ?>

            <div class="col-12 p-0 m-0">
                <div class="row p-0 m-0">

                    <!-- carousel -->
                    <div id="carouselExampleFade" class="carousel slide carousel-fade m-0 p-0" data-bs-ride="carousel">
                        <div class="carousel-inner">
                            <div class="carousel-item active">
                                <img src="resource/slide1.jpg" class="d-block w-100" />
                            </div>
                            <div class="carousel-item">
                                <img src="resource/slide1.jpg" class="d-block w-100" />
                            </div>
                            <div class="carousel-item">
                                <img src="resource/slide2.jpg" class="d-block w-100" />
                            </div>
                            <div class="carousel-item">
                                <img src="resource/slide3.jpg" class="d-block w-100" />
                            </div>
                            <div class="carousel-item">
                                <img src="resource/slide4.jpg" class="d-block w-100" />
                            </div>
                            <div class="carousel-item">
                                <img src="resource/slide5.jpg" class="d-block w-100" />
                            </div>
                            <div class="carousel-item">
                                <img src="resource/slide6.jpg" class="d-block w-100" />
                            </div>
                        </div>
                        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleFade" data-bs-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Previous</span>
                        </button>
                        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleFade" data-bs-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Next</span>
                        </button>
                    </div>
                    <!-- carousel -->

                    <?php

                    $categoryResultset2 = Database::search ("SELECT * FROM `category`");
                    $categoryrownumber2 = $categoryResultset->num_rows;

                    for ($x2 = 0; $x2 < $categoryrownumber2; $x2++) {
                        $categoryData2 = $categoryResultset2->fetch_assoc();
                    ?>

                        <!-- category -->
                        <div class="col-12 pt-3 pb-3">
                            <div class="row">
                                <div class="col-12 text-center pt-3 border-bottom border-2 border-warning" style="background-color: #082D63;">
                                    <h2 class="fs-3 header-txt text-warning fw-bold text-uppercase"><?php echo ($categoryData2["name"]); ?></h2>
                                </div>
                                <div class="col-12 p-3">
                                    <div class="row g-1">
                                        <?php
                                        $productResultset = Database::search("SELECT * FROM `product` WHERE `category_id`='" . $categoryData2["id"] . "' AND `status_id`='1' AND `recycle_bin_id`='1' ORDER BY `datetime_added` DESC LIMIT 6 OFFSET 0");
                                        $productRownumber = $productResultset->num_rows;

                                        for ($y = 0; $y < $productRownumber; $y++) {
                                            $productdata = $productResultset->fetch_assoc();

                                            $imageResultset = Database::search("SELECT * FROM `images` WHERE `product_id`='" . $productdata["id"] . "'");
                                            $imageData = $imageResultset->fetch_assoc();
                                        ?>
                                            <!-- card -->
                                            <div class="col-10 offset-1 offset-md-0 offset-lg-0 col-md-4 col-lg-2 p-2 card-cursor">
                                                <div class="card" style="box-shadow: 0px 1px 3px 1px rgba(0, 0, 0, 0.05);">
                                                    <img src="<?php echo ($imageData["code"]); ?>" class="card-img-top" style="height: 190px;" onclick="window.location='<?php echo('singleProductView.php?id='.$productdata['id']); ?>'"/>
                                                    <div class="card-body justify-content-center">
                                                        <h5 class="card-title fw-bold fs-6 text-uppercase" style="height: 45px;" onclick="window.location='<?php echo('singleProductView.php?id='.$productdata['id']); ?>'"><?php echo ($productdata["title"]); ?></h5>
                                                        <p class="card-text fw-bold fs-4" onclick="window.location='<?php echo('singleProductView.php?id='.$productdata['id']); ?>'">RS. <?php echo ($productdata["price"]) ?> .00</p>
                                                        <div class="col-12">
                                                            <div class="row">
                                                                <div class="col-8">
                                                                    <?php
                                                                    if ($productdata["qty"] > 0) {
                                                                    ?>
                                                                        <button class="btn btn-warning fw-bold p-2" onclick="addToCart(<?php echo($productdata['id']); ?>);">ADD TO CART</button>
                                                                    <?php
                                                                    } else {
                                                                    ?>
                                                                        <button class="btn btn-warning fw-bold p-2 disabled">ADD TO CART</button>
                                                                    <?php
                                                                    }
                                                                    ?>
                                                                </div>

                                                            


                                                                <div class="col-4 text-end mt-3">
                                                                    <?php
                                                                   $watchlistResultset = Database::search("SELECT * FROM `watchlist` WHERE `product_id`='".$productdata["id"]."' AND `user_email`='".$_SESSION["user"]["email"]."'");
                                                                   $watchlistRownumber = $watchlistResultset->num_rows;
                                                                   if($watchlistRownumber == 1){
                                                                    
                                                                    ?>
                                                                        <button onclick="addToWatchlist(<?php echo ($productdata['id']); ?>);" class="bg-transparent border-0" id="heart<?php echo ($productdata['id']); ?>"><i class="bi bi-heart-fill text-black fs-5" id="heart-icon<?php echo ($productdata['id']); ?>"></i></button>
                                                                    <?php
                                                                    } else {
                                                                    ?>
                                                                        <button onclick="addToWatchlist(<?php echo ($productdata['id']); ?>);" class="bg-transparent border-0" id="heart<?php echo ($productdata['id']); ?>"><i class="bi bi-heart text-black fs-5" id="heart-icon<?php echo ($productdata['id']); ?>"></i></button>
                                                                    <?php
                                                                    }
                                                                    ?>
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
                            </div>
                        </div>
                        <!-- category -->

                    <?php
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
            <?php include "footer.php"; ?>
        </div>
    </div>
    <script src="script.js"></script>
</body>

</html>