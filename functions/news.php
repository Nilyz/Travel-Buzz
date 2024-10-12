<?php
// functions/news.php
include 'db.php';

function getAllNews() {
    global $pdo;
    $stmt = $pdo->query("SELECT * FROM noticias ORDER BY fecha DESC");
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function createNews($titulo, $imagen, $texto, $idUser) {
    global $pdo;
    $stmt = $pdo->prepare("INSERT INTO noticias (titulo, imagen, texto, fecha, idUser) VALUES (?, ?, ?, NOW(), ?)");
    $stmt->execute([$titulo, $imagen, $texto, $idUser]);
}

function updateNews($idNoticia, $titulo, $imagen, $texto) {
    global $pdo;
    $stmt = $pdo->prepare("UPDATE noticias SET titulo = ?, imagen = ?, texto = ? WHERE idNoticia = ?");
    $stmt->execute([$titulo, $imagen, $texto, $idNoticia]);
}

function deleteNews($idNoticia) {
    global $pdo;
    $stmt = $pdo->prepare("DELETE FROM noticias WHERE idNoticia = ?");
    $stmt->execute([$idNoticia]);
}
?>
