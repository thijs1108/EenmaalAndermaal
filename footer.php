<?php
    define("TITLE", "Home | Eenmaal Andermaal: voor al uw veilingen");
    //constant named 'Title'
?>

<!doctype html>
<html class="no-js" lang="en" dir="ltr">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo TITLE; ?></title>
    <link href='https://fonts.googleapis.com/css?family=Roboto' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="css/foundation.css">
    <link rel="stylesheet" href="css/app.css">
    <link href="http://cdnjs.cloudflare.com/ajax/libs/foundicons/3.0.0/foundation-icons.css" rel="stylesheet">
    <!-- For Foundation Icons, put this in your head -->
</head>
  <!-- Footer -->
    <section class="contact-footer">
      <div class="row wide">
        <div class="medium-6 columns">
          <div class="row">
            <div class="small-6 medium-12 columns">
              <h4 class="location"><b>EenmaalAndermaal veilingen</b></h4>
              <p>Ruitenberglaan 26</p>
              <p>6826 CC Arnhem</p>
              <h4 class="phone"><b>(026) 365 82 82</b></h4>
            </div>
            <div class="small-6 medium-12 columns">
              <h4 class="email"><b>Email</b></h4>
              <p>Mark.Giesen@han.nl </p>
              <div class="social"><h4><b>Social</b></h4>
                <ul class="inline-list">
                  <a href="https://twitter.com/VeilingsiteEA"><i class="fi-social-twitter"></i></a>
                  <a href="https://github.com/thijs1108/EenmaalAndermaal"><i class="fi-social-github"></i></a>
                </ul>
              </div>
            </div>
          </div>
        </div>
        <div class="medium-6 columns">
          <p class="form-lead"><b>Contacteer ons</b></p>
          <form action="contact_send.php" method="post">
            <div class="row">
              <div class="large-12 columns">
                <input type="text" name="email" placeholder="email">
              </div>
            <div class="large-12 columns">
                <textarea class="FormElement" name="message" cols="40" rows="3" maxlength="500"
                placeholder="Vraag/suggestie/opmerking"></textarea>
                <input type="submit" value="Versturen" class="button round">
                </div>
            </div>
          </form>
        </div>
      </div>
    </section>
