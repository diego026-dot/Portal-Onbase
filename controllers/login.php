<?php
include_once("libs/onbase/database.php");

class Login extends Controller {
    
    function __construct() {
        parent::__construct();
        $this->view->activa = "";
    }

    function render() {
        $this->view->render('login/index');
    }

    function validacion() {
     
        
        $usuario = $_POST['usuario'];
        $contrasena = $_POST['contrasena'];

       

        // Usar la clase DatabaseOnBase para la conexión a la base de datos
        $db = new DatabaseOnBase();
        if (!$db->connect()) {
            die("Error de conexión a la base de datos");
        }

        // Preparar y ejecutar el procedimiento almacenado
        $sql = "EXEC [dbo].[OB_WEB_ValidaUsuario] '" . $usuario . "','" . $contrasena . "'";

        if ($db->query($sql)) {
            $db->bindParam(1, $usuario);
            $db->bindParam(2, $contrasena);
            if ($db->ejecutar()) {
                $resultado = $db->obtener_registro();
                // var_dump($resultado);
                // Verificar el resultado del procedimiento almacenado
                if ($resultado && isset($resultado->VALIDACION)) {
                    if ($resultado->VALIDACION === "1") {

                        session_start();
                        $_SESSION['usuario'] = $usuario;

                        $sql2 = "EXEC [dbo].[OB_WEB_ObtieneUserID] '" . $usuario . "'";
                        if ($db->query($sql2)) {
                            $resultado2 = $db->obtener_registro();
                            if ($resultado2 && isset($resultado2->UsuarioID)) {
                                $_SESSION['usuarioid'] = $resultado2->UsuarioID;
                            }
                        }

                        $sql3 = "EXEC [dbo].[OB_WEB_ObtenerPermisosUsuario] '" . $usuario . "', '1'";
                        if ($db->query($sql3)) {
                            $resultado3 = $db->obtener_registros();
                            if ($resultado3) {
                                $_SESSION['UsuarioModulo'] = []; // Inicializa como un arreglo vacío
                                foreach ($resultado3 as $fila) {
                                    if (isset($fila->Modulo)) {
                                        $_SESSION['UsuarioModulo'][] = $fila->Modulo;
                                    }
                                }
                            }
                        }

                        $sql4 = "EXEC [dbo].[OB_WEB_ObtenerPermisosUsuario] '" . $usuario . "', '2'";
                        if ($db->query($sql4)) {
                            $resultado4 = $db->obtener_registros();
                            if ($resultado4) {
                                $_SESSION['UsuarioOpciones'] = []; // Inicializa como un arreglo vacío
                                foreach ($resultado4 as $fila) {
                                    if (isset($fila->Opcion)) {
                                        $_SESSION['UsuarioOpciones'][] = $fila->Opcion;
                                    }
                                }
                            }
                        }
                            //   print_r($_SESSION['UsuarioModulo']); 
                            //   print_r($_SESSION['UsuarioOpciones']); exit();

                        // Usuario y contraseña válidos   
                        // echo "Credenciales válidas, iniciando sesión.";
                      
                        // Redireccionar al área principal
                        header('Location: ' . constant('URL') . 'main');
                        // exit;
                    } else {
                        // Usuario o contraseña inválidos
                        // echo "Usuario o contraseña inválidos.";

                       
                        header('Location: ' . constant('URL') . 'login');
                        // exit;
                    }
                } else {
                    // Error: No se pudo obtener la propiedad VALIDACION
                    // echo "Error: No se pudo obtener la propiedad VALIDACION del resultado.";
                    
                    header('Location: ' . constant('URL') . 'login');
                    // exit;
                }
            } else {
                // Error al ejecutar el procedimiento
                // echo "Error al ejecutar el procedimiento.";
                
                header('Location: ' . constant('URL') . 'login');
                // exit;
            }
        } else {
            // Error al preparar el procedimiento
            // echo "Error al preparar el procedimiento.";
            
            header('Location: ' . constant('URL') . 'login');
            // exit;
             
        }
    }
}
?>
