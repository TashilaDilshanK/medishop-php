<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>My Profile - - MediShop</title>
    <link rel="stylesheet" href="style.css" />
    <link rel="stylesheet" href="bootstrap.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.2/font/bootstrap-icons.css">
    <link rel="icon" href="resource/logo1.jpg" />
</head>

<body>

    <div class="container-fluid">
        <div class="row">
            <?php
            include "header.php";

            if (isset($_SESSION["user"])) {
                $email = $_SESSION["user"]["email"];

                $userResulstset = Database::search("SELECT * FROM `user` INNER JOIN `gender` ON
                gender.id=user.gender_id WHERE `email`='" . $email . "'");
                $userData = $userResulstset->fetch_assoc();

                $imageResultset = Database::search("SELECT * FROM `profile_image` WHERE `user_email`='" . $email . "'");
                $imageData = $imageResultset->fetch_assoc();

                $addressResultset = Database::search("SELECT * FROM `user_has_address` INNER JOIN `city` ON
                user_has_address.city_id=city.id INNER JOIN `district` ON
                city.district_id=district.id INNER JOIN `province` ON
                district.province_id=province.id WHERE `user_email`='" . $email . "'");
                $addressData = $addressResultset->fetch_assoc();

            ?>

                <div class="col-12">
                    <div class="row">
                        <div class="col-12 border-top border-bottom border-warning border-2 pt-3" style="background-color: #4863A0;">
                            <h1 class="header-txt text-warning text-center fs-2 text-lg-start ps-4 ps-lg-2 text-uppercase">My Profile</h1>
                        </div>
                        <!-- side panel -->
                        <div class="col-12 col-lg-2 p-2" style="background-color: #1974D2;">
                            <div class="col-12 col-lg-12 offset-lg-0 d-grid pt-3">
                                <nav aria-label="breadcrumb" class="ps-5 ps-lg-3">
                                    <ol class="breadcrumb">
                                        <li class="breadcrumb-item"><a href="home.php" class="text-decoration-none header-txt" style="color: #e4c61e;">Home</a></li>
                                        <li class="breadcrumb-item active text-white header-txt" style="margin-top: 2px;" aria-current="page">My Profile</li>
                                    </ol>
                                </nav>
                            </div>
                        </div>
                        <!-- side panel -->
                        <div class="col-12 col-lg-10 p-2">
                            <div class="row g-1">
                                <div class="col-10 def-input offset-1 p-4 p-md-5 p-lg-5 mt-3 mb-3" style="background-color: rgb(253, 253, 253);">
                                    <div class="row g-1">
                                        <div class="col-12 p-2 d-flex flex-row justify-content-center align-items-center">
                                            <?php
                                            if (empty($imageData["path"])) {
                                            ?>
                                                <img src="resource/profileImages/216498_user_icon.svg" class="img-fluid p-2 border prof-img" id="i0" style="width: 170px;height: 170px;" />
                                            <?php
                                            } else {
                                            ?>
                                                <img src="<?php echo ($imageData["path"]); ?>" class="img-fluid p-2 border prof-img" id="i0" style="width: 170px;height: 170px;opacity: 1;" />
                                            <?php
                                            }
                                            ?>
                                            <div class="col-4 d-flex flex-row justify-content-center align-items-center prof-edit-area">
                                                <input type="file" class="d-none" id="profileUploader" />
                                                <div class="text-center bg-body d-flex flex-row justify-content-center align-items-center" style="width:40px;height:40px;border-radius: 100%;margin-top: 160px;box-shadow: 0px 1px 3px 1px rgba(0, 0, 0, 0.09);">
                                                    <label for="profileUploader">
                                                        <i class="bi bi-pencil-square fs-4 prof-edit-btn" onclick="changeProfileImage();"></i>
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12 text-center mt-4">
                                            <h2 class="fw-bold text-capitalize"><?php echo ($userData["fname"] . " " . $userData["lname"]); ?></h2>
                                        </div>
                                        <div class="col-12 text-center border-bottom pb-2">
                                            <label class="fs-4"><?php echo ($userData["email"]); ?></label>
                                        </div>
                                        <div class="col-12 pt-4">
                                            <div class="row g-2">

                                                <div class="col-12 col-lg-6">
                                                    <div class="row g-1">
                                                        <div class="col-12">
                                                            <label class="form-label fs-6 fw-bold">First Name</label>
                                                        </div>
                                                        <div class="col-12 d-grid">
                                                            <input type="text" class="def-input" value="<?php echo ($userData["fname"]); ?>" id="fname" />
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-12 col-lg-6">
                                                    <div class="row g-1">
                                                        <div class="col-12">
                                                            <label class="form-label fs-6 fw-bold">Last Name</label>
                                                        </div>
                                                        <div class="col-12 d-grid">
                                                            <input type="text" class="def-input" value="<?php echo ($userData["lname"]); ?>" id="lname" />
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-12 col-lg-6">
                                                    <div class="row g-1">
                                                        <div class="col-12">
                                                            <label class="form-label fs-6 fw-bold">Mobile</label>
                                                        </div>
                                                        <div class="col-12 d-grid">
                                                            <input type="text" class="def-input" value="<?php echo ($userData["mobile"]); ?>" id="mobile" />
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-12 col-lg-6">
                                                    <div class="row g-1">
                                                        <div class="col-12">
                                                            <label class="form-label fs-6 fw-bold">Password</label>
                                                        </div>
                                                        <div class="col-12">
                                                            <div class="input-group mb-3">
                                                                <input type="password" class="text-decoration-none def-input disabled" disabled style="width: 90%;" aria-label="Recipient's username" aria-describedby="button-addon2" id="npassword2" value="<?php echo ($userData["password"]); ?>" />
                                                                <button class="btn btn-warning" type="button" id="button-addon2" style="width: 10%;" onclick="viewPassword2();" style="background-color: #f1cc28;"><i class="bi bi-eye-fill" id="pass-icon2"></i></button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-12 col-lg-6">
                                                    <div class="row g-1">
                                                        <div class="col-12">
                                                            <label class="form-label fs-6 fw-bold">Email</label>
                                                        </div>
                                                        <div class="col-12 d-grid">
                                                            <input type="text" class="def-input disabled" disabled value="<?php echo ($userData["email"]); ?>" />
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-12 col-lg-6">
                                                    <div class="row g-1">
                                                        <div class="col-12">
                                                            <label class="form-label fs-6 fw-bold">Registered Date</label>
                                                        </div>
                                                        <div class="col-12 d-grid">
                                                            <input type="text" class="def-input disabled" disabled value="<?php echo ($userData["joined_date"]); ?>" />
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-12 col-lg-6">
                                                    <div class="row g-1">
                                                        <div class="col-12">
                                                            <label class="form-label fs-6 fw-bold">Address Line 01</label>
                                                        </div>
                                                        <div class="col-12 d-grid">
                                                        <input type="text" class="def-input" value="<?php echo ($userData["adres1"]); ?>" id="line1"  />
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-12 col-lg-6">
                                                    <div class="row g-1">
                                                        <div class="col-12">
                                                            <label class="form-label fs-6 fw-bold">Address Line 02</label>
                                                        </div>
                                                        <div class="col-12 d-grid">
                                                        <input type="text" class="def-input" value="<?php echo ($userData["adres2"]); ?>" id="line2"  />
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-12 col-lg-4">
                                                    <div class="row g-1">
                                                        <div class="col-12">
                                                            <label class="form-label fs-6 fw-bold">Province</label>
                                                        </div>
                                                        <?php
                                                        $provinceResultset = Database::search("SELECT * FROM `province`");
                                                        $districtResultset = Database::search("SELECT * FROM `district`");
                                                        $cityResultset = Database::search("SELECT * FROM `city`");
                                                        ?>
                                                        <div class="col-12 d-grid">
                                                            <select class="def-input" id="province" onchange="loadDistrict();">
                                                                <option value='0'>Select Province</option>
                                                                <?php
                                                                $provinceRownumber = $provinceResultset->num_rows;
                                                                for ($x = 0; $x < $provinceRownumber; $x++) {
                                                                    $provinceData = $provinceResultset->fetch_assoc();
                                                                ?>
                                                                    <option value="<?php echo ($provinceData["id"]); ?>" <?php if (!empty($addressData["province_id"])) {
                                                                                                                                if ($provinceData["id"] == $addressData["province_id"]) {
                                                                                                                            ?>selected<?php
                                                                                                                                    }
                                                                                                                                }; ?>><?php echo ($provinceData["name"]); ?></option>
                                                                <?php
                                                                }
                                                                ?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-12 col-lg-4">
                                                    <div class="row g-1">
                                                        <div class="col-12">
                                                            <label class="form-label fs-6 fw-bold">District</label>
                                                        </div>
                                                        <div class="col-12 d-grid">
                                                            <select class="def-input" id="district" onchange="loadCity();">
                                                                <option value='0'>Select District</option>
                                                                <?php
                                                                $districtRownumber = $districtResultset->num_rows;
                                                                for ($x = 0; $x < $districtRownumber; $x++) {
                                                                    $districtData = $districtResultset->fetch_assoc();
                                                                ?>
                                                                    <option value="<?php echo ($districtData["id"]); ?>" <?php if (!empty($addressData["district_id"])) {
                                                                                                                                if ($districtData["id"] == $addressData["district_id"]) {
                                                                                                                            ?>selected<?php
                                                                                                                                    }
                                                                                                                                }; ?>><?php echo ($districtData["name"]); ?></option>
                                                                <?php
                                                                }
                                                                ?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-12 col-lg-4">
                                                    <div class="row g-1">
                                                        <div class="col-12">
                                                            <label class="form-label fs-6 fw-bold">City</label>
                                                        </div>
                                                        <div class="col-12 d-grid">
                                                            <select class="def-input" id="city">
                                                                <option value='0'>Select City</option>
                                                                <?php
                                                                $cityRownumber = $cityResultset->num_rows;
                                                                for ($x = 0; $x < $cityRownumber; $x++) {
                                                                    $cityData = $cityResultset->fetch_assoc();
                                                                ?>
                                                                    <option value="<?php echo ($cityData["id"]); ?>" <?php if (!empty($addressData["city_id"])) {
                                                                                                                            if ($cityData["id"] == $addressData["city_id"]) {
                                                                                                                        ?>selected<?php
                                                                                                                                }
                                                                                                                            }; ?>><?php echo ($cityData["name"]); ?></option>
                                                                <?php
                                                                }
                                                                ?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-12 col-lg-6 pb-4">
                                                    <div class="row g-1">
                                                        <div class="col-12">
                                                            <label class="form-label fs-6 fw-bold">Postal Code</label>
                                                        </div>
                                                        <div class="col-12 d-grid">
                                                            <?php
                                                            if (!empty($addressData["postal_code"])) {
                                                            ?>
                                                                <input type="text" class="def-input" value="<?php echo ($addressData["postal_code"]); ?>" id="postalcode" />
                                                            <?php
                                                            } else {
                                                            ?>
                                                                <input type="text" class="def-input" id="postalcode" />
                                                            <?php
                                                            }
                                                            ?>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-12 col-lg-6 pb-4">
                                                    <div class="row g-1">
                                                        <div class="col-12">
                                                            <label class="form-label fs-6 fw-bold">Gender</label>
                                                        </div>
                                                        <div class="col-12 d-grid">
                                                            <input type="text" class="def-input disabled" disabled value="<?php echo ($userData["gender_name"]); ?>" />
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-12 border-top">
                                                    <div class="col-4 offset-4 d-grid pt-4">
                                                        <button class="btn btn-warning fw-bold" onclick="updateProfile();">Update Profile</button>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                </div>
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