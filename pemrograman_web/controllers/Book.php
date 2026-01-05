<?php
class BookController {
    private $model;

    public function __construct() {
        $this->model = new BookModel();
    }

    public function index() {
        $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
        $search = isset($_GET['search']) ? $_GET['search'] : "";
        $limit = 3;
        $offset = ($page - 1) * $limit;

        $books = $this->model->getAll($search, $limit, $offset);
        $total_books = $this->model->countAll($search);
        $total_pages = ceil($total_books / $limit);

        require_once 'views/header.php';
        require_once 'views/books.php';
        require_once 'views/footer.php';
    }

    public function create() {
        $this->checkAdmin();
        require_once 'views/header.php';
        require_once 'views/book_form.php';
        require_once 'views/footer.php';
    }

    public function store() {
        $this->checkAdmin();
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $coverImageName = $this->handleFileUpload();

            $data = [
                'title' => $_POST['title'],
                'author' => $_POST['author'],
                'cover_image' => $coverImageName
            ];
            $this->model->create($data);
            header("Location: " . BASE_URL . "book");
        }
    }

    public function edit($id) {
        $this->checkAdmin();
        $book = $this->model->getById($id);
        require_once 'views/header.php';
        require_once 'views/book_form.php';
        require_once 'views/footer.php';
    }

    public function update($id) {
        $this->checkAdmin();
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $coverImageName = $this->handleFileUpload();

            $data = [
                'title' => $_POST['title'],
                'author' => $_POST['author'],
                'cover_image' => $coverImageName // Akan null jika tidak ada file baru diupload
            ];
            $this->model->update($id, $data);
            header("Location: " . BASE_URL . "book");
        }
    }

    public function delete($id) {
        $this->checkAdmin();
        $this->model->delete($id);
        header("Location: " . BASE_URL . "book");
    }

    private function checkAdmin() {
        if ($_SESSION['role'] !== 'admin') {
            die("Access Denied: You do not have permission.");
        }
    }

    // Helper function untuk upload gambar
    private function handleFileUpload() {
        if (isset($_FILES['cover_image']) && $_FILES['cover_image']['error'] === UPLOAD_ERR_OK) {
            $fileTmpPath = $_FILES['cover_image']['tmp_name'];
            $fileName = $_FILES['cover_image']['name'];
            $fileSize = $_FILES['cover_image']['size'];
            $fileType = $_FILES['cover_image']['type'];
            $fileNameCmps = explode(".", $fileName);
            $fileExtension = strtolower(end($fileNameCmps));

            // Validasi ekstensi yang diperbolehkan
            $allowedfileExtensions = array('jpg', 'gif', 'png', 'jpeg');
            if (in_array($fileExtension, $allowedfileExtensions)) {
                // Generate nama file unik agar tidak bentrok
                $newFileName = md5(time() . $fileName) . '.' . $fileExtension;
                // Folder tujuan (Asumsi folder ini sudah dibuat manual: assets/img/)
                $uploadFileDir = 'assets/img/';
                $dest_path = $uploadFileDir . $newFileName;

                if(move_uploaded_file($fileTmpPath, $dest_path)) {
                    return $newFileName;
                }
            }
        }
        return null;
    }
}