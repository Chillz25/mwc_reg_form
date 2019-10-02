<?php
  session_start();
  require_once('register_2.vc.php');
?>

<!DOCTYPE html>
<html lang="en">
  <head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title>REGISTER TO MY WHITE CARD</title>
    <meta name="author" content="MWC">
    <meta name="robots" content="NOINDEX, NOFOLLOW" />

    <!-- Bootstrap CSS -->
      <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
      <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">

    <!-- styles:custom -->
    <link rel="stylesheet" href="css/custom.css">
    <!-- <link rel="stylesheet" href="css/style.css"> -->
    <!-- <link rel="stylesheet" href="../_lib/v/simple-sidebar/simple-sidebar.css"> -->
    <link rel="stylesheet" href="../_lib/v/jquery-ui/jquery-ui.css">

    <!-- Favicons -->
    <link rel="apple-touch-icon" href="../img/logo_png_solo.png">
    <link rel="icon" href="../img/logo_png_solo.png" sizes="16x16">

    <!-- <script src="https://www.google.com/recaptcha/api.js" async defer></script> -->

  </head>

  <body class="bg-color-dark-grey">
    <div class="nav-header bg-light">
        <nav class="navbar navbar-expand-md navbar-light">
          <div class="container pt-3">
          <a class="navbar-brand" href="../main">
            <img src="../img/logo_header.png" class="img-fluid" width="200">
          </a>
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <div class="input-group w-50 mx-auto d-none">
              <div class="input-group-prepend">
                <span class="input-group-text bg-orange" id="inputGroup-sizing-default"> <i class="fas fa-search"></i> </span>
              </div>
              <input type="text" class="form-control search-bar" aria-label="Default" aria-describedby="inputGroup-sizing-default" placeholder="Search">
            </div>
            <ul class="navbar-nav my-2 my-lg-0 text-center ml-auto">
              <?php
                // Check Session Credentials and auto-login
                if (isset($_SESSION['usrcustomername'])) {
              echo('<li class="nav-item dropdown">
              <a class="nav-link header-user dropdown-toggle user-dropdown" href="#" id="navbarDropdown2" role="button" data-toggle="dropdown"
              aria-haspopup="true" aria-expanded="false">'.$_SESSION['usrcustomername'].' <i class="fas fa-chevron-down ml-2"></i></a>');
              ?>

                <?php
                  $packageid = $_SESSION['usrcustomer_packageid'];

                  if ($packageid == 0) {
                  $ribbon = 'ribbon-guest';
                } else if ($packageid <= 1) {
                  $ribbon = 'ribbon-elite';
                } else if ($packageid == 2) {
                  $ribbon = 'ribbon-premium';
                } else if ($packageid == 3) {
                  $ribbon = 'ribbon-luxury';
                }

                echo('<div class="dropdown-menu left-120" aria-labelledby="navbarDropdown2">
                <span class="dropdown-item">
                <a href="membership.php" class="header-dropdown-links"><img src="../img/'.$ribbon.'.png" width="30" class="img-fluid">
                ');

                  if ($packageid == 0) {
                  echo ('Guest </a></span>');
                } else if($packageid == 1) {
                  echo('Elite Member </a></span>');
                } else if($packageid == 2) {
                  echo('Premium Member </a></span>');
                } else if($packageid == 3) {
                  echo('Luxury Member </a></span>');
                } ?>

                <span class="dropdown-item"><a href="list-claimed.php" class="header-dropdown-links">Claimed Coupon</a></span>
                <span class="dropdown-item"><a href="settings-profile.php" class="header-dropdown-links">Edit Profile</a></span>

                <?php

                if (isset($_SESSION['usrexpirationdays']) <= 0 ) {
                  $packageid == 0;
                } else if ($packageid >= 1) {
                echo('<span class="dropdown-item"> <small>(Expiry: ' . $_SESSION['usrexpirationdate'] . ', ' . $_SESSION['usrexpirationdays'] . ' days remaining)</small></span>');
                }
                ?>

                <div class="dropdown-divider"></div>
                <span class="dropdown-item"><a href="../signout" class="signout">Signout</a></span>
              </div>

                <?php } else { ?>
                <li><a class="nav-link header-link mr-3" href="index.php">Login</a></li>
                <li><a class="nav-link header-link register-header-link" href="register.php">Register</a></li>
                <?php } ?>
            </ul>
          </div>
        </div>
      </nav>
    </div>
    <!-- ERROR ALERT -->
    <!-- <div class='pop-alert bg-danger m-0'>
      <div class='container py-3'><p class='mb-0 text-light t-brandon_med'> ERROR ALERT <i class='fas fa-times float-right fa-lg mr-3 mt-1 button-pop'></i></p></div>
    </div> -->

    <!-- SUCCESS ALERT -->
    <!-- <div class='pop-alert bg-tortouse m-0'>
      <div class='container py-3'><p class='mb-0 text-light t-brandon_med'> SUCCESS ALERT <i class='fas fa-times float-right fa-lg mr-3 mt-1 button-pop'></i></p></div>
    </div> -->


<div class="bg-register py-5">
  <div class="container">
    <div class="register_holder_2 my-3 mx-auto">
      <form method="POST">
        <div class="row mx-3 pt-5 py-5">
          <div class="col-12">
            <h4 class="reg_header"><span class="form-step">1</span> Your billing cycle </h4>
          </div>
          <div class="col-12">
            <div class="form-check d-inline mr-5">
              <input class="form-check-input" type="radio" name="exampleRadios" id="exampleRadios1" value="option1" checked>
              <label class="form-check-label" for="exampleRadios1">
                149
              </label>
            </div>
            <div class="form-check d-inline mr-5">
              <input class="form-check-input" type="radio" name="exampleRadios" id="exampleRadios2" value="option2">
              <label class="form-check-label" for="exampleRadios2">
                349
              </label>
            </div>
            <div class="form-check d-inline mr-5">
              <input class="form-check-input" type="radio" name="exampleRadios" id="exampleRadios3" value="option3">
              <label class="form-check-label" for="exampleRadios3">
                549
              </label>
            </div>
          </div>
          <div class="col-12">
            <hr>
            <h4 class="reg_header"><span class="form-step">2</span> Basic Information </h4>
          </div>
          <div class="col-6">
            <div class="form-group">
              <label for="fname">First Name</label>
              <input type="text" class="form-control" id="fname" name="fname" autocomplete="off" aria-describedby="fnameHelp" required>

            </div>
          </div>
          <div class="col-6">
            <div class="form-group">
              <label for="lname">Last Name</label>
              <input type="text" class="form-control" id="lname" name="lname" aria-describedby="lnameHelp" required>
            </div>
          </div>
          <div class="col-6">
            <div class="form-group">
              <label for="email">Email Address</label>
              <input type="email" class="form-control" id="email" name="email" aria-describedby="emailHelp"required>
            </div>
          </div>
          <div class="col-6">
            <div class="form-group">
              <label for="password">Password</label>
              <input type="password" class="form-control" id="password" name="passwd">
            </div>
          </div>
          <div class="col-6">
            <div class="form-group">
              <div class="row">
                <div class="col-xs-12 col-md-6">
                  <label for="areacode">Area Code</label>
                  <select class="form-control" id="areacode" name="areacode" autocomplete="off" required>
                    <option data-countryCode="AF" value="93">Afghanistan (+93)</option>
                    <option data-countryCode="AL" value="355">Albania (+355)</option>
                    <option data-countryCode="DZ" value="213">Algeria (+213)</option>
                    <option data-countryCode="AS" value="1684">American Samoa (+1684)</option>
                    <option data-countryCode="AD" value="376">Andorra (+376)</option>
                    <option data-countryCode="AO" value="244">Angola (+244)</option>
                    <option data-countryCode="AI" value="1264">Anguilla (+1264)</option>
                    <option data-countryCode="AQ" value="672">Antartica (+672)</option>
                    <option data-countryCode="AG" value="1268">Antigua &amp; Barbuda (+1268)</option>
                    <option data-countryCode="AR" value="54">Argentina (+54)</option>
                    <option data-countryCode="AM" value="374">Armenia (+374)</option>
                    <option data-countryCode="AW" value="297">Aruba (+297)</option>
                    <option data-countryCode="AU" value="61">Australia (+61)</option>
                    <option data-countryCode="AT" value="43">Austria (+43)</option>
                    <option data-countryCode="AZ" value="994">Azerbaijan (+994)</option>
                    <option data-countryCode="BS" value="1242">Bahamas (+1242)</option>
                    <option data-countryCode="BH" value="973">Bahrain (+973)</option>
                    <option data-countryCode="BD" value="880">Bangladesh (+880)</option>
                    <option data-countryCode="BB" value="1246">Barbados (+1246)</option>
                    <option data-countryCode="BY" value="375">Belarus (+375)</option>
                    <option data-countryCode="BE" value="32">Belgium (+32)</option>
                    <option data-countryCode="BZ" value="501">Belize (+501)</option>
                    <option data-countryCode="BJ" value="229">Benin (+229)</option>
                    <option data-countryCode="BM" value="1441">Bermuda (+1441)</option>
                    <option data-countryCode="BT" value="975">Bhutan (+975)</option>
                    <option data-countryCode="BO" value="591">Bolivia (+591)</option>
                    <option data-countryCode="BA" value="387">Bosnia Herzegovina (+387)</option>
                    <option data-countryCode="BW" value="267">Botswana (+267)</option>
                    <option data-countryCode="BR" value="55">Brazil (+55)</option>
                    <option data-countryCode="IO" value="246">British Indian Ocean Territory (+246)</option>
                    <option data-countryCode="IO" value="1284">British Virgin Islands (+1284)</option>
                    <option data-countryCode="BN" value="673">Brunei (+673)</option>
                    <option data-countryCode="BG" value="359">Bulgaria (+359)</option>
                    <option data-countryCode="BF" value="226">Burkina Faso (+226)</option>
                    <option data-countryCode="BI" value="257">Burundi (+257)</option>
                    <option data-countryCode="KH" value="855">Cambodia (+855)</option>
                    <option data-countryCode="CM" value="237">Cameroon (+237)</option>
                    <option data-countryCode="CA" value="1">Canada (+1)</option>
                    <option data-countryCode="CV" value="238">Cape Verde Islands (+238)</option>
                    <option data-countryCode="KY" value="1345">Cayman Islands (+1345)</option>
                    <option data-countryCode="CF" value="236">Central African Republic (+236)</option>
                    <option data-countryCode="TD" value="236">Chad (+235)</option>
                    <option data-countryCode="CL" value="56">Chile (+56)</option>
                    <option data-countryCode="CN" value="86">China (+86)</option>
                    <option data-countryCode="CX" value="61">Christmas Island (+61)</option>
                    <option data-countryCode="CC" value="61">Cocos Islands (+61)</option>
                    <option data-countryCode="CO" value="57">Colombia (+57)</option>
                    <option data-countryCode="KM" value="269">Comoros (+269)</option>
                    <option data-countryCode="CK" value="682">Cook Islands (+682)</option>
                    <option data-countryCode="CR" value="506">Costa Rica (+506)</option>
                    <option data-countryCode="HR" value="385">Croatia (+385)</option>
                    <option data-countryCode="CU" value="53">Cuba (+53)</option>
                    <option data-countryCode="CW" value="599">Curacao (+599)</option>
                    <option data-countryCode="CY" value="357">Cyprus South (+357)</option>
                    <option data-countryCode="CZ" value="420">Czech Republic (+420)</option>
                    <option data-countryCode="CD" value="243">Democratic Republic of the Congo (+243)</option>
                    <option data-countryCode="DK" value="45">Denmark (+45)</option>
                    <option data-countryCode="DJ" value="253">Djibouti (+253)</option>
                    <option data-countryCode="DM" value="1767">Dominica (+1767)</option>
                    <option data-countryCode="DO" value="1809">Dominican Republic (+1809)</option>
                    <option data-countryCode="TL" value="670">East Timor (+670)</option>
                    <option data-countryCode="EC" value="593">Ecuador (+593)</option>
                    <option data-countryCode="EG" value="20">Egypt (+20)</option>
                    <option data-countryCode="SV" value="503">El Salvador (+503)</option>
                    <option data-countryCode="GQ" value="240">Equatorial Guinea (+240)</option>
                    <option data-countryCode="ER" value="291">Eritrea (+291)</option>
                    <option data-countryCode="EE" value="372">Estonia (+372)</option>
                    <option data-countryCode="ET" value="251">Ethiopia (+251)</option>
                    <option data-countryCode="FK" value="500">Falkland Islands (+500)</option>
                    <option data-countryCode="FO" value="298">Faroe Islands (+298)</option>
                    <option data-countryCode="FJ" value="679">Fiji (+679)</option>
                    <option data-countryCode="FI" value="358">Finland (+358)</option>
                    <option data-countryCode="FR" value="33">France (+33)</option>
                    <option data-countryCode="PF" value="689">French Polynesia (+689)</option>
                    <option data-countryCode="GA" value="241">Gabon (+241)</option>
                    <option data-countryCode="GM" value="220">Gambia (+220)</option>
                    <option data-countryCode="GE" value="995">Georgia (+995)</option>
                    <option data-countryCode="DE" value="49">Germany (+49)</option>
                    <option data-countryCode="GH" value="233">Ghana (+233)</option>
                    <option data-countryCode="GI" value="350">Gibraltar (+350)</option>
                    <option data-countryCode="GR" value="30">Greece (+30)</option>
                    <option data-countryCode="GL" value="299">Greenland (+299)</option>
                    <option data-countryCode="GD" value="1473">Grenada (+1473)</option>
                    <option data-countryCode="GU" value="671">Guam (+671)</option>
                    <option data-countryCode="GT" value="502">Guatemala (+502)</option>
                    <option data-countryCode="GG" value="441481">Guernsey (+441481)</option>
                    <option data-countryCode="GN" value="224">Guinea (+224)</option>
                    <option data-countryCode="GW" value="245">Guinea - Bissau (+245)</option>
                    <option data-countryCode="GY" value="592">Guyana (+592)</option>
                    <option data-countryCode="HT" value="509">Haiti (+509)</option>
                    <option data-countryCode="HN" value="504">Honduras (+504)</option>
                    <option data-countryCode="HK" value="852">Hong Kong (+852)</option>
                    <option data-countryCode="HU" value="36">Hungary (+36)</option>
                    <option data-countryCode="IS" value="354">Iceland (+354)</option>
                    <option data-countryCode="IN" value="91">India (+91)</option>
                    <option data-countryCode="ID" value="62">Indonesia (+62)</option>
                    <option data-countryCode="IR" value="98">Iran (+98)</option>
                    <option data-countryCode="IQ" value="964">Iraq (+964)</option>
                    <option data-countryCode="IE" value="353">Ireland (+353)</option>
                    <option data-countryCode="IM" value="44-1624">Isle of Man (+44-1624)</option>
                    <option data-countryCode="IL" value="972">Israel (+972)</option>
                    <option data-countryCode="IT" value="39">Italy (+39)</option>
                    <option data-countryCode="CI" value="225">Ivory Coast (+225)</option>
                    <option data-countryCode="JM" value="1876">Jamaica (+1876)</option>
                    <option data-countryCode="JP" value="81">Japan (+81)</option>
                    <option data-countryCode="JE" value="44-1534">Jersey (+44-1534)</option>
                    <option data-countryCode="JO" value="962">Jordan (+962)</option>
                    <option data-countryCode="KZ" value="7">Kazakhstan (+7)</option>
                    <option data-countryCode="KE" value="254">Kenya (+254)</option>
                    <option data-countryCode="KI" value="686">Kiribati (+686)</option>
                    <option data-countryCode="XK" value="383">Kosovo (+383)</option>
                    <option data-countryCode="KW" value="965">Kuwait (+965)</option>
                    <option data-countryCode="KG" value="996">Kyrgyzstan (+996)</option>
                    <option data-countryCode="LA" value="856">Laos (+856)</option>
                    <option data-countryCode="LV" value="371">Latvia (+371)</option>
                    <option data-countryCode="LB" value="961">Lebanon (+961)</option>
                    <option data-countryCode="LS" value="266">Lesotho (+266)</option>
                    <option data-countryCode="LR" value="231">Liberia (+231)</option>
                    <option data-countryCode="LY" value="218">Libya (+218)</option>
                    <option data-countryCode="LI" value="417">Liechtenstein (+417)</option>
                    <option data-countryCode="LT" value="370">Lithuania (+370)</option>
                    <option data-countryCode="LU" value="352">Luxembourg (+352)</option>
                    <option data-countryCode="MO" value="853">Macao (+853)</option>
                    <option data-countryCode="MK" value="389">Macedonia (+389)</option>
                    <option data-countryCode="MG" value="261">Madagascar (+261)</option>
                    <option data-countryCode="MW" value="265">Malawi (+265)</option>
                    <option data-countryCode="MY" value="60">Malaysia (+60)</option>
                    <option data-countryCode="MV" value="960">Maldives (+960)</option>
                    <option data-countryCode="ML" value="223">Mali (+223)</option>
                    <option data-countryCode="MT" value="356">Malta (+356)</option>
                    <option data-countryCode="MH" value="692">Marshall Islands (+692)</option>
                    <option data-countryCode="MQ" value="596">Martinique (+596)</option>
                    <option data-countryCode="MR" value="222">Mauritania (+222)</option>
                    <option data-countryCode="YT" value="269">Mayotte (+269)</option>
                    <option data-countryCode="MX" value="52">Mexico (+52)</option>
                    <option data-countryCode="FM" value="691">Micronesia (+691)</option>
                    <option data-countryCode="MD" value="373">Moldova (+373)</option>
                    <option data-countryCode="MC" value="377">Monaco (+377)</option>
                    <option data-countryCode="MN" value="976">Mongolia (+976)</option>
                    <option data-countryCode="ME" value="382">Montenegro (+382)</option>
                    <option data-countryCode="MS" value="1664">Montserrat (+1664)</option>
                    <option data-countryCode="MA" value="212">Morocco (+212)</option>
                    <option data-countryCode="MZ" value="258">Mozambique (+258)</option>
                    <option data-countryCode="MN" value="95">Myanmar (+95)</option>
                    <option data-countryCode="NA" value="264">Namibia (+264)</option>
                    <option data-countryCode="NR" value="674">Nauru (+674)</option>
                    <option data-countryCode="NP" value="977">Nepal (+977)</option>
                    <option data-countryCode="NL" value="31">Netherlands (+31)</option>
                    <option data-countryCode="NL" value="599">Netherlands Antilles (+599)</option>
                    <option data-countryCode="NC" value="687">New Caledonia (+687)</option>
                    <option data-countryCode="NZ" value="64">New Zealand (+64)</option>
                    <option data-countryCode="NI" value="505">Nicaragua (+505)</option>
                    <option data-countryCode="NE" value="227">Niger (+227)</option>
                    <option data-countryCode="NG" value="234">Nigeria (+234)</option>
                    <option data-countryCode="NU" value="683">Niue (+683)</option>
                    <option data-countryCode="KP" value="850">North Korea (+850)</option>
                    <option data-countryCode="NP" value="670">Northern Marianas (+670)</option>
                    <option data-countryCode="NO" value="47">Norway (+47)</option>
                    <option data-countryCode="OM" value="968">Oman (+968)</option>
                    <option data-countryCode="PK" value="92">Pakistan (+92)</option>
                    <option data-countryCode="PW" value="680">Palau (+680)</option>
                    <option data-countryCode="PS" value="970">Palestine (+970)</option>
                    <option data-countryCode="PA" value="507">Panama (+507)</option>
                    <option data-countryCode="PG" value="675">Papua New Guinea (+675)</option>
                    <option data-countryCode="PY" value="595">Paraguay (+595)</option>
                    <option data-countryCode="PE" value="51">Peru (+51)</option>
                    <option data-countryCode="PH" value="63" selected="selected">Philippines (+63)</option>
                    <option data-countryCode="PL" value="48">Poland (+48)</option>
                    <option data-countryCode="PT" value="351">Portugal (+351)</option>
                    <option data-countryCode="PR" value="1787">Puerto Rico (+1787)</option>
                    <option data-countryCode="QA" value="974">Qatar (+974)</option>
                    <option data-countryCode="CG" value="974">Republic of the Congo (+242)</option>
                    <option data-countryCode="RE" value="262">Reunion (+262)</option>
                    <option data-countryCode="RO" value="40">Romania (+40)</option>
                    <option data-countryCode="RU" value="7">Russia (+7)</option>
                    <option data-countryCode="RW" value="250">Rwanda (+250)</option>
                    <option data-countryCode="BL" value="590">Saint Barthelemy (+590)</option>
                    <option data-countryCode="SH" value="290">Saint Helena (+290)</option>
                    <option data-countryCode="KN" value="1869">Saint Kitts (+1869)</option>
                    <option data-countryCode="SC" value="1758">Saint Lucia (+1758)</option>
                    <option data-countryCode="MF" value="590">Saint Martin (+590)</option>
                    <option data-countryCode="PM" value="508">Saint Pierre &amp; Miquelon (+508)</option>
                    <option data-countryCode="VC" value="1784">Saint Vincent &amp; the Grenadines (+1784)</option>
                    <option data-countryCode="WS" value="685">Samoa (+685)</option>
                    <option data-countryCode="SM" value="378">San Marino (+378)</option>
                    <option data-countryCode="ST" value="239">Sao Tome &amp; Principe (+239)</option>
                    <option data-countryCode="SA" value="966">Saudi Arabia (+966)</option>
                    <option data-countryCode="SN" value="221">Senegal (+221)</option>
                    <option data-countryCode="CS" value="381">Serbia (+381)</option>
                    <option data-countryCode="SC" value="248">Seychelles (+248)</option>
                    <option data-countryCode="SL" value="232">Sierra Leone (+232)</option>
                    <option data-countryCode="SG" value="65">Singapore (+65)</option>
                    <option data-countryCode="SX" value="1721">Sint Maarten (+1721)</option>
                    <option data-countryCode="SK" value="421">Slovak Republic (+421)</option>
                    <option data-countryCode="SI" value="386">Slovenia (+386)</option>
                    <option data-countryCode="SB" value="677">Solomon Islands (+677)</option>
                    <option data-countryCode="SO" value="252">Somalia (+252)</option>
                    <option data-countryCode="ZA" value="27">South Africa (+27)</option>
                    <option data-countryCode="KR" value="82">South Korea (+82)</option>
                    <option data-countryCode="SS" value="211">South Sudan (+211)</option>
                    <option data-countryCode="ES" value="34">Spain (+34)</option>
                    <option data-countryCode="LK" value="94">Sri Lanka (+94)</option>
                    <option data-countryCode="SD" value="249">Sudan (+249)</option>
                    <option data-countryCode="SR" value="597">Suriname (+597)</option>
                    <option data-countryCode="SJ" value="47">Svalbard &amp; Jan Mayen (+47)</option>
                    <option data-countryCode="SZ" value="268">Swaziland (+268)</option>
                    <option data-countryCode="SE" value="46">Sweden (+46)</option>
                    <option data-countryCode="CH" value="41">Switzerland (+41)</option>
                    <option data-countryCode="SI" value="963">Syria (+963)</option>
                    <option data-countryCode="TW" value="886">Taiwan (+886)</option>
                    <option data-countryCode="TJ" value="7">Tajikstan (+7)</option>
                    <option data-countryCode="TZ" value="255">Tanzania (+255)</option>
                    <option data-countryCode="TH" value="66">Thailand (+66)</option>
                    <option data-countryCode="TG" value="228">Togo (+228)</option>
                    <option data-countryCode="TK" value="690">Tokelau (+690)</option>
                    <option data-countryCode="TO" value="676">Tonga (+676)</option>
                    <option data-countryCode="TT" value="1868">Trinidad &amp; Tobago (+1868)</option>
                    <option data-countryCode="TN" value="216">Tunisia (+216)</option>
                    <option data-countryCode="TR" value="90">Turkey (+90)</option>
                    <option data-countryCode="TM" value="993">Turkmenistan (+993)</option>
                    <option data-countryCode="TC" value="1649">Turks &amp; Caicos Islands (+1649)</option>
                    <option data-countryCode="TV" value="688">Tuvalu (+688)</option>
                    <option data-countryCode="VI" value="84">Virgin Islands - US (+1340)</option>
                    <option data-countryCode="UG" value="256">Uganda (+256)</option>
                    <option data-countryCode="UA" value="380">Ukraine (+380)</option>
                    <option data-countryCode="AE" value="971">United Arab Emirates (+971)</option>
                    <option data-countryCode="GB" value="44">United Kingdom (+44)</option>
                    <option data-countryCode="US" value="1">United States (+1)</option>
                    <option data-countryCode="UY" value="598">Uruguay (+598)</option>
                    <option data-countryCode="UZ" value="7">Uzbekistan (+7)</option>
                    <option data-countryCode="VU" value="678">Vanuatu (+678)</option>
                    <option data-countryCode="VA" value="379">Vatican City (+379)</option>
                    <option data-countryCode="VE" value="58">Venezuela (+58)</option>
                    <option data-countryCode="VN" value="84">Vietnam (+84)</option>
                    <option data-countryCode="WF" value="681">Wallis &amp; Futuna (+681)</option>
                    <option data-countryCode="EH" value="212">Western Sahara (+212)</option>
                    <option data-countryCode="YE" value="967">Yemen (South)(+967)</option>
                    <option data-countryCode="ZM" value="260">Zambia (+260)</option>
                    <option data-countryCode="ZW" value="263">Zimbabwe (+263)</option>
                  </select>
                </div>
                <div class="col-xs-12 col-md-6">
                  <label for="contact_num">Contact Number</label>
                  <input type="text" class="form-control" id="contact_num" name="contact_num" aria-describedby="contactHelp" required>
                </div>
              </div>
            </div>
          </div>
          <div class="col-6">
            <div class="form-group">
              <label for="country">Country</label>
              <select class="form-control" id="country" name="country" autocomplete="off" required>
                <option value="Philippines">Philippines</option>
                <option value="United States">United States</option>
                <option value="United Kingdom">United Kingdom</option>
                <option value="Afghanistan">Afghanistan</option>
                <option value="Albania">Albania</option>
                <option value="Algeria">Algeria</option>
                <option value="American Samoa">American Samoa</option>
                <option value="Andorra">Andorra</option>
                <option value="Angola">Angola</option>
                <option value="Anguilla">Anguilla</option>
                <option value="Antarctica">Antarctica</option>
                <option value="Antigua and Barbuda">Antigua and Barbuda</option>
                <option value="Argentina">Argentina</option>
                <option value="Armenia">Armenia</option>
                <option value="Aruba">Aruba</option>
                <option value="Australia">Australia</option>
                <option value="Austria">Austria</option>
                <option value="Azerbaijan">Azerbaijan</option>
                <option value="Bahamas">Bahamas</option>
                <option value="Bahrain">Bahrain</option>
                <option value="Bangladesh">Bangladesh</option>
                <option value="Barbados">Barbados</option>
                <option value="Belarus">Belarus</option>
                <option value="Belgium">Belgium</option>
                <option value="Belize">Belize</option>
                <option value="Benin">Benin</option>
                <option value="Bermuda">Bermuda</option>
                <option value="Bhutan">Bhutan</option>
                <option value="Bolivia">Bolivia</option>
                <option value="Bosnia and Herzegovina">Bosnia and Herzegovina</option>
                <option value="Botswana">Botswana</option>
                <option value="Bouvet Island">Bouvet Island</option>
                <option value="Brazil">Brazil</option>
                <option value="British Indian Ocean Territory">British Indian Ocean Territory</option>
                <option value="Brunei Darussalam">Brunei Darussalam</option>
                <option value="Bulgaria">Bulgaria</option>
                <option value="Burkina Faso">Burkina Faso</option>
                <option value="Burundi">Burundi</option>
                <option value="Cambodia">Cambodia</option>
                <option value="Cameroon">Cameroon</option>
                <option value="Canada">Canada</option>
                <option value="Cape Verde">Cape Verde</option>
                <option value="Cayman Islands">Cayman Islands</option>
                <option value="Central African Republic">Central African Republic</option>
                <option value="Chad">Chad</option>
                <option value="Chile">Chile</option>
                <option value="China">China</option>
                <option value="Christmas Island">Christmas Island</option>
                <option value="Cocos (Keeling) Islands">Cocos (Keeling) Islands</option>
                <option value="Colombia">Colombia</option>
                <option value="Comoros">Comoros</option>
                <option value="Congo">Congo</option>
                <option value="Congo, The Democratic Republic of The">Congo, The Democratic Republic of The</option>
                <option value="Cook Islands">Cook Islands</option>
                <option value="Costa Rica">Costa Rica</option>
                <option value="Cote D'ivoire">Cote D'ivoire</option>
                <option value="Croatia">Croatia</option>
                <option value="Cuba">Cuba</option>
                <option value="Cyprus">Cyprus</option>
                <option value="Czech Republic">Czech Republic</option>
                <option value="Denmark">Denmark</option>
                <option value="Djibouti">Djibouti</option>
                <option value="Dominica">Dominica</option>
                <option value="Dominican Republic">Dominican Republic</option>
                <option value="Ecuador">Ecuador</option>
                <option value="Egypt">Egypt</option>
                <option value="El Salvador">El Salvador</option>
                <option value="Equatorial Guinea">Equatorial Guinea</option>
                <option value="Eritrea">Eritrea</option>
                <option value="Estonia">Estonia</option>
                <option value="Ethiopia">Ethiopia</option>
                <option value="Falkland Islands (Malvinas)">Falkland Islands (Malvinas)</option>
                <option value="Faroe Islands">Faroe Islands</option>
                <option value="Fiji">Fiji</option>
                <option value="Finland">Finland</option>
                <option value="France">France</option>
                <option value="French Guiana">French Guiana</option>
                <option value="French Polynesia">French Polynesia</option>
                <option value="French Southern Territories">French Southern Territories</option>
                <option value="Gabon">Gabon</option>
                <option value="Gambia">Gambia</option>
                <option value="Georgia">Georgia</option>
                <option value="Germany">Germany</option>
                <option value="Ghana">Ghana</option>
                <option value="Gibraltar">Gibraltar</option>
                <option value="Greece">Greece</option>
                <option value="Greenland">Greenland</option>
                <option value="Grenada">Grenada</option>
                <option value="Guadeloupe">Guadeloupe</option>
                <option value="Guam">Guam</option>
                <option value="Guatemala">Guatemala</option>
                <option value="Guinea">Guinea</option>
                <option value="Guinea-bissau">Guinea-bissau</option>
                <option value="Guyana">Guyana</option>
                <option value="Haiti">Haiti</option>
                <option value="Heard Island and Mcdonald Islands">Heard Island and Mcdonald Islands</option>
                <option value="Holy See (Vatican City State)">Holy See (Vatican City State)</option>
                <option value="Honduras">Honduras</option>
                <option value="Hong Kong">Hong Kong</option>
                <option value="Hungary">Hungary</option>
                <option value="Iceland">Iceland</option>
                <option value="India">India</option>
                <option value="Indonesia">Indonesia</option>
                <option value="Iran, Islamic Republic of">Iran, Islamic Republic of</option>
                <option value="Iraq">Iraq</option>
                <option value="Ireland">Ireland</option>
                <option value="Israel">Israel</option>
                <option value="Italy">Italy</option>
                <option value="Jamaica">Jamaica</option>
                <option value="Japan">Japan</option>
                <option value="Jordan">Jordan</option>
                <option value="Kazakhstan">Kazakhstan</option>
                <option value="Kenya">Kenya</option>
                <option value="Kiribati">Kiribati</option>
                <option value="Korea, Democratic People's Republic of">Korea, Democratic People's Republic of</option>
                <option value="Korea, Republic of">Korea, Republic of</option>
                <option value="Kuwait">Kuwait</option>
                <option value="Kyrgyzstan">Kyrgyzstan</option>
                <option value="Lao People's Democratic Republic">Lao People's Democratic Republic</option>
                <option value="Latvia">Latvia</option>
                <option value="Lebanon">Lebanon</option>
                <option value="Lesotho">Lesotho</option>
                <option value="Liberia">Liberia</option>
                <option value="Libyan Arab Jamahiriya">Libyan Arab Jamahiriya</option>
                <option value="Liechtenstein">Liechtenstein</option>
                <option value="Lithuania">Lithuania</option>
                <option value="Luxembourg">Luxembourg</option>
                <option value="Macao">Macao</option>
                <option value="Macedonia, The Former Yugoslav Republic of">Macedonia, The Former Yugoslav Republic of</option>
                <option value="Madagascar">Madagascar</option>
                <option value="Malawi">Malawi</option>
                <option value="Malaysia">Malaysia</option>
                <option value="Maldives">Maldives</option>
                <option value="Mali">Mali</option>
                <option value="Malta">Malta</option>
                <option value="Marshall Islands">Marshall Islands</option>
                <option value="Martinique">Martinique</option>
                <option value="Mauritania">Mauritania</option>
                <option value="Mauritius">Mauritius</option>
                <option value="Mayotte">Mayotte</option>
                <option value="Mexico">Mexico</option>
                <option value="Micronesia, Federated States of">Micronesia, Federated States of</option>
                <option value="Moldova, Republic of">Moldova, Republic of</option>
                <option value="Monaco">Monaco</option>
                <option value="Mongolia">Mongolia</option>
                <option value="Montserrat">Montserrat</option>
                <option value="Morocco">Morocco</option>
                <option value="Mozambique">Mozambique</option>
                <option value="Myanmar">Myanmar</option>
                <option value="Namibia">Namibia</option>
                <option value="Nauru">Nauru</option>
                <option value="Nepal">Nepal</option>
                <option value="Netherlands">Netherlands</option>
                <option value="Netherlands Antilles">Netherlands Antilles</option>
                <option value="New Caledonia">New Caledonia</option>
                <option value="New Zealand">New Zealand</option>
                <option value="Nicaragua">Nicaragua</option>
                <option value="Niger">Niger</option>
                <option value="Nigeria">Nigeria</option>
                <option value="Niue">Niue</option>
                <option value="Norfolk Island">Norfolk Island</option>
                <option value="Northern Mariana Islands">Northern Mariana Islands</option>
                <option value="Norway">Norway</option>
                <option value="Oman">Oman</option>
                <option value="Pakistan">Pakistan</option>
                <option value="Palau">Palau</option>
                <option value="Palestinian Territory, Occupied">Palestinian Territory, Occupied</option>
                <option value="Panama">Panama</option>
                <option value="Papua New Guinea">Papua New Guinea</option>
                <option value="Paraguay">Paraguay</option>
                <option value="Peru">Peru</option>
                <option value="Philippines" selected="selected">Philippines</option>
                <option value="Pitcairn">Pitcairn</option>
                <option value="Poland">Poland</option>
                <option value="Portugal">Portugal</option>
                <option value="Puerto Rico">Puerto Rico</option>
                <option value="Qatar">Qatar</option>
                <option value="Reunion">Reunion</option>
                <option value="Romania">Romania</option>
                <option value="Russian Federation">Russian Federation</option>
                <option value="Rwanda">Rwanda</option>
                <option value="Saint Helena">Saint Helena</option>
                <option value="Saint Kitts and Nevis">Saint Kitts and Nevis</option>
                <option value="Saint Lucia">Saint Lucia</option>
                <option value="Saint Pierre and Miquelon">Saint Pierre and Miquelon</option>
                <option value="Saint Vincent and The Grenadines">Saint Vincent and The Grenadines</option>
                <option value="Samoa">Samoa</option>
                <option value="San Marino">San Marino</option>
                <option value="Sao Tome and Principe">Sao Tome and Principe</option>
                <option value="Saudi Arabia">Saudi Arabia</option>
                <option value="Senegal">Senegal</option>
                <option value="Serbia and Montenegro">Serbia and Montenegro</option>
                <option value="Seychelles">Seychelles</option>
                <option value="Sierra Leone">Sierra Leone</option>
                <option value="Singapore">Singapore</option>
                <option value="Slovakia">Slovakia</option>
                <option value="Slovenia">Slovenia</option>
                <option value="Solomon Islands">Solomon Islands</option>
                <option value="Somalia">Somalia</option>
                <option value="South Africa">South Africa</option>
                <option value="South Georgia and The South Sandwich Islands">South Georgia and The South Sandwich Islands</option>
                <option value="Spain">Spain</option>
                <option value="Sri Lanka">Sri Lanka</option>
                <option value="Sudan">Sudan</option>
                <option value="Suriname">Suriname</option>
                <option value="Svalbard and Jan Mayen">Svalbard and Jan Mayen</option>
                <option value="Swaziland">Swaziland</option>
                <option value="Sweden">Sweden</option>
                <option value="Switzerland">Switzerland</option>
                <option value="Syrian Arab Republic">Syrian Arab Republic</option>
                <option value="Taiwan, Province of China">Taiwan, Province of China</option>
                <option value="Tajikistan">Tajikistan</option>
                <option value="Tanzania, United Republic of">Tanzania, United Republic of</option>
                <option value="Thailand">Thailand</option>
                <option value="Timor-leste">Timor-leste</option>
                <option value="Togo">Togo</option>
                <option value="Tokelau">Tokelau</option>
                <option value="Tonga">Tonga</option>
                <option value="Trinidad and Tobago">Trinidad and Tobago</option>
                <option value="Tunisia">Tunisia</option>
                <option value="Turkey">Turkey</option>
                <option value="Turkmenistan">Turkmenistan</option>
                <option value="Turks and Caicos Islands">Turks and Caicos Islands</option>
                <option value="Tuvalu">Tuvalu</option>
                <option value="Uganda">Uganda</option>
                <option value="Ukraine">Ukraine</option>
                <option value="United Arab Emirates">United Arab Emirates</option>
                <option value="United Kingdom">United Kingdom</option>
                <option value="United States">United States</option>
                <option value="United States Minor Outlying Islands">United States Minor Outlying Islands</option>
                <option value="Uruguay">Uruguay</option>
                <option value="Uzbekistan">Uzbekistan</option>
                <option value="Vanuatu">Vanuatu</option>
                <option value="Venezuela">Venezuela</option>
                <option value="Viet Nam">Viet Nam</option>
                <option value="Virgin Islands, British">Virgin Islands, British</option>
                <option value="Virgin Islands, U.S.">Virgin Islands, U.S.</option>
                <option value="Wallis and Futuna">Wallis and Futuna</option>
                <option value="Western Sahara">Western Sahara</option>
                <option value="Yemen">Yemen</option>
                <option value="Zambia">Zambia</option>
                <option value="Zimbabwe">Zimbabwe</option>
              </select>
            </div>
          </div>
          <div class="col-12">
            <hr>
            <h4 class="reg_header"><span class="form-step">3</span> Privacy Policy </h4>
          </div>
          <div class="col-6">
            <div class="form-check">
              <input class="form-check-input" type="checkbox" value="" id="terms">
              <label class="form-check-label" for="terms">
                I consent to the Terms & Conditions.
              </label>
            </div>
          </div>
          <div class="col-6">
            <div class="form-check">
              <input class="form-check-input" type="checkbox" value="" id="privacy">
              <label class="form-check-label" for="privacy">
                I consent to the Data Privacy Policy, and I'm at least 18 years old.
              </label>
              <label>
                To use this service, you must meet this minimum age requirement.
              </label>
            </div>
          </div>
          <div class="col-12 mb-3">
            <hr>
            <h4 class="reg_header"><span class="form-step">4</span> Your payment information </h4>
            <span>Your card won't be charged for 7 days. If you cancel before then, your card won't be charged.</span><br>
            <span>You will be charged ₱459 per month when your trial ends.</span>
          </div>
          <div class="col-5">
            <div class="form-group" id="card-number-field">
                <label for="cardNumber">Card Number</label>
                <input type="text" class="form-control" id="cardNumber" required>
            </div>
          </div>
          <div class="col-3">
            <div class="form-group owner">
                <label for="postal">Postal/Zip</label>
                <input type="text" class="form-control" id="postal" required>
            </div>
          </div>
          <div class="col-3">
            <div class="form-group">
                <label for="cvv">CVV</label>
                <input type="text" class="form-control" id="cvv" required>
            </div>
          </div>

          <div class="col-4">
            <div class="form-group">
                <label for="month">Month</label>
                <select class="form-control" id="month" name="month" autocomplete="off" required>
                    <option value="01">1 - January</option>
                    <option value="02">2 - February </option>
                    <option value="03">3 - March</option>
                    <option value="04">4 - April</option>
                    <option value="05">5 - May</option>
                    <option value="06">6 - June</option>
                    <option value="07">7 - July</option>
                    <option value="08">8 - August</option>
                    <option value="09">9 - September</option>
                    <option value="10">10 - October</option>
                    <option value="11">11 - November</option>
                    <option value="12">12 - December</option>
                </select>
            </div>
          </div>

          <div class="col-4">
            <div class="form-group">
                <label for="year">Year</label>
                <select class="form-control" id="year" name="year" autocomplete="off" required>
                    <option value="2019"> 2019</option>
                    <option value="2020"> 2020</option>
                    <option value="2021"> 2021</option>
                    <option value="2022"> 2022</option>
                    <option value="2023"> 2023</option>
                    <option value="2024"> 2024</option>
                    <option value="2025"> 2025</option>
                    <option value="2026"> 2026</option>
                </select>
            </div>
          </div>
        </div>
      </form>
    </div>
  </div>
</div>

<!-- <footer class="text-center">
  <div class="container">
  <div class="row">
    <div class="col-md-3">
      <img src="../img/footer_logo.png" class="img-fluid" width="200">
      <p class="footer-copy"> &copy; My White Card 2019 </p>
    </div>

    <div class="col-md-3">
      <h3 class="color-white bold_font footer-title">LEARN MORE</h3>
        <ul class="ul-footer-links">
          <li class="li-footer-links"><a class="a-footer-links" href="../about">ABOUT US </a></li>
          <li class="li-footer-links"><a class="a-footer-links" href="../contact">CONTACT </a></li>
          <li class="li-footer-links"><a class="a-footer-links" href="list-partners.php">PARTNERS</a></li>
          <li class="li-footer-links"><a class="a-footer-links" href="../privacy">PRIVACY</a></li>
          <li class="li-footer-links"><a class="a-footer-links" href="../terms">TERMS</a></li>
          <li class="li-footer-links"><a class="a-footer-links" href="../faq">FAQ</a></li>
        </ul>
    </div>

    <div class="col-md-3">
        <h3 class="color-white bold_font footer-title">CONNECT WITH US</h3>
        <a target="_blank" href="https://www.facebook.com/My-White-Card-PH-361098511090574/?ref=br_rs"><i class="fab fa-facebook footer-social"></i></a>
        <a target="_blank" href="https://twitter.com/mywhitecard"><i class="fab fa-twitter footer-social"></i></a>
        <a target="_blank" href="https://www.instagram.com/mywhitecardph/"><i class="fab fa-instagram footer-social"></i></a>
    </div>

    <div class="col-md-3">
      <div class="col-md-12">
        <a target="_blank" href="https://itunes.apple.com/ph/app/mywhitecard/id1452460708?mt=8"><img src="../img/mobile_ios.png" class="img-fluid footer-mobile"></a>
        <a target="_blank" href="https://play.google.com/store/apps/details?id=ph.app.mywhitecard"><img src="../img/mobile_google.png" class="img-fluid footer-mobile"></a>
      </div>
    </div>
  </div>
</div>
</footer> -->

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <!-- <script src="../_lib/v/bootstrap/js/bootstrap.min.js"></script> -->

    <script src="js/cms.js"></script>
    <script src="../pages/js/modal_popup.js"></script>
    <script src="js/form_validation.js"></script>
    <script src="js/contact_number_check.js"></script>

    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<!--
    <script>
    function recaptchaCallback() {
    $('#register').removeAttr('disabled');
      };
    </script> -->

    <script>
      $(document).ready(function(){
        $(".pop-alert").hide().slideDown(900);

        $(".button-pop").click(function(){
          $(".pop-alert").slideUp("slow");
        });
      });
    </script>

  </body>
</html>
