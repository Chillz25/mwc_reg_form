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
    $paymentTokenId = $_POST['ptid'];

    if (isset($paymentTokenId) && $paymentTokenId != '') {
        $responseData[] = array('result' => 'empty-fields');
    } else {

        // API Key, change this later.
        $secretAPIKey = 'sk-VGDKY3P90NYZZ0kSWqBFaD1NTIXQCxtdS7SbQXvcA4g';
        $secretAPIKey_Base64 = base64_encode($secretAPIKey);
    }
?>