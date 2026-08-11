<?php
require 'config.php';

$phone = trim($_POST['phone'] ?? '');
$nik   = trim($_POST['nik'] ?? '');
$mac   = trim($_POST['mac_address'] ?? '');
$ap    = trim($_POST['ap_location'] ?? 'Unknown');
$ip    = $_SERVER['HTTP_X_FORWARDED_FOR'] ?? $_SERVER['REMOTE_ADDR'];

if (!preg_match('/^[0-9]{9,15}$/', $phone)) {
    header('Location: index.php?error=Nomor HP tidak valid');
    exit;
}

$sql = "INSERT INTO logins (phone, nik, mac_address, ip_address, ap_location, duration_minutes, auth_status) VALUES (:phone, :nik, :mac, :ip, :ap, 60, 'success')";
$stmt = $conn->prepare($sql);
$stmt->execute([':phone'=>$phone, ':nik'=>$nik, ':mac'=>$mac, ':ip'=>$ip, ':ap'=>$ap]);

header('Location: success.php');
exit;
?>
