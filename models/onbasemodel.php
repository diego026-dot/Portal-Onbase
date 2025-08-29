<?php

class OnbaseModel extends Model
{

    public function __construct()
    {
        $this->dbOnBase = new DatabaseOnBase();
        parent::__construct();
    }

    //LOGIN
    public function login($clave, $pass)
    {
        try {
            $this->dbOnBase->connect();
            $sql = "exec [OBINTEGRATIONS].[dbo].[SP_OB_SAC_PM_ClienteGP] '" . $clave . "'";
            $this->dbOnBase->query($sql);
            $resultados = $this->dbOnBase->obtener_registros();
            return $resultados;
        } catch (PDOEXception $e) {
            return [];
        }
    }


    public function selectUsuarios()
    {
        try {
            $this->dbOnBase->connect();

            $sql = " exec [dbo].[OB_WEB_SelectUsuarios] ";
            $this->dbOnBase->query($sql);
            $resultados = $this->dbOnBase->obtener_registros();

            return $resultados;
        } catch (PDOEXception $e) {
            return [];
        }
    }

    public function consulta_Facturacion($fechaI, $fechaF, $clientes)
    {
        try {
            $this->dbOnBase->connect();
            if ($clientes === '') {
                $sql = "exec [dbo].[OB_WEB_ReporteClientes] '" . $clientes . "','" . $fechaI . "','" . $fechaF . "',' 2 '";
            } else {
                $sql = "exec [dbo].[OB_WEB_ReporteClientes] '" . $clientes . "','" . $fechaI . "','" . $fechaF . "',' 1 '";
            }

            $this->dbOnBase->query($sql);
            $resultados = $this->dbOnBase->obtener_registros();
            return $resultados;
        } catch (PDOEXception $e) {
            return [];
        }
    }

    public function consulta_ReporteStatusF($fechaI, $fechaF, $clientes, $tipo)
    {
        try {
            $this->dbOnBase->connect();
            $sql = "exec [dbo].[OB_WEB_ReporteStatusFactura] '" . $tipo . "','" . $clientes . "','" . $fechaI . "','" . $fechaF . "'";
            $this->dbOnBase->query($sql);
            $resultados = $this->dbOnBase->obtener_registros();
            return $resultados;
        } catch (PDOEXception $e) {
            return [];
        }
    }

    public function selectClientes()
    {
        try {
            $this->dbOnBase->connect();
            $sql = "exec [PORTALONBASE].[dbo].[OB_WEB_SelectClientes] ";
            $this->dbOnBase->query($sql);
            $resultados = $this->dbOnBase->obtener_registros();
            // print_r($resultados);
            return $resultados;
        } catch (PDOEXception $e) {
            return [];
        }
    }
    public function selectProveedor()
    {
        try {
            $this->dbOnBase->connect();
            $sql = "exec [PORTALONBASE].[dbo].[OB_WEB_SelectProveedor] ";
            $this->dbOnBase->query($sql);
            $resultados = $this->dbOnBase->obtener_registros();

            return $resultados;
        } catch (PDOEXception $e) {
            return [];
        }
    }


    public function obtenerPermisosUsuario()
    {
        try {
            $this->dbOnBase->connect();
            $sql = "select * from PermisosUsuarios";
            $this->dbOnBase->query($sql);
            $resultados = $this->dbOnBase->obtener_registros();
            return $resultados;
        } catch (PDOEXception $e) {
            return [];
        }
    }
    public function agregarPermisos($id, $usuario, $correo, $contrasena, $activo)
    {
        try {
            $this->dbOnBase->connect();
            $sql = " exec [dbo].[OB_WEB_AgregarPermisosUsuario] '" . $id . "','" . $usuario . "','" . $correo . "',
            '" . $contrasena . "','" . $activo . "'";
            $this->dbOnBase->query($sql);
            $this->dbOnBase->ejecutar();
        } catch (PDOEXception $e) {
            return [];
        }
    }

    public function agregarUsuarios($id, $usuario, $correo, $contrasena, $activo, $sucursal, $tipo)
    {
        try {
            $this->dbOnBase->connect();
            $sql = " exec [dbo].[OB_WEB_AgregarUsuario] '" . $id . "','" . $usuario . "','" . $correo . "',
            '" . $contrasena . "','" . $activo . "', '" . $sucursal . "','" . $tipo . "'";
            $this->dbOnBase->query($sql);
            $this->dbOnBase->ejecutar();
        } catch (PDOEXception $e) {
            return [];
        }
    }

    public function editarUsuarios($id, $usuario, $correo, $contrasena, $activo, $sucursal, $tipo)
    {
        try {
            $this->dbOnBase->connect();
            $sql = " exec [dbo].[OB_WEB_AgregarUsuario] '" . $id . "','" . $usuario . "','" . $correo . "',
            '" . $contrasena . "','" . $activo . "', '" . $sucursal . "','" . $tipo . "'";
            $this->dbOnBase->query($sql);
            $this->dbOnBase->ejecutar();
        } catch (PDOEXception $e) {
            return [];
        }
    }

