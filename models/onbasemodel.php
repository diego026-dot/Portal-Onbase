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
            if($clientes === ''){
                $sql = "exec [dbo].[OB_WEB_ReporteClientes] '" . $clientes . "','" . $fechaI . "','" . $fechaF . "',' 2 '";
            }else {
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

    public function agregarUsuarios($id, $usuario, $correo, $contrasena, $activo, $tipo)
    {
        try {
            $this->dbOnBase->connect();
            $sql = " exec [dbo].[OB_WEB_AgregarUsuario] '" . $id . "','" . $usuario . "','" . $correo . "',
            '" . $contrasena . "','" . $activo . "','" . $tipo . "'";
            $this->dbOnBase->query($sql);
            $this->dbOnBase->ejecutar();
        } catch (PDOEXception $e) {
            return [];
        }
    }

    public function editarUsuarios($id, $usuario, $correo, $contrasena, $activo, $tipo)
    {
        try {
            $this->dbOnBase->connect();
            $sql = " exec [dbo].[OB_WEB_AgregarUsuario] '" . $id . "','" . $usuario . "','" . $correo . "',
            '" . $contrasena . "','" . $activo . "','" . $tipo . "'";
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

    public function insertaFacturasPortal($a ,$b, $c, $d, $e, $f, $g, $h)
    {
        try {
            $this->dbOnBase->connect();
            $sql = "exec [dbo].[OB_WEB_InsertaFacturasPortal] '" . $a . "', '" . $b . "', '" . $c . "', " . 
            (is_null($d) ? "NULL" : "'" . $d . "'") . ", " . 
            (is_null($e) ? "NULL" : "'" . $e . "'") . ", " . 
            (is_null($f) ? "NULL" : "'" . $f . "'") . ", " . 
            (is_null($g) ? "NULL" : "'" . $g . "'") . ", " . 
            (is_null($h) ? "NULL" : "'" . $h . "'");
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
  [Fecha de creacion] AS [FechaCreacion],
  [Estatus],
  [ID Documento] AS [IDDocumento],
  [Pedimento],
  [Patente],
  [Aduana],
  [Referencia],
  [Remesa],
  [Cliente],
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
  [Fecha de creacion],
  [Estatus],
  [ID Documento],
  [Pedimento],
  [Patente],
  [Aduana],
  [Referencia],
  [Remesa],
  [Cliente],
  [Numero de Cliente],
  [Clave de Pedimento],
  [Segunda Facturacion]
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
