<?php
class Auth {
    private $db;

    public function __construct() {
        $database = new Database();
        $this->db = $database->getConnection();
    }

    public function login() {
        if (isset($_SESSION['user_id'])) {
            header("Location: " . BASE_URL . "dashboard");
            exit;
        }
        require_once 'views/login.php';
    }

    public function authenticate() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $username = $_POST['username'];
            
            // PERUBAHAN: Password tidak lagi di-enkripsi md5()
            // Password diambil langsung apa adanya (plain text)
            $password = $_POST['password']; 

            $query = "SELECT * FROM users WHERE username = :username AND password = :password LIMIT 1";
            $stmt = $this->db->prepare($query);
            $stmt->bindParam(':username', $username);
            $stmt->bindParam(':password', $password);
            $stmt->execute();
            $user = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($user) {
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['username'] = $user['username'];
                $_SESSION['role'] = $user['role'];
                header("Location: " . BASE_URL . "dashboard");
            } else {
                $_SESSION['error'] = "Invalid Username or Password";
                header("Location: " . BASE_URL . "auth/login");
            }
        }
    }

    public function logout() {
        session_destroy();
        header("Location: " . BASE_URL . "auth/login");
        exit;
    }
}