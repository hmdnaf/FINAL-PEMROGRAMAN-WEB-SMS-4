<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: ../login.html");
    exit();
}

require 'db.php';
require 'distance.php';

$user_id = $_SESSION['user_id'];
$from_id = $_POST['from_city'];
$to_id = $_POST['to_city'];
$date = $_POST['travel_date'];
$time = $_POST['departure_time'];
$payment = $_POST['payment_method'];

// Ambil nama kota
$from_name = $conn->query("SELECT name FROM cities WHERE id = $from_id")->fetch_assoc()['name'];
$to_name   = $conn->query("SELECT name FROM cities WHERE id = $to_id")->fetch_assoc()['name'];

// Hitung harga
$price = calculatePrice($from_name, $to_name); // dalam rupiah


// Simpan ke database
$stmt = $conn->prepare("INSERT INTO bookings (user_id, from_city, to_city, travel_date, departure_time, payment_method, price) VALUES (?, ?, ?, ?, ?, ?, ?)");
$stmt->bind_param("iiisssi", $user_id, $from_id, $to_id, $date, $time, $payment, $price);
$stmt->execute();

// echo "Pemesanan berhasil! Harga tiket: Rp " . number_format($price, 0, ',', '.') . "<br><a href='../dashboard.php'>Kembali</a>";
// echo "Pemesanan berhasil! Harga tiket: <strong>Rp " . number_format($price, 0, ',', '.') . "</strong><br>";




echo "
<!DOCTYPE html>
<html>
<head>
    <title>Tiket Travel</title>
    <link rel='stylesheet' href='../css/style.css'>
</head>
<body>
    <div class='ticket'>
        <h2>Tiket Travel Sulawesi</h2>
        <p><strong>Asal:</strong> $from_name</p>
        <p><strong>Tujuan:</strong> $to_name</p>
        <p><strong>Tanggal:</strong> $date</p>
        <p><strong>Jam Keberangkatan:</strong> " . date("H:i", strtotime($time)) . " WIB</p>
        <p><strong>Metode Pembayaran:</strong> $payment</p>
        <p><strong>Harga:</strong> Rp " . number_format($price, 0, ',', '.') . "</p>

        <hr>
        <p><em>Silahkan simpan tiket ini dan tunjukkan pada loket pada saat keberangkatan.</em></p>

        <div class='contact'>
            <p><strong>Customer Service:</strong></p>
            <p>📞 0853-4695-7472</p>
            <p>📧 travelsulawesiid@gmail.com</p>
        </div>

        <div class='buttons'>
            <button onclick='window.print()'>Download Tiket</button>
            <button onclick='sendEmail()'>Kirim Email</button>
        </div>
    </div>

    <script>
    function sendEmail() {
        alert('Fitur Kirim Email belum aktif (simulasi).');
        // Di tahap lanjut bisa dihubungkan ke PHPMailer atau SMTP
    }
    </script>
</body>
</html>
";
?>
