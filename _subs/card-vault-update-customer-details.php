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

    $secretAPIKey = 'sk-VGDKY3P90NYZZ0kSWqBFaD1NTIXQCxtdS7SbQXvcA4g';
    $secretAPIKey_Base64 = base64_encode($secretAPIKey);

    $data = array(
        'firstName' => '2',
        'middleName' => '2',
        'lastName' => '2',
        'birthday' => '2019-10-01',
        'sex' => 'F',
        'contact' =>
            array(
                'phone' => '2',
                'email' => '2@2.com'
            ),
        'billingAddress' =>
            array(
                'line1' => '2',
                'line2' => '2',
                'city' => '2',
                'state' => '2',
                'zipCode' => '2',
                'countryCode' => 'US'
            ),
        'metadata' =>
            array()
    );

    $payload = json_encode($data);

    $ch = curl_init('https://pg-sandbox.paymaya.com/payments/v1/customers/'.$customerId);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "PUT");
    curl_setopt($ch, CURLOPT_POSTFIELDS, $payload);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array(
        'Content-Type: application/json',
        'Authorization: Basic '.$secretAPIKey_Base64,
        'Content-Lenght: '.strlen($payload))
    );

    $result = curl_exec($ch);
    $httpCodeResponse = curl_getinfo($ch, CURLINFO_HEADER_OUT);
    $error = curl_error($ch);

    curl_close($ch);

    echo $result;

?>