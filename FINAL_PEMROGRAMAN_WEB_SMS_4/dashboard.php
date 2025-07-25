<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: ../login.html");
    exit();
}
require 'php/db.php';
$user_id = $_SESSION['user_id'];

$cities = $conn->query("SELECT * FROM cities");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Dashboard</title>
    <link rel="stylesheet" href="css/style.css">

</head>
<body>
    <h2>Pemesanan Tiket Travel</h2>
    <form action="php/booking.php" method="POST">
        Dari: 
        <select name="from_city">
            <?php while ($row = $cities->fetch_assoc()) { ?>
                <option value="<?= $row['id'] ?>"><?= $row['name'] ?></option>
            <?php } ?>
        </select><br>
        Ke:
        <select name="to_city">
            <?php
            $cities->data_seek(0);
            while ($row = $cities->fetch_assoc()) { ?>
                <option value="<?= $row['id'] ?>"><?= $row['name'] ?></option>
            <?php } ?>
        </select><br>
        Tanggal: <input type="date" name="travel_date" required><br>
        <input type="submit" value="Pesan">
        Jam Keberangkatan:
<select name="departure_time" required>
    <option value="07:30:00">07:30 - Pagi</option>
    <option value="13:00:00">13:00 - Siang</option>
    <option value="20:00:00">20:00 - Malam</option>
</select><br>


Metode Pembayaran:
<select name="payment_method">
    <option value="Transfer Bank">Transfer Bank</option>
    <option value="QRIS">QRIS</option>
    <option value="Tunai">Tunai</option>
</select><br>

    </form>
    <br>
    <a href="php/logout.php">Logout</a>
    <script src="js/script.js"></script>

</body>
</html>
