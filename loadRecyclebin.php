<?php
session_start();
require "connection.php";

$query = "SELECT * FROM `product` WHERE `user_email`='" . $_SESSION["adminUser"]["email"] . "' AND `recycle_bin_id`='2'";

$recycleBinResultset = Database::search($query);
$recycleBinRownumber = $recycleBinResultset->num_rows;

if (isset($_GET["page"])) {
    $pageNo = $_GET["page"];
} else {
    $pageNo = 1;
}
?>
<div class="col-10 col-md-12 offset-1 offset-md-0 col-lg-12 offset-lg-0">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="manageProducts.php" class="text-decoration-none text-warning header-txt fw-bold">Manage Products</a></li>
            <li class="breadcrumb-item active text-black header-txt" style="margin-top: 2px;" aria-current="page">Recycle Bin</li>
        </ol>
    </nav>
</div>
<?php
if ($recycleBinRownumber == 0) {
?>
    <!-- def watchlist message -->
    <div class="col-12 mt-5 pb-5 pt-5">
        <div class="row g-1 pt-5 pb-5">
            <div class="col-12 text-center def-input pt-5 pb-5" style="background-color: #fbffc7;">
                <div class="row pt-3 pb-3">
                    <div class="col-12 text-center p-3">
                        <img src="resource/8665900_trash_can_icon.svg" class="img-fluid" style="height: 120px;opacity: 0.6;" />
                    </div>
                    <div class="col-12">
                        <span class="fs-5 header-txt">Empty Recycle Bin</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- def watchlist message -->
    <?php
} else {
    $resultsPerPage = 6;
    $numberOfPage = ceil($recycleBinRownumber / $resultsPerPage);

    $pageResults = ($pageNo - 1) * $resultsPerPage;
    $selectedResultset = Database::search($query . " LIMIT " . $resultsPerPage . " OFFSET " . $pageResults . "");
    $selectedRownumber = $selectedResultset->num_rows;

    for ($x = 0; $x < $selectedRownumber; $x++) {
        $selectedData = $selectedResultset->fetch_assoc();
    ?>
        <!-- card -->
        <div class="col-10 offset-1 card offset-lg-0 col-md-10 col-lg-12 p-3" style="background-color: #fbffc7;">
            <div class="row">
                <div class="col-12 col-lg-3 d-flex flex-row justify-content-center justify-content-lg-start align-items-center">
                    <label class="form-label fw-bold fs-5"><?php echo ($selectedData["title"]); ?></label>
                </div>
                <div class="col-12 col-lg-3 p-2 d-flex flex-row justify-content-center align-items-center">
                    <?php
                    $imageResultset = Database::search("SELECT * FROM `images` WHERE `product_id`='" . $selectedData["id"] . "'");
                    $imageData = $imageResultset->fetch_assoc();
                    ?>
                    <img src="<?php echo ($imageData["code"]); ?>" class="img-fluid border-0 rounded" style="height: 60px;width: 80px;" />
                </div>
                <div class="col-12 col-lg-2 mt-2 mt-lg-0 d-flex flex-row justify-content-center align-items-center"><span class="form-label fs-5">RS. <?php echo ($selectedData["price"]); ?> .00</span></div>
                <div class="col-12 col-lg-2 d-flex flex-row justify-content-center align-items-center"><span class="form-label fs-5"><?php echo ($selectedData["qty"]); ?> items left</span></div>
                <div class="col-12 col-lg-2 d-flex flex-row justify-content-center align-items-center">
                    <div class="col-8 col-lg-12 d-grid">
                        <button class="btn btn-warning fw-bold" onclick="restore(<?php echo ($selectedData['id']); ?>);">Restore</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- card -->
    <?php
    }
    ?>
    <!-- pagination -->
    <div class="col-12 mt-2">
        <nav>
            <ul class="pagination pagination-sm justify-content-center justify-content-lg-start ">
                <?php
                for ($y = 1; $y <= $numberOfPage; $y++) {
                    if ($y == $pageNo) {
                ?>
                        <li class="page-item active">
                            <a href="<?php echo ("?page=" . $y); ?>" class="page-link" style="background-color: #f5d628;border-color: #f5d628;"><?php echo ($y); ?></a>
                        </li>
                    <?php
                    } else {
                    ?>
                        <li class="page-item">
                            <a href="<?php echo ("?page=" . $y); ?>" class="page-link text-black fw-bold"><?php echo ($y); ?></a>
                        </li>
                <?php
                    }
                }
                ?>
            </ul>
        </nav>
    </div>
    <!-- pagination -->
<?php
}
?>