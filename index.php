<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mountain Adventure</title>
    <link rel="stylesheet" href="stylebab2.css">
    <script>
        // Fungsi untuk menyetel cookies
        function setCookie(name, value, days) {
            const date = new Date();
            date.setTime(date.getTime() + (days * 24 * 60 * 60 * 1000));
            const expires = "expires=" + date.toUTCString();
            document.cookie = name + "=" + value + ";" + expires + ";path=/";
        }

        // Fungsi untuk mendapatkan nilai cookies
        function getCookie(name) {
            const cname = name + "=";
            const decodedCookie = decodeURIComponent(document.cookie);
            const cookieArray = decodedCookie.split(';');
            for (let i = 0; i < cookieArray.length; i++) {
                let cookie = cookieArray[i].trim();
                if (cookie.indexOf(cname) === 0) {
                    return cookie.substring(cname.length, cookie.length);
                }
            }
            return "";
        }

        // Fungsi untuk meminta nama pengguna setiap kali halaman di-refresh
        function askNameOnRefresh() {
            const name = prompt("Silakan masukkan nama Anda:");
            if (name) {
                setCookie("username", name, 7); // Simpan nama dalam cookie untuk referensi lain
                alert(`Halo, ${name}! Terima kasih telah mengunjungi Mountain Adventure.`);
            } else {
                alert("Anda tidak memasukkan nama. Silakan coba lagi.");
                askNameOnRefresh(); // Meminta ulang jika tidak ada input
            }
        }

        // Eksekusi fungsi saat halaman dimuat
        window.onload = function() {
            askNameOnRefresh();
        };
    </script>
</head>
<body>
    <div class="background">
        <div class="navbar">
            <a href="#">BERANDA</a>
            <a href="#">SEWA</a>
            <a href="belanja.php">BELANJA</a>
            <a href="#">BANTUAN</a>
            <a href="login1.php">LOGIN</a>
        </div>

        <div class="logo">
            <img src="logo pemweb.png" alt="Logo of a person hiking" width="40" height="60">
            <h1>mountain adventure</h1>
        </div>

        <div class="content">
            <p>persiapkan kebutuhan camping &amp; jagalah kebersihan dan keselamatan</p>
            <div class="button">
                <a href="halaman2.php">rekomendasi</a>
            </div>
        </div>
    </div>
</body>
</html>
