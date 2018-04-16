<?php

$city = !empty($_GET['city']) ? $_GET['city'] : 'Paris'; // variable to get the right city/country 

$urlForecast = 'https://api.weatherbit.io/v2.0/forecast/daily?city='.$city.'&key=21202e9f1aea4bc5ab980d8bcd94e847';
$pathForecast = './cache/'.md5($urlForecast);

// Loop to make the API work and creation of the variable we're gonna use all along for the Abalin API to recover the date
if(file_exists($pathForecast) && time() - filemtime($pathForecast) < 10)
{
    $forecast = json_decode(file_get_contents($pathForecast));
}
else
{
    $forecast = json_decode(file_get_contents($urlForecast));
    file_put_contents($pathForecast, json_encode($forecast));
}

$forecast5Days = array_slice($forecast->data, 0, 5); // Get only the five first days

// Function to recover several times the infomration of the day we want 
function getEpiphanyDay($day)
{
    $dateMonth =  date('m', $day->ts); // variable to recover the month 
    $dateDay = date('d', $day->ts); // variable to recover the day
    $urlNameDay = 'https://api.abalin.net/namedays?day='.$dateDay.'&month='.$dateMonth.'&country=fr'; // Initialization of the Abalin API
    $pathNameDay = './cache/'.md5($urlNameDay);
    
    // Loop to make the API work and creation of the variable we're gonna use all along for the Abalin API to recover the date
    if(file_exists($pathNameDay) && time() - filemtime($pathNameDay) < 10)
    {
        $nameDay = json_decode(file_get_contents($pathNameDay));
    }
    else
    {
        $nameDay = json_decode(file_get_contents($urlNameDay));
        file_put_contents($pathNameDay, json_encode($nameDay));
    }

    // Path to the right epiphany in France
    $epiphany = $nameDay->data->name_fr;
    return $epiphany;
}
?>


 <!DOCTYPE>
    <html lang="fr">

    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>SuperWeather Épiphanies</title>
        <link rel="stylesheet" href="styles/rest.css">
        <link href="https://fonts.googleapis.com/css?family=Montserrat|Montserrat+Alternates|Cabin" rel="stylesheet">
        <link rel="icon" type="image" href="images/favicon.png" /> <!-- Favicon -->

    </head>

    <body>

        <div class="container">

            <header>
                <!-- LOGO -->
                <div class="logo">
                     <a href="index.php"><img src="images/logo.png" /></a>
                </div>

                <nav class="header">
                    <!-- MENU -->
                    <ul class="menu">
                        <li>
                            <a href="index.php">Accueil</a>
                        </li>
                        <li>
                            <a href="epiphanies.php">Épiphanies</a>
                        </li>
                        <li>
                            <a href="credits.html">Credits</a>
                        </li>
                    </ul>
                </nav>

            </header>


            <h1>L'Épiphanie du jour</h1>

            <div class="todayEpiphany">
                <?php
                     $epiphNameDay = getEpiphanyDay($forecast5Days[0]); // Recover the ephiphany of today
                 ?>
            
                 <p class="dateEpi"><?= date('d/m/Y', $forecast5Days[0]->ts); ?></p> <!-- Date of the day -->
                 <p class="nameEpi"><?= $epiphNameDay; ?></p> <!-- Epiphany display of the day -->
            </div>

            <h2>Les Épiphanies de la semaine</h2>

            <div class="forecastEpiphany">
                <?php

                // Recover the epiphany of the next days 
                for($i = 0 ; $i < count($forecast5Days) ; $i++){ 

                    $epiphNameDay = getEpiphanyDay($forecast5Days[$i]); 
            
                 ?>

                 <p class="dateEpi"><?= date('d/m/Y', $forecast5Days[$i]->ts); ?></p> <!-- Date of the next days -->
                 <p class="nameEpi"><?= $epiphNameDay; ?></p> <!-- Epiphany display of the next days -->

                 <?php
                 }
                 ?>

            </div>

    </body>

    </html>