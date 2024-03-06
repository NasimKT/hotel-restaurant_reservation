<!doctype html>
<html class="no-js" lang="zxx">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Restob</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- <link rel="manifest" href="site.webmanifest"> -->
    <link rel="shortcut icon" type="image/x-icon" href="img/favicon.png">
    <!-- Place favicon.ico in the root directory -->

    <!-- CSS here -->
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/owl.carousel.min.css">
    <link rel="stylesheet" href="css/magnific-popup.css">
    <link rel="stylesheet" href="css/font-awesome.min.css">
    <link rel="stylesheet" href="css/themify-icons.css">
    <link rel="stylesheet" href="css/nice-select.css">
    <link rel="stylesheet" href="css/flaticon.css">
    <link rel="stylesheet" href="css/gijgo.css">
    <link rel="stylesheet" href="css/animate.css">
    <link rel="stylesheet" href="css/slicknav.css">
    <link rel="stylesheet" href="css/style.css">

    <!-- <link rel="stylesheet" href="css/responsive.css"> -->
    <style>
        .popup {
            display: none;
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            background-color: #fefefe;
            padding: 20px;
            border: 1px solid #888;
            z-index: 1000;
        }

        .popup-content {
            text-align: center;
        }

        .close {
            position: absolute;
            top: 5px;
            right: 10px;
            font-size: 20px;
            cursor: pointer;
        }
        .spacer {
            height: 50px;
            /* Adjust height as needed */
        }

        .container {
            display: flex;
            flex-direction: row;
            animation: slideIn 1s ease-in-out;
            /* Animation for the image */
            transition: transform 0.3s ease-in-out;
            /* Transition for the hover effect */
        }

        .image {
            flex: 0 0 auto;
            width: 200px;
            /* Adjust the width of the image as needed */

        }

        .container:hover {
            transform: scale(1.1);
            /* Increase the size of the image on hover */
        }

        .content {
            flex: 1;
            padding-left: 20px;
            /* Adjust spacing between image and content */
        }

        @keyframes slideIn {
            from {
                transform: translateX(-100%);
                opacity: 0;
            }

            to {
                transform: translateX(0);
                opacity: 1;
            }
        }
    </style>
</head>

<body>
    <!--[if lte IE 9]>
            <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="https://browsehappy.com/">upgrade your browser</a> to improve your experience and security.</p>
        <![endif]-->

    <!-- header-start -->
    <header>
        <div class="header-area ">
            <div id="sticky-header" class="main-header-area">
                <div class="container-fluid p-0">
                    <div class="row align-items-center no-gutters">
                        <div class="col-xl-5 col-lg-6">
                            <div class="main-menu  d-none d-lg-block">
                                <nav>
                                    <ul id="navigation">
                                        <li><a href="index.php">home</a></li>
                                        <li><a class="active" href="rooms.php">Hotel</a></li>
                                        <li><a href="table.php">Restaurant</i></a>
                                    </ul>
                                </nav>
                            </div>
                        </div>
                        <div class="col-xl-2 col-lg-2">
                            <div class="logo-img">
                                <a href="index.php">
                                    <img src="img/360_F_568383056_PDGaD3j4QFS0OYuFocHb0tdHwNe2jhrJ-removebg-preview.png" alt="" style="width: 100px; height: auto;">

                                </a>
                            </div>
                        </div>
                        <div class="col-xl-5 col-lg-4 d-none d-lg-block">
                            <div class="book_room">
                                <div class="book_btn d-none d-lg-block">
                                    <a href="./hotelbooking/hotel.php"> Hotel Room</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="mobile_menu d-block d-lg-none"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <!-- header-end -->

    <!-- bradcam_area_start -->
    <div class="bradcam_area breadcam_bg_1">
        <h3>Luxurious Restaurant</h3>
    </div>
    <!-- bradcam_area_end -->

    <!-- Add a spacer -->
    <div class="spacer"></div>

    <!-- Container for image and content -->
    <?php
    include("db.php");
    $query = "SELECT * FROM hotel where verified = 1";
    $result = mysqli_query($conn, $query);
    if ($result) {
        while ($row = mysqli_fetch_assoc($result)) {
            echo '
            <div class="container data">
                <div class="image">
                    <img src="uploads/' . $row['image'] . '" alt="Room Image" style="width: 100%; height: 100%;">
                </div>
                <div class="content">
                    <h2>' . $row['name'] . '</h2>
                    <p>' . $row['about'] . '</p>
                    <button class="btn btn-primary" id="openPopup">Details</button>
                </div>
            </div>
            <div id="popup" class="popup">
                <div class="popup-content">
                    <span class="close btn-close">&times;</span>
                    <h2 class="modal-title">' . $row['name'] . '</h2>
                    <div class="modal-body">
                    <p>' . $row['about'] . '</p>
                    <p>Food Facility:' . ($row["verified"] ? "Available" : "Not Available") . '</p>
                    </div>
                </div>
            </div>
        ';
        }
    } else {
        echo 'Failed to fetch options from the database.';
    }
    ?>

    <!-- offers_area_end -->

    <!-- features_room_startt -->

    <!-- forQuery_end-->

    <!-- instragram_area_start -->


    <!-- JS here -->
    <script>
        document.getElementById("openPopup").addEventListener("click", function() {
            document.getElementById("popup").style.display = "block";
        });

        document.querySelector(".close").addEventListener("click", function() {
            document.getElementById("popup").style.display = "none";
        });
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <script src="js/vendor/modernizr-3.5.0.min.js"></script>
    <script src="js/vendor/jquery-1.12.4.min.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/owl.carousel.min.js"></script>
    <script src="js/isotope.pkgd.min.js"></script>
    <script src="js/ajax-form.js"></script>
    <script src="js/waypoints.min.js"></script>
    <script src="js/jquery.counterup.min.js"></script>
    <script src="js/imagesloaded.pkgd.min.js"></script>
    <script src="js/scrollIt.js"></script>
    <script src="js/jquery.scrollUp.min.js"></script>
    <script src="js/wow.min.js"></script>
    <script src="js/nice-select.min.js"></script>
    <script src="js/jquery.slicknav.min.js"></script>
    <script src="js/jquery.magnific-popup.min.js"></script>
    <script src="js/plugins.js"></script>
    <script src="js/gijgo.min.js"></script>

    <!--contact js-->
    <script src="js/contact.js"></script>
    <script src="js/jquery.ajaxchimp.min.js"></script>
    <script src="js/jquery.form.js"></script>
    <script src="js/jquery.validate.min.js"></script>
    <script src="js/mail-script.js"></script>

    <script src="js/main.js"></script>
    <script>
        $('#datepicker').datepicker({
            iconsLibrary: 'fontawesome',
            icons: {
                rightIcon: '<span class="fa fa-caret-down"></span>'
            }
        });
        $('#datepicker2').datepicker({
            iconsLibrary: 'fontawesome',
            icons: {
                rightIcon: '<span class="fa fa-caret-down"></span>'
            }

        });
        let book =document.getElementById('hotelbook');
        book.addEventListener('click',function(){
            window.location.href('./hotelbooking/hotel.php');
        });
    </script>



</body>

</html>