    public function reporteOnbase($fechaI, $fechaF)
    {
        try {
            $this->dbOnBase->connect();
            $sql = " exec [dbo].[OB_WEB_ReporteObControlSum] '" . $fechaI . "','" . $fechaF . "'";
            $this->dbOnBase->query($sql);
            $resultados = $this->dbOnBase->obtener_registros();
            return $resultados;
        } catch (PDOEXception $e) {
            return [];
        }
    }

    public function validaReferenciaModel($referencia, $clave)
    {
        try {
            $this->dbOnBase->connect();
            $sql = " exec [dbo].[OB_WEB_FN_ValidaDatosDarwin]'" . $referencia . "','" . $clave . "'";

            $this->dbOnBase->query($sql);
            $resultados = $this->dbOnBase->obtener_registros();
            return $resultados;
        } catch (PDOEXception $e) {
            return [];
        }
    }

    public function insertaFacturasPortal($a, $b, $c, $d, $e, $f, $g, $h, $i, $j)
    {

        try {
            $this->dbOnBase->connect();
            $sql = "exec [dbo].[OB_WEB_InsertaFacturasPortal] :a, :b, :c, :d, :e, :f, :g, :h, :i, :j";

            // Preparamos la ejecución de la consulta
            $stmt = $this->dbOnBase->prepare($sql);

            // Enlazamos los parámetros con sus respectivos valores o null
            $stmt->bindValue(':a', $a);
            $stmt->bindValue(':b', $b);
            $stmt->bindValue(':c', $c);

            // Verificamos si cada valor es null, si no, lo enviamos como string
            $stmt->bindValue(':d', !empty($d) ? $d : null, $d === null ? PDO::PARAM_NULL : PDO::PARAM_STR);
            $stmt->bindValue(':e', !empty($e) ? $e : null, $e === null ? PDO::PARAM_NULL : PDO::PARAM_STR);
            $stmt->bindValue(':f', !empty($f) ? $f : null, $f === null ? PDO::PARAM_NULL : PDO::PARAM_STR);
            $stmt->bindValue(':g', !empty($g) ? $g : null, $g === null ? PDO::PARAM_NULL : PDO::PARAM_STR);
            $stmt->bindValue(':h', !empty($h) ? $h : null, $h === null ? PDO::PARAM_NULL : PDO::PARAM_STR);

            $stmt->bindValue(':i', $i);
            $stmt->bindValue(':j', $j);


            // Ejecutamos la consulta
            $stmt->execute();
            $resultados = $stmt->fetch(PDO::FETCH_ASSOC);
            return $resultados;
        } catch (PDOEXception $e) {
            return [];
        }
    }

    public function buscarFacturaOB($uuid)
    {
        try {
            $this->dbOnBase->connect();
            $sql = " exec [dbo].[OB_WEB_EstatusFactura]'" . $uuid . "' , '1' , '2' , '2' ";
            $this->dbOnBase->query($sql);
            $resultados = $this->dbOnBase->obtener_registros();
            return $resultados;
        } catch (PDOEXception $e) {
            return [];
        }
    }



    public function reporteOnbaseLimitado($fechaI, $fechaF)
    {
        try {
            $this->dbOnBase->connect();
            $sql = "SELECT 
            [Fecha de creacion] AS [FechaCreacion],[Estatus],[ID Documento] AS [IDDocumento],
            [Pedimento], [Patente],[Aduana],[Referencia],[Remesa],[Cliente],
            [Numero de Cliente] AS [NumeroCliente],
            [Clave de Pedimento] AS [ClavePedimento],
            [Segunda Facturacion] AS [SegundaFacturacion],
            MAX([Motivo Segunda Facturacion]) AS [MotivoSegundaFacturacion],
            MAX([Fecha_Aceptado]) AS [FechaAceptado],
            MAX([Fecha_Parcial]) AS [FechaParcial],
            MAX([Fecha_Rechazado]) AS [FechaRechazado],
            MAX([Fecha_Recibidido]) AS [FechaRecibidido],
            MAX([Correo Ejecutivo]) AS [CorreoEjecutivo],
            MAX([Correo para Facturista]) AS [CorreoFacturista]
            FROM [OB_Integracion_Proveedores].[dbo].[OB_VISTA_CHECKLIST]
            WHERE [Fecha de creacion] BETWEEN :fechaI AND :fechaF
            GROUP BY 
            [Fecha de creacion], [Estatus],[ID Documento],[Pedimento],[Patente],[Aduana],[Referencia],[Remesa], [Cliente],
            [Numero de Cliente],[Clave de Pedimento], [Segunda Facturacion]
            ORDER BY [FechaCreacion] DESC
            OFFSET 0 ROWS FETCH NEXT 1000 ROWS ONLY;";
            $this->dbOnBase->query($sql);
            $this->dbOnBase->bindParam(':fechaI', $fechaI);
            $this->dbOnBase->bindParam(':fechaF', $fechaF);
            $resultados = $this->dbOnBase->obtener_registros();
            return $resultados;
        } catch (PDOEXception $e) {
            return [];
        }
    }

