<?php
    $disableDirectExecution = false;
    if ($disableDirectExecution == true) {
        //session_start();
        if ($_SERVER['REQUEST_METHOD']=='GET' && realpath(__FILE__) == realpath( $_SERVER['SCRIPT_FILENAME'])) {
            header('HTTP/1.0 404 Not Found', TRUE, 404);
            //$_SESSION['message'] = '(Error 404) File not found.';
            die(header('location: /?pg=error'));
            exit();
        }
    }
?>

<?php
    $customerId = '77336004-cde7-4c8b-92e7-508cd6152b11';
    $cardTokenId = 'TBaWyGLY0QggUFq66F9dKQN4rqZBtuqmYtsaWffIrrGM3fgBM3sM4HMfOLmFvwaiRZkO6aJdYR3oXv10VXrbE3jEjpo2hLDubBaHDPsXAVEPkCe4UqsjcSIh8VTYMHtybZdqCkCI6lq28xHSYPsYrSHpI6upHWCbRTfSk';

    $secretAPIKey = 'sk-VGDKY3P90NYZZ0kSWqBFaD1NTIXQCxtdS7SbQXvcA4g';
    $secretAPIKey_Base64 = base64_encode($secretAPIKey);

    $ch = curl_init('https://pg-sandbox.paymaya.com/payments/v1/customers/'.$customerId.'/cards/'.$cardTokenId);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array(
        'Content-Type: application/json',
        'Authorization: Basic '.$secretAPIKey_Base64)
    );

    $result = curl_exec($ch);
    $httpCodeResponse = curl_getinfo($ch, CURLINFO_HEADER_OUT);
    $error = curl_error($ch);

    curl_close($ch);

    echo $result;
?>