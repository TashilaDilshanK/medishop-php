function changePart() {
    var signinPart = document.getElementById("signin-part");
    var signupPart = document.getElementById("signup-part");

    signinPart.classList.toggle("d-none");
    signupPart.classList.toggle("d-none");
}

function changePart2() {
    var signinPart = document.getElementById("signin-part");
    var resetPart = document.getElementById("reset-part");

    signinPart.classList.toggle("d-none");
    resetPart.classList.toggle("d-none");
}

function showToast() {
    var toastLiveExample = document.getElementById('liveToast');
    var toast = new bootstrap.Toast(toastLiveExample);
    toast.show();
}

function signUp() {
    var fname = document.getElementById("fname");
    var lname = document.getElementById("lname");
    var email = document.getElementById("email");
    var password = document.getElementById("password");
    var adres1 = document.getElementById("adres1");
    var adres2 = document.getElementById("adres2");
    var mobile = document.getElementById("mobile");
    var gender = document.getElementById("gender");

    var form = new FormData();
    form.append("fname", fname.value);
    form.append("lname", lname.value);
    form.append("email", email.value);
    form.append("password", password.value);
    form.append("adres1", adres1.value);
    form.append("adres2", adres2.value);
    form.append("mobile", mobile.value);
    form.append("gender", gender.value);

    var request = new XMLHttpRequest();

    request.onreadystatechange = function() {
        if (request.readyState == 4) {
            var text = request.responseText;
            if (text == "Sign Up successful") {
                document.getElementById("toast-icon").classList = "bi bi-check-circle-fill fs-4 text-success justify-content-start";
                document.getElementById("toast-body").innerHTML = text;
                showToast();
                changePart();
            } else {
                document.getElementById("toast-icon").classList = "bi bi-x-circle-fill fs-4 text-warning justify-content-start";
                document.getElementById("toast-body").innerHTML = text;
                showToast();
            }
        }
    };

    request.open("POST", "signUpProcess.php", true);
    request.send(form);
}

function signIn() {
    var email = document.getElementById("email2");
    var password = document.getElementById("password2");
    var rememberMe = document.getElementById("rem");

    var form = new FormData();
    form.append("email", email.value);
    form.append("password", password.value);
    form.append("rem", rememberMe.checked);

    var request = new XMLHttpRequest();

    request.onreadystatechange = function() {
        if (request.readyState == 4) {
            var text = request.responseText;
            if (text == "Sign In successful") {
                document.getElementById("toast-icon").classList = "bi bi-check-circle-fill fs-4 text-success justify-content-start";
                document.getElementById("toast-body").innerHTML = text;
                showToast();
                window.location = "home.php";
            } else {
                document.getElementById("toast-icon").classList = "bi bi-x-circle-fill fs-4 text-warning justify-content-start";
                document.getElementById("toast-body").innerHTML = text;
                showToast();
            }
        }
    };

    request.open("POST", "signInProcess.php", true);
    request.send(form);
}

function forgotPassword() {
    var email = document.getElementById("email2");

    var request = new XMLHttpRequest();

    request.onreadystatechange = function() {
        if (request.readyState == 4) {
            var text = request.responseText;
            if (text == "Verification code sent to your email. Please check your email.") {
                document.getElementById("toast-icon").classList = "bi bi-forward-fill fs-4 text-success justify-content-start";
                document.getElementById("toast-body").innerHTML = text;
                showToast();
                changePart2();
            } else {
                document.getElementById("toast-icon").classList = "bi bi-x-circle-fill fs-4 text-warning justify-content-start";
                document.getElementById("toast-body").innerHTML = text;
                showToast();
            }
        }
    };

    request.open("GET", "forgotPasswordProcess.php?email=" + email.value, true);
    request.send();
}

function viewPassword1() {
    var password1 = document.getElementById("npassword1");
    if (password1.type == "text") {
        password1.type = "password";
        document.getElementById("pass-icon1").classList = "bi bi-eye-slash-fill";
    } else {
        password1.type = "text";
        document.getElementById("pass-icon1").classList = "bi bi-eye-fill";
    }
}

function viewPassword2() {
    var password2 = document.getElementById("npassword2");
    if (password2.type == "text") {
        password2.type = "password";
        document.getElementById("pass-icon2").classList = "bi bi-eye-slash-fill";
    } else {
        password2.type = "text";
        document.getElementById("pass-icon2").classList = "bi bi-eye-fill";
    }
}

