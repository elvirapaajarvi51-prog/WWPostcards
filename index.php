<?php
require_once 'assets/includes/header.php';
?>

<main>

  <head>
    <meta charset="UTF-8"> <!-- Anger teckenkodningen för dokumentet, i det här fallet UTF-8 som är standard och stöder de flesta tecken -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"> <!-- Bootstrap CSS för att använda dess klasser och komponenter -->
    <link rel="stylesheet" href="style.css"> <!-- Länk till vår egen CSS-fil för att anpassa stilen på sidan -->

  </head>

  <main>
    <?php
    // Checks if an action is set
    if (isset($_GET['action'])) {
      // Checks which action is set
      switch ($_GET['action']) {
        case 'empty':
          echo '
          <div class="container d-flex justify-content-center mt-3">
<div class="alert alert-warning w-50 text-center">
Du har inte angett någon e-postadress eller lösenord!
</div>
</div>
';
          break;
        case 'error':
          echo '
          <div class="container d-flex justify-content-center mt-3">
<div class="alert alert-danger w-50 text-center">
Du har angett felaktig e-postadress eller lösenord!
</div>
</div>


';
          break;
        case 'success':
          echo '
          <div class="container d-flex justify-content-center mt-3">
            <div class="alert alert-success w-50 text-center">
            Välkommen tillbaka!
            </div>
            </div>
            ';
          break;
      }
    }
    ?>

    <div class="container py-4"> <!-- container för att centrera innehållet och py-4 för padding top och bottom -->

      <!-- LOGO -->
      <img src="" alt="Logo" width="120" class="mb-3"> <!-- mb-3 för margin-bottom -->

      <!-- HERO = Det första man ser när man kommer till startsidan -->
      <div class="hero mb-5"> <!-- margin-bottom 5 för att få lite avstånd mellan hero och vykort -->

        <h1 class="Slogan"> Discover the world, one postcard at a time</h1> <!-- slogan -->

        <div class="map-container mt-4"> <!-- map-container för att positionera globen och pins -->
          <img src="https://uploads.onecompiler.io/442ssbwmc/44fzyrgz7/Jordglogen.png" class="globe" alt="Jordglob">

          <img src="https://uploads.onecompiler.io/442ssbwmc/44fzyrgz7/Pin.png" class="pin" alt="Pin">
          <img src="https://uploads.onecompiler.io/442ssbwmc/44fzyrgz7/Pin.png" class="pin2" alt="Pin">
          <img src="https://uploads.onecompiler.io/442ssbwmc/44fzyrgz7/Pin.png" width="50" class="pin3" alt="Pin">
          <img src="https://uploads.onecompiler.io/442ssbwmc/44fzyrgz7/Pin.png" width="50" class="pin4" alt="Pin">
        </div>

      </div>

      <!-- VYKORT -->
      <h4 class="mb-4">Nyinkomna Vykort</h4>

      <div class="row g-4"> <!-- g-4 för att få lite avstånd mellan korten -->
        <!-- Varje kort -->
        <div class="col-12 col-md-6"> <!-- col-12 för att korten ska ta hela bredden på små skärmar, col-md-6 för att de ska ta halva bredden på större skärmar -->
          <div class="card shadow-sm"> <!-- shadow-sm för att ge korten en liten skugga -->
            <img src="https://uploads.onecompiler.io/442ssbwmc/44fzyrgz7/Sk%C3%A4rmavbild%202026-03-17%20kl.%2010.45.36.png" class="card-img-top"> <!-- card-img-top för att bilden ska ta upp hela kortets bredd och placeras överst -->
            <div class="card-body text-center"> <!-- card-body för att ge kortet en standardiserad padding, text-center för att centrera texten -->
              <h6 class="card-title">Livets resa i Indonesien</h6> <!-- card-title för att ge titeln en standardiserad stil -->
              <p class="card-text">Mina favorit platser på Bali.</p> <!-- card-text för att ge texten en standardiserad stil -->

            </div>
          </div>
        </div>

        <div class="col-12 col-md-6">
          <div class="card shadow-sm">
            <img src="https://uploads.onecompiler.io/442ssbwmc/44fzyrgz7/Sk%C3%A4rmavbild%202026-03-17%20kl.%2011.40.39.png" class="card-img-top">
            <div class="card-body text-center">
              <h6 class="card-title">Min utbytestermin i Paris</h6>
              <p class="card-text">Smultronställen i Frankrike</p>
            </div>
          </div>
        </div>

        <div class="col-12 col-md-6">
          <div class="card shadow-sm">
            <img src="https://uploads.onecompiler.io/442ssbwmc/44fzyrgz7/Sk%C3%A4rmavbild%202026-03-17%20kl.%2011.43.04.png" class="card-img-top">
            <div class="card-body text-center">
              <h6 class="card-title">Backpackar i Sydamerika</h6>
              <p class="card-text">Tips på hikes i Brasilien.</p>
            </div>
          </div>
        </div>

        <div class="col-12 col-md-6">
          <div class="card shadow-sm">
            <img src="https://uploads.onecompiler.io/442ssbwmc/44fzyrgz7/Sk%C3%A4rmavbild%202026-03-17%20kl.%2011.44.18.png" class="card-img-top">
            <div class="card-body text-center">
              <h6 class="card-title">Roadtrip i USA</h6>
              <p class="card-text">Mina bästa stopp längs vägen.</p>
            </div>
          </div>
        </div>

      </div>

    </div>

  </main>


  <?php
  // Include footer
  require_once 'assets/includes/footer.php';
  ?>