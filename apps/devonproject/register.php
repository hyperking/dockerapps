<?php

# Script 4 - register.php
# Created March 30, 2019
# Created by Devon Kostos
# This script initializes, stores, displays,
# and validates data and messages based on
# user input from an HTML form.

$page_title = 'Weather Wizards Registration';
$name = $guardian = $email = $phone_num = $city = $membership = $workshop[] = "";
include ('includes/header.html');

define('LEGEND', 'Register Your Interests');
define('GAUGE_LABEL', 'Make a Rain Gauge');
define('THERMO_LABEL', 'Make a Thermometer');
define('WINDSOCK_LABEL', 'Make a Windsock');
define('LIGHTNING_LABEL', 'Make Lightning In Your Mouth');
define('HYGRO_LABEL', 'Make a Hygrometer');
define('NAME_LABEL', 'Your name:');
define('GUARDIAN_LABEL', 'Your parent or guardian\'s name:');
define('EMAIL_LABEL', 'Your parent or guardian\'s email:');
define('PHONE_LABEL', 'Your parent or guardian\'s phone:');
define('CITY_LABEL', 'Your closest center:');
define('CHS_LABEL', 'Charleston');
define('SVILLE_LABEL', 'Summerville');
define('MT_P_LABEL', "Mt Pleasant");
define('MEM_LABEL', "Are you a member?");
define('YES_LABEL', "Yes");
define('NO_LABEL', "No");
define('SIGN_UP_LABEL', "Sign me up.");

if ($_SERVER['REQUEST_METHOD'] == 'POST')
{
  // save response in $name if entered otherwise set $name to NULL
  if (!empty($_REQUEST['name']))
  {
    $name = $_REQUEST['name'];
  }
  else
  {
    $name = NULL;
    echo "<p style=color:red;font-weight:bold>You forgot to enter your name.</p>";
  }

  // save response in $guardian if entered otherwise set $guardian to NULL
  if (!empty($_REQUEST['guardian']))
  {
    $guardian = $_REQUEST['guardian'];
  }
  else
  {
    $guardian = NULL;
    echo "<p style=color:red;font-weight:bold>You forgot to enter your parent or guardian's name.</p>";
  }

  // save response in $email if entered otherwise set $email to NULL
  if (!empty($_REQUEST['email']))
  {
    $email = $_REQUEST['email'];
  }
  else
  {
    $email = NULL;
    echo "<p style=color:red;font-weight:bold>You forgot to enter your parent or guardian's email.</p>";
  }

  // save response in $phone_num if entered otherwise set $phone_num to NULL
  if (!empty($_REQUEST['phone_num']))
  {
    $phone_num = $_REQUEST['phone_num'];
  }
  else
  {
    $phone_num = NULL;
    echo "<p style=color:red;font-weight:bold>You forgot to enter your parent or guardian's phone number.</p>";
  }

  // save response in $city if entered otherwise set $city to NULL
  if (!empty($_REQUEST['city']))
  {
    $city = $_REQUEST['city'];
  }
  else
  {
    $city = NULL;
  }

  // save response in $membership if entered otherwise set $membership to NULL
  if (!empty($_REQUEST['membership']))
  {
    $membership = $_REQUEST['membership'];
  }
  else
  {
    $membership = NULL;
    echo "<p style=color:red;font-weight:bold>You forgot to enter your membership status.</p>";
  }

  // save response in $workshop if entered otherwise set $workshop to NULL
  if(isset($_POST['workshop']))
  {
    foreach ($_POST['workshop'] as $value)
    {
      $workshop[] = $value;
    }
  }
  else
  {
    $workshop[] = NULL;
  }


  // The if statement below checks for NULL $name, $guardian, $email, $phone_num and $membership
  if ($name != NULL && $guardian != NULL && $email != NULL && $phone_num != NULL && $membership != NULL)
  {
    //Process the user city with messages that echo the user location
    if ($city == 'charleston')
    {
      echo "<p>You are nearest to our Charleston SC location, the Holy City! Go River Dogs!</p>";
    }
    else if ($city == 'summerville')
    {
      echo "<p>You are nearest to our Summerville SC location, the Birthplace of Sweet Tea! Refreshing!</p>";
    }
    else if ($city == 'mt_pleasant')
    {
      echo "<p>You are nearest to our Mt. Pleasant, SC location that has a historical and beachy vibe!</p>";
    }
    else if ($city == '') {
      echo "<p>Not sure of the nearest location? We will send you an email to keep in touch!</p>";
    }

	  //Process the user membership with messages that echo the user membership including user name
    if ($membership == 'yes')
    {
      echo "<p>Welcome back $name! Thank you for being a member of Weather Wizards.</p>";
    }
    else if ($membership == 'no')
    {
      echo "<p>Hi $name, we hope you'll join Weather Wizards. We have more fun than a jar full of lightning bugs!</p>";
    }
    else if ($membership == 'sign_up')
    {
      echo "<p>Hi $name! Welcome to Weather Wizards where the forecast is always a 99% chance of fun!</p>";
    }

    // processes the checkboxes where the user chooses the workshops they want to take
    if (isset($workshop))
    {
      echo "<p>You have chosen the following workshops:</p>";
      foreach ($workshop as $value)
      {
        echo "<p>$value</p>";
      }
    }
    else // if the user doesn't choose a workshop, we display the message below
    {
      echo "<p>You have not chosen a workshop, but we add new workshops all the time. We'll keep you updated by email.</p>";
    }
  }
  else
  {
    echo "<p>Weather Wizard, we need your name and your parent or guardian's name, email, phone and your membership status to send information about our workshops.
         Enter required information and click the Register button again.</p>";
  }
}
?>