    public function reporteOnbaseCL($fechaI, $fechaF)
    {
        try {
            $this->dbOnBase->connect();
            $sql = " exec [dbo].[OB_WEB_ReporteCL] '" . $fechaI . "','" . $fechaF . "'";
            $this->dbOnBase->query($sql);
            $resultados = $this->dbOnBase->obtener_registros();
            return $resultados;
        } catch (PDOEXception $e) {
            return [];
        }
    }
    public function reporteOnbaseCLimitado($fechaI, $fechaF)
    {
        try {
            $this->dbOnBase->connect();
            $sql = " SELECT [Aduana]
                    ,[Pedimento]
                    ,[Patente]
                    ,[Referencia]
                    ,[Estatus]
                    ,[FechaCreacion]
                    ,[FechaRechazo]
                    ,[FechaModificacion]
                    ,[FechaAceptacion]
                    ,[TipoOperacion]
                    ,[ItemNumChecklist]
                    ,[ItemNumFactura]
                    ,[UUIDFactura]
                    ,[SegundaFacturacion]
                    ,[MotivoSF]
                    FROM [OB_Integracion_Proveedores].[dbo].[OB_VISTA_CHECKLIST_FACTURAS_SF]
                    WHERE [FechaCreacion] BETWEEN :fechaI AND :fechaF ORDER BY [FechaCreacion] DESC OFFSET 0 ROWS FETCH NEXT 1000 ROWS ONLY ;";
            $this->dbOnBase->query($sql);
            $this->dbOnBase->bindParam(':fechaI', $fechaI);
            $this->dbOnBase->bindParam(':fechaF', $fechaF);
            $resultados = $this->dbOnBase->obtener_registros();
            return $resultados;
        } catch (PDOEXception $e) {
            return [];
        }
    }

    public function consultaCheklist($pedimento, $patente, $aduana)
    {
        $tipo = 0;
        try {
            $this->dbOnBase->connect();
            $sql = "exec [dbo].[OB_WEB_CL_ObtieneDetalleChecklist] '" . $pedimento . "','" . $patente . "','" . $aduana . "','" . $tipo . "'";
            // echo  $sql;
            $this->dbOnBase->query($sql);
            $resultados = $this->dbOnBase->obtener_registros();
            return $resultados;
        } catch (PDOEXception $e) {
            echo "Error TRY para mostrar" . $e->getMessage();
            return [];
        }
    }

    public function consultaExcelCheklist($xml)
    {
        try {
            $this->dbOnBase->connect();
            $sql = "exec [dbo].[OB_WEB_InsertaPedimentosXML] '" . $xml . "'";

            $this->dbOnBase->query($sql);
            $resultados = $this->dbOnBase->obtener_registros();


            return $resultados;
        } catch (PDOEXception $e) {
            return [];
        }
    }

    public function consultaEstatusFactura($pedimento, $patente, $aduana, $opcion)
    {

        try {
            $this->dbOnBase->connect();
            $sql = "exec  [dbo].[OB_WEB_EstatusFactura] '" . $pedimento . "','" . $patente . "','" . $aduana . "','" . $opcion . "'";
            // echo  $sql;
            $this->dbOnBase->query($sql);
            $resultados = $this->dbOnBase->obtener_registros();
            return $resultados;
        } catch (PDOEXception $e) {
            echo "Error TRY para mostrar" . $e->getMessage();
            return [];
        }
    }
    public function selectUserAdminCorreo()
    {
        try {
            $this->dbOnBase->connect();
            $sql = "SELECT  * from [OB_Integracion_Proveedores].[dbo].[ADM_USUARIOS_OB]";
            $this->dbOnBase->query($sql);
            $resultados = $this->dbOnBase->obtener_registros();
            // print_r($resultados);
            return $resultados;
        } catch (PDOEXception $e) {
            return [];
        }
    }

    public function agregarUsuarioDetalle($datos)
    {
        error_log(print_r($datos, true));
        try {
            $this->dbOnBase->connect();
            $sql =  "exec [dbo].[OB_WEB_ADM_AgregaUsuarioDetalle] 
            :id, :codigo, :nombreSocio, :usuario, :direccion, :puesto, :funcion,
            :correo, :supervisor, :supervisorC, :nl, :mx, :mzo, :mty, :vr, :tol, :slp, :coa, :maz, :tipo";
            $stmt = $this->dbOnBase->prepare($sql);
            $stmt->execute(array(
                ':id' => $datos['id'] ?? null, // Si 'id' no existe, usa null
                ':codigo' => $datos['codigo'],
                ':nombreSocio' => $datos['nombreSocio'],
                ':usuario' => $datos['usuario'],
                ':direccion' => $datos['direccion'],
                ':puesto' => $datos['puesto'],
                ':funcion' => $datos['funcion'],
                ':correo' => $datos['correo'],
                ':supervisor' => $datos['supervisor'],
                ':supervisorC' => $datos['supervisorCorreo'],
                ':nl' => $datos['nl'],
                ':maz' => $datos['maz'],
                ':mx' => $datos['mx'],
                ':mzo' => $datos['mzo'],
                ':mty' => $datos['mty'],
                ':vr' => $datos['vr'],
                ':tol' => $datos['tol'],
                ':slp' => $datos['slp'],
                ':coa' => $datos['coa'],
                ':tipo' => $datos['tipo']
            ));
            // print_r($resultados);

        } catch (PDOEXception $e) {
            return [];
        }
    }

