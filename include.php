<?php

// Initialization of the API OpenWeatherMap and the different variables  
$city = !empty($_GET['city']) ? $_GET['city'] : 'Paris'; // variable to get the city the user will enter
$url = 'http://api.openweathermap.org/data/2.5/weather?q='.$city.'&units=metric&appid=4450c1968712bc4ca1ce843fada1fd9e';
$path = './cache/'.md5($url);

// Loop to make the API work and creation of the variable we're gonna use all along for this particular API
if(file_exists($path) && time() - filemtime($path) < 10)
{
    $currentWeather = json_decode(file_get_contents($path));
}
else
{
    $currentWeather = json_decode(file_get_contents($url));
    file_put_contents($path, json_encode($currentWeather));
}

// Initialization of the API Weatherbit.io and the different variables
$urlForecast = 'https://api.weatherbit.io/v2.0/forecast/daily?city='.urlencode($city).'&key=21202e9f1aea4bc5ab980d8bcd94e847';
$pathForecast = './cache/'.md5($urlForecast);

// Loop to make the API work and creation of the variable we're gonna use all along for this particular API
if(file_exists($pathForecast) && time() - filemtime($pathForecast) < 10)
{
    $forecast = json_decode(file_get_contents($pathForecast));
}
else
{
    $forecast = json_decode(file_get_contents($urlForecast));
    file_put_contents($pathForecast, json_encode($forecast));
}

// Loop to create an error message if the user enter a wrong value
if(empty($forecast) || empty($currentWeather)) {
    header('Location: index.php?error=true');
}

// Creation of the variable $weatherCode we're gonna use to recover the right icon at the right place
$weatherCode = $currentWeather->weather[0]->icon;

?>

<!-- RECOVER ICONS FOR THE CURRENT WEATHER -->
    <?php
      
      $classWeatherIcon = "";
      
      switch ($weatherCode) {

// SUNNY
        case "01d":
             $classWeatherIcon = "./images/icon_sun.svg";
             break;
        case "01n":
             $classWeatherIcon = "./images/icon_sun_night.svg";
             break;

// CLOUDY
        case "02d":
             $classWeatherIcon = "./images/icon_few_clouds_day.svg";
             break;
        case "02n":
             $classWeatherIcon = "./images/icon_few_clouds_night.svg";
             break;

// BROKEN CLOUDS
        case "03d":
             $classWeatherIcon = "./images/icon_clouds.svg";
             break;
        case "03n":
             $classWeatherIcon = "./images/icon_clouds.svg";
             break;
        case "04d":
             $classWeatherIcon = "./images/icon_clouds_day.svg";
             break;
        case "04n":
             $classWeatherIcon = "./images/icon_clouds_night.svg";
             break;

// SHOWER RAIN
        case "09d":
             $classWeatherIcon = "./images/icon_shower_rain_day.svg";
             break;
        case "09n":
             $classWeatherIcon = "./images/icon_shower_rain_night.svg";
             break;

// RAINY
        case "10d":
             $classWeatherIcon = "./images/icon_rain_day.svg";
             break;
        case "10n":
             $classWeatherIcon = "./images/icon_rain_night.svg";
             break;

// THUNDER
        case "11d":
             $classWeatherIcon = "./images/icon_thunderstorm_day.svg";
             break;
        case "11n":
             $classWeatherIcon = "./images/icon_thunderstorm_night.svg";
             break;

// SNOW
        case "13d":
             $classWeatherIcon = "./images/icon_snow_day.svg";
             break;
        case "13n":
             $classWeatherIcon = "./images/icon_snow_night.svg";
             break;

// MIST
        case "50d":
             $classWeatherIcon = "./images/icon_mist.svg";
             break;
        case "50n":
             $classWeatherIcon = "./images/icon_mist.svg";
             break;
        default:
        }
          
?>

<!-- RECOVER ICONS FOR THE FORECAST WEATHER -->
<?php

