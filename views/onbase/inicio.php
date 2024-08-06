<?php

$this->dbOnBase=new DatabaseOnBase();

    
$this -> dbOnBase->connect();
       
$sql = "exec [dbo].[OB_WEB_IndicadoresMain2] '" . "1" . "'";
$this->dbOnBase->query($sql);
$resultados = $this->dbOnBase->obtener_registros();
    
?>





<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="background-image">
        <img src="public/img/fondos/coflex.png" alt="">
    </div>

   

    <!-- Tu contenido aquí -->

</body>
</html>

