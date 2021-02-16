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
    <title><?= (!empty($ctrl)) ? $title_page[$ctrl] : 'Accueil' ?></title>


</head>

<body class="h-100">

    <header>
        <div class="container-fluid">
            <div class="row justify-content-center">

                <nav id="navBar" class="navbar navbar-expand-md navbar-dark pl-5">

                    <a class="navbar-brand" href="index.php"><img id="hospitalLogo" src="assets/img/logoHospital.png" alt="icon retour accueil"></a>

                    <!-- toggler BTN -->
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarContent">
                        <span class="navbar-toggler-icon"></span>
                    </button>

                    <!-- NavItem -->
                    <div id="navbarContent" class="collapse navbar-collapse justify-content-end pr-5">

                        <ul class="navbar-nav">
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle txt1" id="patientItem" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Patient</a>
                                <div class="dropdown-menu " aria-labellphp="patientItem">
                                    <a class="dropdown-item" href="index.php?ctrl=1">Ajouter patient</a>
                                    <a class="dropdown-item" href="index.php?ctrl=2">Liste des patients</a>
                                </div>
                            </li>
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle txt1" id="appointmentItem" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Rendez-vous</a>
                                <div class="dropdown-menu " aria-labellphp="appointmentItem">
                                    <a class="dropdown-item" href="index.php?ctrl=5">Ajouter rendez-vous</a>
                                    <a class="dropdown-item" href="index.php?ctrl=6">Liste des rendez-vous</a>
                                </div>
                            </li>
                            
                        </ul>
                    </div>
                    
                </nav>

            </div>
        </div>
    </header> 


    <!-- Start Main Content -->
    <div class="container-fluid h-100">

        

            
