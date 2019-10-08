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
    // CHANGE THIS WHEN IN PRODUCTION.
    // Public facing API key.
    $publicFacingAPIKey = 'pk-lNAUk1jk7VPnf7koOT1uoGJoZJjmAxrbjpj6urB8EIA';
    $publicFacingAPIKey_Base64 = base64_encode($publicFacingAPIKey);
    // Secret API Key.
    $secretAPIKey = 'sk-fzukI3GXrzNIUyvXY3n16cji8VTJITfzylz5o5QzZMC';
    $secretAPIKey_Base64 = base64_encode($secretAPIKey);

    /**
     * Subscription: Customer subscription endpoint.
     */
    date_default_timezone_set('Hongkong');
    $datetime = new DateTime('tomorrow');

    session_start();

    $subscriptionPlan = $_SESSION['amount'];
    $description = 'My description.';
    $currency = 'PHP';
    $interval = 'DAY';
    $intervalCount = 30;
    $startDate = $datetime->format('Y-m-d');

    $customerId = $_SESSION['customerId'];
    $cardTokenId = $_SESSION['cardTokenId'];

    $data = array(
        'description' => $description,
        'totalAmount' =>
            array(
                'amount' => $subscriptionPlan,
                'currency' => $currency
            ),
        'interval' => $interval,
        'intervalCount' => $intervalCount,
        'startDate' => $startDate
    );

    $payload = json_encode($data);

    $ch = curl_init('https://pg-sandbox.paymaya.com/payments/v1/customers/'.$customerId.'/cards/'.$cardTokenId.'/subscriptions');
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLINFO_HEADER_OUT, true);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $payload);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array(
        'Content-Type: application/json',
        'Authorization: Basic '.$secretAPIKey_Base64,
        'Content-Length: '.strlen($payload))
    );

    $result = curl_exec($ch);
    $httpCodeResponse = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    $error = curl_error($ch);

    curl_close($ch);

    echo $httpCodeResponse;

    $ch = '';
    $data = '';
    $payload = '';

    echo $result;

    session_destroy();
?>