function resetPassword() {
    var email = document.getElementById("email2");
    var verificationCode = document.getElementById("code");
    var password1 = document.getElementById("npassword1");
    var password2 = document.getElementById("npassword2");

    var form = new FormData();
    form.append("email", email.value);
    form.append("code", verificationCode.value);
    form.append("password1", password1.value);
    form.append("password2", password2.value);

    var request = new XMLHttpRequest();

    request.onreadystatechange = function() {
        if (request.readyState == 4) {
            var text = request.responseText;
            if (text == "Password reset successful") {
                document.getElementById("toast-icon").classList = "bi bi-lock-fill fs-4 text-success justify-content-start";
                document.getElementById("toast-body").innerHTML = text;
                showToast();
                changePart2();
            } else {
                document.getElementById("toast-icon").classList = "bi bi-lock-fill fs-4 text-warning justify-content-start";
                document.getElementById("toast-body").innerHTML = text;
                showToast();
            }
        }
    };

    request.open("POST", "resetPasswordProcess.php", true);
    request.send(form);
}

function signout() {
    var request = new XMLHttpRequest();

    request.onreadystatechange = function() {
        if (request.readyState == 4) {
            var text = request.responseText;
            if (text == "success") {
                window.location = "index.php";
            } else {
                document.getElementById("toast-icon").classList = "bi bi-x-circle-fill fs-4 text-warning justify-content-start";
                document.getElementById("toast-body").innerHTML = text;
                showToast();
            }

        }
    };

    request.open("GET", "signout.php", true);
    request.send();
}

function changeProductImage() {
    var imageUploader = document.getElementById("imageUploader");

    imageUploader.onchange = function() {
        var fileCount = imageUploader.files.length;
        if (fileCount <= 4) {
            for (var x = 0; x < fileCount; x++) {
                var file = this.files[x];
                var url = window.URL.createObjectURL(file);

                document.getElementById("i" + x).src = url;
                document.getElementById("i" + x).style.opacity = "1";
            }
        } else {
            alert("Please select 4 or less than three images");
        }
    };
}

function loadBrand() {
    var category = document.getElementById("category");

    var request = new XMLHttpRequest();

    request.onreadystatechange = function() {
        if (request.readyState == 4) {
            var text = request.responseText;
            document.getElementById("brand").innerHTML = text;
        }
    };

    request.open("GET", "loadBrand.php?category=" + category.value, true);
    request.send();
}

function loadModel() {
    var brand = document.getElementById("brand");

    var request = new XMLHttpRequest();

    request.onreadystatechange = function() {
        if (request.readyState == 4) {
            var text = request.responseText;
            document.getElementById("model").innerHTML = text;
        }
    };

    request.open("GET", "loadModel.php?brand=" + brand.value, true);
    request.send();
}

function addProduct() {
    var title = document.getElementById("title");
    var condition = document.getElementById("condition");
    var category = document.getElementById("category");
    var brand = document.getElementById("brand");
    var model = document.getElementById("model");
    var qty = document.getElementById("qty");
    var cost = document.getElementById("cost");
    var imageUploader = document.getElementById("imageUploader");
    var description = document.getElementById("description");

    var form = new FormData();

    form.append("title", title.value);
    form.append("category", category.value);
    form.append("brand", brand.value);
    form.append("model", model.value);
    form.append("qty", qty.value);
    form.append("cost", cost.value);
    form.append("condition", condition.value);
    form.append("description", description.value);

    var fileCount = imageUploader.files.length;

    for (var x = 0; x < fileCount; x++) {
        form.append("image" + x, imageUploader.files[x]);
    }

    var request = new XMLHttpRequest();

    request.onreadystatechange = function() {
        if (request.readyState == 4) {
            var text = request.responseText;
            if (text == "Product saved successful") {
                document.getElementById("toast-icon").classList = "bi bi-check-circle-fill fs-4 text-success justify-content-start";
                document.getElementById("toast-body").innerHTML = text;
                showToast();

                document.getElementById("title").value = "";
                document.getElementById("condition").value = "0";
                document.getElementById("category").value = "0";
                document.getElementById("brand").value = "0";
                document.getElementById("model").value = "0";
                document.getElementById("qty").value = "";
                document.getElementById("cost").value = "";
                document.getElementById("description").value = "";

                for (var y = 0; y < fileCount; y++) {
                    document.getElementById("i" + y).src = "resource/productImages/item1.jpg";
                    document.getElementById("i" + y).style.opacity = "0.5";
                }

            } else {
                document.getElementById("toast-icon").classList = "bi bi-x-circle-fill fs-4 text-warning justify-content-start";
                document.getElementById("toast-body").innerHTML = text;
                showToast();
            }
        }
    };

    request.open("POST", "addProductProcess.php", true);
    request.send(form);

}

