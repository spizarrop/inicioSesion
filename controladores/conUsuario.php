<?php
require_once __DIR__.'/../config/rutas.php';
require_once __DIR__.'/../'.MODELO.'ModUsuario.php';

class ConUsuario {
    private $modeloUsu;
    public $vista;

    public function __construct() {
        $this->modeloUsu = new ModUsuario();
    }

    /**
     * Método que muestra la vista de login
     */
    public function loginForm() {
        // Establecemos la vista
        $this->vista = "login.php";
    }

    /**
     * Método que procesa el login
     */
    public function procesarLogin() {
        // Recojo la variable de la sesión para saber si el logueo es seguro o inseguro
        $modo = $_SESSION['modo_login'] ?? 'seguro';

        // Dependiendo del modo de logueo establecido llamamos a un método u otro
        if ($modo === 'inseguro') {
            // Método de login inseguro del modelo
            $usuario = $this->modeloUsu->loginInseguro();
        } else {
            // Método de login seguro del modelo
            $usuario = $this->modeloUsu->loginSeguro();
        }

        // Comprobamos si el inicio de sesión es correcto
        if ($usuario) {
            // Si el login es correcto guardamos los datos del usuario en la sesión
            $_SESSION['usuario'] = $usuario['nombre'];
            $_SESSION['tipo'] = $usuario['tipo'];

            // Redirigimos a la página de bienvenida
            header("Location: index.php?c=Usuario&m=bienvenida");
            exit;
        } else {
            // Mostramos la vista del login si no es correcto
            $this->vista = "login.php";
            // Indicamos el error
            return "Usuario o contraseña incorrectos";
        }
    }

    /**
     * Método para mostrar la vista del registro
     */
    public function registroForm() {
        // Indicamos la vista
        $this->vista = "registro.php";
    }

    /**
     * Método para procesar el registro
     */
    public function procesarRegistro() {
        // Validamos que los campos no estén vacios
        if (empty($_POST['nombre']) || empty($_POST['correo']) || empty($_POST['contrasenia']) || empty($_POST['contrasenia2'])) {
            // Si alguno está vacio volvemos a la vista
            $this->vista = "registro.php";
            // Mostramos un mensaje indicando el problema
            return "Todos los campos son obligatorios";
        }

        // Validamos que los campos de contraseñas sean iguales
        if ($_POST['contrasenia'] !== $_POST['contrasenia2']) {
            // Si no lo són volvemos a la vista
            $this->vista = "registro.php";
            // Mostramos un mensaje indicando el problema
            return "Las contraseñas no coinciden";
        }

        // Tras las validaciones llamamos al método del modelo para realizar el registro
        if ($this->modeloUsu->registro()) {
            // Una vez registrado indicamos la vista del login
            $this->vista = "login.php";
            // Mostramos un mensaje de exito
            return "Registro exitoso, ahora puedes iniciar sesión";
        } else {
            // Si hay algún error en el registro volvemos a la vista
            $this->vista = "registro.php";
            // Indicamos el error
            return "Error al registrar usuario";
        }
    }

    /**
     * Método para cerrar sesión
     */
    public function logout() {
        // No realizo un session_destroy() porque guardo el modo de inicio de sesion seguro/inseguro en el session
        unset($_SESSION['usuario']);
        unset($_SESSION['tipo']);

        // Redirigimos al login tras cerrar la sesión
        header("Location: index.php?c=Usuario&m=loginForm");
        exit;
    }

    /**
     * Método para mostrar la vista de bienvenida
     */
    public function bienvenida() {
        // Indicamos la vista
        $this->vista = "bienvenida.php";
    }

    /**
     * Método para cambiar el modo de login seguro / inseguro
     */
    public function cambiarModoLogin() {
        // Establecemos en la sesión el modo de logueo
        $_SESSION['modo_login'] = $_POST['modo_login'];

        // Redirigimos a la misma página para evitar reenvío del formulario
        header("Location: index.php?c=Usuario&m=bienvenida");
        exit;
    }
}
?>
