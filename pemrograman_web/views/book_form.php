<?php
    $isEdit = isset($book);
    $actionUrl = $isEdit ? BASE_URL . "book/update/" . $book['id'] : BASE_URL . "book/store";
    $title = $isEdit ? "Edit Book" : "Add New Book";
?>

<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card custom-card">
            <div class="card-header bg-white border-0 py-3">
                <h4 class="mb-0 text-primary fw-bold"><?= $title ?></h4>
            </div>
            <div class="card-body p-4">
                <form action="<?= $actionUrl ?>" method="POST" enctype="multipart/form-data">
                    
                    <div class="mb-3">
                        <label class="form-label text-muted fw-bold small">BOOK TITLE</label>
                        <input type="text" name="title" class="form-control form-control-lg" 
                               value="<?= $isEdit ? htmlspecialchars($book['title']) : '' ?>" required>
                    </div>

                    <div class="mb-4">
                        <label class="form-label text-muted fw-bold small">AUTHOR NAME</label>
                        <input type="text" name="author" class="form-control" 
                               value="<?= $isEdit ? htmlspecialchars($book['author']) : '' ?>" required>
                    </div>

                    <div class="mb-4">
                        <label class="form-label text-muted fw-bold small">COVER IMAGE (Optional)</label>
                        <input type="file" name="cover_image" class="form-control" accept="image/png, image/jpeg, image/jpg">
                        <?php if ($isEdit && !empty($book['cover_image'])): ?>
                            <div class="mt-2">
                                <small class="text-muted">Current Cover:</small><br>
                                <img src="<?= BASE_URL . 'assets/img/' . $book['cover_image'] ?>" alt="Current Cover" class="img-thumbnail" style="max-height: 100px;">
                            </div>
                        <?php endif; ?>
                        <div class="form-text small">Allowed formats: JPG, JPEG, PNG.</div>
                    </div>

                    <div class="d-flex justify-content-between mt-4">
                        <a href="<?= BASE_URL ?>book" class="btn btn-light text-muted">Cancel</a>
                        <button type="submit" class="btn btn-primary-custom px-4">
                            <i class="fas fa-save me-2"></i> Save Book
                        </button>
                    </div>
                    
                </form>
            </div>
        </div>
    </div>
</div>