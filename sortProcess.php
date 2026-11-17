<?php
session_start();
require "connection.php";

$user = $_SESSION["user"]["email"];

$search = $_POST["txt"];
$time = $_POST["time"];
$qty = $_POST["qty"];
$condition = $_POST["condition"];

$query = "SELECT * FROM `product` WHERE `user_email`='" . $_SESSION["user"]["email"] . "'";

if (!empty($search)) {
    $query .= " AND `title` LIKE '%" . $search . "%'";
}

if ($condition != 0) {
    $query .= " AND `condition_id`='" . $condition . "'";
}

if ($time != 0) {
    if ($time == "1") {
        $query .= " ORDER BY `datetime_added` DESC";
    } else if ($time == "2") {
        $query .= " ORDER BY `datetime_added` ASC";
    }
}

if ($time != "0" && $qty != "0") {
    if ($qty == "1") {
        $query .= " , `qty` DESC";
    } else if ($qty == "2") {
        $query .= " , `qty` ASC";
    }
} else if ($time == "0" && $qty != "0") {
    if ($qty == "1") {
        $query .= " ORDER BY `qty` DESC";
    } else if ($qty == "2") {
        $query .= " ORDER BY `qty` ASC";
    }
}
?>

<div class="col-12 p-0 m-0">
    <h1 class="fs-2 text-center fw-bold text-white pt-2 pb-2 border-bottom border-2 border-warning" style="background-color: #010100;">Manage Products</h1>
</div>
<div class="col-12">
    <div class="row g-1">
        <div class="col-12 col-lg-10 offset-0 offset-lg-1 p-1 pt-2 pt-lg-4 pb-lg-3">
            <div class="row g-1">
                <div class="col-9 col-lg-7 d-grid">
                    <input type="text" class="def-input" placeholder="Search in Watchlist..." id="manage-products-text" />
                </div>
                <div class="col-3 col-lg-2 d-grid">
                    <button class="btn btn-warning header-txt fw-bold pt-1" style="box-shadow: 0px 1px 3px 1px rgba(0, 0, 0, 0.05);font-family: 'josefin';" onclick="sort(0);">SEARCH</button>
                </div>
                <div class="col-6 col-lg-2 d-grid pt-2 pt-lg-0">
                    <button class="btn header-txt text-white fw-bold pt-1" style="background-color: #010100;box-shadow: 0px 1px 3px 1px rgba(0, 0, 0, 0.05);font-family: 'josefin';" onclick="window.location='addProducts.php';">ADD PRODUCT</button>
                </div>
                <div class="col-6 col-lg-1 d-grid pt-2 pt-lg-0">
                    <button class="btn btn-warning header-txt fw-bold pt-1" style="box-shadow: 0px 1px 3px 1px rgba(0, 0, 0, 0.05);font-family: 'josefin';" onclick="window.location='recyclebin.php';"><i class="bi bi-trash-fill text-black fs-4"></i></button>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- sort products panel -->
