<?php

# Script 3 - heat.php
# Created March 29, 2019
# Created by Devon Kostos
# This script initializes, stores, displays,
# calculates and validates data and messages
# about weather using an HTML form.

$page_title = 'Heat Index';
$temperature = $humidity = $message = $calc_prompt = "";
include ('includes/header.html');

define ('LEGEND', 'Get the Heat Index');
define ('TEMP_LABEL', 'Temperature:');
define ('RH_LABEL', 'Humidity:');
define ('TEMP_MIN', 80);
define ('TEMP_MAX', 112);
define ('HUM_MIN', 13);
define ('HUM_MAX', 85);

if ($_SERVER['REQUEST_METHOD'] == 'POST')
{
		if (!empty($_REQUEST['temperature']) && !empty($_REQUEST['humidity']))
		{

			if (($_REQUEST['temperature'] >= TEMP_MIN && $_REQUEST['temperature'] <= TEMP_MAX && $_REQUEST['humidity'] >= HUM_MIN && $_REQUEST['humidity'] <= HUM_MAX))
			{
				$temperature = $_REQUEST['temperature'];
				$humidity = $_REQUEST['humidity'];

				$heat_index = -42.379 + 2.04901523*$temperature + 10.14333127*$humidity - .22475541*$temperature*$humidity - .00683783*$temperature*
											$temperature - .05481717*$humidity*$humidity + .00122874*$temperature*$temperature*$humidity + .00085282*$temperature*
											$humidity*$humidity - .00000199*$temperature*$temperature*$humidity*$humidity;

				$message = "The Heat Index is $heat_index.";

				unset($_POST['temperature'], $_POST['humidity']);

				$calc_prompt = "Please input additional data to calculate another Heat Index.";
			}
			else
			{
				$message = "The temperature should be a number between 80 and 112.<br />The humidity should be a
				number between 13 and 85.<br />Please try again.";
			}
		}
		else
		{
			$message = "Ensure input fields are not blank before submitting.<br />Please try again.";
		}
}
?>

<h1><? echo $page_title ?></h1>

<p>In the Summer, when people say "It's not the heat, it's the humidity", what do they mean? There are 2 factors
	that make a hot day feel really hot. The first is the air Temperature and the second is the relative humidity.
	After taking measurments for temperature and relative humidity, we can calculate a heat index that is called our
	"feels like" temperature.</p>
<p>HI means Heat Index (the "Feels Like" Temperature).</p>
<p>T means the air temperature (This formula works when temperatures are in the range of 80 to 112).</p>
<p>RH means relative humidity (This forumula works when relative humidity is in the range of 13 to 85).</p>
<br /><br /><br />

<span id="message"><?php echo $message ?></span><br />
<p><?php echo $calc_prompt ?></p><br />

<form name="heat.php" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
	 <fieldset>
		 <legend><? echo LEGEND ?></legend>
		 <? echo TEMP_LABEL ?> <input type="number" name="temperature" value="<?php if (isset($_POST['temperature'])) echo $_POST['temperature']; ?>"><br />
		 <? echo RH_LABEL ?> <input type="number" name="humidity" value="<?php if (isset($_POST['humidity'])) echo $_POST['humidity']; ?>"><br /><br />
		 <input type="submit" value="Gimme the Heat Index">
	 </fieldset>
</form>

<br /><br />
<p>If you need to take the temperature, but don't have a Thermometer, then see our <a href="workshops.php">Weather Workshops</a>
	to find a workshop on How to make a Thermometer.</p>
<p>If you need to measure the relative humidity, but don't have a Hygrometer. Don't worry, we have a <a href="workshops.php">Weather
	Workshops</a> that shows you how to make a Hygrometer too!</p>
<p>You can go to the website for those other guys <a href="https://weather.com/">The Weather Channel</a> to get these measurements, but
	taking measurements from them isn't as much fun as doing it yourself.</p><br />

<?php include ('includes/footer.html'); ?>
