<?php
$mac = $_GET['mac'] ?? '';
$ap  = $_GET['ap_location'] ?? $_GET['ssid'] ?? 'Unknown';
?>
<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Free WiFi - Smart Kampung</title>
<style>
  :root {
    --orange: #f2a679;
    --green: #7bc47f;
    --blue: #2f6fed;
    --blue-dark: #1d54c2;
    --dark: #1f2937;
    --muted: #6b7280;
    --bg: #f4f6f8;
    --border: #e8eaee;
    --radius: 16px;
  }
  * { box-sizing: border-box; }
  body { font-family: 'Segoe UI', Arial, sans-serif; margin: 0; background: var(--bg); color: var(--dark); }
  .topbar { display: flex; align-items: center; justify-content: space-between; padding: 16px 28px; background: #fff; border-bottom: 1px solid var(--border); }
  .brand { display: flex; align-items: center; gap: 10px; }
  .brand-icon { width: 38px; height: 38px; border-radius: 10px; background: linear-gradient(135deg, var(--orange), var(--green)); display: flex; align-items: center; justify-content: center; font-size: 18px; }
  .brand-title { font-weight: 700; font-size: 15px; display: block; }
  .brand-sub { font-size: 12px; color: var(--green); font-weight: 600; }
  .hero { background: linear-gradient(90deg, var(--orange) 0%, #fdf6f0 50%, var(--green) 100%); padding: 44px 16px 72px; text-align: center; position: relative; }
  .hero::before { content: ""; position: absolute; inset: 0; background-image: radial-gradient(circle, rgba(255,255,255,0.4) 1px, transparent 1px); background-size: 18px 18px; opacity: 0.5; }
  .hero h1 { position: relative; margin: 0; font-size: 22px; color: #fff; text-shadow: 0 1px 3px rgba(0,0,0,0.15); }
  .hero p { position: relative; margin: 6px 0 0; color: #fff; font-size: 13px; opacity: 0.95; }
  .wrap { max-width: 440px; margin: -52px auto 0; padding: 0 16px; position: relative; }
  .card { background: #fff; border-radius: var(--radius); box-shadow: 0 10px 30px rgba(0,0,0,0.12); padding: 30px 26px; }
  .card h2 { margin: 0 0 4px; font-size: 18px; text-align: center; }
  .card .loc { text-align: center; font-size: 12px; color: var(--muted); margin-bottom: 22px; }
  label.field-label { font-size: 13px; font-weight: 600; display: block; margin: 14px 0 5px; }
  input[type="tel"], input[type="text"] { width: 100%; padding: 12px 14px; border: 1px solid #e2e5ea; border-radius: 10px; font-size: 14px; outline: none; transition: border-color .15s; }
  input:focus { border-color: var(--blue); }
  .terms { text-align: left; font-size: 12px; color: var(--muted); margin: 18px 0 12px; max-height: 100px; overflow-y: auto; border: 1px solid #eee; padding: 12px; border-radius: 10px; background: #fafbfc; line-height: 1.5; }
  .agree { font-size: 13px; display: flex; align-items: flex-start; gap: 8px; text-align: left; }
  .agree input { margin-top: 3px; }
  button { width: 100%; padding: 13px; margin-top: 20px; background: linear-gradient(135deg, var(--blue), var(--blue-dark)); color: #fff; border: none; border-radius: 10px; cursor: pointer; font-size: 15px; font-weight: 600; box-shadow: 0 4px 12px rgba(47,111,237,0.3); }
  button:hover { opacity: 0.92; }
  .err { color: #dc2626; font-size: 13px; margin-top: 12px; background: #fef2f2; padding: 8px; border-radius: 8px; }
  .info { max-width: 440px; margin: 0 auto; padding: 24px 16px 50px; }
  .info-grid { display: flex; gap: 10px; flex-wrap: wrap; justify-content: center; }
  .chip { background: #fff; border: 1px solid var(--border); border-radius: 30px; padding: 8px 14px; font-size: 12px; display: flex; align-items: center; gap: 6px; }
  .chip .dot { width: 8px; height: 8px; border-radius: 50%; background: var(--green); }
  @media (max-width: 380px) { .card { padding: 24px 18px; } .hero h1 { font-size: 19px; } }
</style>
</head>
<body>
  <div class="topbar">
    <div class="brand">
      <div class="brand-icon">📶</div>
      <div>
        <span class="brand-title">Free WiFi</span>
        <span class="brand-sub">Smart Kampung</span>
      </div>
    </div>
  </div>
  <div class="hero">
    <h1>Selamat Datang di WiFi Publik</h1>
    <p>Layanan internet gratis dari Pemerintah untuk masyarakat</p>
  </div>
  <div class="wrap">
    <div class="card">
      <h2>Login untuk Melanjutkan</h2>
      <div class="loc">Lokasi Access Point: <?php echo htmlspecialchars($ap); ?></div>
      <form action="process_login.php" method="POST">
        <input type="hidden" name="mac_address" value="<?php echo htmlspecialchars($mac); ?>">
        <input type="hidden" name="ap_location" value="<?php echo htmlspecialchars($ap); ?>">
        <label class="field-label">Nomor HP</label>
        <input type="tel" name="phone" placeholder="08xxxxxxxxxx" pattern="[0-9]{9,15}" title="Masukkan nomor HP yang valid (9-15 digit)" required>
        <label class="field-label">NIK (opsional)</label>
        <input type="text" name="nik" placeholder="Nomor Induk Kependudukan">
        <div class="terms">
          Dengan menggunakan layanan WiFi publik ini, Anda menyetujui untuk:
          menggunakan internet secara bertanggung jawab, tidak mengakses atau
          menyebarkan konten ilegal, tidak mengganggu keamanan jaringan, dan
          mematuhi ketentuan yang berlaku di lingkungan instansi/pemerintah daerah.
          Aktivitas penggunaan dapat dipantau demi keamanan bersama.
        </div>
        <label class="agree">
          <input type="checkbox" required>
          Saya telah membaca dan menyetujui syarat &amp; ketentuan di atas
        </label>
        <button type="submit">Masuk &amp; Dapatkan Akses Internet</button>
        <?php if (isset($_GET['error'])): ?>
          <div class="err"><?php echo htmlspecialchars($_GET['error']); ?></div>
        <?php endif; ?>
      </form>
    </div>
    <div class="info">
      <div class="info-grid">
        <div class="chip"><span class="dot"></span> Internet Gratis</div>
        <div class="chip"><span class="dot"></span> Aman &amp; Terpantau</div>
        <div class="chip"><span class="dot"></span> Smart Kampung Banyuwangi</div>
      </div>
    </div>
  </div>
</body>
</html>