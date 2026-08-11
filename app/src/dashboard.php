<?php
require 'config.php';

$total = (int) $conn->query("SELECT COUNT(*) FROM logins")->fetchColumn();
$today = (int) $conn->query("SELECT COUNT(*) FROM logins WHERE created_at::date = CURRENT_DATE")->fetchColumn();
$week  = (int) $conn->query("SELECT COUNT(*) FROM logins WHERE date_trunc('week', created_at) = date_trunc('week', CURRENT_DATE)")->fetchColumn();
$month = (int) $conn->query("SELECT COUNT(*) FROM logins WHERE date_trunc('month', created_at) = date_trunc('month', CURRENT_DATE)")->fetchColumn();

$byLocation = $conn->query("SELECT ap_location, COUNT(*) AS c FROM logins GROUP BY ap_location ORDER BY c DESC")->fetchAll();
$history    = $conn->query("SELECT phone, nik, mac_address, ip_address, ap_location, auth_status, created_at FROM logins ORDER BY created_at DESC LIMIT 100")->fetchAll();
?>
<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>Dashboard Captive Portal</title>
<style>
  body { font-family: Arial, sans-serif; background:#f2f4f7; margin:0; padding:24px; }
  h2 { color:#222; }
  .stats { display:flex; gap:16px; margin-bottom:20px; flex-wrap:wrap; }
  .stat-box { background:#fff; padding:16px 24px; border-radius:10px; box-shadow:0 2px 8px rgba(0,0,0,0.08); text-align:center; min-width:120px; }
  .stat-box .num { font-size:26px; font-weight:bold; color:#2563eb; }
  table { width:100%; border-collapse:collapse; background:#fff; border-radius:10px; overflow:hidden; box-shadow:0 2px 8px rgba(0,0,0,0.08); margin-bottom:24px; }
  th, td { padding:10px 14px; text-align:left; border-bottom:1px solid #eee; font-size:13px; }
  th { background:#f8fafc; }
</style>
</head>
<body>
  <h2>Captive Portal Dashboard</h2>
  <div class="stats">
    <div class="stat-box"><div class="num"><?php echo $total; ?></div>Total Login</div>
    <div class="stat-box"><div class="num"><?php echo $today; ?></div>Hari Ini</div>
    <div class="stat-box"><div class="num"><?php echo $week; ?></div>Minggu Ini</div>
    <div class="stat-box"><div class="num"><?php echo $month; ?></div>Bulan Ini</div>
  </div>

  <h3>Statistik per Lokasi Access Point</h3>
  <table>
    <thead><tr><th>Lokasi AP</th><th>Jumlah Login</th></tr></thead>
    <tbody>
      <?php foreach ($byLocation as $row): ?>
        <tr><td><?php echo htmlspecialchars($row['ap_location']); ?></td><td><?php echo $row['c']; ?></td></tr>
      <?php endforeach; ?>
    </tbody>
  </table>

  <h3>Riwayat Login</h3>
  <table>
    <thead><tr><th>No. HP</th><th>NIK</th><th>MAC</th><th>IP</th><th>Lokasi AP</th><th>Status</th><th>Waktu</th></tr></thead>
    <tbody>
      <?php foreach ($history as $row): ?>
        <tr>
          <td><?php echo htmlspecialchars($row['phone']); ?></td>
          <td><?php echo htmlspecialchars($row['nik'] ?: '-'); ?></td>
          <td><?php echo htmlspecialchars($row['mac_address'] ?: '-'); ?></td>
          <td><?php echo htmlspecialchars($row['ip_address']); ?></td>
          <td><?php echo htmlspecialchars($row['ap_location']); ?></td>
          <td><?php echo htmlspecialchars($row['auth_status']); ?></td>
          <td><?php echo $row['created_at']; ?></td>
        </tr>
      <?php endforeach; ?>
    </tbody>
  </table>
</body>
</html>
