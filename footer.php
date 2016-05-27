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
              <h4 class="location">Bone &amp; Mortar</h4>
              <p>2738 Drummond Street<br>
                Parsippany, NJ 07054</p>

              <h4 class="phone">+1 605 475 6972</h4>
            </div>
            <div class="small-6 medium-12 columns">
              <h4 class="email">Email</h4>
              <p>Mark.Giesen@han.nl </p>

              <h4>Social</h4>
              <div class="social">
                <ul class="inline-list">
                  <li><a href="https://twitter.com/VeilingsiteEA"><i class="fi-social-twitter"></i></a></li>
                  <li><a href="https://github.com/thijs1108/EenmaalAndermaal"><i class="fi-social-github"></i></a></li>
                </ul>
              </div>
            </div>
          </div>
        </div>
        <div class="medium-6 columns">
          <p class="form-lead">Let's catch up with some wine and cheese</p>
          <p class="form-lead-in">and I'll become the story teller for a day</p>
          <form class="round-inputs">
            <div class="row">
              <div class="large-12 columns">
                <input type="text" placeholder="Name" />
              </div>
              <div class="large-12 columns">
                <input type="email" placeholder="Email" />
              </div>
              <div class="large-12 columns">
                <input type="text" placeholder="Telephone" />
              </div>
              <div class="large-12 columns">
                <textarea placeholder="Say 'what' again. Say 'what' again, I dare you, I double dare you..."></textarea>
                <a href="#" class="button round">Submit</a>
              </div>
            </div>
          </form>
        </div>
      </div>
    </section>

</body>
