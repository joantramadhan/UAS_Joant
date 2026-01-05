<div class="row mb-4 align-items-center">
    <div class="col-md-6">
        <h2 class="fw-bold text-dark"><i class="fas fa-book me-2 text-primary"></i>Book Collection</h2>
    </div>
    <div class="col-md-6 text-md-end">
        <?php if ($_SESSION['role'] === 'admin'): ?>
            <a href="<?= BASE_URL ?>book/create" class="btn btn-primary-custom shadow-sm">
                <i class="fas fa-plus me-1"></i> Add New Book
            </a>
        <?php endif; ?>
    </div>
</div>

<div class="card custom-card mb-4">
    <div class="card-body p-2">
        <form action="<?= BASE_URL ?>book" method="GET" class="row g-2 align-items-center">
            <div class="col-md-10">
                <input type="text" name="search" class="form-control border-0" 
                       placeholder="Search by title or author..." 
                       value="<?= isset($_GET['search']) ? htmlspecialchars($_GET['search']) : '' ?>">
            </div>
            <div class="col-md-2">
                <button type="submit" class="btn btn-secondary w-100">Search</button>
            </div>
        </form>
    </div>
</div>

<div class="card custom-card overflow-hidden">
    <div class="table-responsive">
        <table class="table table-custom table-hover mb-0 align-middle">
            <thead>
                <tr>
                    <th class="ps-4">#</th>
                    <th class="text-center">Cover</th>
                    <th>Title</th>
                    <th>Author</th>
                    <th class="text-end pe-4">Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php if (empty($books)): ?>
                    <tr>
                        <td colspan="5" class="text-center py-5 text-muted">No books found.</td>
                    </tr>
                <?php else: ?>
                    <?php foreach ($books as $index => $book): ?>
                        <?php 
                            $imgSrc = !empty($book['cover_image']) ? BASE_URL . 'assets/img/' . $book['cover_image'] : BASE_URL . 'assets/img/default.jpg';
                        ?>
                        <tr>
                            <td class="ps-4"><?= $offset + $index + 1 ?></td>
                            <td class="text-center">
                                <img src="<?= $imgSrc ?>" alt="Cover" class="img-thumbnail shadow-sm" style="height: 50px; width: auto;">
                            </td>
                            <td class="fw-bold text-dark"><?= htmlspecialchars($book['title']) ?></td>
                            <td><?= htmlspecialchars($book['author']) ?></td>
                            <td class="text-end pe-4">
                                <button type="button" class="btn btn-sm btn-info text-white action-icon" 
                                        data-bs-toggle="modal" 
                                        data-bs-target="#detailModal"
                                        onclick="showDetail('<?= htmlspecialchars($book['title']) ?>', '<?= htmlspecialchars($book['author']) ?>', '<?= $imgSrc ?>')">
                                    <i class="fas fa-eye"></i>
                                </button>

                                <?php if ($_SESSION['role'] === 'admin'): ?>
                                    <a href="<?= BASE_URL ?>book/edit/<?= $book['id'] ?>" class="btn btn-sm btn-outline-primary action-icon">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <a href="<?= BASE_URL ?>book/delete/<?= $book['id'] ?>" 
                                       class="btn btn-sm btn-outline-danger action-icon"
                                       onclick="return confirm('Are you sure you want to delete this book?');">
                                        <i class="fas fa-trash-alt"></i>
                                    </a>
                                <?php endif; ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<?php if ($total_pages > 1): ?>
    <nav class="mt-4">
        <ul class="pagination justify-content-center">
            <li class="page-item <?= ($page <= 1) ? 'disabled' : '' ?>">
                <a class="page-link" href="<?= BASE_URL ?>book/index/?page=<?= $page - 1 ?>&search=<?= $search ?>">Previous</a>
            </li>

            <?php for ($i = 1; $i <= $total_pages; $i++): ?>
                <li class="page-item <?= ($i == $page) ? 'active' : '' ?>">
                    <a class="page-link" href="<?= BASE_URL ?>book/index/?page=<?= $i ?>&search=<?= $search ?>">
                        <?= $i ?>
                    </a>
                </li>
            <?php endfor; ?>

            <li class="page-item <?= ($page >= $total_pages) ? 'disabled' : '' ?>">
                <a class="page-link" href="<?= BASE_URL ?>book/index/?page=<?= $page + 1 ?>&search=<?= $search ?>">Next</a>
            </li>
        </ul>
    </nav>
<?php endif; ?>

<div class="modal fade" id="detailModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title fw-bold" id="modalTitle">Book Detail</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body text-center p-4">
                <img id="modalImage" src="" class="img-fluid rounded shadow mb-3" style="max-height: 300px;">
                <h3 class="fw-bold text-dark mb-1" id="modalBookTitle"></h3>
                <p class="text-muted fst-italic">by <span id="modalAuthor"></span></p>
            </div>
            <div class="modal-footer justify-content-center border-0 pb-4">
                <button type="button" class="btn btn-secondary px-4" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<script>
function showDetail(title, author, imageSrc) {
    document.getElementById('modalBookTitle').innerText = title;
    document.getElementById('modalAuthor').innerText = author;
    document.getElementById('modalImage').src = imageSrc;
}
</script>