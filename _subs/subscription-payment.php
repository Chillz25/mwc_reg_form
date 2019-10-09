<?php
    $disableDirectExecution = true;
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
    session_start();

    /*************************************
     * CONFIGURATIONS
     *************************************/
    // CHANGE THIS WHEN IN PRODUCTION.
    // Public facing API key.
    $publicFacingAPIKey = 'pk-lNAUk1jk7VPnf7koOT1uoGJoZJjmAxrbjpj6urB8EIA';
    $publicFacingAPIKey_Base64 = base64_encode($publicFacingAPIKey);
    // Secret API Key.
    $secretAPIKey = 'sk-fzukI3GXrzNIUyvXY3n16cji8VTJITfzylz5o5QzZMC';
    $secretAPIKey_Base64 = base64_encode($secretAPIKey);

    $successURL = 'http://test.mywhitecard.ph/subscribe.php';
    $failureURL = 'http://test.mywhitecard.ph/failure.php';
    $cancelURL = 'http://test.mywhitecard.ph/cancel.php'; 

    $host = '127.0.0.1';
    $dbUsername = 'root';
    $dbPassword = '';
    $dbName = 'mwc';
    /* */

    date_default_timezone_set('Asia/Hongkong');
    $datetime = new DateTime();

    $linkConnect = mysqli_connect($host, $dbUsername, $dbPassword, $dbName);

    if (!$linkConnect) {
        echo 'Error: Unable to connect to MySQL.' . PHP_EOL;
        echo 'Debugging Error No: ' . mysqli_connect_error() . PHP_EOL;
        echo 'Debuggin Error: ' . mysqli_connect_error() . PHP_EOL;
        exit;
    }

    if (empty($_GET['q'])) {
        // Do nothing.
        // Redirect to 404.
        exit;
    } else if ($_GET['q'] == 'subscribe') {
        /**
         * Create customer details.
         */
        $_SESSION['firstName'] = $_POST['firstName'];
        $_SESSION['middleName'] = $_POST['middleName'];
        $_SESSION['lastName'] = $_POST['lastName'];
        $_SESSION['birthday'] = $_POST['birthday'];
        $_SESSION['sex'] = $_POST['sex'];
        $_SESSION['phone'] = $_POST['phone'];
        $_SESSION['email'] = $_POST['email'];
        $_SESSION['line1'] = $_POST['line1'];
        $_SESSION['line2'] = $_POST['line2'];
        $_SESSION['city'] = $_POST['city'];
        $_SESSION['state'] = $_POST['state'];
        $_SESSION['zipCode'] = $_POST['zipCode'];
        $_SESSION['countryCode'] = $_POST['countryCode'];

        $_SESSION['subscriptionPlan'] = $_POST['subscriptionPlan'];
        $_SESSION['subscriptionPlanInterval'] = $_POST['subscriptionPlanInterval'];
        $_SESSION['description'] = $_SESSION['subscriptionPlanInterval'];
        $_SESSION['amount'] = $_SESSION['subscriptionPlan'];

        $_SESSION['currency'] = 'PHP';

        $data = array(
            'firstName' => $_SESSION['firstName'],
            'middleName' => $_SESSION['middleName'],
            'lastName' => $_SESSION['lastName'],
            'birthday' => $_SESSION['birthday'],
            'sex' => $_SESSION['sex'],
            'contact' =>
                array(
                    'phone' => $_SESSION['phone'],
                    'email' => $_SESSION['email']
                ),
            'billingAddress' =>
                array(
                    'line1' => $_SESSION['line1'],
                    'line2' => $_SESSION['line2'],
                    'city' => $_SESSION['city'],
                    'state' => $_SESSION['state'],
                    'zipCode' => $_SESSION['zipCode'],
                    'countryCode' => $_SESSION['countryCode']
                ),
            'metadata' =>
                array()
            );

        $payload = json_encode($data);

        $ch = curl_init('https://pg-sandbox.paymaya.com/payments/v1/customers');
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

        $responseCustomerDetails = json_decode($result, true);
        $_SESSION['customerId'] = $responseCustomerDetails['id'];

        $data = '';
        $payload = '';
        $ch = '';

        if ($httpCodeResponse == 200) {
            $sqlQuery = "INSERT INTO
                                customer 
                                    (
                                        id,
                                        firstName, 
                                        middleName, 
                                        lastName, 
                                        birthdate, 
                                        sex, 
                                        phone, 
                                        addressLine1,
                                        addressLine2,
                                        city, 
                                        state, 
                                        zipCode,
                                        countryCode, 
                                        dateCreated,
                                        timeCreated,
                                        dateUpdated, 
                                        timeUpdated
                                    )
                            VALUES 
                                    (
                                        ".$_SESSION['customerId'].",
                                        ".$_SESSION['firstName'].", 
                                        ".$_SESSION['middleName'].", 
                                        ".$_SESSION['lastName'].",
                                        ".$_SESSION['birthday'].", 
                                        ".$_SESSION['sex'].", 
                                        ".$_SESSION['phone'].",
                                        ".$_SESSION['addressLine1'].", 
                                        ".$_SESSION['addressLine2'].", 
                                        ".$_SESSION['city'].",
                                        ".$_SESSION['state'].", 
                                        ".$_SESSION['zipCode'].", 
                                        ".$_SESSION['countryCode'].",
                                        ".$datetime->format('Y-m-d').", 
                                        ".$datetime->format('H:i:s').",
                                        ".$datetime->format('Y-m-d').",
                                        ".$datetime->format('H:i:s')."
                                    )";


            if (mysqli_query($link, $sqlQuery)) {
                /**
                 * Create a payment token.
                 */
                $_SESSION['cardNo'] = $_POST['cardNo'];
                $_SESSION['expMonth'] = $_POST['expMonth'];
                $_SESSION['expYear'] = $_POST['expYear'];
                $_SESSION['cvvNo'] = $_POST['cvvNo'];

                $data = array(
                    'card' =>
                        array(
                            'number' => $_SESSION['cardNo'],
                            'expMonth' => $_SESSION['expMonth'],
                            'expYear' => $_SESSION['expYear'],
                            'cvc' => $_SESSION['cvvNo']
                        )
                    );
                
                $payload = json_encode($data);

                $ch = curl_init('https://pg-sandbox.paymaya.com/payments/v1/payment-tokens');
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                curl_setopt($ch, CURLINFO_HEADER_OUT, true);
                curl_setopt($ch, CURLOPT_POST, true);
                curl_setopt($ch, CURLOPT_POSTFIELDS, $payload);
                curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
                curl_setopt($ch, CURLOPT_HTTPHEADER, array(
                    'Content-Type: application/json',
                    'Authorization: Basic '.$publicFacingAPIKey_Base64,
                    'Content-Length: '.strlen($payload))
                );
        
                $result = curl_exec($ch);
                $httpCodeResponse = curl_getinfo($ch, CURLINFO_HTTP_CODE);
                $error = curl_error($ch);
        
                curl_close($ch);
        
                $data = '';
                $payload = '';
                $ch = '';
        
                $responsePaymentToken = json_decode($result, true);
                $_SESSION['paymentTokenId'] = $responsePaymentToken['paymentTokenId'];
                $_SESSION['isDefault'] = true;               

                /**
                 * Vault a card.
                 */
                $data = array(
                    'paymentTokenId' => $_SESSION['paymentTokenId'],
                    'isDefault' => $_SESSION['isDefault'],
                    'redirectUrl' =>
                        array(
                            'success' => $successURL,
                            'failure' => $failureURL,
                            'cancel' => $cancelURL
                        )
                    );

                $payload = json_encode($data);

                $ch = curl_init('https://pg-sandbox.paymaya.com/payments/v1/customers/'.$_SESSION['customerId'].'/cards');
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

                $data = '';
                $payload = '';
                $ch = '';                

                if ($httpCodeResponse == 200)  {
                    $responseCardVault = json_decode($result, true);
                    $_SESSION['cardTokenId'] = $responseCardVault['cardTokenId'];
                    $_SESSION['cardId'] = $responseCardVault['id'];
                    $_SESSION['verificationUrl'] = $responseCardVault['verificationUrl'];

                    $sqlQuery = "INSERT INTO 
                                        customer_card
                                            (
                                                customerId, 
                                                cardTokenId, 
                                                cardId,
                                                cardNo, 
                                                expirationMonth, 
                                                expirationYear,
                                                cvvNo, 
                                                isDefault, 
                                                dateCreated, 
                                                timeCreated,
                                                dateUpdated, 
                                                timeUpdated
                                            )
                                VALUES 
                                            (
                                                ".$_SESSION['customerId'].", 
                                                ".$_SESSION['cardTokenId'].",
                                                ".$_SESSION['cardId'].",
                                                ".$_SESSION['cardNo'].",
                                                ".$_SESSION['expMonth'].",
                                                ".$_SESSION['expYear'].",
                                                ".$_SESSION['cvvNo'].",
                                                ".$_SESSION['isDefault'].",
                                                ".$datetime->format('Y-m-d').",
                                                ".$datetime->format('H:i:s').",
                                                ".$datetime->format('Y-m-d').",
                                                ".$datetime->format('H:i:s')."
                                            )";

                    if (mysqli_query($linkConnect, $sqlQuery)) { 
                        echo $verificationUrl;
                        mysqli_close($linkConnect);
                    } else {
                        echo 'ERROR: Could not insert record.';
                    }
                } else {
                    echo 'ERROR: Could not insert record.';
                    exit;
                }               
                
            } else {
                echo 'ERROR: Cound not insert record.';
                exit;
            }            
        } else {
            echo 'Error';
        }
    }
?>