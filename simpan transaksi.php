<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Transaksi</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
            background-color: #f9f9f9;
        }
        h2 {
            text-align: center;
        }
        .transaction-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        .transaction-table, .transaction-table th, .transaction-table td {
            border: 1px solid #ddd;
        }
        .transaction-table th, .transaction-table td {
            padding: 10px;
            text-align: left;
        }
        .transaction-table th {
            background-color: #4CAF50;
            color: white;
        }
        .back-button, .add-button {
            display: inline-block;
            width: 100px;
            margin: 10px;
            padding: 10px;
            background-color: #4CAF50;
            color: white;
            text-align: center;
            text-decoration: none;
            border-radius: 5px;
            cursor: pointer;
        }
        .back-button:hover, .add-button:hover {
            background-color: #45a049;
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
            cursor: pointer;
        }
        .close:hover {
            color: black;
        }
    </style>
</head>
<body>
    <h2>Daftar Transaksi</h2>
    <table class="transaction-table">
        <thead>
            <tr>
                <th>Nama</th>
                <th>Alamat</th>
                <th>Jumlah</th>
                <th>Keterangan Barang</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody id="transactionList">
            <!-- Data transaksi akan dimuat di sini -->
        </tbody>
    </table>
    <button class="add-button" onclick="openModal()">Tambah Transaksi</button>
    <a href="index.php" class="back-button">Kembali</a>

    <!-- Modal Form -->
    <div id="myModal" class="modal">
        <div class="modal-content">
            <span class="close" onclick="closeModal()">&times;</span>
            <h2 id="modalTitle">Tambah Transaksi</h2>
            <form id="transactionForm">
                <input type="hidden" id="editIndex" value="">
                <label for="name">Nama:</label>
                <input type="text" id="name" required>
                <br><br>
                <label for="alamat">Alamat:</label>
                <input type="text" id="alamat" required>
                <br><br>
                <label for="amount">Jumlah:</label>
                <input type="number" id="amount" required>
                <br><br>
                <label for="product">Keterangan Barang:</label>
                <input type="text" id="product" required>
                <br><br>
                <button type="submit">Simpan</button>
            </form>
        </div>
    </div>

    <script>
        let transactions = JSON.parse(localStorage.getItem('transactions')) || [];

        function renderTransactions() {
            const transactionList = document.getElementById('transactionList');
            transactionList.innerHTML = '';

            transactions.forEach((transaction, index) => {
                const row = document.createElement('tr');

                row.innerHTML = `
                    <td>${transaction.name}</td>
                    <td>${transaction.alamat}</td>
                    <td>${transaction.amount}</td>
                    <td>${transaction.product}</td>
                    <td>
                        <button onclick="editTransaction(${index})">Edit</button>
                        <button onclick="deleteTransaction(${index})">Hapus</button>
                    </td>
                `;

                transactionList.appendChild(row);
            });
        }

        function openModal(isEdit = false) {
            document.getElementById('myModal').style.display = 'block';
            document.getElementById('modalTitle').innerText = isEdit ? 'Edit Transaksi' : 'Tambah Transaksi';
            document.getElementById('transactionForm').reset();
            document.getElementById('editIndex').value = isEdit ? document.getElementById('editIndex').value : '';
        }

        function closeModal() {
            document.getElementById('myModal').style.display = 'none';
        }

        function saveTransaction(event) {
        event.preventDefault();

        const name = document.getElementById('name').value;
        const alamat = document.getElementById('alamat').value;
        const amount = document.getElementById('amount').value;
        const productDescription = document.getElementById('product').value;
        const editIndex = document.getElementById('editIndex').value;

        if (editIndex) {
        transactions[editIndex] = { name, alamat, amount, product: productDescription };
        } else {
        transactions.push({ name, alamat, amount, product: productDescription });
        }

        localStorage.setItem('transactions', JSON.stringify(transactions));
        closeModal();
        renderTransactions();
        }

        function renderTransactions() {
        const transactionList = document.getElementById('transactionList');
        transactionList.innerHTML = '';
        transactions.forEach((transaction, index) => {
        const row = document.createElement('tr');

        row.innerHTML = `
            <td>${transaction.name}</td>
            <td>${transaction.alamat}</td>
            <td>${transaction.amount}</td>
            <td>${transaction.product || ''}</td> <!-- Menampilkan keterangan barang -->
            <td>
                <button onclick="editTransaction(${index})">Edit</button>
                <button onclick="deleteTransaction(${index})">Hapus</button>
            </td>
        `;

        transactionList.appendChild(row);
    });
}


        function editTransaction(index) {
            document.getElementById('editIndex').value = index;
            document.getElementById('name').value = transactions[index].name;
            document.getElementById('alamat').value = transactions[index].alamat;
            document.getElementById('amount').value = transactions[index].amount;
            document.getElementById('product').value = transactions[index].product;
            openModal(true);
        }

        function deleteTransaction(index) {
            transactions.splice(index, 1);
            localStorage.setItem('transactions', JSON.stringify(transactions));
            renderTransactions();
        }

        document.getElementById('transactionForm').addEventListener('submit', saveTransaction);
        window.onclick = function(event) {
            if (event.target == document.getElementById('myModal')) {
                closeModal();
            }
        }

        // Initial render
        renderTransactions();
    </script>
</body>
</html>
