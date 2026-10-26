<?php

class userManager
{
    public static function getAllUsers()
    {
        global $con;
        $stmt = $con->prepare("SELECT * from user ORDER BY score DESC");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }

    public static function insertScoreByUserID($points, $id)
    {
        global $con;
        $stmt = $con->prepare("UPDATE user SET score = ? WHERE id = ?");
        $stmt->bindValue(1, $points);
        $stmt->bindValue(2, $id);
        $stmt->execute();
    }
}
