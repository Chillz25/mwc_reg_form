<!DOCTYPE html>
<html>
<head>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <title>My White Card | Subscribe</title>
</head>
<body class="container-fluid">
    <div class="mx-auto text-center">
        <h3>Subscribing</h3>
        <p class="mt-0 pt-0">Please wait...</p>
        <p>DO NOT CLOSE OR REFRESH THIS PAGE</p>
    </div>
    <?php
        session_start();

        /*************************************
         * CONFIGURATIONS
         *************************************/
        // Public facing API key.
        $publicFacingAPIKey = 'pk-lNAUk1jk7VPnf7koOT1uoGJoZJjmAxrbjpj6urB8EIA';
        $publicFacingAPIKey_Base64 = base64_encode($publicFacingAPIKey);
        // Secret API Key.
        $secretAPIKey = 'sk-fzukI3GXrzNIUyvXY3n16cji8VTJITfzylz5o5QzZMC';
        $secretAPIKey_Base64 = base64_encode($secretAPIKey);

        $host = '127.0.0.1';
        $dbUsername = 'root';
        $dbPassword = '';
        $dbName = 'mwc';
        /* */

        date_default_timezone_set('Asia/Hongkong');
        $datetime = new DateTime('tomorrow');

        $linkConnect = mysqli_connect($host, $dbUsername, $dbPassword, $dbName);

        if (!$linkConnect) {
            echo 'Error: Unable to connect to MySQL.' . PHP_EOL;
            echo 'Debugging Error No: ' . mysqli_connect_error() . PHP_EOL;
            echo 'Debugging Error: ' . mysqli_connect_error() . PHP_EOL;
            exit;
        }

        if ($_SESSION['customerId'] !== '' && $_SESSION['cardTokenId'] !== '') {
            /**
             * Subscription: Customer subscription endpoint.
             */

            $startDate = $datetime->format('Y-m-d');

            $data = array(
                'description' => $_SESSION['description'],
                'totalAmount' =>
                    array(
                        'amount' => $_SESSION['amount'],
                        'currency' => $_SESSION['currency']
                    ),
                'interval' => $_SESSION['subscriptionPlanInterval'],
                'intervalCount' => $_SESSION['subscriptionPlan'],
                'startDate' => $startDate
            );

            $payload = json_encode($data);

            $ch = curl_init('https://pg-sandbox.paymaya.com/payments/v1/customers/'.$_SESSION['customerId'].'/cards/'.$_SESSION['cardTokenId'].'/subscriptions');
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

            $responseSubscription = json_decode($result, true);
            $_SESSION['subscriptionId'] = $responseSubscription['id'];
            $_SESSION['status'] = $responseSubscription['status'];
            $_SESSION['amount'] = $responseSubscription['amount'];
            $_SESSION['currency'] = $responseSubscription['currency'];
            $_SESSION['interval'] = $responseSubscription['interval'];
            $_SESSION['metadata'] = $responseSubscription['metadata'];
            $_SESSION['intervalCount'] = $responseSubscription['intervalCount'];
            $_SESSION['startDate'] = $responseSubscription['startDate'];
            $_SESSION['endDate'] = $responseSubscription['endData'];
            $_SESSION['cancelledAt'] = $responseSubscription['cancelledAt'];
            $_SESSION['createdAt'] = $responseSubscription['createdAt'];
            $_SESSION['updatedAt'] = $responseSubscription['updatedAt'];

            curl_close($ch);

            if ($httpCodeResponse == 200) {
                $sqlQuery = "INSERT INTO
                                    customer_subscription
                                        (
                                            id,
                                            customerId,
                                            description,
                                            status,
                                            amount,
                                            currency,
                                            interval,
                                            metadata,
                                            intervalCount,
                                            startDate,
                                            endDate,
                                            cancelledAt,
                                            dateCreated,
                                            timeCreated,
                                            dateUpdated,
                                            timeUpdated
                                        )
                                VALUES
                                        (
                                            ".$_SESSION['subscriptionId'].",
                                            ".$_SESSION['customerId'].",
                                            ".$_SESSION['description'].",
                                            ".$_SESSION['status'].",
                                            ".$_SESSION['amount'].",
                                            ".$_SESSION['currency'].",
                                            ".$_SESSION['interval'].",
                                            ".$_SESSION['metadata'].",
                                            ".$_SESSION['intervalCount'].",
                                            ".$_SESSION['startDate'].",
                                            ".$_SESSION['endData'].",
                                            ".$_SESSION['cancelledAt'].",
                                            ".$datetime->format('Y-m-d').",
                                            ".$datetime->format('H:i:s').",
                                            ".$datetime->format('Y-m-d').",
                                            ".$datetime->format('H:i:s')."
                                        )";

                if (mysqli_query($linkConnect, $sqlQuery)) {
                    // Return to homepage.
                } else {
                    echo 'ERROR';
                    exit;
                }
            } else {
                echo 'ERROR';
                exit;
            }
        } else { ?>            
            <p>ERROR: Please call your adminstrator.</p>
        <? exit;
        }

        $ch = '';
        $data = '';
        $payload = '';

        //echo $result;
    ?>
    <? if ($httpCodeResponse == 200) { ?>
        <p>Thank you for subscribing, redirecting to home page...</p>
    <? } else { ?>
        <p><? echo $result; ?></p>
    <? } ?>
</body>
</html>

