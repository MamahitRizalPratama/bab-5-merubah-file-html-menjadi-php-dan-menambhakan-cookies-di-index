<html>
<head>
    <title>Produk</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet"/>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }
        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 10px 20px;
            background-color: #fff;
            border-bottom: 1px solid #ccc;
        }
        .header a {
            text-decoration: none;
            color: black;
            margin: 0 10px;
        }
        .breadcrumb {
            display: flex;
            align-items: center;
            padding: 10px 20px;
            background-color: #e0e0e0;
        }
        .breadcrumb i {
            margin-right: 5px;
        }
        .breadcrumb a {
            text-decoration: none;
            color: black;
            margin-right: 5px;
        }
        .breadcrumb span {
            margin-right: 5px;
        }
        .content {
            display: flex;
            padding: 20px;
        }
        .products {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
            flex: 3;
        }
        .product {
            border: 1px solid #000;
            padding: 10px;
            text-align: center;
            width: 200px;
            cursor: pointer;
        }
        .product img {
            width: 100%;
            height: auto;
        }
        .sidebar {
            flex: 1;
            padding: 20px;
        }
        .pagination {
            display: flex;
            justify-content: center;
            padding: 20px;
        }
        .pagination button {
            border: 1px solid #000;
            background-color: #fff;
            padding: 5px 10px;
            margin: 0 5px;
            cursor: pointer;
        }
        .pagination button:hover {
            background-color: #e0e0e0;
        }
        .modal {
            display: none;
            position: fixed;
            z-index: 1;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgb(0,0,0);
            background-color: rgba(0,0,0,0.4);
            padding-top: 60px;
        }
        .modal-content {
            background-color: #fefefe;
            margin: 5% auto;
            padding: 20px;
            border: 1px solid #888;
            width: 80%;
        }
        .close {
            color: #aaa;
            float: right;
            font-size: 28px;
            font-weight: bold;
        }
        .close:hover,
        .close:focus {
            color: black;
            text-decoration: none;
            cursor: pointer;
        }
    </style>
</head>
<body>
    <div class="header">
        <div>
            <a href="index.php">BERANDA</a>
            <a href="#">SEWA</a>
            <a href="#">BELANJA</a>
            <a href="#">BANTUAN</a>
        </div>
        <div>
            <a href="login1.php">LOGIN</a>
        </div>
    </div>
    <div class="breadcrumb">
        <i class="fas fa-home"></i>
        <a href="#">HOME</a>
        <span>/</span>
        <span>PRODUK</span>
    </div>
    <div class="content">
        <div class="products">
            <div class="product" onclick="openModal('TENDA 4P (SEWA)', 'Rp.70.000')">
                <img alt="Tenda 4P (Sewa)" height="200" src="tenda.jpg" width="200"/>
                <p>TENDA 4P (SEWA)</p>
                <p>Rp.70.000</p>
            </div>
            <div class="product" onclick="openModal('KURSI DUDUK (SEWA)', 'Rp.15.000')">
                <img alt="Kursi Duduk (Sewa)" height="200" src="kursilipat.jpeg" width="200"/>
                <p>KURSI DUDUK (SEWA)</p>
                <p>Rp.15.000</p>
            </div>
            <div class="product" onclick="openModal('ALAT MASAK 1 SET (SEWA)', 'Rp.50.000')">
                <img alt="Alat Masak 1 Set (Sewa)" height="200" src="panci.png" width="200"/>
                <p>ALAT MASAK 1 SET (SEWA)</p>
                <p>Rp.50.000</p>
            </div>
        </div>
        <div class="sidebar">
            <h3>KATEGORI PRODUK</h3>
            <p>PRODUK <span>+</span></p>
            <p>Rent For Camping <span>+</span></p>
        </div>
    </div>
    <div class="pagination">
        <button>1</button>
        <button>2</button>
        <button>3</button>
        <button><i class="fas fa-arrow-right"></i></button>
    </div>

    <!-- Modal -->
    <div id="myModal" class="modal">
        <div class="modal-content">
            <span class="close" onclick="closeModal()">&times;</span>
            <h2 id="productTitle"></h2>
            <p id="productPrice"></p>
            <form id="transactionForm">
                <label for="name">Nama:</label>
                <input type="text" id="name" required>
                <br><br>
                <label for="alamat">Alamat:</label>
                <input type="text" id="alamat" required>
                <br><br>
                <label for="amount">Jumlah:</label>
                <input type="number" id="amount" required>
                <br><br>
                <button type="submit">Simpan Transaksi</button>
            </form>
            
        </div>
    </div>

    <script>
        function openModal(productName, productPrice) {
            document.getElementById('productTitle').innerText = productName;
            document.getElementById('productPrice').innerText = productPrice;
            document.getElementById('myModal').style.display = "block";
        }

        function closeModal() {
            document.getElementById('myModal').style.display = "none";
        }

        window.onclick = function(event) {
            if (event.target == document.getElementById('myModal')) {
                closeModal();
            }
        }
        document.getElementById('transactionForm').addEventListener('submit', function(event) {
        event.preventDefault();

        const name = document.getElementById('name').value;
        const alamat = document.getElementById('alamat').value;
        const amount = document.getElementById('amount').value;

        // Ambil data transaksi yang sudah ada dari local storage
        let transactions = JSON.parse(localStorage.getItem('transactions')) || [];

        // Tambahkan transaksi baru ke dalam array
        transactions.push({ name: name, alamat: alamat, amount: amount });

        // Simpan kembali ke local storage
        localStorage.setItem('transactions', JSON.stringify(transactions));

        // Reset form
        this.reset();

        // Arahkan ke halaman transaksi
        window.location.href = 'simpan transaksi.php';
    });
    </script>
</body>
</html>