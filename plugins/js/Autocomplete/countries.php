<?php include('../bd_conn/config.php');

			$entro=""; $existe_produccion_hora=0;
			$sql = "EXEC Intr_SP_ConsultaEmpleados ";  //echo $sql;
				  $stmt = sqlsrv_query( $conn_CH, $sql );
				  while( $row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC))
			 {
				if($entro=="1"){ echo ", "; $existe_produccion_hora=1; }
				if($entro<>"1"){ echo "var countries = { "; }
				
				echo '"'.$row["IDEMPLEADO"].'" : "'.$row["NOMBRE_COMPLETO"].'"';
				$entro="1";
			 } 
			 echo " }";
?>