// Creation of the variable $forecastCode we're gonna use to recover the right icon at the right place
$forecastCode = $forecast->data[0]->weather->icon;
  
  $forecastWeatherIcon = "";
  
  switch ($forecastCode) {

// SUNNY
    case "c01d":
         $forecastWeatherIcon = "./images/icon_sun.svg";
         break;
    case "c01n":
         $forecastWeatherIcon = "./images/icon_sun_night.svg";
         break;

// FEW CLOUDS
    case "c02d":
         $forecastWeatherIcon = "./images/icon_few_clouds_day.svg";
         break;
    case "c02n":
         $forecastWeatherIcon = "./images/icon_few_clouds_night.svg";
         break;

// CLOUDY
    case "c03d":
         $forecastWeatherIcon = "./images/icon_clouds.svg";
         break;
    case "c03n":
         $forecastWeatherIcon = "./images/icon_clouds.svg";
         break;

// BROKEN CLOUDS
    case "c04d":
         $forecastWeatherIcon = "./images/icon_clouds_day.svg";
         break;
    case "c04n":
         $forecastWeatherIcon = "./images/icon_clouds_night.svg";
         break;

// RAINY
    case "f01d":
         $forecastWeatherIcon = "./images/icon_shower_rain_day.svg";
         break;
    case "f01n":
         $forecastWeatherIcon = "./images/icon_shower_rain_night.svg";
         break;
    case "r01d":
         $forecastWeatherIcon = "./images/icon_shower_rain_day.svg";
         break;
    case "r01n":
         $forecastWeatherIcon = "./images/icon_shower_rain_night.svg";
         break;
    case "r03d":
         $forecastWeatherIcon = "./images/icon_shower_rain_day.svg";
         break;
    case "r03n":
         $forecastWeatherIcon = "./images/icon_shower_rain_day.svg";
         break;
    case "r04d":
         $forecastWeatherIcon = "./images/icon_shower_rain_day.svg";
         break;
    case "r04n":
         $forecastWeatherIcon = "./images/icon_rain_day.svg";
         break;
    case "u00d":
         $forecastWeatherIcon = "./images/icon_shower_rain_day.svg";
         break;
    case "u00n":
         $forecastWeatherIcon = "./images/icon_rain_night.svg";
         break;

// SHOWER RAIN
    case "r05d":
         $forecastWeatherIcon = "./images/icon_shower_rain_day.svg";
         break;
    case "r05n":
         $forecastWeatherIcon = "./images/icon_shower_rain_day.svg";
         break;
    case "r06d":
         $forecastWeatherIcon = "./images/icon_shower_rain_day.svg";
         break;
    case "r06n":
         $forecastWeatherIcon = "./images/icon_shower_rain_day.svg";
         break;


// THUNDER
    case "t01d":
         $forecastWeatherIcon = "./images/icon_thunderstorm_day.svg";
         break;
    case "t01n":
         $forecastWeatherIcon = "./images/icon_thunderstorm_night.svg";
         break;
    case "t02d":
         $forecastWeatherIcon = "./images/icon_thunderstorm_day.svg";
         break;
    case "t02n":
         $forecastWeatherIcon = "./images/icon_thunderstorm_night.svg";
         break;
    case "t03d":
         $forecastWeatherIcon = "./images/icon_thunderstorm_day.svg";
         break;
    case "t03n":
         $forecastWeatherIcon = "./images/icon_thunderstorm_night.svg";
         break;
    case "t04d":
         $forecastWeatherIcon = "./images/icon_thunderstorm_day.svg";
         break;
    case "t04n":
         $forecastWeatherIcon = "./images/icon_thunderstorm_night.svg";
         break;
    case "t05d":
         $forecastWeatherIcon = "./images/icon_thunderstorm_day.svg";
         break;
    case "t05n":
         $forecastWeatherIcon = "./images/icon_thunderstorm_night.svg";
         break; 
         

// SNOW
    case "d01d":
         $forecastWeatherIcon = "./images/icon_snow_night.svg";
         break;
    case "d01n":
         $forecastWeatherIcon = "./images/icon_snow_night.svg";
         break;
    case "d02d":
         $forecastWeatherIcon = "./images/icon_snow_night.svg";
         break;
    case "d02n":
         $forecastWeatherIcon = "./images/icon_snow_night.svg";
         break;
    case "d03d":
         $forecastWeatherIcon = "./images/icon_snow_night.svg";
         break;
    case "d03n":
         $forecastWeatherIcon = "./images/icon_snow_night.svg";
         break;
    case "s01d":
         $forecastWeatherIcon = "./images/icon_snow_day.svg";
         break;
    case "s01n":
         $forecastWeatherIcon = "./images/icon_snow_night.svg";
         break;
    case "s02d":
         $forecastWeatherIcon = "./images/icon_snow_day.svg";
         break;
    case "s02n":
         $forecastWeatherIcon = "./images/icon_snow_night.svg";
         break;
    case "s03d":
         $forecastWeatherIcon = "./images/icon_snow_day.svg";
         break;
    case "s03n":
         $forecastWeatherIcon = "./images/icon_snow_night.svg";
         break;
    case "s04d":
         $forecastWeatherIcon = "./images/icon_snow_day.svg";
         break;
    case "s04n":
         $forecastWeatherIcon = "./images/icon_snow_night.svg";
         break;
    case "s06d":
         $forecastWeatherIcon = "./images/icon_snow_day.svg";
         break;
    case "s06n":
         $forecastWeatherIcon = "./images/icon_snow_night.svg";
         break;
    

// MIST
    case "s05d":
         $forecastWeatherIcon = "./images/icon_mist.svg";
         break;
    case "s05n":
         $forecastWeatherIcon = "./images/icon_mist.svg";
         break;
    case "a01d":
         $forecastWeatherIcon = "./images/icon_mist.svg";
         break;
    case "a01n":
         $forecastWeatherIcon = "./images/icon_mist.svg";
         break;
    case "a02d":
         $forecastWeatherIcon = "./images/icon_mist.svg";
         break;
    case "a02n":
         $forecastWeatherIcon = "./images/icon_mist.svg";
         break;
    case "a03d":
         $forecastWeatherIcon = "./images/icon_mist.svg";
         break;
    case "a03n":
         $forecastWeatherIcon = "./images/icon_mist.svg";
         break;
    case "a04d":
         $forecastWeatherIcon = "./images/icon_mist.svg";
         break;
    case "a04n":
         $forecastWeatherIcon = "./images/icon_mist.svg";
         break;
    case "a05d":
         $forecastWeatherIcon = "./images/icon_mist.svg";
         break;
    case "a05n":
         $forecastWeatherIcon = "./images/icon_mist.svg";
         break;
    case "a06d":
         $forecastWeatherIcon = "./images/icon_mist.svg";
         break;
    case "a06n":
         $forecastWeatherIcon = "./images/icon_mist.svg";
         break;


    default:
    }
      
?>