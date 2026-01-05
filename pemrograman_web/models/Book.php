<?php
class BookModel {
    private $conn;
    private $table = "books";

    public function __construct() {
        $database = new Database();
        $this->conn = $database->getConnection();
    }

    public function getAll($search = "", $limit = 5, $offset = 0) {
        $query = "SELECT * FROM " . $this->table . " 
                  WHERE title LIKE :search OR author LIKE :search 
                  ORDER BY id DESC LIMIT :limit OFFSET :offset";
        $stmt = $this->conn->prepare($query);
        $searchTerm = "%$search%";
        $stmt->bindParam(':search', $searchTerm);
        $stmt->bindParam(':limit', $limit, PDO::PARAM_INT);
        $stmt->bindParam(':offset', $offset, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function countAll($search = "") {
        $query = "SELECT COUNT(*) as total FROM " . $this->table . " 
                  WHERE title LIKE :search OR author LIKE :search";
        $stmt = $this->conn->prepare($query);
        $searchTerm = "%$search%";
        $stmt->bindParam(':search', $searchTerm);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        return $row['total'];
    }

    public function getById($id) {
        $query = "SELECT * FROM " . $this->table . " WHERE id = :id LIMIT 1";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function create($data) {
        // Update query untuk menyertakan cover_image
        $query = "INSERT INTO " . $this->table . " (title, author, cover_image) VALUES (:title, :author, :cover_image)";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':title', $data['title']);
        $stmt->bindParam(':author', $data['author']);
        // Gunakan Null jika tidak ada gambar
        $coverValue = !empty($data['cover_image']) ? $data['cover_image'] : null;
        $stmt->bindParam(':cover_image', $coverValue);
        return $stmt->execute();
    }

    public function update($id, $data) {
        // Logic untuk menghapus gambar lama jika ada gambar baru yang diupload
        if (!empty($data['cover_image'])) {
            $oldBook = $this->getById($id);
            if ($oldBook && $oldBook['cover_image'] && file_exists('assets/img/' . $oldBook['cover_image'])) {
                unlink('assets/img/' . $oldBook['cover_image']);
            }
            $query = "UPDATE " . $this->table . " SET title=:title, author=:author, cover_image=:cover_image WHERE id=:id";
        } else {
            // Jika tidak ada gambar baru, jangan update kolom cover_image
            $query = "UPDATE " . $this->table . " SET title=:title, author=:author WHERE id=:id";
        }

        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':title', $data['title']);
        $stmt->bindParam(':author', $data['author']);
        $stmt->bindParam(':id', $id);
        
        if (!empty($data['cover_image'])) {
             $stmt->bindParam(':cover_image', $data['cover_image']);
        }
        
        return $stmt->execute();
    }

    public function delete($id) {
        // Hapus file gambar fisik terlebih dahulu sebelum menghapus data di DB
        $book = $this->getById($id);
        if ($book && $book['cover_image']) {
            $filePath = 'assets/img/' . $book['cover_image'];
            if (file_exists($filePath)) {
                unlink($filePath);
            }
        }

        $query = "DELETE FROM " . $this->table . " WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id);
        return $stmt->execute();
    }
}