function addToWatchlist(id) {
    var request = new XMLHttpRequest();

    request.onreadystatechange = function() {
        if (request.readyState == 4) {
            var text = request.responseText;
            if (text == "Item removed") {
                document.getElementById("toast-icon").classList = "bi bi-trash-fill fs-4 text-warning justify-content-start";
                document.getElementById("toast-body").innerHTML = text;
                document.getElementById("heart-icon" + id).classList = "bi bi-heart text-black fs-5";
                showToast();
            } else if (text == "Item Added") {
                document.getElementById("toast-icon").classList = "bi bi-check-circle-fill fs-4 text-success justify-content-start";
                document.getElementById("toast-body").innerHTML = text;
                document.getElementById("heart-icon" + id).classList = "bi bi-heart-fill text-black fs-5";
                showToast();
            } else {
                document.getElementById("toast-icon").classList = "bi bi-x-circle-fill fs-4 text-warning justify-content-start";
                document.getElementById("toast-body").innerHTML = text;
                showToast();
            }
        }
    };

    request.open("GET", "addToWatchlistProcess.php?id=" + id, true);
    request.send();
}

function removeFromWatchlist(id) {
    var request = new XMLHttpRequest();

    request.onreadystatechange = function() {
        if (request.readyState == 4) {
            var text = request.responseText;
            if (text == "Item removed") {
                document.getElementById("toast-icon").classList = "bi bi-trash-fill fs-4 text-warning justify-content-start";
                document.getElementById("toast-body").innerHTML = text;
                loadWatchlist();
                showToast();
            } else {
                document.getElementById("toast-icon").classList = "bi bi-x-circle-fill fs-4 text-warning justify-content-start";
                document.getElementById("toast-body").innerHTML = text;
                showToast();
            }
        }
    };

    request.open("GET", "removeFromWatchlistProcess.php?id=" + id, true);
    request.send();
}

function loadWatchlist() {
    var request = new XMLHttpRequest();

    request.onreadystatechange = function() {
        if (request.readyState == 4) {
            var text = request.responseText;
            document.getElementById("watchlistLoader").innerHTML = text;
        }
    };

    request.open("GET", "loadWatchlist.php", true);
    request.send();
}

var txt;

function watchlistBasicSearch(page) {
    if (document.getElementById("watchlist-text").value != "") {
        txt = document.getElementById("watchlist-text").value;
    }

    var form = new FormData();
    form.append("txt", txt);
    form.append("page", page);

    var request = new XMLHttpRequest();

    request.onreadystatechange = function() {
        if (request.readyState == 4) {
            var text = request.responseText;
            document.getElementById("watchlistLoader").innerHTML = text;
        }
    };

    request.open("POST", "watchlistBasicSearchProcess.php", true);
    request.send(form);
}

function changeStatus(id) {
    var request = new XMLHttpRequest();

    request.onreadystatechange = function() {
        if (request.readyState == 4) {
            var text = request.responseText;
            if (text == "Product activated") {
                document.getElementById("toast-icon").classList = "bi bi-check-circle-fill fs-4 text-success justify-content-start";
                document.getElementById("toast-body").innerHTML = text;
                document.getElementById("lfd" + id).innerHTML = "Active";
                document.getElementById("fd" + id).classList = "form-check-input bg-warning border-0";
                document.getElementById("fd" + id).style.checked;
                showToast();
            } else if (text == "Product deactivated") {
                document.getElementById("toast-icon").classList = "bi bi-check-circle-fill fs-4 text-success justify-content-start";
                document.getElementById("toast-body").innerHTML = text;
                document.getElementById("lfd" + id).innerHTML = "Deactive";
                document.getElementById("fd" + id).classList = "form-check-input bg-secondary border-0";
                showToast();
            } else {
                document.getElementById("toast-icon").classList = "bi bi-x-circle-fill fs-4 text-warning justify-content-start";
                document.getElementById("toast-body").innerHTML = text;
                showToast();
            }
        }
    };

    request.open("GET", "changeStatusProcess.php?id=" + id, true);
    request.send();
}

