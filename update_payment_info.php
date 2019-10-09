<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <title>MWC</title>
  </head>
  <body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <a class="navbar-brand" href="#">MWC</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav mr-auto">
            <li class="nav-item">
              <a class="nav-link" href="main.php">Home <span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle active" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Account
              </a>
              <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                <a class="dropdown-item" href="subscription_details.php">Subscription</a>
                <div class="dropdown-divider"></div>
              </div>
            </li>
          </ul>
        </div>
      </nav>

      <div class="container p-5">
        <h2> Update your credit or debit card. </h2>
        <hr>
        <div>
          <div style="width:400px;" class="mx-auto">
            <div class="row">
              <div class="col-12">
                <div class="form-group" id="card-number-field">
                    <label for="cardNumber">Card Number</label>
                    <input type="text" class="form-control" id="cardNumber" required>
                </div>
              </div>
              <div class="col-6">
                <div class="form-group owner">
                    <label for="postal">Postal/Zip</label>
                    <input type="text" class="form-control" id="postal" required>
                </div>
              </div>
              <div class="col-6">
                <div class="form-group">
                    <label for="cvv">CVV</label>
                    <input type="text" class="form-control" id="cvv" required>
                </div>
              </div>

              <div class="col-6">
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

              <div class="col-6">
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
            <button type="button" class="btn btn-danger btn-block"> SAVE </button>
          </div>
        </div>
      </div>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  </body>
</html>
