<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>MediShop</title>
    <link rel="stylesheet" href="style.css" />
    <link rel="stylesheet" href="bootstrap.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.2/font/bootstrap-icons.css">
    <link rel="icon" href="resource/logo1.jpg" />
</head>

<body class="main-body">

    <div class="container-fluid vh-100 d-flex justify-content-center">
        <div class="row align-content-center">
            <div class="col-12">
                <div class="row">
                
                    <div class="col-10 col-md-6 col-lg-4 offset-1 offset-md-3 offset-lg-4 d-flex flex-row justify-content-center pt-1">
                        <img src="resource/logo1.jpg" class="img-fluid" style="height: 110px;" />
                    </div>
                    <div class="col-10 col-md-6 col-lg-4 offset-1 offset-md-3 offset-lg-4 mt-1 text-center">
                        <span class="fs-6 text-white opacity-75" style="font-family: 'josefin';letter-spacing: 2px;">WELCOME TO MEDISHOP.</span>
                    </div>

                    <!-- sign up part -->
                    <div class="col-12 d-none" id="signup-part">
                        <div class="row">

                            <div class="col-10 col-md-6 col-lg-4 offset-1 offset-md-3 offset-lg-4 mt-3 text-center">
                                <span class="fs-1 text-white" >Sign Up</span>
                            </div>
                            <div class="col-10 col-md-6 col-lg-4 offset-1 offset-md-3 offset-lg-4 rounded p-4" style="background-color: #fff;">
                                <div class="row g-2">
                                    <div class="col-6 px-2">
                                        <label class="form-label fw-bold">First Name</label>
                                        <div class="col-12 d-grid">
                                            <input type="text" class="def-input d-grid" id="fname" />
                                        </div>
                                    </div>
                                    <div class="col-6 px-2">
                                        <label class="form-label fw-bold">Last Name</label>
                                        <div class="col-12 d-grid">
                                            <input type="text" class="def-input d-grid fs-6" id="lname" />
                                        </div>
                                    </div>
                                    <div class="col-12 px-2">
                                        <label class="form-label fw-bold">Email</label>
                                        <div class="col-12 d-grid">
                                            <input type="email" class="def-input d-grid fs-6" id="email" />
                                        </div>
                                    </div>
                                    <div class="col-12 px-2">
                                        <label class="form-label fw-bold">Password</label>
                                        <div class="col-12 d-grid">
                                            <input type="password" class="def-input d-grid fs-6" id="password" />
                                        </div>
                                    </div>
                                    <div class="col-6 px-2">
                                        <label class="form-label fw-bold">Adress Line 1</label>
                                        <div class="col-12 d-grid">
                                            <input type="text" class="def-input d-grid fs-6" id="adres1" />
                                        </div>
                                    </div>
                                    <div class="col-6 px-2">
                                        <label class="form-label fw-bold">Adress Line 2</label>
                                        <div class="col-12 d-grid">
                                            <input type="text" class="def-input d-grid fs-6" id="adres2" />
                                        </div>
                                    </div>
                                    <div class="col-6 px-2">
                                        <label class="form-label fw-bold">Mobile</label>
                                        <div class="col-12 d-grid">
                                            <input type="text" class="def-input d-grid fs-6" id="mobile" />
                                        </div>
                                    </div>
                                    <div class="col-6 px-2">
                                        <label class="form-label fw-bold">Gender</label>
                                        <div class="col-12 d-grid">
                                            <select class="def-input" id="gender">
                                                <option selected value="1">Male</option>
                                                <option value="2">Female</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-12 pt-3 px-2">
                                        <div class="row g-2">
                                            <div class="col-12 col-lg-6 d-grid">
                                                <button class="def-btn rounded fw-bold p-1" onclick="signUp();">Sign Up</button>
                                            </div>
                                            <div class="col-12 col-lg-6 d-grid">
                                                <button class="def-btn def-btn-dark rounded fw-bold p-1" onclick="changePart();">Sign In to an Existing Account</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                    <!-- sign up part -->

                    <!-- sign in part -->
                    <div class="col-12" id="signin-part">
                        <div class="row">

                            <div class="col-10 col-md-6 col-lg-4 offset-1 offset-md-3 offset-lg-4 mt-3 text-center">
                                <span class="fs-1 text-white" style="font-family: 'josefin';">Sign In</span>
                            </div>
                            <div class="col-10 col-md-6 col-lg-4 offset-1 offset-md-3 offset-lg-4 rounded p-4" style="background-color: #fff;">
                                <div class="row g-2">
                                    <?php

                                    $email = "";
                                    $password = "";

                                    if (isset($_COOKIE["email"])) {
                                        $email = $_COOKIE["email"];
                                    }
                                    if (isset($_COOKIE["password"])) {
                                        $password = $_COOKIE["password"];
                                    }

                                    ?>
                                    <div class="col-12 px-2">
                                        <label class="form-label fw-bold">Email</label>
                                        <div class="col-12 d-grid">
                                            <input type="email" class="def-input d-grid fs-6" id="email2" value="<?php echo ($email); ?>" />
                                        </div>
                                    </div>
                                    <div class="col-12 px-2">
                                        <label class="form-label fw-bold">Password</label>
                                        <div class="col-12 d-grid">
                                            <input type="password" class="def-input d-grid fs-6" id="password2" value="<?php echo ($password); ?>" />
                                        </div>
                                    </div>
                                    <div class="col-12 px-2">
                                        <div class="row g-1">
                                            <div class="col-6">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" value="" id="rem">
                                                    <label class="form-check-label fw-bold" for="rem">Remember me</label>
                                                </div>
                                            </div>
                                            <div class="col-6 text-end">
                                                <a href="#" class="fw-bold text-decoration-none" style="color: #ddbc00;" onclick="forgotPassword();">Forgot Password</a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 pt-3 px-2">
                                        <div class="row g-2">
                                            <div class="col-12 col-lg-6 d-grid">
                                                <button class="def-btn rounded fw-bold p-1" onclick="signIn();">Sign In</button>
                                            </div>
                                            <div class="col-12 col-lg-6 d-grid">
                                                <button class="def-btn def-btn-dark rounded fw-bold p-1" onclick="changePart();">New to site? Sign Up</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                    <!-- sign in part -->

                    <!-- reset password -->
                    <div class="col-12 d-none" id="reset-part">
                        <div class="row">

                            <div class="col-10 col-md-6 col-lg-4 offset-1 offset-md-3 offset-lg-4 mt-3 text-center">
                                <span class="fs-1 text-white" style="font-family: 'josefin';">Sign In - Reset Password</span>
                            </div>
                            <div class="col-10 col-md-6 col-lg-4 offset-1 offset-md-3 offset-lg-4 rounded p-4" style="background-color: #fff;">
                                <div class="row g-2">

                                    <div class="col-12 px-2">
                                        <label class="form-label fw-bold">Verification Code</label>
                                        <div class="col-12 d-grid">
                                            <input type="text" class="def-input d-grid fs-6" id="code" />
                                        </div>
                                    </div>
                                    <div class="col-6 px-2">
                                        <label class="form-label fw-bold">New Password</label>
                                        <div class="col-12">
                                            <div class="input-group mb-3">
                                                <input type="password" class="text-decoration-none def-input" style="width: 79%;" aria-label="Recipient's username" aria-describedby="button-addon2" id="npassword1">
                                                <button class="btn btn-warning" type="button" id="button-addon2" onclick="viewPassword1();" style="background-color: #f1cc28;"><i class="bi bi-eye-fill" id="pass-icon1"></i></button>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-6 px-2">
                                        <label class="form-label fw-bold">Retype Password</label>
                                        <div class="col-12">
                                            <div class="input-group mb-3">
                                                <input type="password" class="text-decoration-none def-input" style="width: 79%;" aria-label="Recipient's username" aria-describedby="button-addon2" id="npassword2">
                                                <button class="btn btn-warning" type="button" id="button-addon2" onclick="viewPassword2();" style="background-color: #f1cc28;width: 21%;"><i class="bi bi-eye-fill" id="pass-icon2"></i></button>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 pt-3 px-2">
                                        <div class="row g-2">
                                            <div class="col-12 col-lg-10 offset-0 offset-lg-1 d-grid">
                                                <button class="def-btn rounded fw-bold p-1" onclick="resetPassword();">Reset Password</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                    <!-- reset password -->

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

                    <div class="col-12 text-center mt-3 pb-3">
                        <span class="text-white" style="opacity: 0.8;">&copy; 2022 MediShop.lk | All Rights Reserved</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="bootstrap.bundle.js"></script>
    <script src="script.js"></script>
</body>

</html>