<div class="col-12 pt-2">
    <div class="col-12 col-lg-10 offset-0 offset-lg-1 rounded" style="background-color: #010100;">
        <div class="row">
            <div class="col-12">
                <h1 class="fs-4 text-center text-white pt-2 pb-2 border-bottom border-1 border-warning header-txt">Sort Products</h1>
            </div>
            <div class="col-12">
                <div class="row g-1">
                    <div class="col-4 p-1 border-end border-warning">
                        <div class="row g-1">
                            <div class="col-12 text-center">
                                <span class="fs-5 text-warning header-txt">Active Time</span>
                            </div>
                            <div class="col-12 col-md-6 col-lg-6 d-flex flex-row justify-content-center">
                                <div class="form-check">
                                    <input class="form-check-input bg-secondary" type="radio" name="c1" id="n">
                                    <label class="form-check-label text-white header-txt" for="flexRadioDefault1">Newest to oldest</label>
                                </div>
                            </div>
                            <div class="col-12 col-md-6 col-lg-6 d-flex flex-row justify-content-center">
                                <div class="form-check">
                                    <input class="form-check-input bg-secondary" type="radio" name="c1" id="o">
                                    <label class="form-check-label text-white header-txt" for="flexRadioDefault1">Oldest to newest</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-4 p-1 border-end border-warning">
                        <div class="row g-1">
                            <div class="col-12 text-center">
                                <span class="fs-5 text-warning header-txt">By Quantity</span>
                            </div>
                            <div class="col-12 col-md-6 col-lg-6 d-flex flex-row justify-content-center">
                                <div class="form-check">
                                    <input class="form-check-input bg-secondary" type="radio" name="c2" id="h">
                                    <label class="form-check-label text-white header-txt" for="flexRadioDefault1">High to low</label>
                                </div>
                            </div>
                            <div class="col-12 col-md-6 col-lg-6 d-flex flex-row justify-content-center">
                                <div class="form-check">
                                    <input class="form-check-input bg-secondary" type="radio" name="c2" id="l">
                                    <label class="form-check-label text-white header-txt" for="flexRadioDefault1">Low to high</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-4 p-1">
                        <div class="row g-1">
                            <div class="col-12 text-center">
                                <span class="fs-5 text-warning header-txt">By Condition</span>
                            </div>
                            <div class="col-12 col-md-6 col-lg-6 d-flex flex-row justify-content-center">
                                <div class="form-check">
                                    <input class="form-check-input bg-secondary" type="radio" name="c3" id="b">
                                    <label class="form-check-label text-white header-txt" for="flexRadioDefault1">Brandnew</label>
                                </div>
                            </div>
                            <div class="col-12 col-md-6 col-lg-6 d-flex flex-row justify-content-center">
                                <div class="form-check">
                                    <input class="form-check-input bg-secondary" type="radio" name="c3" id="u">
                                    <label class="form-check-label text-white header-txt" for="flexRadioDefault1">Used</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-lg-4 offset-0 offset-lg-8">
                        <div class="row g-1">
                            <div class="col-6 offset-3 offset-lg-6 d-grid p-3" style="font-family: 'josefin';">
                                <button class="btn btn-warning fw-bold header-txt text-uppercase" onclick="sort(0);">Filter</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- sort products panel -->
<?php
$manageProductsSortResultset = Database::search($query);
$manageProductssortRownumber = $manageProductsSortResultset->num_rows;

if ($_POST["page"] != "0") {
    $pageNo = $_POST["page"];
} else {
    $pageNo = 1;
}

