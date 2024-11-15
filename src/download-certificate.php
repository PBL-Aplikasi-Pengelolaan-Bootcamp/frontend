<?php
// Mulai buffer output
ob_start();

// Include pustaka FPDF
require 'fpdf/fpdf.php';
include 'function.php';

// Pastikan session dimulai sebelum ada output lain
session_start();

// Ambil data pengguna dan kursus
$data_login = get_data_user_login();
$kursus = get_course_by_slug();
$participant_name = isset($data_login['name']) ? $data_login['name'] : 'Peserta Tidak Dikenal';
$course = $kursus['title'] ?? '';

// Nama file sertifikat
$certificate_file = "Certificate_Course_{$course}.pdf";

// Buat file PDF dengan FPDF
$pdf = new FPDF('L', 'mm', 'A4'); // Orientasi Landscape
$pdf->AddPage();
$pdf->SetMargins(20, 20, 20);

// Desain Border
$pdf->SetLineWidth(1);
$pdf->SetDrawColor(0, 64, 128);
$pdf->Rect(10, 10, 277, 190, 'D'); // Border luar
$pdf->Rect(15, 15, 267, 180, 'D'); // Border dalam

// Header Sertifikat
$pdf->SetFont('Arial', 'B', 30);
$pdf->SetTextColor(0, 64, 128);
$pdf->Cell(0, 50, 'Certificate of Completion', 0, 1, 'C');
$pdf->Ln(5);

// Sub-header
$pdf->SetFont('Arial', '', 14);
$pdf->SetTextColor(50, 50, 50);
$pdf->Cell(0, 10, "This certificate is proudly presented to", 0, 1, 'C');
$pdf->Ln(10);

// Nama Peserta
$pdf->SetFont('Arial', 'B', 24);
$pdf->SetTextColor(0, 102, 204);
$pdf->Cell(0, 10, $participant_name, 0, 1, 'C');
$pdf->Ln(10);

// Pesan Penyelesaian
$pdf->SetFont('Arial', '', 12);
$pdf->SetTextColor(50, 50, 50);
$pdf->MultiCell(0, 8, "For successfully completing the course:", 0, 'C');
$pdf->SetFont('Arial', 'B', 16);
$pdf->Cell(0, 10, $course, 0, 1, 'C');
$pdf->Ln(15);

// Garis Pemisah
// Menyusun garis pemisah agar lebih rata
$pdf->SetLineWidth(0.5);           // Ketebalan garis
$pdf->SetDrawColor(0, 64, 128);    // Warna garis
$pdf->Line(70, 125, 220, 125);     // Panjang dan margin atas (disesuaikan)
$pdf->Ln(15);                      // Jarak setelah garis

// Bagian Tanda Tangan
$pdf->SetFont('Arial', '', 12);
$pdf->SetTextColor(0, 0, 0);
$pdf->Cell(0, 10, "Issued on: " . date('d-m-Y'), 0, 1, 'C');
$pdf->Ln(10);

// Menyesuaikan posisi tanda tangan agar rata kiri dan kanan
$pdf->SetFont('Arial', '', 12);
$pdf->Cell(90, 10, "Instructor Signature", 0, 0, 'C');
$pdf->Cell(90, 10, "", 0, 0, 'C'); // Spacer
$pdf->Cell(90, 10, "Course Director Signature", 0, 1, 'C');

// Garis Tanda Tangan
$pdf->SetLineWidth(0.2);
$pdf->Line(40, 160, 120, 160);
$pdf->Line(180, 160, 260, 160);

// Bersihkan output buffer sebelum mengirim PDF
ob_end_clean();

// Output PDF sebagai unduhan
header('Content-Type: application/pdf');
header("Content-Disposition: attachment; filename={$certificate_file}");
$pdf->Output(); 
exit;
?>
