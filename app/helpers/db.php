
public function getConnection() {
  try {
    $dbhost="localhost";
    $dbuser="frag_user";
    $dbpass="(6xzu;HH6.4T";
    $dbname="frag_reports";
    $dbh = new PDO("mysql:host=$dbhost;dbname=$dbname;charset=utf8", $dbuser, $dbpass, array(PDO::ATTR_EMULATE_PREPARES => false, PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
    return $dbh;
  }catch(PDOException $e){
    $app->render(500,array(
      'msg' => 'Database Connection Error'
    ));
  }
}
