<!doctype html>
<html class="no-js" lang="en" dir="ltr">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Eenmaal Andermaal</title>
    <link href='https://fonts.googleapis.com/css?family=Roboto' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="css/foundation.css">
    <link rel="stylesheet" href="css/app.css">
    <link rel="stylesheet" type="text/css" href="awesomefont/css/font-awesome.min.css">
</head>
<body>
    <div class="row">
      <img class="logo" src="Images/Logo_v1.1.png" alt="Logo">
    </div>
    <br/>
    <div class="row">
      <?php include 'includes/menu.php';?>
        <?php include 'includes/database.php';?>
          <?php include 'includes/functions.php';?>
    <div class="content">
      <form action="inloggen.php" method="post">
    <div class="large-12 columns">
        <h2>Product aanbieden</h2>
          <i class="subtitle">Velden met een <span class="star">*</span> zijn verplicht</i></div>
            <div class="large-6 columns">

              <table>
                <tr>
                  <td>
                    Productnaam: <span class="star">*</span>
                  <br/>
                    <i class="subtitle">Maximaal 25 characters</i>
                      </td>
                        <td>
                          <input type="text" name="productname" placeholder="Productnaam" maxlength="25">
                        </td>
                          </tr>
                          <tr>
                        <td>
                          Beschrijving:<span class="star">*</span>
                        <br/>
                          <i class="subtitle">Maximaal 500 characters</i>
                            </td>
                            <td>
                              <textarea name="description" cols="40" rows="7" maxlength="500" placeholder="Beschrijving"></textarea>
                            </td>
                            </tr>
                            <tr>
                            <td>
                              Startbedrag: <span class="star">*</span>
                            </td>
                              <td>
                                <input type="text" name="startingprice" placeholder="€1,23">
                              </td>
                                </tr>
                                  <tr>
                                    <td>
                                      Biedingstijd: <span class="star">*</span>
                                    </td>
                                    <td>
                                      <select name="secretquestion" default>
                                        <option value="5">5 dagen</option>
                                        <option value="7" selected>7 dagen</option>
                                        <option value="9">9 dagen</option>
                                        <option value="10">10 dagen</option>
                                      </select>
                                        </td>
                                        </tr>
                                        <tr>
                                        <td>
                                          Afbeeldingen: <span class="star">*</span>
                                        </td>
                                        <td>
                                          <input name="filesToUpload[]" id="filesToUpload" type="file" multiple="" accept="image/jpg, image/jpeg, image/png" />
                                        </td>
                                    </tr>
                                </table>
                            </div>

                            <div class="large-6 columns">
                              <table>
                                <tr>
                                  <td>
                                    Plaatsnaam: <span class="star">*</span>
                                  </td>
                                  <td>
                                      <input type="text" name="place" placeholder="Plaatsnaam">
                                  </td>
                                  </tr>
                                  <tr>
                                  <td>
                                    Land:<span class="star">*</span>
                                  </td>
                                  <td>
                                    <input type="text" name="country" placeholder="Land">
                                  </td>
                                    </tr>
                                    <tr>
                                      <td>
                                        Betalingswijze: <span class="star">*</span>
                                      </td>
                                      <td>
                                        <select name="paymethod" default>
                                        <option value="1">iDeal</option>
                                        <option value="2">Acceptgiro</option>
                                        <option value="3">Paypal</option>
                                          </select>
                                        </td>
                                    </tr>
                                    <tr>
                                      <td>
                                        Betalingsinstructie:
                                      <br/>
                                        <i class="subtitle">Maximaal 30 characters</i>
                                      </td>
                                      <td>
                                        <textarea name="paying" cols="40" rows="2" maxlength="30" placeholder="Beschrijving"></textarea>
                                      </td>
                                    </tr>
                                    <tr>
                                      <td>
                                        Verzendkosten:
                                      </td>
                                      <td>
                                        <input type="text" name="transportcost" placeholder="€1,23">
                                      </td>
                                    </tr>
                                    <tr>
                                      <td>
                                        Verzendinstructies:
                                      <br/>
                                        <i class="subtitle">Maximaal 100 characters</i>
                                      </td>
                                      <td>
                                        <textarea name="sendinginstructions" cols="40" rows="4" maxlength="100" placeholder="Verzendinstructies"></textarea>
                                      </td>
                                    </tr>
                                </table>
                                <input type="submit" value="Verzenden" class="rechts smallbtn">
                                <br/>
                                <br/>
                            </div>

                        </form>

                    </div>
    </div>
    <script src="js/vendor/jquery.js"></script>
    <script src="js/vendor/what-input.js"></script>
    <script src="js/vendor/foundation.js"></script>
    <script src="js/app.js"></script>
</body>

</html>
