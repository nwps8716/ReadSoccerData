<?php
require_once "MyPdo.php";

class League
{
    public $dbcon;
    public $dbpdo;

    public function __construct()
    {
        $this->dbpdo = new MyPdo();
        $this->dbcon = $this->dbpdo->getConnection();
    }

    public function insertGameData($league, $time, $teamName, $capott1, $overAllHandicap, $overAllSize, $oddOrEven, $capott2, $halfHandicap, $halfSize)
    {
        $sql = "INSERT INTO `Game` (`league`, `time`, `teamName`, `capott1`, `overAllHandicap`, `overAllSize`, `oddOrEven`, `capott2`, `halfHandicap`, `halfSize`)
                VALUES (:league, :time, :teamName, :capott1, :overAllHandicap, :overAllSize, :oddOrEven, :capott2, :halfHandicap, :halfSize)";
        $stmt = $this->dbcon->prepare($sql);
    	$stmt->bindValue(':league', $league);
    	$stmt->bindValue(':time', $time);
    	$stmt->bindValue(':teamName', $teamName);
    	$stmt->bindValue(':capott1', $capott1);
    	$stmt->bindValue(':overAllHandicap', $overAllHandicap);
    	$stmt->bindValue(':overAllSize', $overAllSize);
    	$stmt->bindValue(':oddOrEven', $oddOrEven);
    	$stmt->bindValue(':capott2', $capott2);
    	$stmt->bindValue(':halfHandicap', $halfHandicap);
    	$stmt->bindValue(':halfSize', $halfSize);
    	$stmt->execute();

     	$this->dbpdo->closeConnection();
    }

    public function deleteGameData(){
        $sql = "DELETE FROM `Game` WHERE 1 = 1";
        $stmt = $this->dbcon->prepare($sql);
        $stmt->execute();
        $this->dbpdo->closeConnection();
    }
}
?>