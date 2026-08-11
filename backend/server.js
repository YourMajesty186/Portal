const express = require('express');
const { Pool } = require('pg');
const path = require('path');

const app = express();
app.use(express.json());
app.use(express.static(path.join(__dirname, 'public')));

const pool = new Pool({
  host: process.env.DB_HOST,
  user: process.env.DB_USER,
  password: process.env.DB_PASSWORD,
  database: process.env.DB_NAME,
  port: process.env.DB_PORT,
});

app.post('/api/login', async (req, res) => {
  const { nik, nama } = req.body;
  if (!nik) return res.status(400).json({ error: 'NIK wajib diisi' });
  const ip = req.headers['x-forwarded-for'] || req.socket.remoteAddress;
  try {
    await pool.query(
      'INSERT INTO logins (nik, nama, ip_address) VALUES ($1, $2, $3)',
      [nik, nama || '', ip]
    );
    res.json({ success: true, message: 'Akses internet berhasil diberikan.' });
  } catch (err) {
    console.error(err);
    res.status(500).json({ error: 'Gagal menyimpan data' });
  }
});

app.get('/api/users', async (req, res) => {
  try {
    const result = await pool.query(
      'SELECT id, nik, nama, ip_address, created_at FROM logins ORDER BY created_at DESC LIMIT 100'
    );
    res.json(result.rows);
  } catch (err) {
    console.error(err);
    res.status(500).json({ error: 'Gagal mengambil data' });
  }
});

app.get('/api/stats', async (req, res) => {
  try {
    const total = await pool.query('SELECT COUNT(*) FROM logins');
    const today = await pool.query(
      "SELECT COUNT(*) FROM logins WHERE created_at::date = CURRENT_DATE"
    );
    res.json({
      total_users: parseInt(total.rows[0].count, 10),
      today_logins: parseInt(today.rows[0].count, 10),
    });
  } catch (err) {
    console.error(err);
    res.status(500).json({ error: 'Gagal mengambil statistik' });
  }
});

const PORT = 3000;
app.listen(PORT, () => console.log(`Server running on port ${PORT}`));
