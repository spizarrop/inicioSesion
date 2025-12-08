<?php
require_once __DIR__.'/../config/conexion.php';

class ModUsuario extends Conexion {

    public function __construct() {
        parent::__construct();
    }

    /**
     * Inserta un nuevo usuario en la base de datos.
     * @return bool
     */
    public function registrar() {
        try {
            $sql = "INSERT INTO usuarios (nombre, contrasenia, correo, tipo) VALUES (:nombre, :contrasenia, :correo, :tipo)";
            $stmt = $this->conexion->prepare($sql);

            // Hasheamos la contraseña
            $contraseniaHash = password_hash($_POST['contrasenia'], PASSWORD_DEFAULT);

            $stmt->bindParam(':nombre', $_POST['nombre']);
            $stmt->bindParam(':contrasenia', $contraseniaHash);
            $stmt->bindParam(':correo', $_POST['correo']);
            $tipo = 'U'; // Tipo por defecto usuario normal
            $stmt->bindParam(':tipo', $tipo);

            return $stmt->execute();
        } catch (PDOException $e) {
            return false;
        }
    }

    /**
     * Verifica usuario y contraseña para login
     * @return array|false
     */
    public function login() {
        try {
            $sql = "SELECT * FROM usuarios WHERE nombre = :nombre OR correo = :correo";
            $stmt = $this->conexion->prepare($sql);
            $stmt->bindParam(':nombre', $_POST['nombre']);
            $stmt->bindParam(':correo', $_POST['nombre']);
            $stmt->execute();

            $usuario = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($usuario && password_verify($_POST['contrasenia'], $usuario['contrasenia'])) {
                return $usuario;
            } else {
                return false;
            }
        } catch (PDOException $e) {
            return false;
        }
    }
}
?>
