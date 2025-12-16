<?php
require_once __DIR__.'/../config/conexion.php';

class ModUsuario extends Conexion {

    public function __construct() {
        parent::__construct();
    }

    /**
     * Método para registrar los usuarios
     * @return bool
     */
    public function registro() {
        try {
            // Establecemos la consulta del registro
            $sql = "INSERT INTO usuarios (nombre, contrasenia, correo, tipo) VALUES (:nombre, :contrasenia, :correo, :tipo)";
            // Preparamos la consulta
            $stmt = $this->conexion->prepare($sql);

            // Hasheamos la contraseña (este registro solo lo uso para el login seguro)
            $contraseniaHash = password_hash($_POST['contrasenia'], PASSWORD_DEFAULT);

            // Indicamos los parámetros de nuestra consulta
            $stmt->bindParam(':nombre', $_POST['nombre']);
            $stmt->bindParam(':contrasenia', $contraseniaHash);
            $stmt->bindParam(':correo', $_POST['correo']);
            $tipo = 'U';
            $stmt->bindParam(':tipo', $tipo);

            // Ejecutamos la consulta y devolvemos si fue correcta
            return $stmt->execute();
        } catch (PDOException $e) {
            // Si no se hizo correctamente devolvemos un false
            return false;
        }
    }

    /**
     * Método para realizar un login seguro (consulta preparada + password_verify del hash)
     * @return array|false
     */
    public function loginSeguro() {
        try {
            // Establecemos la consulta del login seguro
            $sql = "SELECT * FROM usuarios WHERE correo = :correo";
            // Preparamos la consulta
            $stmt = $this->conexion->prepare($sql);

            // Indicamos los parámetros
            $stmt->bindParam(':correo', $_POST['correo']);
            // Ejecutamos la consulta
            $stmt->execute();

            // Recogemos los datos de la consulta
            $usuario = $stmt->fetch(PDO::FETCH_ASSOC);

            // Verificamos la contraseña hasheada
            if ($usuario && password_verify($_POST['contrasenia'], $usuario['contrasenia'])) {
                // Si la contraseña es correcta devolvemos los datos del usuario
                return $usuario;
            }

            // Si la contraseña no es correcta devolvemos false
            return false;
        } catch (PDOException $e) {
            // Si se produce algun error devolvemos false
            return false;
        }
    }

    /**
     * Método para realizar un login INSEGURO que permitiria inyeccion SQL
     * @return array|false
     */
    public function loginInseguro() {
        try {
            // Establecemos la consulta insegura
            $sql = "SELECT * FROM usuarios WHERE correo = '".$_POST['correo']."' AND contrasenia = '".$_POST['contrasenia']."'";
            // Ejecutamos la consulta y recogemos los datos
            $resultado = $this->conexion->query($sql);
            // Devolvemos los datos
            return $resultado->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            // Si se produjese algun error devolvemos false
            return false;
        }
    }
}
?>