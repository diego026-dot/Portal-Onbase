<?php
session_start();
class Logout extends Controller{

    function __construct(){
        parent::__construct();
        $this->view->activa = "";
    }

    function render(){
        session_destroy();
        echo "<script>insertaRegistroControl();</script>"; 
       
        
        $_SESSION["mensaje"] = "<div class='alert alert-warning' role='alert'><b>Aviso!</b> Finalizó la sesión.</div>";
        $this->view->render('login/index');
    }

}
?>
<?php include("public/inc/jsfooter.php");?>
<script>

    function insertaRegistroControl(){
       
        var usuario = "<?php echo $_SESSION['strUsuario']; ?>";
       
        var direccion="http://192.168.1.191:81/coflex/onbase/insertaUsuarioControl";


        
        var url = direccion+"/"+$.trim(usuario)+"/"+$.trim(0)+"/"+$.trim(2);

$.ajax({                        
	type: "POST",
	url: url,            
	beforeSend: function(){ },  
success: function(data){
   
}});
}



</script>