    public function validarDatosUsuarioDetalle($id, $correo)
    {

        try {
            $this->dbOnBase->connect();
            $sql =  "SELECT Correo, [Codigo SN]  from [OB_Integracion_Proveedores].[dbo].[ADM_USUARIOS_OB] where [Codigo SN] = :id and Correo = :correo";
            $this->dbOnBase->prepare($sql);
            $this->dbOnBase->bindParam(':id', $id);
            $this->dbOnBase->bindParam(':correo', $correo);
            $resultados = $this->dbOnBase->obtener_registros();
            return $resultados;
        } catch (PDOEXception $e) {
            return [];
        }
    }

    public function validaSucursalGerente($user)
    {
        try {
            $this->dbOnBase->connect();
            $sql = "SELECT  * from [PORTALONBASE].[dbo].[UsuariosPortal] where NombreUsuario = :user";
            $this->dbOnBase->prepare($sql);
            $this->dbOnBase->bindParam(':user', $user);
            // print_r($resultados);
            $resultados = $this->dbOnBase->obtener_registros();
            return $resultados;
        } catch (PDOEXception $e) {
            return [];
        }
    }

    public function usuariosSucursal($sucursal)
    {
        try {
            $this->dbOnBase->connect();
            $sql = "SELECT  * from [PORTALONBASE].[dbo].[UsuariosPortal] where Sucursal = :sucursal";
            $this->dbOnBase->prepare($sql);
            $this->dbOnBase->bindParam(':sucursal', $sucursal);
            // print_r($resultados);
            $resultados = $this->dbOnBase->obtener_registros();
            return $resultados;
        } catch (PDOEXception $e) {
            return [];
        }
    }

    public function consulta_validacion_web($email)
    {
        try {
            $this->dbOnBase->connect();
            $sql = "exec [OBINTEGRATIONS].[dbo].[SP_OB_CCD_WEB_Valida_Correo_Usuario] '" . $email . "'";
            // echo  $sql;
            $this->dbOnBase->query($sql);
            $resultados = $this->dbOnBase->obtener_registros();
            return $resultados;
        } catch (PDOEXception $e) {
            echo "Error TRY para mostrar" . $e->getMessage();
            return [];
        }
    }

    public function registrarCandidatoModel($data)
    {
        try {
            $this->dbOnBase->connect();

            $sql = "EXEC [dbo].[OB_WEB_AgregarCandidato]
                @RECLUTADOR = :reclutador,
                @NOMBRE = :nombre,
                @MEDIOR = :medioR,
                @PUESTO = :puesto,
                @SUCURSAL = :sucursal,
                @CORREO = :correo,
                @TELEFONO = :telefono,
                @URL = :url,
                @ESTATUS = :estatus,
                @COMENTARIOS = :comentarios,
                @EVALUACION = :evaluacion";

            $stmt = $this->dbOnBase->prepare($sql);

            $stmt->execute([
                ':reclutador' => $data['reclutador'],
                ':nombre' => $data['nombre'],
                ':medioR' => $data['medioR'],
                ':puesto' => $data['puesto'],
                ':sucursal' => $data['sucursal'],
                ':correo' => $data['correo'],
                ':telefono' => str_replace(' ','',$data['telefono']),
                ':url' => $data['url'],
                ':estatus' => $data['estatus'],
                ':comentarios' => $data['comentarios'],
                ':evaluacion' => $data['evaluacion']
            ]);
        } catch (PDOException $e) {
            echo "Error en base de datos: " . $e->getMessage();
            return [];
        }
    }

    public function actualizaEstatusCandidatoModel($data, $id, $campo)
    {
        try {
            $this->dbOnBase->connect();

            $sql = "UPDATE OB_WEB_Candidatos
		            SET  $campo = :estatus where Id = :id";

            $stmt = $this->dbOnBase->prepare($sql);

            $stmt->execute([
                ':estatus' => $data,
                ':id' => $id

            ]);
        } catch (PDOException $e) {
            echo "Error en base de datos: " . $e->getMessage();
            return [];
        }
    }

    public function actualizarCandidatoModel($data)
    {
        try {
            $this->dbOnBase->connect();

            $sql = "EXEC [dbo].[OB_WEB_ActualizarCandidato]
            @ID = :id,
            @NOMBRE = :nombre,
            @MEDIOR = :medioR,
            @PUESTO = :puesto,
            @SUCURSAL = :sucursal,
            @CORREO = :correo,
            @TELEFONO = :telefono,
            @URL = :url,
            @EVALUACION = :evaluacion,
            @COMENTARIOS = :comentarios,
            @ESTATUS = :estatus";

            $stmt = $this->dbOnBase->prepare($sql);

            $stmt->execute([
                ':id' => $data['id'],
                ':nombre' => $data['nombre'],
                ':medioR' => $data['medioR'],
                ':puesto' => $data['puesto'],
                ':sucursal' => $data['sucursal'],
                ':correo' => $data['correo'],
                ':telefono' => $data['telefono'],
                ':url' => $data['url'],
                ':evaluacion' => $data['evaluacion'],
                ':comentarios' => $data['comentarios'],
                ':estatus' => $data['estatus']
            ]);

            // Obtener el mensaje de retorno
            $resultado = $stmt->fetch(PDO::FETCH_ASSOC);

            return $resultado;
        } catch (PDOException $e) {
            return 'Error en base de datos: ' . $e->getMessage();
        }
    }

