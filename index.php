<?php
// file_put_contents('log.txt', $response);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pemesanan Tiket Pesawat</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script>
            function sendMessage() {
    const userInput = document.getElementById('userInput');
    const messagesDiv = document.getElementById('messages');
    const message = userInput.value.trim();

    if (!message) return;

    // Tambahkan pesan pengguna ke UI
    messagesDiv.innerHTML += `<div class="user-message">${escapeHtml(message)}</div>`;
    userInput.value = '';

    // Tampilkan loading indicator
    const loadingDiv = document.createElement('div');
    loadingDiv.className = 'ai-message';
    loadingDiv.textContent = 'Mengetik...';
    messagesDiv.appendChild(loadingDiv);
    messagesDiv.scrollTop = messagesDiv.scrollHeight;

    // Kirim permintaan ke server
    fetch('chat.php', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify({ message: message })
    })
    .then(response => {
        // Log raw response for debugging
        console.log('Raw response:', response);
        return response.json();
    })
    .then(data => {
        // Log parsed data for debugging
        console.log('Parsed data:', data);

        // Hapus loading indicator
        messagesDiv.removeChild(loadingDiv);

        if (data.error) {
            throw new Error(data.message || 'Server error occurred');
        }

        if (!data.response || data.response === 'undefined') {
            throw new Error('Invalid response from server');
        }

        // Tampilkan balasan dari AI
        messagesDiv.innerHTML += `<div class="ai-message">${escapeHtml(data.response)}</div>`;
        messagesDiv.scrollTop = messagesDiv.scrollHeight;
    })
    .catch(error => {
        console.error('Error details:', error);
        
        // Hapus loading indicator jika masih ada
        if (loadingDiv.parentNode) {
            messagesDiv.removeChild(loadingDiv);
        }

        // Tampilkan pesan error
        messagesDiv.innerHTML += `
            <div class="error-message">
                Error: ${escapeHtml(error.message || 'Terjadi kesalahan. Coba lagi nanti.')}
            </div>
        `;
        messagesDiv.scrollTop = messagesDiv.scrollHeight;
    });
}

function escapeHtml(unsafe) {
    return unsafe
        .replace(/&/g, "&amp;")
        .replace(/</g, "&lt;")
        .replace(/>/g, "&gt;")
        .replace(/"/g, "&quot;")
        .replace(/'/g, "&#039;");
}
    </script>
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        header {
            background: linear-gradient(to right, #4e54c8, #8f94fb);
            position: fixed;
            top: 0;
            width: 100%;
            z-index: 1030;
        }
        header .navbar-brand {
            font-weight: bold;
            font-size: 1.5rem;
        }
        header .navbar {
            max-width: 960px;
            margin: 0 auto;
        }
        .search-section {
            background: url('img/bg/bg-1.jpg') no-repeat center center/cover;
            color: white;
            padding: 7rem 0;
            margin-top: 75px;
        }
        .search-section h1 {
            font-size: 3rem;
            margin-bottom: 1.5rem;
        }
        .search-section .btn {
            padding: 0.75rem 2rem;
            font-size: 1.25rem;
        }
        .card img {
            height: 200px;
            object-fit: cover;
        }
        footer {
            background: #343a40;
            color: white;
        }
        footer a {
            color: #8f94fb;
            text-decoration: none;
        }
        footer a:hover {
            text-decoration: underline;
        }

        /* AI */
        #chatbox {
    width: 400px;
    height: 600px;
    border: 1px solid #ddd;
    border-radius: 10px;
    background: #fff;
    overflow: hidden;
    display: flex;
    flex-direction: column;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
}

#messages {
    flex: 1;
    padding: 10px;
    overflow-y: auto;
    background: #f9f9f9;
}

#input-area {
    display: flex;
    border-top: 1px solid #ddd;
    padding: 10px;
    background: #fff;
}

#userInput {
    flex: 1;
    padding: 10px;
    border: 1px solid #ddd;
    border-radius: 5px;
}

button {
    padding: 10px 20px;
    margin-left: 10px;
    border: none;
    background: #007bff;
    color: #fff;
    border-radius: 5px;
    cursor: pointer;
}

    </style>
</head>
<body>

    <!-- Header Section -->
    <header class="text-white py-3">
        <nav class="navbar navbar-expand-lg navbar-dark">
            <a class="navbar-brand" href="#">Pesawatku</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item"><a class="nav-link" href="#Home">Home</a></li>
                    <li class="nav-item"><a class="nav-link" href="#Info">Info</a></li>
                    <li class="nav-item"><a class="nav-link" href="booking_form.php"><b>Pesan Sekarang</b></a></li>
                    <li class="nav-item"><a class="nav-link" href="#">Bantuan</a></li>
                </ul>
            </div>
        </nav>
    </header>

    <!-- Search Section -->
    <section id="Home" class="search-section text-center">
        <div class="container">
            <h1>Pesan Tiket Pesawat dengan Mudah</h1>
            <p>Cari tiket penerbangan terbaik untuk perjalanan Anda.</p>
            <a href="booking_form.php" class="btn btn-primary">Pesan Sekarang</a>
            <!-- <button class="btn btn-primary">Pesan Sekarang</button> -->
        </div>
    </section>

    <!-- Info Section -->
    <section id="Info" class="py-5">
        <div class="container">
            <h2 class="text-center mb-4">Info Terbaru</h2>
            <div class="row">
                <div class="col-md-4">
                    <div class="card">
                        <img src="img/g1.jpg" class="card-img-top" alt="Info 1">
                        <div class="card-body">
                            <h5 class="card-title">Diskon 50% Tiket Domestik</h5>
                            <p class="card-text">Pesan sekarang dan hemat hingga 50% untuk penerbangan domestik.</p>
                            <a href="#" class="btn btn-primary">Selengkapnya</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card">
                        <img src="img/g2.jpg" class="card-img-top" alt="Info 2">
                        <div class="card-body">
                            <h5 class="card-title">Tiket Internasional Murah</h5>
                            <p class="card-text">Terbang ke luar negeri dengan harga terjangkau.</p>
                            <a href="#" class="btn btn-primary">Selengkapnya</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card">
                        <img src="img/g3.jpg" class="card-img-top" alt="Info 3">
                        <div class="card-body">
                            <h5 class="card-title">Paket Hemat Liburan</h5>
                            <p class="card-text">Nikmati paket perjalanan hemat dengan berbagai fasilitas.</p>
                            <a href="#" class="btn btn-primary">Selengkapnya</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer Section -->
    <footer class="py-4">
        <div class="container text-center">
            <p>&copy; 2025 Pesawatku. All Rights Reserved.</p>
            <p>Ikuti kami di:
                <a href="#">Facebook</a> |
                <a href="#">Instagram</a> |
                <a href="#">Twitter</a>
            </p>
        </div>
    </footer>
    <!-- <div id="chatbox">
        <div id="messages"></div>
        <div id="input-area">
            <input type="text" id="userInput" placeholder="Ketik pesan...">
            <button onclick="sendMessage()">Kirim</button>
        </div>
    </div> -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <!--Start of Tawk.to Script-->
    <script type="text/javascript">
    var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();
    (function(){
    var s1=document.createElement("script"),s0=document.getElementsByTagName("script")[0];
    s1.async=true;
    s1.src='https://embed.tawk.to/67871c59825083258e051f56/1ihjsdg6e';
    s1.charset='UTF-8';
    s1.setAttribute('crossorigin','*');
    s0.parentNode.insertBefore(s1,s0);
    })();
    </script>
    <!--End of Tawk.to Script-->
</body>
</html>
