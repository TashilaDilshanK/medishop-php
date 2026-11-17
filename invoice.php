<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Invoice - MediShop</title>
    <link rel="stylesheet" href="bootstrap.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css" />
    <link rel="stylesheet" href="style.css" />
    <link rel="icon" href="resource/logo.svg" />
</head>

<body class="mt-2" style="background-color: #f7f7ff;">

    <div class="container-fluid">
        <div class="row">

            <?php include "header.php";
            require_once "connection.php";

            if (isset($_SESSION["user"])) {
                $umail = $_SESSION["user"]["email"];
                $oId = $_GET["id"];

            ?>

                <div class="col-12">
                    <hr />
                </div>

                <div class="col-12 btn-toolbar justify-content-end">
                    <button class="btn btn-dark me-2" onclick="printInvoice();"><i class="bi bi-printer-fill"></i> Print</button>
                    <button class="btn btn-danger me-2"><i class="bi bi-filetype-pdf"></i> Export as PDF</button>
                </div>

                <div class="col-12">
                    <hr />
                </div>

                <div class="col-12" id="page">
                    <div class="row">



                        <div class="col-6">
                            <div class="col-12 text-primary text-decoration-none text-end">
                                <h2>MediShop</h2>
                            </div>
                            <div class="col-12 fw-bold text-end">
                                <span>Maradana, Colombo 10, Sri Lanka</span><br />
                                <span>+94 112 400 300</span>
                                <span>medishop@gmail.com</span>
                            </div>
                        </div>

                        <div class="col-12">
                            <hr class="border border-1 border-primary" />
                        </div>

                        <div class="col-12 mb-4">
                            <div class="row">
                                <div class="col-6">
                                    <h5 class="fw-bold">INVOICE TO :</h5>
                                    <?php
                                    $addressResultset = Database::search("SELECT * FROM `user_has_address` WHERE `user_email`='" . $umail . "'");
                                    $addressData = $addressResultset->fetch_assoc();
                                    ?>
                                    <h2><?php echo ($_SESSION["user"]["fname"] . " " . $_SESSION["user"]["lname"]); ?></h2>
                                    <span><?php echo ($addressData["line1"] . ", " . $addressData["line2"]); ?></span>
                                    <span><?php echo ($umail); ?></span>
                                </div>

                                <?php

                                $invoiceResultset = Database::search("SELECT * FROM `invoice` WHERE `order_id`='" . $oId . "'");
                                $invoiceData = $invoiceResultset->fetch_assoc();

                                ?>

                                <div class="col-6 text-end mt-4">
                                    <h1 class="text-primary">INVOICE 0<?php echo ($invoiceData["id"]); ?></h1>
                                    <span class="fw-bold">Date & Time of Invoice :</span><br />
                                    <span><?php echo ($invoiceData["date"]); ?></span>
                                </div>
                                <div class="col-12">
                                    <hr class="border border-1 border-primary" />
                                </div>
                                <div class="col-12">
                                    <table class="table">
                                        <thead>
                                            <tr class="border border-1 border-secondary">
                                                <th>#</th>
                                                <th>Order ID & Product</th>
                                                <th class="text-end">Unit Price</th>
                                                <th class="text-end">Quantity</th>
                                                <th class="text-end">Price</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr style="height: 72px;">
                                                <td class="bg-primary text-white fs-3 pt-3"><?php echo ($invoiceData["id"]); ?></td>
                                                <td>
                                                    <span class="fw-bold text-decoration-underline p-2 text-primary"><?php echo ($oId); ?></span><br />
                                                    <?php

                                                    $productResultset = Database::search("SELECT * FROM `product` WHERE `id`='" . $invoiceData["product_id"] . "'");
                                                    $productData = $productResultset->fetch_assoc();

                                                    ?>
                                                    <span class="fw-bold text-primary fs-4 p-2"><?php echo ($productData["title"]); ?></span>
                                                </td>
                                                <td class="fw-bold fs-6 text-end pt-4 bg-secondary text-white">Rs. <?php echo ($productData["price"]); ?>.00</td>
                                                <td class="fw-bold fs-6 text-end pt-4"><?php echo ($invoiceData["qty"]); ?></td>
                                                <td class="fw-bold fs-6 text-end pt-4 bg-secondary text-white">RS. <?php echo ($invoiceData["total"]); ?>.00</td>
                                            </tr>
                                        </tbody>
                                        <tfoot>
                                            <?php
                                            $cityResultset = Database::search("SELECT * FROM `city` WHERE `id`='" . $addressData["city_id"] . "'");
                                            $cityData = $cityResultset->fetch_assoc();


                                            $delivery = $productData["delivery_cost_id"];
                                            $total = $invoiceData["total"];
                                            $g = $total - $delivery;
                                            ?>
                                            <tr>
                                                <td colspan="3" class="boredr-0"></td>
                                                <td class="fs-5 text-end fw-bold">SUBTOTAL</td>
                                                <td class="text-end">Rs. <?php echo ($g); ?>.00</td>
                                            </tr>
                                            <tr>
                                                <td colspan="3" class="boredr-0"></td>
                                                <td class="fs-5 text-end fw-bold border-primary">Deliver Fee</td>
                                                <td class="text-end border-primary">Rs. <?php echo ($delivery); ?>.00</td>
                                            </tr>
                                            <tr>
                                                <td colspan="3" class="boredr-0"></td>
                                                <td class="fs-5 text-end fw-bold border-primary text-primary">SUBTOTAL</td>
                                                <td class="text-end border-primary text-primary">Rs. <?php echo ($total); ?>.00</td>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>

                                <div class="col-4 text-center" style="margin-top: -100px;">
                                    <span class="fs-1 fw-bold text-success">Thank You</span>
                                </div>

                                <div class="col-12 border-start border-5 border-primary mt-3 mb-3 rounded" style="background-color: #e7f2ff;">
                                    <div class="row">
                                        <div class="col-12 mt-3 mb-3">
                                            <label class="form-label fw-bold fs-5">NOTICE : </label><br />
                                            <label class="form-label fs-6">Purchased items can return befor 14 days of delivery.</label>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-12">
                                    <hr class="border border-1 border-secondary" />
                                </div>

                                <div class="col-12 text-center mb-3">
                                    <label class="form-label fs-5 text-black-50 fw-bold">
                                        Invoice was created on a computer and is valid without the signature and seal.
                                    </label>
                                </div>

                            </div>
                        </div>

                    </div>
                </div>

            <?php
            }

            ?>

            <?php include "footer.php"; ?>

        </div>
    </div>

    <script src="bootstrap.bundle.js"></script>
    <script src="script.js"></script>
</body>

</html>