    public function getCandidatosModel()
    {
        if ($_SESSION['usuario'] === 'Monserrat' || $_SESSION['usuario'] === 'admin') {
            $sql = "SELECT * FROM [PORTALONBASE].[dbo].[OB_WEB_Candidatos] order by Fecha desc";
        } else {
            $sql = "SELECT * FROM [PORTALONBASE].[dbo].[OB_WEB_Candidatos] WHERE Reclutador = '" . $_SESSION['usuario'] . "' order by Fecha desc";
        }

        try {
            $this->dbOnBase->connect();
            $this->dbOnBase->query($sql);
            $resultados = $this->dbOnBase->obtener_registros();
            return $resultados;
        } catch (PDOEXception $e) {
            return [];
        }
    }

    public function validaTelCandidatoModel($telefono)
    {
        try {
            $this->dbOnBase->connect();
            $sql = "SELECT Telefono FROM [PORTALONBASE].[dbo].[OB_WEB_Candidatos] where Telefono = '" . $telefono . "'";
            $this->dbOnBase->query($sql);
            $resultados = $this->dbOnBase->obtener_registros();
            return $resultados;
        } catch (PDOEXception $e) {
            return [];
        }
    }

    public function filtrarCandidatoModel($query)
    {
        try {
            $this->dbOnBase->connect();
            $this->dbOnBase->query($query);
            $resultados = $this->dbOnBase->obtener_registros();
            return $resultados;
        } catch (PDOEXception $e) {
            return [];
        }
    }

    public function deleteCandidatoModel($id)
    {
        try {
            $this->dbOnBase->connect();
            $sql = "DELETE FROM OB_WEB_Candidatos WHERE Id = :id";
            $stmt = $this->dbOnBase->prepare($sql);
            $stmt->execute([':id' => $id]);
        } catch (PDOEXception $e) {
            return [];
        }
    }

    public function getPuestosModel()
    {
        try {
            $this->dbOnBase->connect();
            $sql = "SELECT * FROM OB_WEB_Candidatos_Puestos";
            $this->dbOnBase->query($sql);
            $resultados = $this->dbOnBase->obtener_registros();
            return $resultados;
        } catch (PDOEXception $e) {
            return [];
        }
    }

    public function agregarPuestoModel($puesto)
    {
        try {
            $this->dbOnBase->connect();
            $sql = "INSERT INTO OB_WEB_Candidatos_Puestos(Puesto) VALUES (:puesto)";
            $stmt = $this->dbOnBase->prepare($sql);
            $stmt->execute([':puesto' => $puesto]);
            return true;
        } catch (PDOEcception $e) {
            return [];
        }
    }


    public function agregarComentarioModel($comentario)
    {
        try {
            $this->dbOnBase->connect();

            $sql = "UPDATE OB_WEB_Candidatos
                    SET ComentarioFinal = :comentario
                    WHERE Id = :id";
            $stmt = $this->dbOnBase->prepare($sql);
            $stmt->execute([
                ':comentario' => $comentario['comentario'],
                ':id'         => $comentario['id']
            ]);
            return true;
        } catch (PDOException $e) {
            error_log("Error en agregarComentarioModel: " . $e->getMessage());
            return false;
        }
    }

    public function getChecklistPendientesModel()
    {
        try {
            $this->dbOnBase->connect();
            $sql = 'exec [dbo].[OB_WEB_CL_ClSinReferencia]';
            $this->dbOnBase->query($sql);
            $resultados = $this->dbOnBase->obtener_registros();
            return $resultados;
        } catch (PDOEXception $e) {
            return [];
        }
    }

    public function getChecklistPendientesFecha($fechaI, $fechaF)
    {
        try {
            $this->dbOnBase->connect();
            $sql = 'exec [dbo].[OB_WEB_CL_ClSinReferenciaFecha]"' . $fechaI . '","' . $fechaF . '"';
            $this->dbOnBase->query($sql);
            $resultados = $this->dbOnBase->obtener_registros();
            return $resultados;
        } catch (PDOEXception $e) {
            return [];
        }
    }



    public function documentos($clave, $valor, $radiob)
    {
        try {
            $this->dbOnBase->connect();
            $sql = "exec [OBINTEGRATIONS].[dbo].[SP_OB_CCD_WEB_DocumentosVigentes_xVista] '2','" . $clave . "','" . $valor . "','" . $radiob . "'";
            $this->dbOnBase->query($sql);
            $resultados = $this->dbOnBase->obtener_registros();
            return $resultados;
        } catch (PDOEXception $e) {
            return [];
        }
    }
    public function documentosING($clave, $valor, $radiob)
    {
        try {
            $this->dbOnBase->connect();
            $sql = "exec [OBINTEGRATIONS].[dbo].[SP_OB_CCD_WEB_DocumentosVigentes_xVista] '1','" . $clave . "','" . $valor . "','" . $radiob . "'";
            $this->dbOnBase->query($sql);
            $resultados = $this->dbOnBase->obtener_registros();
            return $resultados;
        } catch (PDOEXception $e) {
            return [];
        }
    }
    public function descargaDocs($usuario)
    {
        try {
            $this->dbOnBase->connect();
            $sql = "exec [OBINTEGRATIONS].[dbo].[SP_OB_CCD_WEB_Usuario_Permiso_DescargaDocumentos] '" . $usuario . "'";
            $this->dbOnBase->query($sql);
            $resultados = $this->dbOnBase->obtener_registros();
            return $resultados;
        } catch (PDOEXception $e) {
            return [];
        }
    }

