<?php

  // route middleware for simple API authentication
  $app->get('/authenticate', function() use ($app) {
    if ($_SESSION['id']){
      $app->render(200,array(
        'msg' => 'Passed Authentication',
        'data' => array('result', 1),
        'error' => false
      ));
    }else{
      $app->render(401,array(
        'msg' => 'Failed Authentication',
        'data' => array('result', 0),
        'error' => true
      ));
    }
  });

  $app->post('/login', function() use ($app) { //This should only flow over HTTPS connections as the password is coming in plain text.
    $request = $app->request();
    $body = $request->getBody();
    $input = json_decode($body);

    $email = $input->email;
    $spass = sha1($input->password);

    $dbh = getConnection();
    $stmt = $dbh->prepare("select * from user where email like :email and password=:pass");
    $stmt->bindParam(':email', $email, PDO::PARAM_STR, 50);
    $stmt->bindParam(':pass', $spass, PDO::PARAM_STR, 50);
    $stmt->execute();
    if($result = $stmt->fetch(PDO::FETCH_ASSOC)){
      $_SESSION['id'] = $result['id'];
      $_SESSION['fname'] = $result['fname'];
      $_SESSION['lname'] = $result['lname'];
      $_SESSION['email'] = $result['email'];
      $_SESSION['defaultYear'] = $result['defaultYear'];

      $app->render(200,array(
        'msg' => 'Logged In',
        'data' => $result
      ));
    }else{
      $app->render(401, array(
        'msg' => 'Invalid Username or Password'
      ));
    }
  });

  $app->get('/logout', function() use ($app) {
    unset($_SESSION['id']);
    $app->render(200,array(
      'msg' => 'Logged Out'
    ));
  });
