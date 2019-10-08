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
    // $cardNo = $_POST['cardNo'];
    // $cardExpMonth = $_POST['expMonth'];
    // $cardExpYear = $_POST['expYear'];
    // $cardCVCNo = $_POST['cvcNo'];

    $cardNo = '5424820003325881';
    $expMonth = '05';
    $expYear = '2021';
    $cvcNo = '346';

    // API Key, change this later.
    $publicFacingAPIKey = 'pk-yaj6GVzYkce52R193RIWpuRR5tTZKqzBWsUeCkP9EAf';
    $publicFacingAPIKey_Base64 = base64_encode($publicFacingAPIKey);        

    $data = array( 
        'card' =>
            array(
                'number' => $cardNo, 
                'expMonth' => $expMonth, 
                'expYear' => $expYear, 
                'cvc' => $cvcNo
            )
    );

    $payLoad = json_encode($data);

    $ch = curl_init('https://pg-sandbox.paymaya.com/payments/v1/payment-tokens');
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLINFO_HEADER_OUT, true);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $payLoad);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false); // Change this later, when the website is on 'https'.
    
    curl_setopt($ch, CURLOPT_HTTPHEADER, array(
        'Content-Type: application/json',
        'Authorization: Basic '.$publicFacingAPIKey_Base64,
        'Content-Length: '.strlen($payLoad))
    );

    $result = curl_exec($ch);
    $httpCodeResponse = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    $error = curl_error($ch);

    curl_close($ch);

    echo $result;
?>