if ($manageProductssortRownumber == 0) {
?>
    <!-- def watchlist message -->
    <div class="col-12 mt-5 pb-5 pt-3">
        <div class="row g-1">
            <div class="col-12 text-center def-input pt-5 pb-5" style="background-color: #fbffc7;">
                <div class="row">
                    <div class="col-12 text-center p-3">
                        <img src="resource/2639894_product_icon.svg" class="img-fluid" style="height: 120px;opacity: 0.6;" />
                    </div>
                    <div class="col-12">
                        <span class="fs-5 header-txt">You have not added products to sell yet.</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- def watchlist message -->
<?php
} else {
    $resultsPerPage = 6;
    $numberOfPage = ceil($manageProductssortRownumber / $resultsPerPage);

    $pageResults = ($pageNo - 1) * $resultsPerPage;
    $selectedResultset = Database::search($query . " LIMIT " . $resultsPerPage . " OFFSET " . $pageResults . "");
    $selectedRownumber = $selectedResultset->num_rows;
?>
    <!-- watchlist products load -->
    <div class="col-12 mt-5">
        <div class="row">
            <?php
            for ($x = 0; $x < $selectedRownumber; $x++) {
                $selectedData = $selectedResultset->fetch_assoc();

                $imageResultset = Database::search("SELECT * FROM `images` WHERE `product_id`='" . $selectedData["id"] . "'");
                $imageData = $imageResultset->fetch_assoc();
            ?>
                <!-- card -->
                <div class="col-10 offset-1 offset-md-0 offset-lg-0 col-md-6 col-lg-4">
                    <div class="card mb-3" style="box-shadow: 0px 1px 3px 1px rgba(0, 0, 0, 0.05);">
                        <div class="row g-0">
                            <div class="col-md-4 d-flex flex-row justify-content-center align-items-center">
                                <img src="<?php echo ($imageData["code"]); ?>" class="img-fluid rounded-start" style="background-size: contain;height: 250px;" />
                            </div>
                            <div class="col-md-8">
                                <div class="card-body">
                                    <div class="col-12 d-flex flex-row justify-content-end pb-1">
                                        <div class="form-check form-switch">
                                            <?php
                                            if ($selectedData["status_id"] == 1) {
                                            ?>
                                                <input class="form-check-input bg-warning border-0" type="checkbox" role="switch" id="fd<?php echo ($selectedData["id"]); ?>" <?php
                                                                                                                                                                                if ($selectedData["status_id"] == 1) {
                                                                                                                                                                                ?> checked <?php } ?> onclick="changeStatus(<?php echo ($selectedData['id']); ?>);" />
                                                <label class="form-check-label fw-bold" for="fd<?php echo ($selectedData["id"]); ?>" id="lfd<?php echo ($selectedData["id"]); ?>">Active</label>
                                            <?php
                                            } else {
                                            ?>
                                                <input class="form-check-input bg-secondary border-0" type="checkbox" role="switch" id="fd<?php echo ($selectedData["id"]); ?>" <?php
                                                                                                                                                                                if ($selectedData["status_id"] == 1) {
                                                                                                                                                                                ?> checked <?php } ?> onclick="changeStatus(<?php echo ($selectedData['id']); ?>);" />
                                                <label class="form-check-label fw-bold" for="fd<?php echo ($selectedData["id"]); ?>" id="lfd<?php echo ($selectedData["id"]); ?>">Deactive</label>
                                            <?php
                                            }
                                            ?>
                                        </div>
                                    </div>
                                    <h5 class="card-title fs-6 fw-bold text-uppercase" style="height: 25px;"><?php echo ($selectedData["title"]); ?></h5>
                                    <p class="card-text fw-bold fs-4 pt-2">RS. <?php echo ($selectedData["price"]); ?> .00</p>
                                    <?php
                                    if ($selectedData["qty"] <= 3) {
                                    ?>
                                        <p class="card-text fw-bold text-danger fs-5"><?php echo ($selectedData["qty"]); ?> items left</p>
                                    <?php
                                    } else {
                                    ?>
                                        <p class="card-text fw-bold fs-5"><?php echo ($selectedData["qty"]); ?> items left</p>
                                    <?php
                                    }
                                    ?>
                                    <div class="col-12">
                                        <div class="row g-1">
                                            <div class="col-12 d-grid">
                                                <button class="btn btn-warning fw-bold rounded p-1" onclick="sendProductId(<?php echo ($selectedData['id']); ?>);">UPDATE</button>
                                            </div>
                                            <div class="col-12 d-grid pt-1">
                                                <button class="def-btn-dark fw-bold rounded p-1 text-decoration-none text-center" onclick="removeProduct(<?php echo ($selectedData['id']); ?>);">DELETE</button>
                                            </div>
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
            <!-- pagination -->
            <div class="col-12 mt-2">
                <nav>
                    <ul class="pagination pagination-sm justify-content-center justify-content-lg-start ">
                        <?php
                        for ($y = 1; $y <= $numberOfPage; $y++) {
                            if ($y == $pageNo) {
                        ?>
                                <li class="page-item active">
                                    <a onclick="sort('<?php echo ($y); ?>');" class="page-link" style="background-color: #f5d628;border-color: #f5d628;"><?php echo ($y); ?></a>
                                </li>
                            <?php
                            } else {
                            ?>
                                <li class="page-item">
                                    <a onclick="sort('<?php echo ($y); ?>');" class="page-link text-black fw-bold"><?php echo ($y); ?></a>
                                </li>
                        <?php
                            }
                        }
                        ?>
                    </ul>
                </nav>
            </div>
            <!-- pagination -->
        </div>
    </div>
    <!-- watchlist products load -->
<?php
}
?>