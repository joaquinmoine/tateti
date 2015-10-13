<?php
session_start();

function validate($in){
    $result = true;
    /* Si in pertenece a el arreglo de 1 o 2 */
    if(in_array($in, $_SESSION['arrayPlayer1']) or in_array($in, $_SESSION['arrayPlayer2'])){
        $result = false;
    }
    if($in<0 or $in>=9) {
        $result = false;
    }
    return $result;
}

function inc_round(){
    $_SESSION['round'] = $_SESSION['round'] + 1;
}

function add_cell($cell){
    if($_SESSION['next_player'] == $_SESSION['player1']){
        array_push($_SESSION['arrayPlayer1'], $cell);
    }else{
        array_push($_SESSION['arrayPlayer2'], $cell);
    }
}

function check_has_win(){
    /* Combinaciones posibles */
    $array_possible = array(
                        array(0,1,2),
                        array(3,4,5),
                        array(6,7,8),
                        array(0,4,8),
                        array(2,4,6),
                        array(0,3,6),
                        array(1,4,7),
                        array(2,5,8)
                        );
    /* Si el jugador que agrego la celda fue el primero  */
    if($_SESSION['next_player'] == $_SESSION['player1']){
        foreach ($array_possible as $i){
            /* Si estan los tres elementos del arreglo en las celdas del jugador */
            if(in_array($i[0],$_SESSION['arrayPlayer1']) and 
               in_array($i[1],$_SESSION['arrayPlayer1']) and 
               in_array($i[2],$_SESSION['arrayPlayer1'])){
                return true;
            }
        }
    /* Si el jugador que agrego la celda fue el segundo */
    } else {
        foreach ($array_possible as $i){
            /* Si estan los tres elementos del arreglo en las celdas del jugador */
            if(in_array($i[0],$_SESSION['arrayPlayer2']) and 
               in_array($i[1],$_SESSION['arrayPlayer2']) and 
               in_array($i[2],$_SESSION['arrayPlayer2'])){
                return true;
            }
        }
    }
    return false;
}

function set_finish_game(){
    $_SESSION['start_game'] = false;
}

function set_next_player(){
    if($_SESSION['next_player'] == $_SESSION['player1']){
        $_SESSION['next_player'] = $_SESSION['player2'];
    } else {
        $_SESSION['next_player'] = $_SESSION['player1'];
    }
}
