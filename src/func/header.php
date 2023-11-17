<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="./assets/phone.png" type="image/x-icon">
    <title>Lunar Delights</title>

    <!-- Bootstrap CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">

    <!-- Owl-carousel CDN -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css"
        integrity="sha256-UhQQ4fxEeABh4JrcmAJ1+16id/1dnlOEVCFOxDef9Lw=" crossorigin="anonymous" />
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css"
        integrity="sha256-kksNxjDRxd/5+jGurZUJd1sdR2v+ClrCl3svESBaJqw=" crossorigin="anonymous" />

    <!-- font awesome icons -->
    <script src="https://kit.fontawesome.com/7860568151.js" crossorigin="anonymous"></script>

    <!-- form validate -->
    <link rel="stylesheet" href="https://ltp.crfnetwork.cyou/form-validate/css/style.css">

    <!-- Custom CSS file -->
    <link rel="stylesheet" href="css/style.css">

</head>

<body>
    <div class="form-check form-switch ms-auto mt-3 me-3" id="formSwitch">
        <label class="form-check-label ms-3" for="inputSwicher">
            <i class="fas fa-sun light-mode"></i>
            <i class="fas fa-moon dark-mode d-none"></i>
        </label>
        <input class="form-check-input" type="checkbox" id="inputSwicher" />
    </div>
    <span id="top"></span>
    <a class="scroll-up" href="#top"><i class="fas fa-chevron-up"></i></a>
    <!-- start #header -->
    <header id="header">
        

        <!-- Primary Navigation -->
        <nav class="navbar navbar-expand-lg px-3 navbar-dark color-second-bg">
            <img src="./assets/logo.png" class="logo">
            <a class="navbar-brand" href="./index.php">Lunar Delights</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item active">
                        <a class="nav-link" href="./index.php">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="./index.php#special-price">Special Price</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="./index.php#new-mooncakes">New Mooncakes</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="./index.php#blogs">Blogs</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="./cart.php">Cart</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="./faq.php">FAQ</a>
                    </li>
                </ul>
                
                <form action="#" class="font-size-18 ms-auto">
                    <ul class="navbar-nav ms-auto">
                        <li class="nav-item">
                                <?php 
                                if ($_SESSION['logged'] == 1) {
                                    if ($_SESSION['role'] === 'Admin') {
                                
                                        echo '<a href="./admin.php" class="px-3 nav-link">';
                                        $user = $acc->getAccount($_SESSION['userid'], 'admin');
                                    }
                                    else {
                                        echo '<a href="./login.php" class="px-3 nav-link">';
                                        $user = $acc->getAccount($_SESSION['userid'], 'users');
                                    }
                                    print $user['Username'];
                                } 
                                else 
                                {
                                    echo '<a href="./login.php" class="px-3 nav-link">';
                                    echo "Login";
                                } 
                                ?>
                            </a>
                        </li>
                        <!-- Removing the registration option if logged in -->
                        <?php
                            if ($_SESSION['logged'] == false) {
                                echo "<li class='nav-item'><a href='./register.php' class='px-3 nav-link'> Register</a></li>";
                            }
                            if ($_SESSION['logged'] == true) {
                                if ($_SESSION['role'] == 'Admin') {
                                    echo "<li class='nav-item'><a href='./account.php' class='px-3 nav-item nav-link'>Account</a></li>";
                                }
                            }
                            if ($_SESSION['logged'] == true) {
                                if ($_SESSION['role'] == 'Admin') {
                                    echo "<li class='nav-item'><a href='./manage.php' class='px-3 nav-item nav-link'>Manage</a></li>";
                                }
                            }
                        ?>
                        <li class="nav-item">
                            <a href="./cart.php" class="d-flex align-items-center rounded-pill bg-primary">
                                <span class="font-size-14 px-2 py-2 text-white">
                                    <i class="fas fa-shopping-cart" aria-hidden="true"></i>
                                </span>
                                <div class="px-3 py-2 font-size-14 rounded-pill text-black bg-white">0</div>
                            </a>
                        </li>
                    </ul>
                </form>
            </div>
        </nav>
        <!-- !Primary Navigation -->

    </header>
    <!-- !stop #header -->