    public function PermisoVisualizarModal($usuario)
    {
        try {
            $this->dbOnBase->connect();
            $sql = "exec [OBINTEGRATIONS].[dbo].[SP_OB_CCD_WEB_Usuario_Permiso_Visualizar_Modal] '" . $usuario . "'";
            $this->dbOnBase->query($sql);
            $resultados = $this->dbOnBase->obtener_registros();
            return $resultados;
        } catch (PDOEXception $e) {
            return [];
        }
    }

    public function ingClaveRel($clave, $v)
    {
        try {
            $this->dbOnBase->connect();
            $sql = "exec [OBINTEGRATIONS].[dbo].[SP_OB_CCD_WEB_Consulta_ClaveRelacionada] '" . $clave . "', '" . $v . "'";
            $this->dbOnBase->query($sql);
            $resultados = $this->dbOnBase->obtener_registros();
            return $resultados;
        } catch (PDOEXception $e) {
            return [];
        }
    }

    public function ingDocumentosOBSajax($clave)
    {
        try {
            $this->dbOnBase->connect();
            $sql = "exec [OBINTEGRATIONS].[dbo].[SP_OB_CCD_WEB_DocumentosRevisionObsoleta] '" . $clave . "'";
            $this->dbOnBase->query($sql);
            $resultados = $this->dbOnBase->obtener_registros();
            return $resultados;
        } catch (PDOEXception $e) {
            return [];
        }
    }
    public function sgcPuestoRelacionados($clave)
    {
        try {
            $this->dbOnBase->connect();
            $sql = "exec [OBINTEGRATIONS].[dbo].[SP_OB_CCD_WEB_Consulta_PuestosRelacionados] '" . $clave . "','2'";
            $this->dbOnBase->query($sql);
            $resultados = $this->dbOnBase->obtener_registros();
            return $resultados;
        } catch (PDOEXception $e) {
            return [];
        }
    }
    public function consulta_procesos($valor1)
    {
        try {
            $this->dbOnBase->connect();
            $sql = "exec [OBINTEGRATIONS].[dbo].[SP_OB_CCD_WEB_PermisosUsuario_Procesos] '" . $valor1 . "'";
            $this->dbOnBase->query($sql);
            $resultados = $this->dbOnBase->obtener_registros();
            return $resultados;
        } catch (PDOEXception $e) {
            return [];
        }
    }
    public function consulta_procesos2($valor2)
    {
        try {
            $this->dbOnBase->connect();
            $sql = "exec [OBINTEGRATIONS].[dbo].[SP_OB_CCD_WEB_PermisosUsuario_Procesos] '" . $valor2 . "'";
            $this->dbOnBase->query($sql);
            $resultados = $this->dbOnBase->obtener_registros();
            return $resultados;
        } catch (PDOEXception $e) {
            return [];
        }
    }
    public function KardexEmpleado($norma, $proceso)
    {
        try {
            $this->dbOnBase->connect();
            $sql = "exec [OBINTEGRATIONS].[dbo].[SP_OB_CCD_WEB_ConsultaDifusionEmpleado] '" . $norma . "', '" . $proceso . "'";
            $this->dbOnBase->query($sql);
            $resultados = $this->dbOnBase->obtener_registros();
            return $resultados;
        } catch (PDOEXception $e) {
            return [];
        }
    }
    public function KardexAreas($norma, $proceso)
    {
        try {
            $this->dbOnBase->connect();
            $sql = "exec [OBINTEGRATIONS].[dbo].[SP_OB_CCD_WEB_ConsultaDifusionArea] '" . $norma . "', '" . $proceso . "'";
            $this->dbOnBase->query($sql);
            $resultados = $this->dbOnBase->obtener_registros();
            return $resultados;
        } catch (PDOEXception $e) {
            return [];
        }
    }

    public function KardexDetalle($norma, $proceso)
    {
        try {
            $this->dbOnBase->connect();
            $sql = "exec [OBINTEGRATIONS].[dbo].[SP_OB_CCD_WEB_ConsultaDifusionEmpleadoDetalle] '" . $norma . "', '" . $proceso . "'";
            $this->dbOnBase->query($sql);
            $resultados = $this->dbOnBase->obtener_registros();
            return $resultados;
        } catch (PDOEXception $e) {
            return [];
        }
    }

