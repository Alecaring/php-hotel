<?php
$hotels = [

    [
        'name' => 'Hotel Belvedere',
        'img' => 'h1',
        'description' => "Benvenuti all'Hotel Belvedere, un'oasi di lusso e comfort situata nel cuore di una delle destinazioni più affascinanti del mondo. Con una vista mozzafiato e un servizio impeccabile, l'Hotel Belvedere è il luogo ideale per una vacanza indimenticabile.",
        'parking' => true,
        'vote' => "4.0",
        'distance_to_center' => 10.4
    ],
    [
        'name' => 'Hotel Futuro',
        'img' => 'h2',
        'description' => "Benvenuti all'Hotel Futuro, un gioiello moderno di design e tecnologia avanzata, situato nel cuore della città. Qui, il futuro incontra l'ospitalità, offrendo un'esperienza di soggiorno che unisce comfort, innovazione e sostenibilità.",
        'parking' => true,
        'vote' => "2.0",
        'distance_to_center' => 2
    ],
    [
        'name' => 'Hotel Rivamare',
        'img' => 'h3',
        'description' => "Benvenuti all'Hotel Rivamare, un angolo di paradiso situato direttamente sulla costa, dove il mare cristallino incontra l'ospitalità di lusso. Con panorami mozzafiato e servizi di alta classe, l'Hotel Rivamare è la destinazione perfetta per chi cerca relax e raffinatezza.",
        'parking' => false,
        'vote' => "1.0",
        'distance_to_center' => 1
    ],
    [
        'name' => 'Hotel Bellavista',
        'img' => 'h1',
        'description' => "Benvenuti all'Hotel Bellavista, un luogo incantevole dove il lusso incontra la serenità delle viste panoramiche mozzafiato. Situato in una posizione privilegiata, l'Hotel Bellavista è la scelta ideale per chi cerca un rifugio di pace e raffinatezza immerso nella natura.",
        'parking' => false,
        'vote' => "5.0",
        'distance_to_center' => 5.5
    ],
    [
        'name' => 'Hotel Milano',
        'img' => 'h1',
        'description' => "Benvenuti all'Hotel Milano, un'oasi di eleganza e comfort situata nel cuore della vibrante città di Milano. Con il suo design contemporaneo e servizi di alta classe, l'Hotel Milano è la scelta ideale per chi desidera esplorare il meglio della moda, della cultura e della cucina italiana.",
        'parking' => true,
        'vote' => "2.0",
        'distance_to_center' => 50
    ],

];
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="css/index.css">
  <title>Document</title>
  
</head>
<body>
<div class="sidebar">
  <h1 class="titleFilter">Filtra Hotel</h1>
  <form method="get" action="">
    <label class="label" for="parking">Disponibilità Parcheggio:</label><br>

    <ul class="ul">
        <li class="li">

            <input type="radio" id="parking" name="parking" value="">
            <span>Tutti</span>

        </li>
        <li class="li">

            <input type="radio" id="parking" name="parking" value="1" <?php if(isset($_GET['parking']) && $_GET['parking'] == '1') echo 'selected'; ?>>
            <span>Parchrggio disponibile</span>

        </li>
        <li class="li">

            <input type="radio" id="parking" name="parking" value="0" <?php if(isset($_GET['parking']) && $_GET['parking'] == '0') echo 'selected'; ?>>
            <span>Parcheggio non disponibile</span>

        </li>
    </ul>

    
   


    <label for="vote">Voto Minimo:</label>
    <input type="number" id="vote" name="vote" min="1" max="5" value="<?php echo isset($_GET['vote']) ? $_GET['vote'] : ''; ?>"><br><br>
    <button class="btn" type="submit">Filtra</button>
  </form>
</div>

