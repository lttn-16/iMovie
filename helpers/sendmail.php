
<?php
include "../include/db.php";

$name = $_POST['name'];
$name = htmlspecialchars($name);
$name = mysqli_real_escape_string($connection, $name);

$email = $_POST['email'];
$email = htmlspecialchars($email);
$email = mysqli_real_escape_string($connection, $email);

$content = $_POST['content'];
$content = htmlspecialchars($content);
$content = mysqli_real_escape_string($connection, $content);

$sql = "INSERT INTO contact_request (`name`, `email`, `content`) VALUES ('$name', '$email', '$content')";

$result = mysqli_query($connection, $sql);

$to      = 'imovietrial@gmail.com';
$subject = '[iMovie] Có liên hệ từ ' . $_POST['name'];
$message = $_POST['content'];
$headers = 'From: contact@imovie.xyz';

$result = mail($to, $subject, $message, $headers);


?>