function sendProductId(id) {
    var request = new XMLHttpRequest();

    request.onreadystatechange = function() {
        if (request.readyState == 4) {
            var text = request.responseText;
            if (text == "success") {
                window.location = "updateProducts.php";
            } else {
                document.getElementById("toast-icon").classList = "bi bi-x-circle-fill fs-4 text-warning justify-content-start";
                document.getElementById("toast-body").innerHTML = text;
                showToast();
            }
        }
    };

    request.open("GET", "sendProductIdProcess.php?id=" + id, true);
    request.send();
}

function updateProduct() {
    var title = document.getElementById("title");
    var qty = document.getElementById("qty");
    var cost = document.getElementById("cost");
    var description = document.getElementById("description");
    var imageUploader = document.getElementById("imageUploader");

    var form = new FormData();
    form.append("title", title.value);
    form.append("qty", qty.value);
    form.append("cost", cost.value);
    form.append("description", description.value);

    var fileCount = imageUploader.files.length;

    for (var x = 0; x < fileCount; x++) {
        form.append("image" + x, imageUploader.files[x]);
    }

    var request = new XMLHttpRequest();

    request.onreadystatechange = function() {
        if (request.readyState == 4) {
            var text = request.responseText;
            if (text == "Product update successful") {
                document.getElementById("toast-icon").classList = "bi bi-check-circle-fill fs-4 text-success justify-content-start";
                document.getElementById("toast-body").innerHTML = text;
                showToast();
            } else {
                document.getElementById("toast-icon").classList = "bi bi-x-circle-fill fs-4 text-warning justify-content-start";
                document.getElementById("toast-body").innerHTML = text;
                showToast();
            }
        }
    };

    request.open("POST", "updateProductProcess.php", true);
    request.send(form);
}

function removeProduct(id) {
    var request = new XMLHttpRequest();

    request.onreadystatechange = function() {
        if (request.readyState == 4) {
            var text = request.responseText;
            if (text == "Product deleted") {
                document.getElementById("toast-icon").classList = "bi bi-trash-fill fs-4 text-success justify-content-start";
                document.getElementById("toast-body").innerHTML = text;
                loadManageProducts();
                showToast();
            } else {
                document.getElementById("toast-icon").classList = "bi bi-check-circle-fill fs-4 text-success justify-content-start";
                document.getElementById("toast-body").innerHTML = text;
                loadManageProducts();
                showToast();
            }
        }
    };

    request.open("GET", "removeProductProcess.php?id=" + id, true);
    request.send();
}

function loadManageProducts() {
    var request = new XMLHttpRequest();

    request.onreadystatechange = function() {
        if (request.readyState == 4) {
            var text = request.responseText;
            document.getElementById("manageProductsLoader").innerHTML = text;
        }
    };

    request.open("GET", "loadManageProducts.php", true);
    request.send();
}


function sort(page) {
    var txt = document.getElementById("manage-products-text");

    var time;
    if (document.getElementById("n").checked) {
        time = "1";
    } else if (document.getElementById("o").checked) {
        time = "2";
    } else {
        time = "0";
    }

    var qty;
    if (document.getElementById("h").checked) {
        qty = "1";
    } else if (document.getElementById("l").checked) {
        qty = "2";
    } else {
        qty = "0";
    }

    var condition;
    if (document.getElementById("b").checked) {
        condition = "1";
    } else if (document.getElementById("u").checked) {
        condition = "2";
    } else {
        condition = "0";
    }

    var form = new FormData();
    form.append("txt", txt.value);
    form.append("time", time);
    form.append("qty", qty);
    form.append("condition", condition);
    form.append("page", page);

    var request = new XMLHttpRequest();

    request.onreadystatechange = function() {
        if (request.readyState == 4) {
            var text = request.responseText;
            document.getElementById("manageProductsLoader").innerHTML = text;
        }
    };

    request.open("POST", "sortProcess.php", true);
    request.send(form);
}

function restore(id) {
    var request = new XMLHttpRequest();

    request.onreadystatechange = function() {
        if (request.readyState == 4) {
            var text = request.responseText;
            if (text == "Product restored") {
                document.getElementById("toast-icon").classList = "bi bi-check-circle-fill fs-4 text-success justify-content-start";
                document.getElementById("toast-body").innerHTML = text;
                loadRestore();
                showToast();
            } else {
                document.getElementById("toast-icon").classList = "bi bi-check-circle-fill fs-4 text-success justify-content-start";
                document.getElementById("toast-body").innerHTML = text;
                showToast();
            }
        }
    };

    request.open("GET", "restoreProcess.php?id=" + id, true);
    request.send();
}

