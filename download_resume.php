<?php
// download_resume.php
// 1) connect to the DB
$conn = new mysqli('localhost','root','','portfolio_db');
if($conn->connect_error) die("Connection failed: ".$conn->connect_error);

// 2) fetch the PDF row (we assume id=1)
$id = 1;
$stmt = $conn->prepare("SELECT filename, mime_type, content FROM resumes WHERE id = ?");
$stmt->bind_param('i', $id);
$stmt->execute();
$stmt->store_result();

if($stmt->num_rows === 1) {
    $stmt->bind_result($filename, $mime, $data);
    $stmt->fetch();

    // 3) send headers
    header("Content-Type: $mime");
    header('Content-Disposition: attachment; filename="'.basename($filename).'"');
    header('Content-Length: '.strlen($data));

    // 4) output the PDF
    echo $data;
    exit;
} else {
    http_response_code(404);
    echo "Resume not found.";
}
