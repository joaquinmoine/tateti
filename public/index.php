<?php 
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>THEF Tech Test</title>

    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Just for debugging purposes. Don't actually copy these 2 lines! -->
    <!--[if lt IE 9]><script src="../../assets/js/ie8-responsive-file-warning.js"></script><![endif]-->
    <script src="js/ie-emulation-modes-warning.js"></script>

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    <style>
    .select_box {
        background-color: blue;
        border-style: solid;
        border-top-color: red;
        border-right-color: red;
        border-bottom-color: red;
        border-left-color: red;
    }

    .default-box{
        background-color: blue;
        border-style: solid;
        border-top-color: black;
        border-right-color: black;
        border-bottom-color: black;
        border-left-color: black;
    }

    .row-box>div>div{
	display: table-cell;
        vertical-align: middle;
    }

    .empty-cell{
        width: 100%;
    }

    img{
        width: 100%;
    }

    .error{
        color: red;
    }
    </style>
</head>
<body>

    <?php
        include_once("../app/game.php");
    ?>
    
    <nav class="navbar navbar-default">
        <div class="container">
        <ul class="nav navbar-nav">
            <li><a href="index.php">Inicio</a></li>
            <li><a href="#play">Jugar</a></li>
        </ul>
        <?php if($_SESSION['start_game']==true): ?>
            <form method="post">
            <button type="submit" name="restart" value="yes" class="btn btn-warning navbar-btn">Reiniciar partida</button>
            <button type="submit" name="finish" value="yes" class="btn btn-danger navbar-btn">Terminar partida</button>
            </form>
        <?php endif; ?>
        </div>
    </nav>

    <div class="container">

        <div>
                <h1 class="active">JUEGO</h1>
                <?php if($msg!=""): ?>
                    <div class="row text-center">
                        <h3>
                            <?php echo($msg); ?>
                        </h3>
                    </div>
                <?php endif; ?>
                    <!--Si se inicio el juego-->
                    <?php if($_SESSION['start_game']==true): ?>
                        <div class="row text-center" id="player">
                            <h3> Es el turno de: <?php echo($_SESSION['next_player']); ?> </h3>
                        </div> <!--player-->
                        <div class="row text-center row-box" id="box">
                        <?php for($i=0; $i<9; $i++): ?>
                            <!--Abro el div de la clase que contiene la fila-->
                            <?php if($i%3 == 0): ?>
                                <div class="col-xs-12 col-md-4 col-md-offset-4">
                            <?php endif;  ?>
                                <div class="col-xs-4 col-sm-4 default-box" id="<?php echo($i);?>">
                                    <!--Si la celda pertenece al jugador 1-->
                                    <?php if(in_array($i,$_SESSION['arrayPlayer1'])): ?>
                                        <img src="<?php echo($_SESSION['symbolPlayer1']); ?>" class="img-responsive" alt="Responsive image">
                                    <!--Si la celda pertenece al jugador 2-->
                                    <?php elseif(in_array($i,$_SESSION['arrayPlayer2'])): ?>
                                        <img src="<?php echo($_SESSION['symbolPlayer2']);?>" class="img-responsive" alt="Responsive image">
                                    <?php else: ?>
                                        <img src="blue.svg">
                                    <?php endif; ?>
                                </div>
                            <!--Cierro el div que contiene la fila-->
                            <?php if(($i+1)%3 == 0): ?>
                                </div>
                            <?php endif; ?>
                        <?php endfor; ?>
                        </div> <!--box-->
                        <div class="row text-center">
                        <form method="post">
                            <input type="hidden" id="cell_selected" name="cell_selected" value="-1">
                            <button type="submit" name="send" value="yes" class="btn btn-default">Obtener celda</button>
                        </form>
                        </div>
                    <?php endif; ?>
        </div>
	<div>
            <div>
                <h1>TA TE TI</h1>
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quidem tempore atque saepe error, nulla esse odio, a porro aperiam ipsam debitis quisquam. Doloribus modi iure dolor rem libero voluptatem soluta architecto reprehenderit nihil veniam delectus, aliquid iusto maxime similique dolore natus consequatur quis magni aut minus, accusantium eos alias? Tempore, sed commodi deserunt ducimus a quibusdam possimus velit ipsum in hic, ipsa delectus. Sit molestiae voluptatem saepe exercitationem, architecto minima quae repellat libero beatae hic veritatis praesentium eius fugiat nam eos reprehenderit, harum officia ex. Ad eaque excepturi optio similique officiis dolore voluptates consequatur, ut dignissimos. Iure hic ad sunt laborum, placeat ipsa ipsam, minima soluta in, blanditiis cum consequuntur quod dignissimos inventore dolore est debitis explicabo fuga quibusdam eaque reiciendis unde fugiat eum. Enim labore optio repudiandae, ab numquam obcaecati perspiciatis quam magni iste ducimus adipisci impedit reiciendis animi veniam. Quia eos incidunt, illo illum impedit molestiae, esse porro repudiandae quae, optio sed facilis, nam debitis earum neque suscipit architecto? Quisquam soluta asperiores impedit, quod sequi a eaque, labore ipsa, perspiciatis exercitationem pariatur vero. Reiciendis quisquam illum fugiat totam, consequuntur culpa. Aut veritatis cumque et quae doloremque, nulla unde facilis autem porro quod provident magni nisi consequatur, nesciunt dolorem!</p>
            </div>
            <div>
                <h1>LOGIN FORM</h1>
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quidem tempore atque saepe error, nulla esse odio, a porro aperiam ipsam debitis quisquam. Doloribus modi iure dolor rem libero voluptatem soluta architecto reprehenderit nihil veniam delectus, aliquid iusto maxime similique dolore natus consequatur quis magni aut minus, accusantium eos alias? Tempore, sed commodi deserunt ducimus a quibusdam possimus velit ipsum in hic, ipsa delectus. Sit molestiae voluptatem saepe exercitationem, architecto minima quae repellat libero beatae hic veritatis praesentium eius fugiat nam eos reprehenderit, harum officia ex.</p>

                <section id="play">
                <!--Metodo post con cuatro campos y boton submit-->
                <form method="post">
                    <div class="text-center">
                    <div><label>Nombre jugador 1</label><input type="text" name="player1" id="player1"></div>
                    <div><label>Simbolo utilizado (X o O)</label><input type="text" name="symbolPlayer1" id="symbolPlayer1"></div>
                    <div><label>Nombre jugador 2</label><input type="text" name="player2" id="player2"></div>
                    <div><label>Simbolo utilizado (X o O)</label><input type="text" name="symbolPlayer2" id="symbolPlayer2"></div>
                    <button type="submit" name="create" value="yes" class="btn btn-default">Jugar</button>
                    </div>
                </form>
                </section>
            </div>
            <div>
            </div>
        </div>
    <div>
        <p>Joaquin Moine</p>
    </div>
    
    </div> <!--container-->
    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script>
        /* Ultima celda seleccionada */
        var last_selected = null;
        $(".row-box>div>div").click(function() {
            /* Si hay uno previamente seleccionado */
            if(last_selected != null){
                last_selected.removeClass("select_box");
                last_selected.addClass("default-box");
            }
            /* El ultimo seleccionado es el actual */
            last_selected = $(this)
            /* Obtengo el id seleccionado */
            var get_id = $(this).attr("id");
            /* Remuevo la clase por defecto */
            $(this).removeClass("default-box");
            /* Agrego la nueva clase */
            $(this).addClass("select_box");
            /* En el formulario agrego el nuevo id */
            $("#cell_selected").val(get_id);
        });
    </script>
    <script src="js/bootstrap.min.js"></script>
    <!-- Just to make our placeholder images work. Don't actually copy the next line! -->
    <script src="js/holder.min.js"></script>
    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="js/ie10-viewport-bug-workaround.js"></script>
</body>
</html>
