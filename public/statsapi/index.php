<?php
header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");
header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE');

// STATS API
// env.php
define('webRoot', dirname(getcwd()));
define('dbName', 'doug6576_dov_eagleair');
define('dbHost', '127.0.0.1');
define('dbUsername', 'doug6576_dov_eagleair');
define('dbPassword', 'qvn+bA)N25yj');
define('dbPrefix', '');

// Database library
// PHP 7
class Database {
    private $connection = null;

    function __construct(string $databaseName, string $databaseHost, string $databaseUsername, string $databasePassword) {
        $connection = new PDO('mysql:dbname=' . $databaseName . ';host=' . $databaseHost . ';charset=utf8', $databaseUsername, $databasePassword);
        $connection->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
        $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $this->connection = $connection;
    }

    public function execute(string $userQuery, array $data=array()) {
        // execute - This function is used if the query is not present within this database driver. This function will not return any data, but will return true if successful.
        // $userQuery - The PDO query that will be ran to the database. If parsing user data, use question mark as the user fields, and pass their data through the $data variable
        // $data - The user data that will be parsed through PDO. This is an empty array by default.
        if ($this->connection != null ) {
            $query = $this->connection->prepare($userQuery);
            try {
                $query->execute($data);
            } catch (Exception $e ) {
                return $e;
            }
            $query->closeCursor();
            return true;
        }
        return null;
    }

    public function fetch(string $userQuery, array $array=array()) {
        // fetch - This function is similar to execute, however, the data received by the query will be returned by the user in array form, each array being a row.
        // $userQuery - The PDO query that will be ran to the database. If parsing user data, use question mark as the user fields, and pass their data through the $data variable
        // $data - The user data that will be parsed through PDO. This is an empty array by default.
        if ($this->connection != null ) {
            $query = $this->connection->prepare($userQuery);
            $results = array();
            try {
                if ($query->execute($array))
                {
                    while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
                        array_push($results, $row);
                    }
                }
            } catch (Exception $e ) {
                return null;
            }
            $query->closeCursor();
            return $results;
        }
        return null;
    }

    public function createTable(string $tbl, string $vars) {
        // createTable - Create a table if it does not exist
        // $tbl - The name of the table
        // $vars - The variables and their type definitions
        if ($this->connection != null) {
            $query = $this->connection->prepare('CREATE TABLE IF NOT EXISTS ' . $tbl . ' (' . $vars . ')');
            try {
                $query->execute();
            } catch (Exception $e) {
                return null;
            }
            $query->closeCursor();
            return true;
        }
        return null;
    }
    
    public function deleteTable(string $tbl) {
        // deleteTable - Delete a table if it does exist
        // $tbl - The name of the table
        if ($this->connection != null) {
            $query = $this->connection->prepare('DROP TABLE IF EXISTS ' . $tbl);
            try {
                $query->execute();
            } catch (Exception $e) {
                return null;
            }
            $query->closeCursor();
            return true;
        }
        return null;
    }
    
    public function insert(string $tbl, array $data, string $extra='') {
        // insert - Insert a value in a table
        // $tbl - The name of the table
        // $data - A dictionary of data to be inserted into the database, the key being the field and the value being the data inserted
        // $extra - Extra fields to add to the query
        if ($this->connection != null) {
            $sql = 'INSERT INTO ' . $tbl . ' (';
            $count = 0;
            $newData = array();
            foreach($data as $key=>$value) {
                if ($count != 0) {
                    $sql .= ', ';   
                }
                $sql .= $key;
                $count++;
            }
            $sql .= ') VALUES (';
            $count = 0;
            foreach($data as $key=>$value) {
                if ($count != 0) {
                    $sql .= ', ';   
                }
                $sql .= ':' . $key;
                $newData[':' . $key] = $value;
                $count++;
            }
            $sql .= ') ' . $extra;
            $query = $this->connection->prepare($sql);
            try {
                $query->execute($newData);
            } catch (Exception $e) {
                return null;
            }
            $query->closeCursor();
            return true;
        }
        return null;
    }

    public function replace(string $tbl, array $data, string $extra='') {
        // replace - Replace a value from a table
        // $tbl - The name of the table
        // $data - A dictionary of data to be inserted into the database, the key being the field and the value being the data inserted
        // $extra - Extra fields to add to the query
        if($this->connection != null) {
            $sql = 'REPLACE INTO ' . $tbl . '(';
            $count = 0;
            $newData = array();
            foreach($data as $key=>$value) {
                if ($count != 0) {
                    $sql .= ', ';
                }
                $sql .= $key;
                $count++;
            }
            $sql .= ') VALUES (';
            $count = 0;
            foreach($data as $key=>$value) {
                if ($count != 0) {
                    $sql .= ', ';   
                }
                $sql .= ':' . $key;
                $newData[':' . $key] = $value;
                $count++;
            }
            $sql .= ') ' . $extra;
            $query = $this->connection->prepare($sql);
            try {
                $query->execute($newData);
            } catch (Exception $e) {
                return null;
            }
            $query->closeCursor();
            return true;
        }
        return null;
    }
    
    public function select(string $tbl, string $fields='*', string $extra='') {
        // select - Select values from a table
        // $tbl - The name of the table
        // $fields - The fields to be selected, '*' by default
        // $extra - Extra fields to add to the query
        if ($this->connection != null) {
            $query = $this->connection->prepare('SELECT ' . $fields . ' FROM ' . $tbl . ' ' . $extra);
            $results = array();
            try {
                if ($query->execute())
                {
                    while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
                        array_push($results, $row);
                    }
                }
            } catch (Exception $e) {
                return null;
            }
            $query->closeCursor();
            return $results;
        }
        return null;
    }

    public function getLastInsertID(string $sequence = null) {
        return $this->connection->lastInsertId($sequence);
    }
}

