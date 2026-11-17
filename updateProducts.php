<?php
session_start();
require "connection.php";
if (isset($_SESSION["adminUser"])) {
    if (isset($_SESSION["product"])) {
?>
        <!DOCTYPE html>
        <html>

        <head>
            <meta charset="utf-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">

            <title>Admin Panel - Update Products</title>
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
                    <div class="col-12 col-lg-2 p-2 sidebar-nav">
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
                                <h1 class="fs-2 text-center fw-bold text-white pt-2 pb-2 border-bottom border-2 border-warning" style="background-color: #082D63;">Update Products</h1>
                            </div>
                            <div class="col-12 col-lg-10 offset-0 offset-lg-1 mt-3">
                                <div class="row g-3">
                                    <div class="col-10 col-md-12 offset-1 offset-md-0 col-lg-12 offset-lg-0">
                                        <nav aria-label="breadcrumb">
                                            <ol class="breadcrumb">
                                                <li class="breadcrumb-item"><a href="manageProducts.php" class="text-decoration-none text-warning header-txt fw-bold">Manage Products</a></li>
                                                <li class="breadcrumb-item active text-black header-txt" style="margin-top: 2px;" aria-current="page">Update Products</li>
                                            </ol>
                                        </nav>
                                    </div>
                                    <div class="col-10 offset-1 offset-md-0 offste-lg-0 col-md-6 col-lg-8">
                                        <div class="row">
                                            <div class="col-12">
                                                <?php
                                                $product = $_SESSION["product"];
                                                ?>
                                                <label class="form-label fw-bold fs-5">Product Title</label>
                                            </div>
                                            <div class="col-12 d-grid">
                                                <input type="text" class="def-input" id="title" value="<?php echo ($product["title"]); ?>" />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-10 offset-1 offset-md-0 offste-lg-0 col-md-6 col-lg-4">
                                        <div class="row">
                                            <div class="col-12">
                                                <label class="form-label fw-bold fs-5">Condition</label>
                                            </div>
                                            <div class="col-12 d-grid">
                                                <select class="def-input" id="condition" disabled>
                                                    <?php
                                                    $conditionResultset = Database::search("SELECT * FROM `condition` WHERE `id`='" . $product["condition_id"] . "'");
                                                    $conditionData = $conditionResultset->fetch_assoc();
                                                    ?>
                                                    <option value="<?php echo ($conditionData["id"]); ?>"><?php echo ($conditionData["name"]); ?></option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-10 offset-1 offset-md-0 offste-lg-0 col-md-6 col-lg-4">
                                        <div class="row">
                                            <div class="col-12">
                                                <label class="form-label fw-bold fs-5">Category</label>
                                            </div>
                                            <div class="col-12 d-grid">
                                                <select class="def-input" id="category" disabled>
                                                    <?php
                                                    $categoryResultset = Database::search("SELECT * FROM `category` WHERE `id`='" . $product["category_id"] . "'");
                                                    $categoryData = $categoryResultset->fetch_assoc();
                                                    ?>
                                                    <option value="<?php echo ($categoryData["id"]); ?>"><?php echo ($categoryData["name"]); ?></option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-10 offset-1 offset-md-0 offste-lg-0 col-md-6 col-lg-4">
                                        <div class="row">
                                            <div class="col-12">
                                                <label class="form-label fw-bold fs-5">Brand</label>
                                            </div>
                                            <div class="col-12 d-grid">
                                                <select class="def-input" id="brand" disabled>
                                                    <?php
                                                    $brandResultset = Database::search("SELECT * FROM `brand` WHERE `id` IN (SELECT `brand_id` FROM `brand_has_model` WHERE `id`='" . $product["brand_has_model_id"] . "')");
                                                    $brandData = $brandResultset->fetch_assoc();
                                                    ?>
                                                    <option value="<?php echo ($brandData["id"]); ?>"><?php echo ($brandData["name"]); ?></option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-10 offset-1 offset-md-0 offste-lg-0 col-md-6 col-lg-4">
                                        <div class="row">
                                            <div class="col-12">
                                                <label class="form-label fw-bold fs-5">Model</label>
                                            </div>
                                            <div class="col-12 d-grid">
                                                <select class="def-input" id="model" disabled>
                                                    <?php
                                                    $modelResultset = Database::search("SELECT * FROM `model` WHERE `id` IN (SELECT `model_id` FROM `brand_has_model` WHERE `id`='" . $product["brand_has_model_id"] . "')");
                                                    $modelData = $modelResultset->fetch_assoc();
                                                    ?>
                                                    <option value="<?php echo ($modelData["id"]); ?>"><?php echo ($modelData["name"]); ?></option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-10 offset-1 offset-md-0 offste-lg-0 col-md-6 col-lg-4">
                                        <div class="row">
                                            <div class="col-12">
                                                <label class="form-label fw-bold fs-5">Quantity</label>
                                            </div>
                                            <div class="col-12 d-grid">
                                                <input type="number" class="def-input" id="qty" min="1" value="<?php echo ($product["qty"]); ?>" />
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-10 offset-1 offset-md-0 offste-lg-0 col-md-6 col-lg-4">
                                        <div class="row">
                                            <div class="col-12">
                                                <label class="form-label fw-bold fs-5">Cost Per Item</label>
                                            </div>
                                            <div class="col-12">
                                                <div class="input-group border-0">
                                                    <span class="input-group-text border-0 btn btn-warning" style="width:12%;">RS</span>
                                                    <input type="text" class="text-decoration-none def-input" aria-label="Amount (to the nearest dollar)" style="width: 76%;" id="cost" value="<?php echo ($product["price"]); ?>" />
                                                    <span class="input-group-text border-0 btn btn-warning" style="width:12%;">.00</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-10 offset-1 offset-md-0 offste-lg-0 col-md-12 col-lg-12">
                                        <div class="row">
                                            <div class="col-12">
                                                <label class="form-label fw-bold fs-5">Add Product Images</label>
                                            </div>
                                            <div class="col-12 d-grid">
                                                <div class="col-12 def-input p-4">
                                                    <?php

                                                    $image = array();
                                                    $image[0] = "resource/productImages/item1.svg";
                                                    $image[1] = "resource/productImages/item1.svg";
                                                    $image[2] = "resource/productImages/item1.svg";
                                                    $image[3] = "resource/productImages/item1.svg";

                                                    $imageResultset = Database::search("SELECT * FROM `images` WHERE `product_id`='" . $product["id"] . "'");
                                                    $imageRownumber = $imageResultset->num_rows;

                                                    for ($x = 0; $x < $imageRownumber; $x++) {
                                                        $imageData = $imageResultset->fetch_assoc();
                                                        $image[$x] = $imageData["code"];
                                                    ?>
                                                    <?php
                                                    }

                                                    ?>
                                                    <div class="row g-1">
                                                        <div class="col-12 col-lg-3 p-1 d-flex flex-row justify-content-center align-items-center">
                                                            <img src="<?php echo ($image[0]); ?>" class="img-fluid rounded border" style="background-size: contain; height:240px; opacity: 0.2;" id="i0" />
                                                        </div>
                                                        <div class="col-12 col-lg-3 p-1 d-flex flex-row justify-content-center align-items-center">
                                                            <img src="<?php echo ($image[1]); ?>" class="img-fluid rounded border" style="background-size: contain; height:240px; opacity: 0.2;" id="i1" />
                                                        </div>
                                                        <div class="col-12 col-lg-3 p-1 d-flex flex-row justify-content-center align-items-center">
                                                            <img src="<?php echo ($image[2]); ?>" class="img-fluid rounded border" style="background-size: contain; height:240px; opacity: 0.2;" id="i2" />
                                                        </div>
                                                        <div class="col-12 col-lg-3 p-1 d-flex flex-row justify-content-center align-items-center">
                                                            <img src="<?php echo ($image[3]); ?>" class="img-fluid rounded border" style="background-size: contain; height:240px; opacity: 0.2;" id="i3" />
                                                        </div>
                                                        <script>
                                                            setOpacity();

                                                            function setOpacity() {
                                                                for (var y = 0; y < 4; y++) {
                                                                    if (document.getElementById("i" + y).src != "http://localhost/salpila/resource/productImages/item1.svg") {
                                                                        document.getElementById("i" + y).style.opacity = "1";
                                                                    }
                                                                }
                                                            }
                                                        </script>
                                                        <div class="col-12 d-flex flex-row justify-content-center pt-3">
                                                            <input type="file" id="imageUploader" class="d-none" multiple />
                                                            <label for="imageUploader" class="btn btn-warning p-2 fw-bold imguploader" onclick="changeProductImage();">Upload Images</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-10 offset-1 offset-md-0 offste-lg-0 col-md-12 col-lg-12">
                                        <div class="row">
                                            <div class="col-12">
                                                <label class="form-label fw-bold fs-5">Product Description</label>
                                            </div>
                                            <div class="col-12 d-grid">
                                                <textarea cols="30" rows="7" class="def-input" id="description"><?php echo ($product["description"]); ?></textarea>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-10 offset-1 offset-md-0 offste-lg-0 col-md-12 col-lg-12">
                                        <div class="row p-2">
                                            <div class="col-12 rounded p-2 ps-3 border-start border-3 border-dark" style="background-color: #fbffc7;">
                                                <div class="col-12">
                                                    <label class="form-label fw-bold fs-5">Notice</label>
                                                </div>
                                                <div class="col-12 d-grid">
                                                    <span class="">We are taking 5% of the product form price form every product as a service charge.</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-10 offset-1 offset-md-2 offset-lg-0 col-md-8 col-lg-12 d-flex flex-row justify-content-center pb-0 pb-lg-3">
                                        <div class="col-10 col-lg-3 d-grid">
                                            <button class="def-btn-dark rounded p-2" onclick="updateProduct();">Update Product</button>
                                        </div>
                                    </div>

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
        header("Location:manageProducts.php");
    }
} else {
    header("Location:home.php");
}
?>