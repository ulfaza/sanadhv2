-- set tahun lulus kelas 12
UPDATE m_siswa
JOIN m_kelas
ON m_siswa.k_id = m_kelas.k_id
SET m_siswa.th_lulus = '2024'
WHERE m_kelas.tingkat = '12';