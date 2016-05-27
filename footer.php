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
<body>
    <!-- Footer -->
    <section class="contact-footer">
      <div class="row wide">
        <div class="medium-6 columns">
          <div class="row">
            <div class="small-6 medium-12 columns">
              <h4 class="location">EenmaalAndermaal veilingen</h4>
              <p>Ruitenberglaan 26</p>
              <p>6826 CC Arnhem</p>
              <h4 class="phone">(026) 365 82 82</h4>
            </div>
            <div class="small-6 medium-12 columns">
              <h4 class="email">Email</h4>
              <p>Mark.Giesen@han.nl </p>
              <h4>Social</h4>
              <div class="social">
                <ul class="inline-list">
                  <a href="https://twitter.com/VeilingsiteEA"><i class="fi-social-twitter"></i></a><br>
                  <a href="https://github.com/thijs1108/EenmaalAndermaal"><i class="fi-social-github"></i></a>
                </ul>
              </div>
            </div>
          </div>
        </div>
        <div class="medium-6 columns">
          <p class="form-lead">Wees geen vreemde!</p>
          <form class="round-inputs">
            <div class="row">
              <div class="large-12 columns">
                <input type="email" placeholder="Email" />
              </div>
            <div class="large-12 columns">
                <textarea placeholder="Voer hier uw commentaar/vragen/suggesties."></textarea>
                <a href="#" class="button round">Verzenden</a>
              </div>
            </div>
          </form>
        </div>
      </div>
    </section>
</body>
