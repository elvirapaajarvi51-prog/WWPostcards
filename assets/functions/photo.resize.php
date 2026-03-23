<?php
// Checks whether resize button has been pressed
if (isset($_POST['upload-resize'])) {
    //==============================================================
    // Calculate where to crop the original image
    //==============================================================
    // X- and Y coordinate of new file (cropped image)
    $dst_x = 0;
    $dst_y = 0;
    // Must be same values of minSize in JS script
    // Sets size of new file (cropped image)
    $dst_w = 250;
    $dst_h = 150;
    // Crops start X and Y position in original image
    $src_x = $_POST['x'];
    $src_y = $_POST['y'];
    // Crops end X and Y position in original image
    $src_w = $_POST['w'];
    $src_h = $_POST['h'];
    // Creates an image with true colors for thumb
    $dst_image = imagecreatetruecolor($dst_w, $dst_h);
    // Retrieve path to original and thumb photos
    $file_original = 'photos/' . $_SESSION['file_original'];
    $file_resized = 'photos/' . $_SESSION['file_resized'];
    // Checks file extension
    $file_ext = pathinfo($file_original, PATHINFO_EXTENSION);
    // Creates new file
    switch ($file_ext) {
        case 'jpeg':
        case 'jpg':
            // Create a new JPG/JPEG from original filename (uploaded photo)
            $src_image = imagecreatefromjpeg($file_original);
            // Cropping
            imagecopyresampled(
                $dst_image,
                $src_image,
                $dst_x,
                $dst_y,
                $src_x,
                $src_y,
                $dst_w,
                $dst_h,
                $src_w,
                $src_h
            );
            // Saving new filename (cropped photo)
            imagejpeg($dst_image, $file_resized);
            break;
        case 'png':
            // Create a new PNG from original filename (uploaded photo)
            $src_image = imagecreatefrompng($file_original);
            // Cropping
            imagecopyresampled(
                $dst_image,
                $src_image,
                $dst_x,
                $dst_y,
                $src_x,
                $src_y,
                $dst_w,
                $dst_h,
                $src_w,
                $src_h
            );
            // Saving new filename (cropped photo)
            imagepng($dst_image, $file_resized);
            break;
        case 'gif':
            // Create a new GIF from original filename (uploaded photo)
            $src_image = imagecreatefromgif($file_original);
            // Cropping
            imagecopyresampled(
                $dst_image,
                $src_image,
                $dst_x,
                $dst_y,
                $src_x,
                $src_y,
                $dst_w,
                $dst_h,
                $src_w,
                $src_h
            );
            // Saving new filename (cropped photo)
            imagegif($dst_image, $file_resized);
            break;
    }
    //==============================================================
    // Insert information about original and thumb photos in database
    //==============================================================
    // Creates, prepares, binds and executes a query
    $sql = '
INSERT INTO photos
(user_id, original, resized, regdate)
VALUES
(:user_id, :original, :resized, NOW())';
    $stmt = $dbh->prepare($sql);
    $stmt->bindValue(':user_id', $_SESSION['user_id']);
    $stmt->bindValue(':original', $_SESSION['file_original']);
    $stmt->bindValue(':resized', $_SESSION['file_resized']);
    // Checks whether query executed correctly
    if ($stmt->execute()) {
        // Deletes session variable for original and resized files
        unset($_SESSION['file_original']);
        unset($_SESSION['file_resized']);
        // Redirect user to gallery
        header('Location: ../../gallery.php');
        exit();
    }
}
