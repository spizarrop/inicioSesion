<?php
require_once __DIR__.'/../config/rutas.php';
require_once __DIR__.'/../'.MODELO.'ModUsuario.php';

class ConUsuario {
    private $modelo;
    public $vista;

    public function __construct() {
        $this->modelo = new ModUsuario();
    }

    /**
     * Muestra la vista de login
     */
    public function loginForm() {
        $this->vista = "login.php";
    }

    /**
     * Procesa el login
     */
    public function procesarLogin() {
        session_start();

        $usuario = $this->modelo->loginNoControlado();

        if ($usuario) {
            $_SESSION['usuario'] = $usuario['nombre'];
            $_SESSION['tipo'] = $usuario['tipo'];
            header("Location: index.php?c=Usuario&m=bienvenida");
            exit;
        } else {
            $this->vista = "login.php";
            return "Usuario o contraseña incorrectos";
        }
    }

    /**
     * Muestra la vista de registro
     */
    public function registroForm() {
        $this->vista = "registro.php";
    }

    /**
     * Procesa el registro
     */
    public function procesarRegistro() {
        if (empty($_POST['nombre']) || empty($_POST['correo']) || empty($_POST['contrasenia']) || empty($_POST['contrasenia2'])) {
            $this->vista = "registro.php";
            return "Todos los campos son obligatorios";
        }

        if ($_POST['contrasenia'] !== $_POST['contrasenia2']) {
            $this->vista = "registro.php";
            return "Las contraseñas no coinciden";
        }

        if ($this->modelo->registrar()) {
            $this->vista = "login.php";
            return "Registro exitoso, ahora puedes iniciar sesión";
        } else {
            $this->vista = "registro.php";
            return "Error al registrar usuario";
        }
    }

    /**
     * Cierra sesión
     */
    public function logout() {
        session_start();
        session_destroy();
        header("Location: index.php?c=Usuario&m=loginForm");
        exit;
    }

    /**
     * Muestra la vista de bienvenida
     */
    public function bienvenida() {
        $this->vista = "bienvenida.php";
    }
}
?>
