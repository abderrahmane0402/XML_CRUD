<?php

include_once '../load.php';
use BaseXClient\BaseXException;
use BaseXClient\Session;

try {
    $session = new Session("localhost", 1984, "admin", "admin");

    // perform command and print returned string
    $session->execute("OPEN database");

    $query = $session->query("//Specialites/Specialite/libelle/text()");
    $query2 = $session->query("//Specialites/Specialite/@ID_Specialite");
    foreach ($query as $key => $value) {
        $specialite[$key] = $value;
    }
    foreach ($query2 as $key => $value) {
        if (preg_match('/"([^"]+)"/', $value, $matches)) {
            $id = $matches[1];
        }
        $specialites[$id] = $specialite[$key];
    }

    $query = $session->query("//Concours/Concour/NomConcours/text()");
    $query2 = $session->query("//Concours/Concour/@ID_Concours");
    foreach ($query as $key => $value) {
        $concour[$key] = $value;
    }
    foreach ($query2 as $key => $value) {
        if (preg_match('/"([^"]+)"/', $value, $matches)) {
            $id = $matches[1];
        }
        $concours[$id] = $concour[$key];
    }

    // close session
    $session->close();


    // print time needed
} catch (BaseXException $e) {
    // print exception
    print $e->getMessage();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="apple-touch-icon" sizes="76x76" href="../assets/img/apple-icon.png">
    <link rel="icon" type="image/png" href="../assets/img/favicon.png">
    <title>
        Material Dashboard 2 by Creative Tim
    </title>
    <!--     Fonts and icons     -->
    <link rel="stylesheet" type="text/css"
        href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700,900|Roboto+Slab:400,700" />
    <!-- Nucleo Icons -->
    <link href="../assets/css/nucleo-icons.css" rel="stylesheet" />
    <link href="../assets/css/nucleo-svg.css" rel="stylesheet" />
    <!-- Font Awesome Icons -->
    <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
    <!-- Material Icons -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Round" rel="stylesheet">
    <!-- CSS Files -->
    <link id="pagestyle" href="../assets/css/material-dashboard.css?v=3.1.0" rel="stylesheet" />
    <!-- Nepcha Analytics (nepcha.com) -->
    <!-- Nepcha is a easy-to-use web analytics. No cookies and fully compliant with GDPR, CCPA and PECR. -->
    <script defer data-site="YOUR_DOMAIN_HERE" src="https://api.nepcha.com/js/nepcha-analytics.js"></script>
</head>

<body class="g-sidenav-show  bg-gray-200">
    <aside
        class="sidenav navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-3   bg-gradient-dark"
        id="sidenav-main">
        <div class="sidenav-header">
            <i class="fas fa-times p-3 cursor-pointer text-white opacity-5 position-absolute end-0 top-0 d-none d-xl-none"
                aria-hidden="true" id="iconSidenav"></i>
            <a class="navbar-brand m-0" href=" https://demos.creative-tim.com/material-dashboard/pages/dashboard "
                target="_blank">
                <img src="../assets/img/logo-ct.png" class="navbar-brand-img h-100" alt="main_logo">
                <span class="ms-1 font-weight-bold text-white">INSCRIPTION LP</span>
            </a>
        </div>
        <hr class="horizontal light mt-0 mb-2">
        <div class="collapse navbar-collapse  w-auto " id="sidenav-collapse-main">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link text-white active  " href="../pages/PageAjout.php">
                        <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="material-icons opacity-10">dashboard</i>
                        </div>
                        <span class="nav-link-text ms-1">Inscrire</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white " href="../pages/ListCandidats.php">
                        <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="material-icons opacity-10">table_view</i>
                        </div>
                        <scpan class="nav-link-text ms-1">Liste des Condidats</scpan>
                    </a>
                </li>
            </ul>
        </div>
    </aside>
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
        <!-- Navbar -->
        <nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl" id="navbarBlur"
            data-scroll="true">
            <div class="container-fluid py-1 px-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
                        <li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark" href="javascript:;">Pages</a>
                        </li>
                        <li class="breadcrumb-item text-sm text-dark active" aria-current="page">Ajout</li>
                    </ol>
                    <h6 class="font-weight-bolder mb-0">Page d'ajout des information de condidat</h6>
                </nav>
            </div>
        </nav>
        <div class="container-fluid py-4">
            <div class="card">
                <div class="card-header p-3 pt-2">
                    <div class="text-start pt-1">
                        <p class="text-lg mb-0 text-capitalize">Information Personnel</p>
                    </div>
                </div>
                <hr class="dark horizontal my-0">
                <div class="card-footer p-3">
                    <form action="../actions/ajout.php" method="post" role="form">
                        <div class="row">
                            <div class="col-xl-6">
                                <div class="input-group input-group-outline mb-3">
                                    <label class="form-label">Nom</label>
                                    <input name="nom" type="text" class="form-control">
                                </div>
                            </div>

                            <div class="col-xl-6">
                                <div class="input-group input-group-outline mb-3">
                                    <label class="form-label">Prenom</label>
                                    <input name="prenom" type="text" class="form-control">
                                </div>
                            </div>

                            <div class="col-xl-6">
                                <div class="input-group input-group-outline mb-3">
                                    <label class="form-label">Telephone</label>
                                    <input name="telephone" type="tel" class="form-control">
                                </div>
                            </div>

                            <div class="col-xl-6">
                                <div class="input-group input-group-outline mb-3">
                                    <input name="date_n" type="date" class="form-control">
                                </div>
                            </div>

                            <div class="col-xl-6">
                                <div class="input-group input-group-outline mb-3">
                                    <label class="form-label">CIN</label>
                                    <input name="cin" type="text" class="form-control">
                                </div>
                            </div>

                            <div class="col-xl-6">
                                <div class="input-group input-group-outline mb-3">
                                    <label class="form-label">CNE</label>
                                    <input name="cne" type="text" class="form-control">
                                </div>
                            </div>

                            <div class="col-xl-6">
                                <div class="input-group input-group-outline mb-3">
                                    <label class="form-label">Email</label>
                                    <input name="email" type="email" class="form-control">
                                </div>
                            </div>

                            <div class="col-xl-6">
                                <div class="input-group input-group-outline mb-3">
                                    <label class="form-label">Password</label>
                                    <input name="password" type="password" class="form-control">
                                </div>
                            </div>
                        </div>
                        <div class='row mb-3'>
                            <div class="card-header p-3 pt-2">
                                <div class="text-start pt-1">
                                    <p class="text-lg mb-0 text-capitalize">information sur le diplome</p>
                                </div>
                            </div>
                            <hr class="dark horizontal my-0">
                        </div>
                        <div class="row">
                            <div class="col-xl-6">
                                <div class="input-group input-group-outline mb-3">
                                    <label class="form-label">Annee d'option</label>
                                    <input name="anne" type="number" class="form-control">
                                </div>
                            </div>

                            <div class="col-xl-6">
                                <div class="input-group input-group-outline mb-4">
                                    <select name="specialite" aria-placeholder="specialite" class="form-control"
                                        id="exampleFormControlSelect1">
                                        <option value="0">Specialite</option>
                                        <?php foreach ($specialites as $key => $value) { ?>
                                            <option value="<?= $key ?>">
                                                <?= $value ?>
                                            </option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class='row mb-3'>
                            <div class="card-header p-3 pt-2">
                                <div class="text-start pt-1">
                                    <p class="text-lg mb-0 text-capitalize">Condidature</p>
                                </div>
                            </div>
                            <hr class="dark horizontal my-0">
                        </div>
                        <div class="input-group input-group-static">
                            <label for="exampleFormControlSelect2" class="ms-0">Example multiple select</label>
                            <select multiple="" class="form-control pb-4" id="exampleFormControlSelect2"
                                name="concours[]">
                                <?php foreach ($concours as $key => $value) { ?>
                                    <option value="<?= $key ?>">
                                        <?= $value ?>
                                    </option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="row">
                            <div class="text-center">
                                <button type="submit"
                                    class="btn btn-lg bg-gradient-primary btn-lg w-100 mt-4 mb-0">Enregistrer</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- End Navbar -->
        <div class="container-fluid py-4">
            <footer class="footer py-4  ">
                <div class="container-fluid">
                    <div class="row align-items-center justify-content-lg-between">
                        <div class="col-lg-6 mb-lg-0 mb-4">
                            <div class="copyright text-center text-sm text-muted text-lg-start">
                                ©
                                <script>
                                    document.write(new Date().getFullYear())
                                </script>,
                                made with <i class="fa fa-heart"></i> by
                                <a href="https://www.creative-tim.com" class="font-weight-bold" target="_blank">Creative
                                    Tim</a>
                                for a better web.
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <ul class="nav nav-footer justify-content-center justify-content-lg-end">
                                <li class="nav-item">
                                    <a href="https://www.creative-tim.com" class="nav-link text-muted"
                                        target="_blank">Creative Tim</a>
                                </li>
                                <li class="nav-item">
                                    <a href="https://www.creative-tim.com/presentation" class="nav-link text-muted"
                                        target="_blank">About
                                        Us</a>
                                </li>
                                <li class="nav-item">
                                    <a href="https://www.creative-tim.com/blog" class="nav-link text-muted"
                                        target="_blank">Blog</a>
                                </li>
                                <li class="nav-item">
                                    <a href="https://www.creative-tim.com/license" class="nav-link pe-0 text-muted"
                                        target="_blank">License</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </footer>
        </div>
    </main>
    <!--   Core JS Files   -->
    <script src="../assets/js/core/popper.min.js"></script>
    <script src="../assets/js/core/bootstrap.min.js"></script>
    <script src="../assets/js/plugins/perfect-scrollbar.min.js"></script>
    <script src="../assets/js/plugins/smooth-scrollbar.min.js"></script>
    <script>
        var win = navigator.platform.indexOf('Win') > -1;
        if (win && document.querySelector('#sidenav-scrollbar')) {
            var options = {
                damping: '0.5'
            }
            Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
        }
    </script>
    <!-- Github buttons -->
    <script async defer src="https://buttons.github.io/buttons.js"></script>
    <!-- Control Center for Material Dashboard: parallax effects, scripts for the example pages etc -->
    <script src="../assets/js/material-dashboard.min.js?v=3.1.0"></script>
</body>

</html>