<h1><?php echo $page_title ?></h1>

<p>We host weather wizards workshops throughout the year for kids from 6-12.<br /><br />
   Please note that the following workshops are free to members.<br /><br />
  <ul>
		<li><?php echo GAUGE_LABEL ?></li>
		<li><?php echo THERMO_LABEL ?></li>
	</ul>
</p>

<form name="register.php" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">

  <fieldset>
    <legend><?php echo LEGEND ?></legend>

      <input type="checkbox" name="workshop[]" value="Make a Rain Gauge" <?php if (in_array('Make a Rain Gauge', $workshop)) echo(' CHECKED '); ?>/> <?php echo GAUGE_LABEL ?><br />
      <input type="checkbox" name="workshop[]" value="Make a Thermometer" <?php if (in_array('Make a Thermometer', $workshop)) echo(' CHECKED '); ?>/> <?php echo THERMO_LABEL ?><br />
      <input type="checkbox" name="workshop[]" value="Make a Windsock" <?php if (in_array('Make a Windsock', $workshop)) echo(' CHECKED '); ?>/> <?php echo WINDSOCK_LABEL ?><br />
      <input type="checkbox" name="workshop[]" value="Make Lighning In Your Mouth" <?php if (in_array('Make Lighning In Your Mouth', $workshop)) echo(' CHECKED '); ?>/> <?php echo LIGHTNING_LABEL ?><br />
      <input type="checkbox" name="workshop[]" value="Make a Hygrometer" <?php if (in_array('Make a Hygrometer', $workshop)) echo(' CHECKED '); ?>/> <?php echo HYGRO_LABEL ?>

      <p>
        <label><?php echo NAME_LABEL ?><br /><input type="text" name="name" size="20" maxlength="40" value="<?php if (isset($_POST['name'])) echo $_POST['name']; ?>"/></label><br /><br />
        <label><?php echo GUARDIAN_LABEL ?><br /><input type="text" name="guardian" size="20" maxlength="40" value="<?php if (isset($_POST['guardian'])) echo $_POST['guardian']; ?>"/></label><br /><br />
        <label><?php echo EMAIL_LABEL ?><br /><input type="text" name="email" size="20" maxlength="40" value="<?php if (isset($_POST['email'])) echo $_POST['email']; ?>"/></label><br /><br />
        <label><?php echo PHONE_LABEL ?><br /><input type="text" name="phone_num" size="20" maxlength="40" value="<?php if (isset($_POST['phone_num'])) echo $_POST['phone_num']; ?>"/></label><br /><br />
      </p>

      <p>
        <label><?php echo CITY_LABEL ?></label>
          <select name="city">
            <option value="" <?php if (isset($_POST['city']) && ($_POST['city'] == '')) echo 'selected = "selected"'; ?>></option>
            <option value="charleston" <?php if (isset($_POST['city']) && ($_POST['city'] == 'charleston')) echo 'selected = "selected"'; ?>><?php echo CHS_LABEL ?></option>
            <option value="summerville" <?php if (isset($_POST['city']) && ($_POST['city'] == 'summerville')) echo 'selected = "selected"'; ?>><?php echo SVILLE_LABEL ?></option>
            <option value="mt_pleasant" <?php if (isset($_POST['city']) && ($_POST['city'] == 'mt_pleasant')) echo 'selected = "selected"'; ?>><?php echo MT_P_LABEL ?></option>
          </select>
      </p>

      <label id="member"><?php echo MEM_LABEL ?></label>
      <input type="radio" name="membership" value="yes" <?php if (isset($_POST['membership']) && ($_POST['membership'] == 'yes')) echo 'checked="checked"'; ?>/> <?php echo YES_LABEL ?>
      <input type="radio" name="membership" value="no" <?php if (isset($_POST['membership']) && ($_POST['membership'] == 'no')) echo 'checked="checked"'; ?>/> <?php echo NO_LABEL ?>
      <input type="radio" name="membership" value="sign_up" <?php if (isset($_POST['membership']) && ($_POST['membership'] == 'sign_up')) echo 'checked="checked"'; ?>/> <?php echo SIGN_UP_LABEL ?><br /><br />
      <input type="submit" class="button" value="Register"/>
      <input type="reset" class="button" value="Clear Form"/>
	</fieldset>
</form>

<?php include ('includes/footer.html'); ?>