function loadRestore() {
    var request = new XMLHttpRequest();

    request.onreadystatechange = function() {
        if (request.readyState == 4) {
            var text = request.responseText;
            document.getElementById("recycleBinLoader").innerHTML = text;
        }
    };

    request.open("GET", "loadRecyclebin.php", true);
    request.send();
}

function changeProfileImage() {
    var profileUploader = document.getElementById("profileUploader");

    profileUploader.onchange = function() {
        var fileCount = profileUploader.files.length;
        if (fileCount == 1) {
            var file = this.files[0];
            var url = window.URL.createObjectURL(file);

            document.getElementById("i0").src = url;
            document.getElementById("i0").style.opacity = "1";
        }
    };
}

function loadDistrict() {
    var province = document.getElementById("province");

    var request = new XMLHttpRequest();

    request.onreadystatechange = function() {
        if (request.readyState == 4) {
            var text = request.responseText;
            document.getElementById("district").innerHTML = text;
        }
    };

    request.open("GET", "loadDistrictProcess.php?province=" + province.value, true);
    request.send();
}

function loadCity() {
    var district = document.getElementById("district");

    var request = new XMLHttpRequest();

    request.onreadystatechange = function() {
        if (request.readyState == 4) {
            var text = request.responseText;
            document.getElementById("city").innerHTML = text;
        }
    };

    request.open("GET", "loadCityProcess.php?district=" + district.value, true);
    request.send();
}

function updateProfile() {
    var fname = document.getElementById("fname");
    var lname = document.getElementById("lname");
    var line1 = document.getElementById("line1");
    var line2 = document.getElementById("line2");
    var mobile = document.getElementById("mobile");
    var province = document.getElementById("province");
    var district = document.getElementById("district");
    var city = document.getElementById("city");
    var postalcode = document.getElementById("postalcode");
    var profileImageUploader = document.getElementById("profileUploader");

    var form = new FormData();
    form.append("fname", fname.value);
    form.append("lname", lname.value);
    form.append("line1", line1.value);
    form.append("line2", line2.value);
    form.append("mobile", mobile.value);
    form.append("province", province.value);
    form.append("district", district.value);
    form.append("city", city.value);
    form.append("postalcode", postalcode.value);
    form.append("image", profileImageUploader.files[0]);

    var request = new XMLHttpRequest();

    request.onreadystatechange = function() {
        if (request.readyState == 4) {
            var text = request.responseText;
            if (text == "Product updated") {
                document.getElementById("toast-icon").classList = "bi bi-check-circle-fill fs-4 text-success justify-content-start";
                document.getElementById("toast-body").innerHTML = text;
                showToast();
            } else {
                document.getElementById("toast-icon").classList = "bi bi-check-circle-fill fs-4 text-success justify-content-start";
                document.getElementById("toast-body").innerHTML = text;
                showToast();
            }
        }
    };

    request.open("POST", "profileUpdateProcess.php", true);
    request.send(form);
}

function loadMainImage(id) {
    var image = document.getElementById("productImg" + id).src
    var main = document.getElementById("main_image");
    main.style.backgroundImage = "url(" + image + ")";
    main.style.opacity = 1;
}

function checkValue(qty) {
    var input = document.getElementById("qty_input");

    if (input.value <= 0) {
        alert("Quantity must be 1 or more");
        input.value = 1;
    } else if (input.value > qty) {
        alert("Maximum quantity achieved");
        input.value = qty;
    }
}

function addToCart(id) {
    var request = new XMLHttpRequest();

    request.onreadystatechange = function() {
        if (request.readyState == 4) {
            var text = request.responseText;
            if (text == "Added To Cart") {
                document.getElementById("toast-icon").classList = "bi bi-check-circle-fill fs-4 text-success justify-content-start";
                document.getElementById("toast-body").innerHTML = text;

                showToast();
            } else if (text == "Product Updated") {
                document.getElementById("toast-icon").classList = "bi bi-check-circle-fill fs-4 text-success justify-content-start";
                document.getElementById("toast-body").innerHTML = text;

                showToast();
            } else {
                document.getElementById("toast-icon").classList = "bi bi-x-circle-fill fs-4 text-warning justify-content-start";
                document.getElementById("toast-body").innerHTML = text;
                showToast();
            }
        }
    };

    request.open("GET", "addToCartProcess.php?id=" + id, true);
    request.send();
}