    public function normas()
    {
        try {
            $this->dbOnBase->connect();
            $sql = "exec [OBINTEGRATIONS].[dbo].[SP_OB_CCD_WEB_Consulta_Normas] ";
            $this->dbOnBase->query($sql);
            $resultados = $this->dbOnBase->obtener_registros();
            return $resultados;
        } catch (PDOEXception $e) {
            return [];
        }
    }
    public function procesosDifusion()
    {
        try {
            $this->dbOnBase->connect();
            $sql = "exec [OBINTEGRATIONS].[dbo].[SP_OB_CCD_WEB_Consulta_Procesos] ";
            $this->dbOnBase->query($sql);
            $resultados = $this->dbOnBase->obtener_registros();
            return $resultados;
        } catch (PDOEXception $e) {
            return [];
        }
    }
    public function consulta_procesos3($valor3)
    {
        try {
            $this->dbOnBase->connect();
            $sql = "exec [OBINTEGRATIONS].[dbo].[SP_OB_CCD_WEB_PermisosUsuario_Procesos] '" . $valor3 . "'";
            $this->dbOnBase->query($sql);
            $resultados = $this->dbOnBase->obtener_registros();
            return $resultados;
        } catch (PDOEXception $e) {
            return [];
        }
    }

    public function consulta_validacion($valor1)
    {
        try {
            $this->dbOnBase->connect();
            $sql = "exec [OBINTEGRATIONS].[dbo].[SP_OB_CCD_WEB_Procesos_Validacion_Opciones] '" . $valor1 . "'";
            $this->dbOnBase->query($sql);
            $resultados = $this->dbOnBase->obtener_registros();
            return $resultados;
        } catch (PDOEXception $e) {
            return [];
        }
    }
    public function consulta_validacion2($valor2)
    {
        try {
            $this->dbOnBase->connect();
            $sql = "exec [OBINTEGRATIONS].[dbo].[SP_OB_CCD_WEB_Procesos_Validacion_Opciones] '" . $valor2 . "'";
            $this->dbOnBase->query($sql);
            $resultados = $this->dbOnBase->obtener_registros();
            return $resultados;
        } catch (PDOEXception $e) {
            return [];
        }
    }
    public function consulta_validacion3($valor3)
    {
        try {
            $this->dbOnBase->connect();
            $sql = "exec [OBINTEGRATIONS].[dbo].[SP_OB_CCD_WEB_Procesos_Validacion_Opciones] '" . $valor3 . "'";
            $this->dbOnBase->query($sql);
            $resultados = $this->dbOnBase->obtener_registros();
            return $resultados;
        } catch (PDOEXception $e) {
            return [];
        }
    }

    public function consulta_opcionesASG($usuario)
    {
        try {
            $this->dbOnBase->connect();
            $sql = "exec [OBINTEGRATIONS].[dbo].[SP_OB_CCD_WEB_Valida_Permiso_Opciones] '" . $usuario . "','2'";
            $this->dbOnBase->query($sql);
            $resultados = $this->dbOnBase->obtener_registros();
            return $resultados;
        } catch (PDOEXception $e) {
            return [];
        }
    }

    public function consulta_SolicitudesAbiertas($datoob, $tipo)
    {
        try {
            $this->dbOnBase->connect();
            $sql = "exec [OBINTEGRATIONS].[dbo].[SP_OB_CCD_WEB_ConsultaSolicitudes] '" . $datoob . "','" . $tipo . "'";
            $this->dbOnBase->query($sql);
            $resultados = $this->dbOnBase->obtener_registros();
            return $resultados;
        } catch (PDOEXception $e) {
            return [];
        }
    }
    public function consulta_opcionesING($usuario)
    {
        try {
            $this->dbOnBase->connect();
            $sql = "exec [OBINTEGRATIONS].[dbo].[SP_OB_CCD_WEB_Valida_Permiso_Opciones] '" . $usuario . "','1'";
            $this->dbOnBase->query($sql);
            $resultados = $this->dbOnBase->obtener_registros();
            return $resultados;
        } catch (PDOEXception $e) {
            return [];
        }
    }
    public function acciones_correctivas()
    {
        try {
            $this->dbOnBase->connect();
            $sql = "exec [OBINTEGRATIONS].[dbo].[SP_OB_ASG_AccionesCorrectivasTiempos] ";
            $this->dbOnBase->query($sql);
            $resultados = $this->dbOnBase->obtener_registros();
            return $resultados;
        } catch (PDOEXception $e) {
            return [];
        }
    }
    public function reclamos_tiempos($fechaI, $fechaF)
    {
        try {
            $this->dbOnBase->connect();

            $sql = "exec [OBINTEGRATIONS].[dbo].[SP_OB_SAC_ReclamosTiempos] '" . $fechaI . "','" . $fechaF . "'";
            $this->dbOnBase->query($sql);
            $resultados = $this->dbOnBase->obtener_registros();
            return $resultados;
        } catch (PDOEXception $e) {
            return [];
        }
    }

    public function altaprov_tiempos($fechaI, $fechaF)
    {
        try {
            $this->dbOnBase->connect();

            $sql = "exec [OBINTEGRATIONS].[dbo].[SP_OB_CMP_AltaProveedor_Tiempos] '" . $fechaI . "','" . $fechaF . "'";
            $this->dbOnBase->query($sql);
            $resultados = $this->dbOnBase->obtener_registros();
            return $resultados;
        } catch (PDOEXception $e) {
            return [];
        }
    }

