<?php
include "./utils/protect-page-route.php";
include "./database/comments-repository.php";
include "./utils/sonner.php";
include "./utils/get-missing-id.php";

if (!get_missing_id()) {
    sonner("error", "Desaparecido não encontrado");
    header("Location: index.php");
}

$missing_id = get_missing_id();
$comment = filter_var($_POST["comment"], FILTER_SANITIZE_SPECIAL_CHARS);
$latitude = filter_var($_POST["latitude"], FILTER_SANITIZE_SPECIAL_CHARS);
$longitude = filter_var($_POST["longitude"], FILTER_SANITIZE_SPECIAL_CHARS);

if (isset($_FILES['imagem']) && $_FILES['imagem']['error'] == UPLOAD_ERR_OK) {
    $type_file = strtolower(substr($_FILES['imagem']['name'], -4));
    $comment_image_url = md5(time()) . $type_file;
    $path_image_url = "./assets/uploads/comments/";
    move_uploaded_file($_FILES["imagem"]["tmp_name"], $path_image_url . $comment_image_url);
} else {
    $comment_image_url = null;
}


create_comment($connection, get_missing_id(), get_user_id(), $comment, $latitude, $longitude, $comment_image_url);
sonner("success", "Comentário criado com sucesso");
if (isset($_SERVER['HTTP_REFERER'])) {
    $previousPage = filter_var($_SERVER['HTTP_REFERER'], FILTER_VALIDATE_URL);

    if ($previousPage) {
        header("Location: $previousPage");
        exit;
    }
}
header("Location: index.php");
exit;
