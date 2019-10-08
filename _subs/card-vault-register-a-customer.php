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

    if (!isset($firstName) && $firstName != '' ||
        !isset($lastName) && $lastName != '' ||
        !isset($birthday) && $birthday != '' ||
        !isset($sex) && $sex != '' ||
        !isset($phone) && $phone != '' ||
        !isset($email) && $email != '' ||
        !isset($line1) && $line1 != '' ||
        !isset($line2) && $line2 != '' ||
        !isset($city) && $city != '' ||
        !isset($state) && $state != '' ||
        !isset($zipCode) && $zipCode != '' ||
        !isset($countryCode) && $countryCode != '') {
            $responseData[] = array('result' => 'empty-fields');

            header('Content-Type: application/json');
            $result = json_encode($responseData);
        } else {
            // API Key, change this later.
            $secretAPIKey = 'sk-VGDKY3P90NYZZ0kSWqBFaD1NTIXQCxtdS7SbQXvcA4g';
            $secretAPIKey_Base64 = base64_encode($secretAPIKey);

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
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false); // Change this later, when the web app is in 'https'.

            curl_setopt($ch, CURLOPT_HTTPHEADER, array(
                'Content-Type: application/json',
                'Authorization: Basic '.$secretAPIKey_Base64,
                'Content-Length: '.strlen($payload))
            );

            $result = curl_exec($ch);
            $httpCodeResponse = curl_getinfo($ch, CURLINFO_HEADER_OUT);
            $error = curl_error($ch);

            curl_close($ch);

            echo $result;
        }
?>