$database = new Database(dbName, dbHost, dbUsername, dbPassword);

function convertTime() {
    $args = func_get_args();
    switch (count($args)) {
        case 1:     //total minutes was passed so output hours, minutes
            $time = array();

            $time['hours'] = $args[0] > 0 ? floor($args[0]/60) : ceil($args[0]/60);

            $time['mins'] = ($args[0]%60);
            return $time;
            break;
        case 2:     //hours, minutes was passed so output total minutes
            return ($args[0] * 60) + $args[1];
    }
}

// Database Select

if(isset($_GET['voos'])) {
    $results = $database->fetch('SELECT * FROM pireps WHERE state="2";');
    echo count($results);
}
if(isset($_GET['horas'])) {
    $results = $database->fetch('SELECT sum(flight_time) as horas FROM doug6576_dov_eagleair.pireps WHERE state="2";');
    $hm = convertTime($results[0]["horas"]);
    echo $hm["hours"], "h ", $hm["mins"], "m";
}
if(isset($_GET['milhas'])) {
    $results = $database->fetch('SELECT sum(planned_distance) as milhas FROM doug6576_dov_eagleair.pireps WHERE state="2";');
    echo $results[0]["milhas"];
}
if(isset($_GET['td'])) {
    $results = $database->fetch('SELECT round(avg(landing_rate), 0) as "td" FROM doug6576_dov_eagleair.pireps WHERE state="2";');
    echo $results[0]["td"];
}
if(isset($_GET['10voos'])) {
    $results = $database->fetch('SELECT count(*) as voos, b.pilot_id, b.name, a.user_id, b.avatar, b.country FROM doug6576_dov_eagleair.pireps a join doug6576_dov_eagleair.users b on a.user_id = b.id where MONTH(a.submitted_at) = MONTH(now()) and YEAR(a.submitted_at) = YEAR(now()) and a.state = "2" group by a.user_id order by voos desc limit 10;');
    echo json_encode($results);
}
if(isset($_GET['10horas'])) {
    $results = $database->fetch('SELECT SUM(a.flight_time) as horas, b.pilot_id, b.name, a.user_id, b.avatar, b.country FROM doug6576_dov_eagleair.pireps a join doug6576_dov_eagleair.users b on a.user_id = b.id where MONTH(a.submitted_at) = MONTH(now()) and YEAR(a.submitted_at) = YEAR(now()) and a.state = "2" group by a.user_id order by horas desc limit 10;');
    echo json_encode($results);
}
if(isset($_GET['10vooslast'])) {
    $results = $database->fetch('SELECT count(*) as voos, b.pilot_id, b.name, a.user_id, b.avatar, b.country FROM doug6576_dov_eagleair.pireps a join doug6576_dov_eagleair.users b on a.user_id = b.id where MONTH(a.submitted_at) = MONTH(now()- INTERVAL 1 MONTH) and YEAR(a.submitted_at) = YEAR(now()) and a.state = "2" group by a.user_id order by voos desc limit 10;');
    echo json_encode($results);
}
if(isset($_GET['10horaslast'])) {
    $results = $database->fetch('SELECT SUM(a.flight_time) as horas, b.pilot_id, b.name, a.user_id, b.avatar, b.country FROM doug6576_dov_eagleair.pireps a join doug6576_dov_eagleair.users b on a.user_id = b.id where MONTH(a.submitted_at) = MONTH(now()- INTERVAL 1 MONTH) and YEAR(a.submitted_at) = YEAR(now()) and a.state = "2" group by a.user_id order by horas desc limit 10;');
    echo json_encode($results);
}
if(isset($_GET['10landing'])) {
    $results = $database->fetch('SELECT b.pilot_id, b.name, a.user_id, b.avatar, b.country, a.id, a.flight_number, a.dpt_airport_id, a.arr_airport_id, a.landing_rate FROM doug6576_dov_eagleair.pireps a join doug6576_dov_eagleair.users b on a.user_id = b.id  where a.state = "2" and a.landing_rate <= 0 order by a.landing_rate desc limit 10;');
    echo json_encode($results);
}

?>