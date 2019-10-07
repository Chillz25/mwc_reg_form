<?php

  require '_lib/c/flight/Flight.php';

  Flight::route('/', function(){
    $rootPath = '';
    require_once('pages/main.php');
  });

  Flight::route('/main', function(){
    $rootPath = '';
    require_once('pages/main.php');
  });

  // Flight::route('/welcome', function(){
  //   $rootPath = '';
  //   require_once('cards/welcome.php');
  // });

  Flight::route('/about', function(){
    $rootPath = '';
    require_once('pages/about.php');
  });

  Flight::route('/form', function(){
    $rootPath = '';
    require_once('pages/paymaya-form.php');
  });

  Flight::route('/contact', function(){
    $rootPath = '';
    require_once('pages/contact.php');
  });

  Flight::route('/faq', function(){
    $rootPath = '';
    require_once('pages/faq.php');
  });

  Flight::route('/privacy', function(){
    $rootPath = '';
    require_once('pages/privacy.php');
  });

  Flight::route('/terms', function(){
    $rootPath = '';
    require_once('pages/terms.php');
  });

  Flight::route('/articles', function(){
    $rootPath = '';
    require_once('pages/articles.php');
  });

  Flight::route('/career', function(){
    $rootPath = '';
    require_once('pages/career.php');
  });

  Flight::route('/qrcode', function(){
    $rootPath = '';
    require_once('pages/qrcode.php');
  });

  Flight::route('/app', function(){
    $rootPath = '';
    require_once('pages/app.php');
  });

  Flight::route('/signout', function(){
    $rootPath = '';
    require_once('pages/signout.php');
  });

  Flight::start();
