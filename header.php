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

    <div class="col-12 bg-body">
        <div class="row">

            <div class="col-4 col-lg-2 p-2" style="background-color: #1974D2 ;">
                <div class="col-12 p-2 d-flex rounded flex-row justify-content-center">
                    <a href="home.php"><img src="resource/logo1.jpg" class="img-fluid" style="height: 78px;" /></a>
                </div>
            </div>

            <div class="col-8 col-lg-5 py-4 mt-3">
                <div class="row g-1">
                    <div class="col-9 d-grid">
                        <input type="text" class="def-input header-txt" placeholder="Search for products..." />
                    </div>
                    <div class="col-3 d-grid">
                        <button class="header-txt btn btn-primary pt-1 fw-bold" style="box-shadow: 0px 1px 3px 1px rgba(23, 94, 154);font-family: 'josefin';padding-top: 2px;">SEARCH</button>
                    </div>
                </div>
            </div>

            <div class="col-4 col-lg-2 py-4 mt-4 d-none d-lg-block">
                <div class="row g-1">
                    <div class="col-6 text-center">
                        <a href="#" class="def-text text-decoration-none header-txt fw-bold" style="color: #1e1e1e;">ABOUT</a>
                    </div>
                    <div class="col-6 text-center">
                        <a href="#" class="def-text text-decoration-none header-txt fw-bold" style="color: #1e1e1e;">CONTACT US</a>
                    </div>
                </div>
            </div>

            <div class="col-8 col-lg-3 py-4 mt-0 mt-lg-4 offset-2 offset-lg-0 order-1 order-lg-0">
                <div class="row g-2">
                    <?php
                    session_start();
                    if (isset($_SESSION["user"])) {
                    ?>
                        <div class="col-3 offset-2">
                            <label class="header-txt fw-bold">WELCOME</label>
                        </div>
                        <div class="col-3">
                            <label class="header-txt fw-bold text-uppercase">| <?php echo ($_SESSION["user"]["fname"]); ?></label>
                        </div>
                    <?php
                    } else {
                    ?>
                        <div class="col-6 offset-2 text-center">
                            <a href="index.php" class="header-txt fw-bold text-decoration-none text-primary">SIGN IN</a>
                        </div>
                    <?php
                    }
                    ?>
                    <div class="col-2 p-0 m-0">
                        <a href="#" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="bi bi-person-video fs-3 user-sign-out"></i>
                        </a>
                        <?php
                        if (isset($_SESSION["user"])) {
                        ?>
                            <ul class="dropdown-menu dropdown-menu-end dropdown-menu-dark">
                                <li><button class="dropdown-item header-txt text-uppercase" type="button" onclick="signout();">Sign Out</button></li>
                                <li><button class="dropdown-item header-txt text-uppercase" type="button" onclick="window.location='myProfile.php';">My Profile</button></li>
                                <li><button class="dropdown-item header-txt text-uppercase" type="button" onclick="window.location='watchlist.php';">Watchlist</button></li>
                                <li><button class="dropdown-item header-txt text-uppercase" type="button">Purchase History</button></li>
                               
                            </ul>
                        <?php
                        }
                        ?>
                    </div>
                    <div class="col-2 p-0 m-0"><a href="cart.php"><i class="bi bi-bag fs-4 cart"></i></a></div>
                </div>
            </div>

            <div class="col-12 bg-black m-0 p-0 order-0 order-lg-1">
                <nav class="navbar navbar-expand-lg" style="background-color: #1A4A73">
                    <div class="container-fluid justify-content-end">
                        <div class="col-1 d-none d-lg-block">
                            <label class="header-txt text-white ps-2">CAREGORIES : </label>
                        </div>
                        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation" style="background-color: #f1cc28;">
                            <span class="navbar-toggler-icon"></span>
                        </button>
                        <div class="col-8 collapse navbar-collapse" id="navbarNavAltMarkup">
                            <div class="navbar-nav gap-3 text-center">
                                <?php
                                require_once "connection.php";

                                $categoryResultset = Database::search("SELECT * FROM `category`");
                                $categoryrownumber = $categoryResultset->num_rows;

                                for ($x = 0; $x < $categoryrownumber; $x++) {
                                    $categoryData = $categoryResultset->fetch_assoc();
                                ?>
                                    <a class="nav-link fs-6 header-txt text-white category-link rounded text-uppercase" href="#"><?php echo ($categoryData["name"]); ?></a>
                                <?php
                                }
                                ?>
                            </div>
                        </div>
                    </div>
                </nav>
            </div>
        </div>
    </div>
    <script src="bootstrap.bundle.js"></script>
</body>

</html>