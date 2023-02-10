<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="public/css/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Homemade+Apple&family=Lato:wght@300;400;700&display=swap" rel="stylesheet">
    <title>Accueil | Pub G4</title>
</head>

<body>

    <header>
        <a href="#a-propos">À PROPOS</a>
        <a href="#menu">MENU</a>
        <a href="index">
            <img src="public/images/logo.png" alt="Logo Pub G4" height="120">
        </a>
        <a href="contact">CONTACT</a>
        <a href="#" class="reservez liveToastBtn">RÉSERVEZ</a>
    </header>
    
    <!-- Toast des boutons "RÉSERVEZ" -->
    <div class="toast-container position-fixed bottom-0 end-0 p-3">
        <div id="liveToast" class="toast" role="alert" aria-live="assertive" aria-atomic="true">
            <div class="toast-header">
                <img src="public/images/logo.png" class="rounded me-2" alt="..." height="20">
                <strong class="me-auto">PUB G4</strong>
                <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
            <div class="toast-body">
                Pour effectuer une réservation, veuillez communiquer avec nous au (450) 436-1531.
            </div>
        </div>
    </div>