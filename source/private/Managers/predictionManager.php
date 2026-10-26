<?php
class predictionManager
{
    public static function createPrediction($userId, $matchId, $score1, $score2)
    {
        global $con;
        $stmt = $con->prepare("
            INSERT INTO prediction (user_id, match_id, score1, score2)
            VALUES (?, ?, ?, ?)
        ");

        $stmt->execute([$userId, $matchId, $score1, $score2]);
    }



    // prediction ophalen van user en wedstrijd
    public static function getPrediction($userId, $matchId)
    {
        global $con;

        $stmt = $con->prepare("SELECT * FROM prediction WHERE user_id = ? AND match_id = ?");

        $stmt->execute([$userId, $matchId]);

        return $stmt->fetch(PDO::FETCH_OBJ);
    }



    public static function calculatePoints($predScore1, $predScore2, $matchScore1, $matchScore2): int
    {
        //  wedstrijd niet gespeeld
        if ($matchScore1 === null || $matchScore2 === null) {
            return 0;
        }

        //  geen voorspelling gedaan
        if ($predScore1 === "" || $predScore2 === "" || $predScore1 === null || $predScore2 === null) {
            return 0;
        }


        // uitslag precies goed geraden
        if ($predScore1 === $matchScore1 && $predScore2 === $matchScore2) {
            return 5;
        }

        // alleen team 1 winnaar goed geraden
        if ($predScore1 > $predScore2 && $matchScore1 > $matchScore2) {
            return 3;
        }

        // alleen team 2 winnaar goed geraden
        if ($predScore1 < $predScore2 && $matchScore1 < $matchScore2) {
            return 3;
        }

        // goed geraden dat gelijk spel is geworden
        if ($predScore1 == $predScore2 && $matchScore1 == $matchScore2) {
            return 2;
        }

        // niets is waar, dus helemaal fout
        return 0;
    }
}
