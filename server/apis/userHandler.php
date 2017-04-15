<?php

$app->get('/viewUser', function() {
    $db = new dbHandler();
    $response = array();
    $resp = $db->getAllRecords("SELECT * FROM users");
    
    $response["status"] = "success";
    $response["users"] = array();
    
    while($user = $resp->fetch_assoc()) {
        $tmp = array();
        $tmp["_id"] = $user["id"];
        $tmp["firstname"] = $user["firstname"];
        $tmp["lastname"] = $user["lastname"];
        $tmp["othername"] = $user["othername"];
        $tmp["college"] = $user["college"];
        $tmp["department"] = $user["department"];
        $tmp["level"] = $user["level"];
        $tmp["hall"] = $user["hall"];
        $tmp["room"] = $user["room"];
        $tmp["reg_no"] = $user["reg_no"];
        $tmp["matric"] = $user["matric"];
        $tmp["email"] = $user["email"];
        $tmp["phone"] = $user["phone"];
        $tmp["created_by"] =  $user["created_by"];
        $tmp["ip_address"] = $user["ip_address"];
        $tmp["date_created"] = $user["date_created"];
        $tmp["date_modified"] = $user["date_modified"];
        array_push($response["users"], $tmp);
    }
    echoResponse(200, $response);
});

$app->post('/addUser', function() use ($app) {
    $response = array();
    $r = json_decode($app->request->getBody());
    verifyRequiredParams(array('firstname', 'lastname', 'othername', 'college', 'department', 'level', 'hall', 'room', 'reg_no', 'matric', 'email', 'phone', 'created_by'),$r);
    $db = new DbHandler();
    $firstname = $r->firstname;
    $lastname = $r->lastname;
    $othername = $r->othername;
    $college = $r->college;
    $department = $r->department;
    $level = $r->level;
    $hall = $r->hall;
    $room = $r->room;
    $reg_no = $r->reg_no;
    $matric = $r->matric;
    $email = $r->email;
    $phone = $r->phone;
    $created_by = $r->created_by;

    $isUserExists = $db->getoneRecord("SELECT 1 from users where firstname='$firstname' or reg_no='$reg_no' or matric='$matric' or email='$email'");
    if(!$isUserExists){
        $table_name = "users";
        $coloum_name = array('firstname', 'lastname', 'othername', 'college', 'department', 'level', 'hall', 'room', 'reg_no', 'matric', 'email', 'phone', 'created_by');
        $result = $db->insertIntoTable($r, $coloum_name, $table_name);
        if($result != null){
            $response["status"] = "success";
            $response["message"] = "User Added";
            echoResponse(200, $response);
        }
        else{
            $response["status"] = "error";
            $response["message"] = "Error Trying To Add User";
            echoResponse(201, $response);
        }}
        else {
            $response["status"] = "error";
            $response["message"] = "User Already Exist";
            echoResponse(201, $response);
        }
});

$app->put('/editUser/:id', function($id) use($app){
    $response = array();
    $r = json_decode($app->request->getBody());
    $condition = array('_id'=>$id);
    verifyRequiredParams(array('firstname', 'lastname', 'othername', 'college', 'department', 'level', 'hall', 'room', 'reg_no', 'matric', 'email', 'phone'),$r);
    $db = new DbHandler();
    $firstname = $r->firstname;
    $lastname = $r->lastname;
    $othername = $r->othername;
    $college = $r->college;
    $department = $r->department;
    $level = $r->level;
    $hall = $r->hall;
    $room =$r->room;
    $reg_no = $r->reg_no;
    $matric = $r->matric;
    $email = $r->email;
    $phone = $r->phone;

    $table_name = "users";
    $coloum_name = array('firstname', 'lastname', 'othername', 'college', 'department', 'level', 'hall', 'room', 'reg_no', 'matric', 'email', 'phone');
    $result = $db->updateTable($r, $coloum_name, $table_name);
    if($result != null){
        $response["status"] = "success";
        $response["message"] = "Update successfull";
        echoResponse(200, $response);
    }
    else{
        $response["status"] = "error";
        $response["message"] = "Update Failed";
        echoResponse(201, $response);
    }
});

$app->delete('/deleteUser/:id', function($id) use($app){
    $response = array();
    $r = json_decode($app->request->getBody());
    $condition = array('_id'=>$id);

    $db = new dbHandler();
    $table_name = "users";
    $result = $db->deleteTable($table_name, $condition);
    if($result != null){
        $response["status"] = "success";
        $response["message"] = "Delete Successfull";
        echoResponse(200, $response);
    }
    else{
        $response["status"] = "error";
        $response["message"] = "Delete Unsuccessfull";
        echoResponse(201, $response);
    }
});
?>