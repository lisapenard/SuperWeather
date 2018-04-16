<?php

// Redirection towards the include.php file that contents most of the PHP
include('include.php');

?>


<!DOCTYPE>

<html lang="fr">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>SuperWeather</title>
    <link rel="stylesheet" href="styles/css.css" media="screen">
    <link href="https://fonts.googleapis.com/css?family=Montserrat|Montserrat+Alternates|Cabin" rel="stylesheet">
    <link rel="icon" type="image" href="images/favicon.png" /> <!-- Favicon -->

</head>

<body>


    <div class="container">

        <header>
            <!-- LOGO -->
            <div class="logo">
                <a href="index.php">
                    <img src="images/logo.png" />
                </a>
            </div>

            <!-- MENU -->
            <nav class="header" id="navigation" role="navigation">
            <label for="toggle-nav" class="nav-button"></label>
            <div class="nav-inner">
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
            </div>
            </nav>

        </header>

        <!-- SEARCH BAR -->
        <div class="recherche">
            <form action="#" method="get">
                <?php if(!empty($_GET['error']) && $_GET['error'] == true) { ?> <!-- initalization of the php in case of error -->
                <strong>Veuillez renseigner une ville correcte !</strong> <!-- error message-->
                <?php } ?>
                <input class="search" type="text" value="<?= $city; ?>" name="city" placeholder="Rechercher une ville" />
                <button class="enterButton" type="submit">Rechercher</button>
            </form>
        </div>

        <h1>Météo du jour et de la semaine à venir</h1>

        <!-- MAIN WEATHER = weather of the current day -->
        <div class="mainWeather">
            <div class="mainIcon">
                <img src=<?=$classWeatherIcon ?> />
            </div>
            <div class="currentInfos">
                <h2>
                    <?= $city; ?> <!-- overview of the city searched -->
                </h2>
                <div class="mainTemp">
                    <?php echo intval($currentWeather->main->temp); ?>°C</div> <!-- Temperature -->
                <div class="mainHumidity">
                    <?php echo intval($currentWeather->main->humidity); ?>% <!-- Humidity -->
                    <img src="images/humidity.svg" />
                </div>
                <div class="mainTempMin">
                    <?php echo intval($currentWeather->main->temp_min); ?>°C</div> <!-- Minimum Temperature-->
                <div class="mainTempMax">
                    <?php echo intval($currentWeather->main->temp_max); ?>°C</div> <!-- Maximum Temperature -->
            </div>
        </div>

        <!-- FORECAST WEATHER = weather of the 5 days to come -->
        <div class="forecastInfos">

            <!-- DAY ONE WEATHER -->
            <div class="dayOne">
                <?php 
                        
                    $forecast5Days = array_slice($forecast->data, 0, 1); // Get only the first day
                        
                    foreach($forecast5Days as $_forecast): ?> <!-- simpler way to get the path-->

                <div class="date">
                    <?= date('l', $_forecast->ts); ?> <!-- 'l' = way to get only the day -->
                </div>
                <div class="temp">
                    <?php echo intval ($_forecast->temp); ?>°C</div>
                <div class="tempMin">
                    <?php echo intval($_forecast->min_temp); ?>°C</div>
                <div class="tempMax">
                    <?php echo intval($_forecast->max_temp); ?>°C</div>

                <div class="forecastIcon">
                    <img src="<?=$forecastWeatherIcon?>">
                </div>
                <?php endforeach; ?>

            </div>

            <!-- DAY TWO WEATHER -->
            <div class="dayTwo">
                <?php 
                        
                    $forecast5Days = array_slice($forecast->data, 1, 1); // Get only the second day
                        
                    foreach($forecast5Days as $_forecast): ?> <!-- simpler way to get the path-->

                <div class="date">
                    <?= date('l', $_forecast->ts); ?> <!-- 'l' = way to get only the day -->
                </div>
                <div class="temp">
                    <?php echo intval ($_forecast->temp); ?>°C</div>
                <div class="tempMin">
                    <?php echo intval($_forecast->min_temp); ?>°C</div>
                <div class="tempMax">
                    <?php echo intval($_forecast->max_temp); ?>°C</div>

                <div class="forecastIcon">
                    <img src="<?=$forecastWeatherIcon?>">
                </div>
                <?php endforeach; ?>

            </div>

            <!-- DAY THREE WEATHER -->
            <div class="dayThree">
                <?php 
                        
                             $forecast5Days = array_slice($forecast->data, 2, 1); // Get only the third day
                        
                            foreach($forecast5Days as $_forecast): ?> <!-- simpler way to get the path-->

                <div class="date">
                    <?= date('l', $_forecast->ts); ?> <!-- 'l' = way to get only the day -->
                </div>
                <div class="temp">
                    <?php echo intval ($_forecast->temp); ?>°C</div>
                <div class="tempMin">
                    <?php echo intval($_forecast->min_temp); ?>°C</div>
                <div class="tempMax">
                    <?php echo intval($_forecast->max_temp); ?>°C</div>

                <div class="forecastIcon">
                    <img src="<?=$forecastWeatherIcon?>">
                </div>
                <?php endforeach; ?>

            </div>

            <!-- DAY FOUR WEATHER -->
            <div class="dayFour">
                <?php 
                        
                             $forecast5Days = array_slice($forecast->data, 4, 1); // Get only the fourth day
                        
                            foreach($forecast5Days as $_forecast): ?> <!-- simpler way to get the path-->

                <div class="date">
                    <?= date('l', $_forecast->ts); ?> <!-- 'l' = way to get only the day -->
                </div>
                <div class="temp">
                    <?php echo intval ($_forecast->temp); ?>°C</div>
                <div class="tempMin">
                    <?php echo intval($_forecast->min_temp); ?>°C</div>
                <div class="tempMax">
                    <?php echo intval($_forecast->max_temp); ?>°C</div>

                <div class="forecastIcon">
                    <img src="<?=$forecastWeatherIcon?>">
                </div>
                <?php endforeach; ?>

            </div>

             <!-- DAY FIVE WEATHER -->
            <div class="dayFive">
                <?php 
                        
                             $forecast5Days = array_slice($forecast->data, 5, 1); // Get only the fifth day
                        
                            foreach($forecast5Days as $_forecast): ?> <!-- simpler way to get the path-->

                <div class="date">
                    <?= date('l', $_forecast->ts); ?> <!-- 'l' = way to get only the day -->
                </div>
                <div class="temp">
                    <?php echo intval ($_forecast->temp); ?>°C</div>
                <div class="tempMin">
                    <?php echo intval($_forecast->min_temp); ?>°C</div>
                <div class="tempMax">
                    <?php echo intval($_forecast->max_temp); ?>°C</div>

                <div class="forecastIcon">
                    <img src="<?=$forecastWeatherIcon?>">
                </div>
                <?php endforeach; ?>

            </div>

        </div>

    </div>

    <script src="scripts/script.js"></script>
</body>

</html>