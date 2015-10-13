<?php
session_start();

include_once("functions.php");

$msg = ""; 

/* Si no comenzo una partida */
if($_SESSION['start_game']==false){
    if(isset($_POST['player1'], $_POST['player2'], $_POST['symbolPlayer1'], $_POST['symbolPlayer2'])){
        /* Configuracion de las variables que almacenaran valores */
        // Simbolo utilizado por el competidor 1
        $symbol1 = filter_input(INPUT_POST, 'symbolPlayer1', FILTER_SANITIZE_STRING);
        // Si el simbolo del jugador 1 es O
        if($symbol1 == 'O' or $symbol1 == 'o' or $symbol1 = '0'){ 
            $_SESSION['symbolPlayer1'] = 'o.svg';
            $_SESSION['symbolPlayer2'] = 'x.svg';
        } else {
            $_SESSION['symbolPlayer1'] = 'x.svg';
            $_SESSION['symbolPlayer2'] = 'o.svg';
        }
        // Nombre del competidor uno
        $_SESSION['player1'] = filter_input(INPUT_POST, 'player1', FILTER_SANITIZE_STRING);
        // Nombre del competidor dos
        $_SESSION['player2'] = filter_input(INPUT_POST, 'player2', FILTER_SANITIZE_STRING);
        // La partida esta iniciada
        $_SESSION['start_game'] = true;
        // Siguiente jugador
        $_SESSION['next_player'] = $_SESSION['player1'];
        // id de los lugares ocupados por el jugador 1
        $_SESSION['arrayPlayer1'] = array();
        // id de los lugares ocupados por el jugador 2
        $_SESSION['arrayPlayer2'] = array();
        // ronda
        $_SESSION['round'] = 0;
        header("Location: index.php#player");
    }
} else {
    if(isset($_POST['send'], $_POST['cell_selected'])){
        $cell_selected = filter_input(INPUT_POST, 'cell_selected', FILTER_SANITIZE_NUMBER_INT);
        $msg = "";
        /* Si los datos de entrada son los correctos */
        if(validate($cell_selected)){
            /* se incrementa la ronda */
            inc_round();
            /* se agraga la celda */
            add_cell($cell_selected);
            /* En cualquiera de estas rondas puede llegar a haber una victoria */
            if($_SESSION['round']>=5 and $_SESSION['round']<9){
                /* Choqueo para saber si hay un ganador */
                $result_check = check_has_win();
                if($result_check){
                    $msg = "El jugador: ".$_SESSION['next_player']. " ha ganado la partido";
                    /* Se setea la finalizacion de la  */
                    set_finish_game();
                /* Si no hay ganador */
                } else {
                    /* En caso de no haber un ganador el turno es del siguiente jugador */
                    set_next_player();
                }
            }elseif($_SESSION['round']<5){
                /* El turno es del siguiente jugador */
                set_next_player();
            }else{
                /* Choqueo para saber si hay un ganador */
                $result_check = check_has_win();
                if($result_check){
                    $msg = "El jugador: ".$_SESSION['next_player']. " ha ganado la partido";
                } else {
                    $msg = "La partida ha terminado en empate";
                }
                set_finish_game();
            }
        } else {
            $msg = "<div class='error'>La celda no ya a sido ocupada o es invalida</div>";
        }
    }
    if(isset($_POST['restart'])){
        // Siguiente jugador
        $_SESSION['next_player'] = $_SESSION['player1'];
        // id de los lugares ocupados por el jugador 1
        $_SESSION['arrayPlayer1'] = array();
        // id de los lugares ocupados por el jugador 2
        $_SESSION['arrayPlayer2'] = array();
        // ronda
        $_SESSION['round'] = 0;
        header("Location: index.php#player");
    }
    if(isset($_POST['finish'])){
        # El juego se da por terminado
        $_SESSION['start_game']=false;
    }
}
