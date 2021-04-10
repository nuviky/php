    <?php

function getRes($fPath)
{
    $file = fopen($fPath, 'r');

    $countB = fgets($file); //Кол-во ставок

    $bets = []; //Заполнение информации о ставках
    for ($i=0; $i < $countB; $i++) { 
        list($gameID, $amountBet, $winnerBet) = explode(" ", fgets($file));
        $bets[$gameID]['betAmount'] = (float)$amountBet;
        $bets[$gameID]['betWinner'] = trim($winnerBet, "\n\r");
    }

    $countG = fgets($file); //Кол-во игр

    $games = []; //Заполнение информации о игр
    for ($i=0; $i < $countG; $i++) { 
        list($gameID, $coefL, $coefR, $coefD, $resGame) = explode(" ", fgets($file));
        $games[$gameID]['coefL'] = (float)$coefL;
        $games[$gameID]['coefR'] = (float)$coefR;
        $games[$gameID]['coefD'] = (float)$coefD;
        $games[$gameID]['resGame'] = trim($resGame, "\n\r");
    }

    $res = 0; //Результат функции
    foreach ($bets as $gameID => $bet) { //Обходим каждую ставку
        if($bet['betWinner']  == $games[$gameID]['resGame']) { //Проверка прошла ли ставка
            $res += $games[$gameID]['coef'.$bet['betWinner']] * $bet['betAmount'] - $bet['betAmount']; 
        }
        else{
            $res -= $bet['betAmount'];
        }
    }

    return $res;

}