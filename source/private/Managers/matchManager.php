<?php

class matchManager
{


    public static function getmatchesOfPhase(string $aID): array
    {

        global $con;
        $stmt = $con->prepare(
            "SELECT  *, 
        (SELECT name from country where country.id = country_id1) As land_1,
        (SELECT name from country where country.id = country_id2) As land_2,
        (SELECT image_id from country where country.id = country_id1) As land_1_flag,
        (SELECT image_id  from country where country.id = country_id2) As land_2_flag
         from `match`
       where phase_id = ?
         order by 
         match_date ASC
;
"
        );
        $stmt->bindValue(1, $aID);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }

    public static function getMatchScoreByID($id)
    {
        global $con;
        $stmt = $con->prepare("SELECT score1, score2 FROM wk_pool_2026.match where id = ?");
        $stmt->bindValue(1, $id);
        $stmt->execute();
        $stmt->fetchAll(PDO::FETCH_OBJ);
    }

    public static function insertOrUpdateScoreByID($id, $score1, $score2)
    {
        global $con;

        // Voeg backticks toe rondom de tabelnaam `match`
        $stmt = $con->prepare("UPDATE wk_pool_2026.`match` SET score1 = ?, score2 = ? WHERE id = ?");
        $stmt->bindValue(1, $score1);
        $stmt->bindValue(2, $score2);
        $stmt->bindValue(3, $id);
        $stmt->execute();
    }
}
