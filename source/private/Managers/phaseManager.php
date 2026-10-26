<?php

class phaseManager{
    public static function getAllPhases(){
        global $con;
        $stmt = $con->prepare("SELECT * FROM phase order by open ASC");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }

   public static function getPhaseById(string $aid) {
        global $con;
        $stmt = $con->prepare("SELECT * FROM phase WHERE id = ?");
        $stmt->bindValue(1, $aid);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_OBJ); 
    }
}






    




?>