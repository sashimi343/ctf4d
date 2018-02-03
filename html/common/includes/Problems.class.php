<?php

require_once(dirname(__FILE__) . '/mysql_config.inc.php');

class Problems {
    private $pdo;

    public function __construct() {
        $this->establish_connection();
    }

    public function find_all() {
        if($this->pdo === null) {
            return array();
        }

        $query = 'SELECT P.id problem_no, P.unique_name unique_name, P.title title, G.name genre_name, P.point point FROM problems P INNER JOIN genres G ON P.genre_id = G.id ORDER BY P.id';
        try {
            $statement = $this->pdo->prepare($query);
            $statement->execute();
            $problems = $statement->fetchAll();
            return $problems;
        } catch(PDOException $e) {
            error_log('PDOException in Problems#find_all: ' . $e->getMessage());
            return array();
        }
    }

    public function find_by_unique_name($unique_name) {
        if($this->pdo === null) {
            return array();
        }

        $query = 'SELECT P.id problem_no, P.unique_name unique_name, P.title title, G.name genre_name, P.point point FROM problems P INNER JOIN genres G ON P.genre_id = G.id WHERE P.unique_name = :unique_name ORDER BY P.id LIMIT 1';
        try {
            $statement = $this->pdo->prepare($query);
            $statement->execute(array(':unique_name' => $unique_name));
            $problem = $statement->fetch();
            return $problem;
        } catch(PDOException $e) {
            error_log('PDOException in Problems#find_by_unique_name: ' . $e->getMessage());
            return array();
        }
    }

    public function verify_flag($problem_no, $challenge) {
        if($this->pdo === null) {
            return array();
        }

        $challenge_body = $this->strip_flag($challenge);
        $query = 'SELECT count(id) FROM problems WHERE id = :id AND flag = :flag';

        try {
            $statement = $this->pdo->prepare($query);
            $statement->execute(array(':id' => $problem_no, ':flag' => $challenge_body));
            $result = $statement->fetch();
            return $result['count(id)'] === 1;
        } catch(PDOException $e) {
            error_log('PDOException in Problems#verify_flag: ' . $e->getMessage());
            return false;
        }
    }

    private function strip_flag($flag) {
        if(preg_match('/^FLAG\{(.+)\}$/', $flag, $matches)) {
            return $matches[1];
        } else {
            return '';
        }
    }

    private function establish_connection() {
        try {
            $this->pdo = new PDO(
                'mysql:host=db;dbname=' . MYSQL_SYSTEM_DB,
                'root',
                MYSQL_ROOT_PASSWORD,
                array(
                    PDO::ATTR_PERSISTENT => true,
                    PDO::ATTR_EMULATE_PREPARES => false,
                    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
                )
            );
        } catch(PDOException $e) {
            error_log('PDOException in Problems#establish_connection: ' . $e->getMessage());
            $this->pdo = null;
        }
    }
}

?>
