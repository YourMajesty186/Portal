CREATE TABLE IF NOT EXISTS logins (
  id SERIAL PRIMARY KEY,
  phone VARCHAR(20) NOT NULL,
  nik VARCHAR(20),
  nama VARCHAR(100),
  mac_address VARCHAR(50),
  ip_address VARCHAR(45),
  ap_location VARCHAR(100),
  duration_minutes INTEGER DEFAULT 60,
  auth_status VARCHAR(20) DEFAULT 'success',
  created_at TIMESTAMP DEFAULT NOW()
);