<div class="container">
  <?php
  $filteredHotels = $hotels;

  if (isset($_GET['parking']) && $_GET['parking'] !== '') {
      $filteredHotels = array_filter($filteredHotels, function($hotel) {
          return $hotel['parking'] == (bool)$_GET['parking'];
      });
  }

  if (isset($_GET['vote']) && $_GET['vote'] !== '') {
      $filteredHotels = array_filter($filteredHotels, function($hotel) {
          return $hotel['vote'] >= $_GET['vote'];
      });
  }

  if (empty($filteredHotels)) {
      echo "<p>Nessun hotel trovato con i filtri applicati.</p>";
  } else {
      foreach ($filteredHotels as $hotel) {
          echo "<div class='containerCard'>";
          echo "<div class='nameHotel'><h2 class='title'>{$hotel['name']}</h2><img src='img/{$hotel['img']}.webp' alt='{$hotel['name']}'></div>";
          echo "<div class='containerSpan'>";
          echo "<div class='containerPark'>";
          if ($hotel['parking'] === true) {
              echo "<span class='iconSpan'><svg xmlns='http://www.w3.org/2000/svg' width='100%' height='100%' fill='currentColor' class='bi bi-p-circle-fill' viewBox='0 0 16 16'><path d='M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0M5.5 4.002V12h1.283V9.164h1.668C10.033 9.164 11 8.08 11 6.586c0-1.482-.955-2.584-2.538-2.584zm2.77 4.072c.893 0 1.419-.545 1.419-1.488s-.526-1.482-1.42-1.482H6.778v2.97z'/></svg></span>";
          } else {
              echo "<span class='iconSpan'><svg xmlns='http://www.w3.org/2000/svg' width='100%' height='100%' fill='currentColor' class='bi bi-sign-no-parking-fill' viewBox='0 0 16 16'><path d='M13.292 14A8 8 0 0 1 2 2.707l3.5 3.5V12h1.283V9.164h1.674zm.708-.708-4.37-4.37C10.5 8.524 11 7.662 11 6.587c0-1.482-.955-2.584-2.538-2.584H5.5v.79L2.708 2.002A8 8 0 0 1 14 13.293Z'/><path d='M6.777 7.485v.59h.59zm1.949.535L6.777 6.07v-.966H8.27c.893 0 1.419.539 1.419 1.482 0 .769-.35 1.273-.963 1.433Z'/></svg></span>";
          }
          echo "</div>";

          echo "<div class='ContainerStars'><span class='txtVote'>{$hotel['vote']}</span><div class='contInnerStars'>";
          $rating = $hotel['vote'];
          for ($i = 1; $i <= 5; $i++) {
              if ($i <= $rating) {
                  if ($rating >= 3) {
                      echo "<span class='green iconStars'><svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-star-fill' viewBox='0 0 16 16'><path d='M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z'/></svg></span>";
                  } else {
                      echo "<span class='orange iconStars'><svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-star-fill' viewBox='0 0 16 16'><path d='M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z'/></svg></span>";
                  }
              } else {
                  echo "<span class='iconStars'><svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-star' viewBox='0 0 16 16'><path d='M2.866 14.85c-.078.444.36.791.746.593l4.39-2.256 4.389 2.256c.386.198.824-.149.746-.592l-.83-4.73 3.522-3.356c.33-.314.16-.888-.282-.95l-4.898-.696L8.465.792a.513.513 0 0 0-.927 0L5.354 5.12l-4.898.696c-.441.062-.612.636-.283.95l3.523 3.356-.83 4.73zm4.905-2.767-3.686 1.894.694-3.957a.56.56 0 0 0-.163-.505L1.71 6.745l4.052-.576a.53.53 0 0 0 .393-.288L8 2.223l1.847 3.658a.53.53 0 0 0 .393.288l4.052.575-2.906 2.77a.56.56 0 0 0-.163.506l.694 3.957-3.686-1.894a.5.5 0 0 0-.461 0z'/></svg></span>";
              }
          }
          echo "</div></div>";
          echo "<span class='iconSpankm'>{$hotel['distance_to_center']} km</span>";
          echo "</div>";

          echo "<div class='containerDescription'>";
          echo "<p>{$hotel['description']}</p>";
          echo "</div>";
          echo "</div>";
      }
  }
  ?>
</div>
</body>
</html>