function deleteFormCart(id) {
    var request = new XMLHttpRequest();
    request.onreadystatechange = function() {
        if (request.readyState == 4) {
            var text = request.responseText;
            if (text == "Item removed") {
                document.getElementById("toast-icon").classList = "bi bi-check-circle-fill fs-4 text-success justify-content-start";
                document.getElementById("toast-body").innerHTML = text;

                showToast();
                window.location.reload();

            } else {
                document.getElementById("toast-icon").classList = "bi bi-x-circle-fill fs-4 text-warning justify-content-start";
                document.getElementById("toast-body").innerHTML = text;
                showToast();
            }
        }
    };
    request.open("GET", "deleteFromCartProcess.php?id=" + id, true);
    request.send();
}


function payNow(id) {
    var qty = document.getElementById("qty_input").value;

    var request = new XMLHttpRequest();

    request.onreadystatechange = function() {
        if (request.readyState == 4) {
            var text = request.responseText;

            var obj = JSON.parse(text);

            var mail = obj["mail"];
            var amount = obj["amount"];
            if (text == "1") {
                document.getElementById("toast-icon").classList = "bi bi-check-circle-fill fs-4 text-success justify-content-start";
                document.getElementById("toast-body").innerHTML = ("Please Log in or sign up");
                window.location = "index.php";
            } else if (text == "2") {
                document.getElementById("toast-icon").classList = "bi bi-check-circle-fill fs-4 text-success justify-content-start";
                document.getElementById("toast-body").innerHTML = ("Please update your profile first");
                window.location = "myProfile.php";
            } else {
                // Payment completed. It can be a successful failure.
                payhere.onCompleted = function onCompleted(orderId) {
                    console.log("Payment completed. OrderID:" + orderId);
                    saveInvoice(orderId, id, mail, amount, qty);
                    // Note: validate the payment and show success or failure page to the customer
                };

                // Payment window closed
                payhere.onDismissed = function onDismissed() {
                    // Note: Prompt user to pay again or show an error page
                    console.log("Payment dismissed");
                };

                // Error occurred
                payhere.onError = function onError(error) {
                    // Note: show an error page
                    console.log("Error:" + error);
                };

                // Put the payment variables here
                var payment = {
                    "sandbox": true,
                    "merchant_id": "1221946", // Replace your Merchant ID
                    "return_url": "http://localhost/eshop/singleProductView.php?id" + id, // Important
                    "cancel_url": "http://localhost/eshop/singleProductView.php?id" + id, // Important
                    "notify_url": "http://sample.com/notify",
                    "order_id": obj["id"],
                    "items": obj["item"],
                    "amount": amount,
                    "currency": "LKR",
                    "first_name": obj["fname"],
                    "last_name": obj["lname"],
                    "email": mail,
                    "phone": obj["mobile"],
                    "address": obj["address"],
                    "city": obj["city"],
                    "country": "Sri Lanka",
                    "delivery_address": obj["address"],
                    "delivery_city": obj["city"],
                    "delivery_country": "Sri Lanka",
                    "custom_1": "",
                    "custom_2": ""
                };

                // Show the payhere.js popup, when "PayHere Pay" is clicked
                // document.getElementById('payhere-payment').onclick = function(e) {
                payhere.startPayment(payment);
                // };
            }
        }
    };

    request.open("GET", "buyNowProcess.php?qty=" + qty + "&id=" + id, true);
    request.send();
}

function saveInvoice(orderId, id, mail, amount, qty) {
    var form = new FormData();
    form.append("orderId", orderId);
    form.append("productId", id);
    form.append("mail", mail);
    form.append("amount", amount);
    form.append("qty", qty);

    var request = new XMLHttpRequest();

    request.onreadystatechange = function() {
        if (request.readyState == 4) {
            var text = request.responseText;
            if (text == "1") {
                window.location = "invoice.php?id=" + orderId;
            } else {
                alert(text);
            }
        }
    };

    request.open("POST", "saveInvoice.php", true);
    request.send(form);
}

function printInvoice() {
    var body = document.body.innerHTML;
    var page = document.getElementById("page").innerHTML;
    document.body.innerHTML = page;
    window.print();
    document.body.innerHTML = body;
}