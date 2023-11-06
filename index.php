<?php
session_start();

// Creació de l'array calculs en $_SESSION per registrar les operacions
if (!isset($_SESSION['calculs'])) {
    $_SESSION['calculs'] = array();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $usuari = $_POST['nom'];
    $opt1 = $_POST['opt1'];
    $opt2 = $_POST['opt2'];
    $opt3 = $_POST['opt3'];
}

// Funció dels calculs en funció del tipus rebut
function calculs($valor1, $valor2, $valor3)
{
    if (is_numeric($valor1) && is_numeric($valor2) && is_numeric($valor3)) {
        $resultat = $valor1 + $valor2 + $valor3;
        echo '<p class="missatge-estatic">Resultat: </p>' . $resultat;
    } else {
        $resultat = $valor1 . $valor2 . $valor3;
        echo '<p class="missatge-estatic">Resultat: </p>' . $resultat;
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="media.css">
    <title>Proba Nemon - Calculadora</title>
</head>

<body>
    <form action="" method="post" class="formulari">
        <label for="nom">Nom usuari</label>
        <input type="text" name="nom">

        <label for="opt1">Operand_1</label>
        <input type="text" name="opt1">

        <label for="opt2">Operand_2</label>
        <input type="text" name="opt2">

        <label for="opt3">Operand_3</label>
        <input type="text" name="opt3">

        <input type="submit" value="Calcula">
    </form>

    <div class="missatge">
        <?php

        //Evalua si els camps Operand1 i Operand2 estan buits
        if (empty($opt1) || empty($opt2)) {
            echo '<p class="missatge-estatic">Els operands 1 i 2 son obligatoris</p>';
        } else {

            //Variable per registrar l'operació
            $operacio = $opt1 . $opt2 . $opt3;

            //Comprova si l'operació ja existeix i mostra el usuari i el resultat
            if (in_array($operacio, $_SESSION['calculs'])) {
                $usuariAnterior = array_search($operacio, $_SESSION['calculs']);
                echo '<p class="missatge-estatic">Operació realitzada anteriorment per: </p>' . $usuariAnterior;
                echo '<br>';
                calculs($opt1, $opt2, $opt3);
            } else {

                //Registra el nou calcul y el usuari que l'ha fet
                $_SESSION['calculs'][$usuari] = $operacio;

                //Mostra el usuari que ha fet l'operació i el resultat
                echo '<p class="missatge-estatic">Usuari: </p>' . $usuari;
                echo '<br>';
                calculs($opt1, $opt2, $opt3);
            }
        }
        // echo '<br>';
        // var_dump($_SESSION['calculs']);
        ?>
    </div>
</body>

</html>