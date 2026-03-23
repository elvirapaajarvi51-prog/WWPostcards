<?php
// Checks whether upload button has been pressed
if (isset($_POST['create_postcard'])) {
    // Checks whether a file has been selected
    if ($_FILES['photo']['size'] != 0) {
        // Sets max filesize to 10 MB (1 MB = 1048576 bytes)
        $max_file_size = 10485760;
        // Sets accepted image files
        $file_types = array('gif', 'jpg', 'jpeg', 'png');
        // Sets folder for upload
        $upload_dir = 'uploads/';
        // Creates array for storing error messages
        $errors = array();
        // Sets information of uploaded file
        $file_tmp = $_FILES['photo']['tmp_name'];
        $file_name = $_FILES['photo']['name'];
        $file_size = $_FILES['photo']['size'];
        $file_uniq = uniqid();
        $file_ext = pathinfo($file_name, PATHINFO_EXTENSION);
        // Sets path to save uploaded file
        $file_save = $upload_dir . $file_uniq . '-original.' . $file_ext;
        // Checks if file is a photo
        if (!getimagesize($file_tmp)) {
            $errors[] = 'Uppladdad fil är inte en bild';
        }
        // Checks photo filesize
        if ($file_size > $max_file_size) {
            $errors[] = 'Filstorlek överskriden (max 10 MB)';
        }
        // Checks if uploaded file is an accepted type
        if (!in_array($file_ext, $file_types)) {
            $errors[] = 'Ej giltig filtyp';
        }
        // Checks if errors have been set
        if (count($errors) == 0) {
            // Saves uploaded file to folder
            if (move_uploaded_file($file_tmp, $file_save)) {
                // Creates session for original name and thumb
                $_SESSION['file_original'] = $file_uniq . '-original.' . $file_ext;
                $_SESSION['file_resized'] = $file_uniq . '-resized.' . $file_ext;
                // Redirects user to resize page
                header('Location: ../../resize.php');
                exit();
            } else {
                $errors[] = 'Fel inträffade vid uppladdning av fil';
            }
        }
    } else {
        $errors[] = 'Det finns ingen uppladdad fil!';
    }
}
