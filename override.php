<?php
const USER = $_SESSION['name'];
const BASE_URL = "http://localhost/booking-form/?aid=12&#038;utm=";
const DSN = "mysql:host=localhost;dbname=my-wp; charset=utf8";
const DB_USER = "root";
const DB_PSWD = "root";

function connect_db() {
  try {
      $pdo = new PDO(DSN, DB_USER, DB_PSWD,
      [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
      ]
    );
    return $pdo;
  } catch (PDOException $e) {
    echo $e;
  }
}

function get_tf_list() {
  $sql = "SELECT * FROM wp_mtssb_booking WHERE booking_time = :tfid and user_name = :name" ; 

  $database = connect_db();
  $stmt = $database->prepare($sql);
  $stmt->bindValue(':bookid', BOOKID);
  $stmt->bindValue(':name', USER);
  $stmt->execute();
  $info = $stmt->fetch();
  $tfid_list = info['booking-time'];
  return $tfid_list;
}

function override_html() {
  echo <<<EOM
  <script>
    // php -> json -> js
    var four_room_elements = document.getElementsByClassName('booking-timelink');
    var time_frame_id_list = JSON.parse('<?php echo $time_frame_id_list; ?>');
    
    var $reserved_id = array_intersect($four_room_elements, $time_frame_id_list)

    for (id in reserved_id) {
      var target_url = "<?php echo BASE_URL ?>" + id
      var target = document.getElementByTagName('a[href=' + target_url + ']');

      new_element = target.replaceWith(p)
    }
  </script>
  EOM;
}

?>
