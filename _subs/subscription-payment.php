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

    $successURL = '';
    $failureURL = 'http://www.google.com';
    $cancelURL = 'http://www.bing.com';

    $paymentTokenId = '';
    $customerId = '';
    $cardTokenId = '';

    if (empty($_GET['q'])) {
        // Do nothing.
        // Redirect to 404.
    } else if ($_GET['q'] == 'subscribe') {
        /**
         * Create payment token.
         */
        $cardNo = $_POST['cardNo'];
        $expMonth = $_POST['expMonth'];
        $expYear = $_POST['expYear'];
        $cvvNo = $_POST['cvvNo'];

        $data = array(
            'card' =>
                array(
                    'number' => $cardNo,
                    'expMonth' => $expMonth,
                    'expYear' => $expYear,
                    'cvc' => $cvvNo
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
        $paymentTokenId = $responsePaymentToken['paymentTokenId'];

        if ($httpCodeResponse === 200) {
            /**
             * Create customer details.
             */
            $firstName = $_POST['firstName'];
            $middleName = $_POST['middleName'];
            $lastName = $_POST['lastName'];
            $birthday = $_POST['birthday'];
            $sex = $_POST['sex'];
            $phone = $_POST['phone'];
            $email = $_POST['email'];
            $line1 = $_POST['line1'];
            $line2 = $_POST['line2'];
            $city = $_POST['city'];
            $state = $_POST['state'];
            $zipCode = $_POST['zipCode'];
            $countryCode = $_POST['countryCode'];
            
            $data = array(
                'firstName' => $firstName,
                'middleName' => $middleName,
                'lastName' => $lastName,
                'birthday' => $birthday,
                'sex' => $sex,
                'contact' =>
                    array(
                        'phone' => $phone,
                        'email' => $email
                    ),
                'billingAddress' =>
                    array(
                        'line1' => $line1,
                        'line2' => $line2,
                        'city' => $city,
                        'state' => $state,
                        'zipCode' => $zipCode,
                        'countryCode' => $countryCode
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
            $customerId = $responseCustomerDetails['id'];

            $data = '';
            $payload = '';
            $ch = '';

            if ($httpCodeResponse == 200) {
                /**
                 * Vault a card. To create cardTokenId.
                 */
                $data = array(
                    'paymentTokenId' => $paymentTokenId,
                    'isDefault' => true,
                    'redirectUrl' =>
                        array(
                            'success' => $successURL,
                            'failure' => $failureURL,
                            'cancel' => $cancelURL
                        )
                    );

                $payload = json_encode($data);

                $ch = curl_init('https://pg-sandbox.paymaya.com/payments/v1/customers/'.$customerId.'/cards');
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

                $responseCardVault = json_decode($result, true);
                $cardTokenId = $responseCardVault['cardTokenId'];
                $verificationUrl = $responseCardVault['verificationUrl'];

                echo $verificationUrl;

                if ($httpCodeResponse == 200) {
                    /**
                     * Subscription: Customer subscription endpoint.
                     */
                    // $datetime = new DateTime('tomorrow');

                    // $subscriptionPlan = $_POST['subscriptionPlan']; // Amount
                    // $description = 'My description.';
                    // $currency = 'PHP';
                    // $interval = 'DAY';
                    // $intervalCount = 30;
                    // $startDate = $datetime->format('Y-m-d');

                    // $data = array(
                    //     'description' => $description,
                    //     'totalAmount' =>
                    //         array(
                    //             'amount' => $subscriptionPlan,
                    //             'currency' => $currency
                    //         ),
                    //     'interval' => $interval,
                    //     'intervalCount' => $intervalCount,
                    //     'startDate' => $startDate
                    // );
                
                    // $payload = json_encode($data);

                    // $ch = curl_init('https://pg-sandbox.paymaya.com/payments/v1/customers/'.$customerId.'/cards/'.$cardTokenId.'/subscriptions');
                    // curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                    // curl_setopt($ch, CURLINFO_HEADER_OUT, true);
                    // curl_setopt($ch, CURLOPT_POST, true);
                    // curl_setopt($ch, CURLOPT_POSTFIELDS, $payload);
                    // curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
                    // curl_setopt($ch, CURLOPT_HTTPHEADER, array(
                    //     'Content-Type: application/json',
                    //     'Authorization: Basic '.$secretAPIKey_Base64,
                    //     'Content-Length: '.strlen($payload))
                    // );
                
                    // $result = curl_exec($ch);
                    // $httpCodeResponse = curl_getinfo($ch, CURLINFO_HTTP_CODE);
                    // $error = curl_error($ch);
                
                    // curl_close($ch);
                
                    // echo $httpCodeResponse;

                    // $ch = '';
                    // $data = '';
                    // $payload = '';

                    // echo $result;
                    
                }

            }
        } else {
            // Error
            exit();
        }
    }
?>