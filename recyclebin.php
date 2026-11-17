<?php
session_start();
require "connection.php";

if (isset($_SESSION["adminUser"])) {
?>
    <!DOCTYPE html>
    <html>

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <title>Admin Panel - Recycle Bin</title>
        <link rel="stylesheet" href="style.css" />
        <link rel="stylesheet" href="bootstrap.css" />
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.2/font/bootstrap-icons.css">
        <link rel="icon" href="resource/logo1.jpg" />

        <!-- Main CSS File -->
    <link href="assets/css/style(1).css" rel="stylesheet">
    </head>

    <body>

        <div class="container-fluid">
            <div class="row">

                <!-- side panel -->
                <div class="col-12 col-lg-2 p-2 pb-5 sidebar-nav">
                    <div class="col-12 p-2 d-flex rounded flex-row justify-content-center">
                        <a href="home.php"><img src="resource/logo.jpg" class="img-fluid" style="height: 78px;" /></a>
                    </div>
                    <div class="col-12 mt-5">
                        <h3 class="text-warning header-txt ps-0 ps-lg-3 text-center text-lg-start text-uppercase">MediAdmin</h3>
                    </div>
                    <div class="col-8 offset-2 col-lg-12 offset-lg-0 d-grid pt-3">
                        <button class="def-ad-btn text-center text-lg-start header-txt rounded pt-2 pb-2 ps-3"><a href="AdminPanel.php">Dash Borad</a></button>
                    </div>
                    <div class="col-8 offset-2 col-lg-12 offset-lg-0 d-grid pt-3">
                        <button class="def-ad-btn-active header-txt text-center text-lg-start rounded pt-2 pb-2 ps-3" onclick="window.location='manageProducts.php';">Manage Products</button>
                    </div>
                </div>
                <!-- side panel -->

                <div class="col-12 col-lg-10 p-0 m-0 pb-4">
                    <div class="row p-0 m-0">
                        <div class="col-12 p-0 m-0">
                            <h1 class="fs-2 text-center fw-bold text-white pt-2 pb-2 border-bottom border-2 border-warning" style="background-color: #082D63;">Recycle Bin</h1>
                        </div>
                        <div class="col-12 col-lg-10 offset-0 offset-lg-1 mt-3">
                            <div class="row g-3" id="recycleBinLoader">
                                <div class="col-10 col-md-12 offset-1 offset-md-0 col-lg-12 offset-lg-0">
                                    <nav aria-label="breadcrumb">
                                        <ol class="breadcrumb">
                                            <li class="breadcrumb-item"><a href="manageProducts.php" class="text-decoration-none text-warning header-txt fw-bold">Manage Products</a></li>
                                            <li class="breadcrumb-item active text-black header-txt" style="margin-top: 2px;" aria-current="page">Recycle Bin</li>
                                        </ol>
                                    </nav>
                                </div>
                                <?php
                                $query = "SELECT * FROM `product` WHERE `recycle_bin_id`='2' AND `user_email`= '" . $_SESSION["adminUser"]["email"] . "'";
                                $recycleBinResultset = Database::search($query);
                                $recycleBinRownumber = $recycleBinResultset->num_rows;

                                if (isset($_GET["page"])) {
                                    $pageNo = $_GET["page"];
                                } else {
                                    $pageNo = 1;
                                }

                                if ($recycleBinRownumber == 0) {
                                ?>
                                    <!-- def watchlist message -->
                                    <div class="col-12 mt-5 pb-5 pt-5">
                                        <div class="row g-1 pt-5 pb-5">
                                            <div class="col-12 text-center def-input pt-5 pb-5" style="background-color: #1974D2;">
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
                                        <div class="col-10 offset-1 card offset-lg-0 col-md-10 col-lg-12 p-3" style="background-color:#1974D2;">
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
                            </div>
                        </div>
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

            </div>
        </div>
        <script src="bootstrap.bundle.js"></script>
        <script src="script.js"></script>
    </body>

    </html>
<?php
} else {
    header("Location:AdminPanal.php");
}
?>