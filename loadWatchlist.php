<?php
session_start();
require "connection.php";

$watchlistResultset = Database::search("SELECT * FROM `watchlist` WHERE `user_email`='" . $_SESSION["user"]["email"] . "'");
$watchlistRownumber = $watchlistResultset->num_rows;

if ($watchlistRownumber == 0) {
?>
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
                        <button class="btn btn-warning header-txt p-1" style="box-shadow: 0px 1px 3px 1px rgba(0, 0, 0, 0.05);font-family: 'josefin';" onclick="window.location='home.php';">Start Shopping</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- def watchlist message -->
<?php
} else {
?>
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
    <!-- watchlist products load -->
    <div class="col-12 p-2 mt-3">
        <div class="row" id="watchlistLoader">
            <?php
            for ($x = 0; $x < $watchlistRownumber; $x++) {
                $watchData = $watchlistResultset->fetch_assoc();
            ?>
                <!-- card -->
                <div class="col-10 offset-1 offset-md-0 offset-lg-0 col-md-6 col-lg-4">
                    <div class="card mb-3" style="box-shadow: 0px 1px 3px 1px rgba(0, 0, 0, 0.05);">
                        <div class="row g-0">
                            <div class="col-md-4 d-flex flex-row justify-content-center align-items-center p-0 overflow-hidden">
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
                                                    <button class="btn btn-warning fw-bold rounded p-1">ADD TO CART</button>
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
                                                    <button class="def-btn-dark fw-bold rounded p-1 text-decoration-none text-center" onclick="removeFromWatchlist(<?php echo ($watchData['id']); ?>);">REMOVE</button>
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