    public function pedimentos_tiempos($fechaI, $fechaF)
    {
        try {
            $this->dbOnBase->connect();

            $sql = "exec [OBINTEGRATIONS].[dbo].[SP_OB_CXP_PedimentosTiempos] '" . $fechaI . "','" . $fechaF . "'";
            $this->dbOnBase->query($sql);
            $resultados = $this->dbOnBase->obtener_registros();
            return $resultados;
        } catch (PDOEXception $e) {
            return [];
        }
    }

    public function consulta_catalogo($v, $m, $s)
    {
        try {
            if ($s == null) {
                $s = '';
            }
            $this->dbOnBase->connect();
            $sql = "exec [OBINTEGRATIONS].[dbo].[SP_OB_CDD_WEB_Catalogo_UsuarioModuloOpciones] '" . $v . "', '" . $m . "', '" . $s . "'";
            $this->dbOnBase->query($sql);
            $resultados = $this->dbOnBase->obtener_registros();
            return $resultados;
        } catch (PDOEXception $e) {
            return [];
        }
    }

    public function agregar_permiso($usuario, $seccion, $sub, $opcion)
    {
        try {
            $this->dbOnBase->connect();
            $sql = "exec [OBINTEGRATIONS].[dbo].[SP_OB_CCD_WEB_Agregar_PermisosUsuario] '" . $usuario . "','" . $seccion . "','" . $sub . "','" . $opcion . "'";
            //VAR_DUMP($sql);
            $this->dbOnBase->query($sql);
            $resultados = $this->dbOnBase->obtener_registro();

            return $resultados;
        } catch (PDOEXception $e) {
            return [];
        }
    }

    public function insertaUsuarioControl($usuario, $estatus, $mod)
    {
        try {
            $this->dbOnBase->connect();
            $sql = "exec [OBINTEGRATIONS].[dbo].[SP_OB_CCD_WEB_Inserta_Usuario_Inactivo] '" . $usuario . "','" . $estatus . "','" . $mod . "'";
            //VAR_DUMP($sql);
            $this->dbOnBase->query($sql);
            $resultados = $this->dbOnBase->obtener_registro();

            return $resultados;
        } catch (PDOEXception $e) {
            return [];
        }
    }

    public function consultaUsuarioCMP()
    {
        try {
            $this->dbOnBase->connect();
            $sql = "exec [OBINTEGRATIONS].[dbo].[SP_OB_CCD_WEB_ConsultaUsuarioCMP] ";
            //VAR_DUMP($sql);
            $this->dbOnBase->query($sql);
            $resultados = $this->dbOnBase->obtener_registros();

            return $resultados;
        } catch (PDOEXception $e) {
            return [];
        }
    }

    public function elimina_permiso($usuario, $seccion, $sub, $opcion, $tipo)
    {
        try {
            $this->dbOnBase->connect();
            $sql = "exec [OBINTEGRATIONS].[dbo].[SP_OB_CCD_WEB_Elimina_PermisosUsuario] '" . $usuario . "','" . $seccion . "','" . $sub . "','" . $opcion . "','" . $tipo . "'";
            //VAR_DUMP($sql);
            $this->dbOnBase->query($sql);
            $resultados = $this->dbOnBase->obtener_registro();

            return $resultados;
        } catch (PDOEXception $e) {
            return [];
        }
    }

    public function consulta_Permisos($usuario)
    {
        try {
            $this->dbOnBase->connect();
            $sql = "exec [OBINTEGRATIONS].[dbo].[SP_OB_CCD_WEB_Consulta_PermisosUsuario] '" . $usuario . "'";
            $this->dbOnBase->query($sql);
            $resultados = $this->dbOnBase->obtener_registros();
            return $resultados;
        } catch (PDOEXception $e) {
            return [];
        }
    }

    public function consulta_usuarios_PU()
    {
        try {
            $this->dbOnBase->connect();
            $sql = "exec [OBINTEGRATIONS].[dbo].[SP_OB_CCD_WEB_Consulta_UsuariosPU] ";
            $this->dbOnBase->query($sql);
            $resultados = $this->dbOnBase->obtener_registros();
            return $resultados;
        } catch (PDOEXception $e) {
            return [];
        }
    }

    public function insertaXML($xmlString)
    {
        try {
            $this->dbOnBase->connect();

            $sql = "EXEC [OBINTEGRATIONS].[dbo].[SP_OB_CMP_WEB_INSERTA_ARTICULO_VENDOR] '" . $xmlString . "'";
            //echo $sql;

            $this->dbOnBase->query($sql);

            $resultados = $this->dbOnBase->obtener_registros();

            return $resultados;
        } catch (PDOException $e) {
            //return ["error modelo"];
            echo $e;
        }
    }


    public function obtener_archivos()
    {
        try {
            // Ruta del directorio donde están los archivos
            $fileName = "";
            $fileExtension = "";
            // Ruta del directorio donde están los archivos
            $path  = '//192.168.1.191/coflex/public/pdf_docs/';
            // Arreglo con todos los nombres de los archivos
            $files = array_diff(scandir($path), array('.', '..'));
            //print_r($files);
            return $files;
        } catch (PDOEXception $e) {
            // echo $rutaArchivo;
            return [];
        }
    }
}
