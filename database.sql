CREATE DATABASE mahasiswa2;

USE mahasiswa2;

CREATE TABLE mahasiswa (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL, 
    nim VARCHAR(20) NOT NULL,
    prodi VARCHAR(100) NOT NULL,
    deskripsi TEXT,
    browser TEXT,
    ip_address VARCHAR(45)
);

SELECT 'Tabel mahasiswa berhasil dibuat!' AS pesan;
