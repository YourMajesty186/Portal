CREATE TABLE IF NOT EXISTS logins (
  id INT AUTO_INCREMENT PRIMARY KEY,
  phone VARCHAR(20) NOT NULL,
  nik VARCHAR(20),
  mac_address VARCHAR(50),
  ip_address VARCHAR(45),
  ap_location VARCHAR(100),
  duration_minutes INT DEFAULT 60,
  auth_status VARCHAR(20) DEFAULT 'success',
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
