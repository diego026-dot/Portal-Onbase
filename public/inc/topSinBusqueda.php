	
		<div class=" header d-flex align-items-center justify-content-between" style = "background-color: #08043b">
			

			<i class=" bi bi-list menu-icon" style = " font-size:40px; margin-left:10px; cursor: pointer; color: white"></i>
			
			<?php include("public/inc/menu_derecho.php");?>	
			 
				
		</div>	
		
	

	<script>
		function ocultarcampo()   
		{
			var nombre=$("#sgcnombre").val();
			var clave=$("#sgcclave").val();
			var claverl=$("#sgcclaverl").val();
			var busqueda=$("#busqueda").val();

				if (nombre != "") {
					$("#sgcclave").hide();
					$("#sgcclaverl").hide();
					$("#sgclbclave").hide();
					$("#sgclbclaverl").hide();
				}
				else {
					$("#sgcclave").show();
					$("#sgcclaverl").show();
					$("#sgclbclave").show();
					$("#sgclbclaverl").show();
				

				if (clave != "") {
					$("#sgcnombre").hide();
					$("#sgcclaverl").hide();
					$("#sgclbnombre").hide();
					$("#sgclbclaverl").hide();
				}
				else {
					$("#sgcnombre").show();
					$("#sgcclaverl").show();
					$("#sgclbnombre").show();
					$("#sgclbclaverl").show();
				

				if (claverl != "") {
					$("#sgcnombre").hide();
					$("#sgcclave").hide();
					$("#sgclbnombre").hide();
					$("#sgclbclave").hide();
				}
				else {
					$("#sgcnombre").show();
					$("#sgcclave").show();
					$("#sgclbnombre").show();
					$("#sgclbclave").show();
				
				if (busqueda != "") {
					$("#sgcnombre").hide();
					$("#sgcclave").hide();
					$("#sgcclaverl").hide();
					$("#sgclbnombre").hide();
					$("#sgclbclave").hide();
					$("#sgclbclaverl").hide();
				}
				else {
					$("#sgcnombre").show();
					$("#sgcclave").show();
					$("#sgcclaverl").show();
					$("#sgclbnombre").show();
					$("#sgclbclave").show();
					$("#sgclbclaverl").show();
				}
				   }
				     }
				       }


		}

	</script>