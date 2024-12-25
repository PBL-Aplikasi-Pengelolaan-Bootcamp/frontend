<?php
// Mulai buffer output
ob_start();

// Include pustaka FPDF
require 'fpdf/fpdf.php';
include 'function.php';

// Fungsi untuk mencari file tanda tangan dengan berbagai ekstensi
function find_signature_file($folder, $filename_without_extension) {
    $extensions = ['png','PNG','JPG', 'jpg', 'jpeg', 'gif']; // Daftar ekstensi yang didukung
    foreach ($extensions as $ext) {
        $file_path = $folder . '/' . $filename_without_extension . '.' . $ext;
        if (file_exists($file_path)) {
            return $file_path;
        }
    }
    return null; // Jika tidak ditemukan
}

// Ambil data pengguna dan kursus
$data_login = get_data_user_login();
$kursus = get_course_by_slug();
$participant_name = isset($data_login['name']) ? $data_login['name'] : 'Peserta Tidak Dikenal';
$course = $kursus['title'] ?? 'Kursus Tidak Diketahui';
$mentor = $kursus['name'] ?? 'Mentor Tidak Dikenal';
$mentorsignature = $kursus['signature'];
$mentor_filename_without_extension = pathinfo($mentorsignature, PATHINFO_FILENAME);

// Nama file sertifikat
$certificate_file = "Certificate_Course_{$course}.pdf";

// Path tanda tangan director dan mentor
$director_signature = "./foto_signature/ttd_nasyith.png"; 
$mentor_signature = find_signature_file("./foto_signature", $mentor_filename_without_extension);  // Nama file tanpa ekstensi

// Debugging: Log tanda tangan mentor (hanya untuk pengujian, hapus di produksi)
if (!$mentor_signature) {
    error_log("Tanda tangan mentor tidak ditemukan!");
} else {
    error_log("Tanda tangan mentor ditemukan: $mentor_signature");
}

// Buat file PDF dengan FPDF
$pdf = new FPDF('L', 'mm', 'A4'); // Orientasi Landscape
$pdf->AddPage();
$pdf->SetMargins(20, 20, 20);

// Desain Border
$pdf->SetFillColor(240, 240, 255);
$pdf->Rect(10, 10, 277, 190, 'DF'); // Border dengan fill

$pdf->SetLineWidth(0.5);
$pdf->SetDrawColor(0, 64, 128);
$pdf->Rect(15, 15, 267, 180, 'D'); // Border dalam

$pdf->Cell(0, 10, '', 0, 1, 'C');

// Header Sertifikat
$pdf->SetFont('Courier', 'B', 30);
$pdf->SetTextColor(0, 64, 128);
$pdf->Cell(0, 50, 'CERTIFICATE of COMPLETION', 0, 1, 'C');

// Nama Peserta
$pdf->SetFont('Arial', 'B', 20);
$pdf->SetTextColor(0, 0, 0);
$participant_name_uppercase = strtoupper($participant_name);
$pdf->Cell(0, 5, $participant_name_uppercase, 0, 1, 'C');

// Garis Pemisah
$pdf->SetLineWidth(0.5);
$pdf->SetDrawColor(0, 64, 128);
$pdf->Line(70, $pdf->GetY() + 5, 220, $pdf->GetY() + 5);

// Pesan Penyelesaian
$pdf->SetFont('Arial', '', 12);
$pdf->SetTextColor(50, 50, 50);
$pdf->MultiCell(0, 30, "For successfully completing the course", 0, 'C');

// Nama Kursus
$pdf->SetFont('Arial', 'B', 18);
$pdf->SetTextColor(0, 0, 0);
$pdf->Cell(0, 10, $course, 0, 1, 'C');

$pdf->SetFont('Arial', '', 12);
$pdf->SetTextColor(50, 50, 50);
$start_date = date("d F Y", strtotime($kursus['start_date'] ?? ''));
$end_date = date("d F Y", strtotime($kursus['end_date'] ?? ''));
$pdf->MultiCell(0, 30, "Conducted from ". $start_date. " to ". $end_date, 0, 'C');

// Bagian Tanda Tangan
$pdf->SetFont('Arial', '', 11);
$pdf->SetTextColor(50, 50, 50);

// Tanda Tangan Director
$director_x = 40;
$director_y = 150;
if (file_exists($director_signature)) {
    $pdf->Image($director_signature, $director_x, $director_y, 40, 0, 'PNG');
} else {
    $pdf->SetXY($director_x, $director_y + 20);
    $pdf->Cell(80, 7, '', 'B', 1, 'C');
}
$pdf->SetXY(30, 170);
$pdf->Cell(80, 7, "Nasyith Aditya", 0, 1, 'C');
$pdf->SetX(30);
$pdf->Cell(80, 7, "Director of Simplify", 0, 1, 'C');

// Tanda Tangan Mentor
$mentor_x = 190;
$mentor_y = 150;
if ($mentor_signature && file_exists($mentor_signature)) {
    $pdf->Image($mentor_signature, $mentor_x, $mentor_y, 40, 0);
} else {
    $pdf->SetXY($mentor_x, $mentor_y + 20);
    $pdf->Cell(130, 7, '', 'B', 1, 'C');
}
$pdf->SetXY(150, 170);
$pdf->Cell(130, 7, $mentor, 0, 1, 'C');
$pdf->SetX(150);
$pdf->Cell(130, 7, "Course Mentor", 0, 1, 'C');

// Tambahkan garis horizontal untuk tanda tangan
$pdf->SetDrawColor(0, 64, 128);
$pdf->Line(35, 165, 115, 165);  // Garis pertama
$pdf->Line(175, 165, 255, 165); // Garis kedua

// Bersihkan output buffer sebelum mengirim PDF
ob_end_clean();

// Output PDF sebagai unduhan
header('Content-Type: application/pdf');
header("Content-Disposition: attachment; filename={$certificate_file}");
$pdf->Output();
exit;
?>
