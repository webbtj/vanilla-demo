<?php

require_once(dirname(__FILE__) . '/utilities.php');

class DB {
  private $mysqli;

  private function connect() {
    $this->mysqli = new mysqli(config('DB_HOST'), config('DB_USER'), config('DB_PASS'), config('DB_NAME'));
  }

  public function select(String $sql) {
    $results = [];
    $this->connect();
    if ($result = $this->mysqli->query($sql, MYSQLI_USE_RESULT)) {
      while($row = $result->fetch_assoc()) {
        $results[] = $row;
      }
    }
    $this->disconnect();
    return $results;
  }

  public function insert(String $sql) {
    $this->connect();
    if ($this->mysqli->query($sql) === true) {
      return true;
    }
    $this->disconnect();
    return false;
  }

  public function delete(String $sql) {
    return $this->insert($sql);
  }

  private function disconnect() {
    $this->mysqli->close();
  }

}