<?php
require_once 'assets/includes/display_errors.php';
require_once 'assets/config/db.php';
require_once 'assets/functions/insert.php';
require_once 'assets/includes/header.php';
?>

<main class="container mt-5">
    <h1 class="mb-4">Skapa nytt vykort</h1>

    <form action="add_postcard.php" method="post" enctype="multipart/form-data">

        <div class="row mb-3">
            <label for="title" class="col-2 col-form-label">Rubrik</label>
            <div class="col-6">
                <input type="text" class="form-control" id="title" name="title" required>
            </div>
        </div>

        <div class="row mb-3">
            <label for="message" class="col-2 col-form-label">Text</label>
            <div class="col-6">
                <textarea class="form-control" id="message" name="message" rows="5" required></textarea>
            </div>
        </div>

        <div class="row mb-3">
            <label for="continent" class="col-2 col-form-label">Kontinent</label>
            <div class="col-6">
                <select class="form-select" id="continent" name="continent" required>
                    <option value="">Välj kontinent</option>
                    <option value="Asien">Asien</option>
                    <option value="Europa">Europa</option>
                    <option value="Afrika">Afrika</option>
                    <option value="Nordamerika">Nordamerika</option>
                    <option value="Sydamerika">Sydamerika</option>
                    <option value="Oceanien">Oceanien</option>
                </select>
            </div>
        </div>

        <div class="row mb-3">
            <label for="country" class="col-2 col-form-label">Land</label>
            <div class="col-6">
                <input type="text" class="form-control" id="country" name="country" required>
            </div>
        </div>

        <div class="row mb-3">
            <label for="city" class="col-2 col-form-label">Stad</label>
            <div class="col-6">
                <input type="text" class="form-control" id="city" name="city" required>
            </div>
        </div>

        <div class="row mb-4">
            <label for="image" class="col-2 col-form-label">Bild</label>
            <div class="col-6">
                <input type="file" class="form-control" id="image" name="image" accept="image/*" required>
            </div>
        </div>

        <button type="submit" class="btn btn-success" name="create_postcard">
            Publicera vykort
        </button>
    </form>
</main>

<?php require_once 'assets/includes/footer.php'; ?>