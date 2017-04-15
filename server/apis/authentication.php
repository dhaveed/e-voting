<?php
$app->get('/session', function() {
    $db = new DbHandler();
    $session = $db->getSession();
    $response["_id"] = $session['_id'];
    $response["username"] = $session['username'];
    $response["email"] = $session['email'];
    $response["firstname"] = $session['firstname'];
    $response["lastname"] = $session['lastname'];
    $response["createdAt"] = $session['createdAt'];
    echoResponse(200, $session);
});

$app->post('/join', function() use ($app){
    require_once 'passwordHash.php';
    $response = array();
    $r = json_decode($app->request->getBody());
    verifyRequiredParams(array('fullname','matricnumber','email','password'),$r);
    

    $db = new DbHandler();


    $nom = $r->fullname;
    $schoolnum = $r->matricnumber;
    $mailbox = $r->email;
    $key = $r->password;



    $checkExistence = $db->getOneRecord("SELECT * FROM peanuts WHERE email='$mailbox' or matnum='$schoolnum'");

    //echoResponse(200, $r);

    if(!$checkExistence){
        $r->mailbox = $mailbox;
        $r->matnum = $schoolnum;
        $r->secret_key = passwordHash::hash($key);
        $r->clearText = $r->password;
    
        $cols = array('fullname', 'email', 'matnum', 'secret_key','clearText');
        $joinQuery = $db->insertIntoTable($r, $cols, 'peanuts');

        if($joinQuery != null){
            $response["status"] = "success";
            $response["message"] = "Successfully Registered";
            echoResponse(200, $response);
        } else {
            $response["status"] = "error";
            $response["message"] = "An error occured while registering you. Please try again";
            echoResponse(201, $response);
        }
    } else{
        $response['message'] = "Sorry that email or matric number has already been registered";
        $response['status'] = 'error';
        echoResponse(201, $response);
    }
});

$app->post('/login', function() use ($app) {
    require_once 'passwordHash.php';
    $r = json_decode($app->request->getBody());
    verifyRequiredParams(array('matricnumber', 'password'),$r);
    $response = array();
    $db = new DbHandler();

    $matnum = $r->matricnumber;
    $r->matnum = $matnum;
    $password = $r->password;
    $r->secret_key = $password;

    $user = $db->getOneRecord("select _id,fullname, email, secret_key, matnum from peanuts where matnum='$matnum'");
    if ($user != NULL) {
        if(passwordHash::check_password($user['secret_key'],$password)){
            $response['status'] = "success";
            $response['message'] = 'Login was successful';
            $response['_id'] = $user['_id'];
            $response['fullname'] = $user['fullname'];
            $response['email'] = $user['email'];
            $response['matnum'] = $user['matnum'];

            if (!isset($_SESSION)) {
                session_start();
            }

            $_SESSION['_id'] = $user['_id'];
            $_SESSION['fullname'] = $user['fullname'];
            $_SESSION['email'] = $user['email'];
            $_SESSION['matnum'] = $user['matnum'];

            echoResponse(200, $response);
        } else {
            $response['status'] = "error";
            $response['message'] = 'Login failed. Incorrect credentials';
            echoResponse(201, $response);
        }
    }else {
            $response['status'] = "error";
            $response['message'] = 'No such user is registered';
            echoResponse(201, $response);
        }

});

$app->post('/forgotPass', function() use ($app) {
    require_once 'passwordHash.php';
    $r = json_decode($app->request->getBody());
    verifyRequiredParams(array('email'),$r);
    $response = array();
    $db = new DbHandler();
    $email = $r->email;
    $user = $db->getOneRecord("select _id, username, email from admin where email='$email' or username='$email'");
    if ($user != NULL && sendResetMail($user['username'],$user['email'])) {
        $response['status'] = "success";
        $response['message'] = 'Password Reset Code has been sent to your email';
    }else {
            $response['status'] = "error";
            $response['message'] = 'Email address does not exist';
        }
    echoResponse(200, $response);
});

//CREATE ACCOUNT NOT COMPLETED YET
// $app->post('/createAcct', function() use ($app) {
//     $response = array();
//     $r = json_decode($app->request->getBody());





$app->get('/logout', function() {
    $db = new DbHandler();
    $session = $db->destroySession();
    $response["status"] = "info";
    $response["message"] = "Logged out successfully";
    echoResponse(200, $response);
});
?>
