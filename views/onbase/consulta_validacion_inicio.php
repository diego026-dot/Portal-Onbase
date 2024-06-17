<?php session_start(); ?>
<?php include("public/inc/encabezado_sinbusqueda.php");?>
<?php foreach($this->consulta_validacion as $row){ //INICIO DEL FOR ?>
  <?php // echo $row->strCorreo;  ?>

 <?php  $_SESSION['correo']= $row->strCorreo;
 


 
 
 ?>

 
    <?php } //FIN DEL FOR?>
    <?php echo $_SESSION["correo"]; ?>
<?php include("public/inc/jsfooter.php");?>
</html>
