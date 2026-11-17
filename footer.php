<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="style.css" />
    <link rel="stylesheet" href="bootstrap.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.2/font/bootstrap-icons.css">
</head>

<body>
    <footer>
        <div class="col-12" style="background-color: #37517e;">
            <div class="row">

                <div class="col-12 col-lg-3 pt-3 pb-3 ps-5 ps-lg-0 footer-wall"></div>
                <div class="col-12 col-lg-6 pt-5 pb-3 ps-5 ps-lg-3" style="background-color:#37517e">
                    <div class="row g-1">
                        <div class="col-12 col-lg-4">
                            <div class="col-12 text-md-center text-lg-start">
                                <h4 class="fw-bold header-txt fs-5 text-light">CATEGORIES</h4>
                            </div>
                            <div class="col-12 text-md-center text-lg-start pt-2">
                                <ul class="list-unstyled">
                                    <?php
                                    $categoryResultset = Database::search("SELECT * FROM `category`");
                                    $categoryrownumber = $categoryResultset->num_rows;

                                    for ($x = 0; $x < $categoryrownumber; $x++) {
                                        $categoryData = $categoryResultset->fetch_assoc();
                                    ?>
                                        <li><a href="#" class="footer-link-txt text-decoration-none header-txt text-uppercase"><?php echo ($categoryData["name"]); ?></a></li>
                                    <?php
                                    }
                                    ?>
                                </ul>
                            </div>
                        </div>
                        <div class="col-12 col-lg-6">
                            <div class="col-12 text-md-center text-lg-start">
                                <h4 class="fw-bold header-txt fs-5 text-light">CONTACT</h4>
                            </div>
                            <div class="col-12 text-md-center text-lg-start pt-2">
                                <p class="text-light"><i class="bi bi-house-fill"></i> Maradana, Colombo 10, Sri Lanka</p>
                                <p class="text-light"><i class="bi bi-at"></i> eShop@gmail.com</p>
                                <p class="text-light"><i class="bi bi-telephone-fill"></i> +94112 4445558</p>
                                <p class="text-light"><i class="bi bi-printer-fill"></i> +94112 4445558</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-lg-3 pt-0 pt-lg-5 pb-3 ps-5 ps-lg-0 " style="background-color: #37517e;">
                    <div class="col-12 text-md-center text-lg-start">
                        <h4 class="fw-bold header-txt fs-5 text-light">FOLLOW US</h4>
                    </div>
                    <div class="col-4 offset-md-4 offset-lg-0 col-lg-8 text-md-center text-lg-start">
                        <div class="row g-2">
                            <div class="col-3">
                                <a href="#"><i class="bi bi-facebook footer-link-txt fs-4"></i></a>
                            </div>
                            <div class="col-3">
                                <a href="#"><i class="bi bi-whatsapp footer-link-txt fs-4"></i></a>
                            </div>
                            <div class="col-3">
                                <a href="#"><i class="bi bi-twitter footer-link-txt fs-4"></i></a>
                            </div>
                            <div class="col-3">
                                <a href="#"><i class="bi bi-youtube footer-link-txt fs-4"></i></a>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 my-4 text-md-center text-lg-start">
                        <span class="header-txt text-white text-uppercase">Copyright&copy; 2022 MEDISHOP All rights reserved</span>
                    </div>
                </div>
            </div>
        </div>
    </footer>
</body>

</html>