<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">

    <!-- Responsive meta tag -->
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- CDN MDB / BOOTSTRAP / SLICK -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css?family=Muli:400,800&display=swap" rel="stylesheet">
    
    <!-- Police général -->
    <link href="https://fonts.googleapis.com/css2?family=Oswald:wght@300&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.gstatic.com">

    <!-- Mes feuiiles de style -->
    <link rel="stylesheet" href="assets/style.css">

    <!-- Titre de la page actuelle -->
    <title>PDO - Partie 1 - exercice <?= $id ?></title>


</head>

<body class="">

    <header>
        <div class="container-fluid">
            <div class="row justify-content-center mt-5">

                <nav id="navBar" class="navbar navbar-expand-md navbar-dark justify-content-md-between">
                    
                    <!-- toggler BTN -->
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarContent">
                        <span class="navbar-toggler-icon"></span>
                    </button>

                    <!-- NavItem -->
                    <div id="navbarContent" class="collapse navbar-collapse">
                        <ul class="navbar-nav d-md-flex justify-content-around">
                            <li class="nav-item"><a class="nav-link mx-2" href="index.php?id=1">Exercice 1</a></li>
                            <li class="nav-item"><a class="nav-link mx-2" href="index.php?id=2">Exercice 2</a></li>
                            <li class="nav-item"><a class="nav-link mx-2" href="index.php?id=3">Exercice 3</a></li>
                            <li class="nav-item"><a class="nav-link mx-2" href="index.php?id=4">Exercice 4</a></li>
                            <li class="nav-item"><a class="nav-link mx-2" href="index.php?id=5">Exercice 5</a></li>
                            <li class="nav-item"><a class="nav-link mx-2" href="index.php?id=6">Exercice 6</a></li>
                            <li class="nav-item"><a class="nav-link mx-2" href="index.php?id=7">Exercice 7</a></li>
                        </ul>
                    </div>
                    
                </nav>

            </div>
        </div>
    </header> 


    <!-- Start Main Content -->
    <div class="container">

        <!-- Start Main Row -->
        <div class="row justify-content-center text-center pt-3">

            <div class="col-12 text-left mb-2">Exercice <?= $id ?> :</div>
            <div class="col-12 text-left mb-3"><?= $exercices[$id - 1] ?></div>
            <!-- <div class="col-2 text-right py-0">Info database</div> -->
            <div class="col-10 text-left py-0 pl-3 mb-4" style="color:<?= !empty($error) ? 'red' : 'green' ?>"><?= !empty($error) ? $error : $msg ?></div>
