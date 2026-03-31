<!DOCTYPE html>
<html>
<head>
    <title>Bukti Peminjaman</title>

    <style>
        body {
            font-family: monospace;
            width: 320px;
            margin: auto;
        }

        .center {
            text-align: center;
        }

        hr {
            border: 1px dashed #000;
        }

        .btn-print {
            margin-top: 20px;
            text-align: center;
        }

        @media print {
            .btn-print {
                display: none;
            }
        }
    </style>
</head>
<body>

    <h3 class="center">📚 TachSavvy Library</h3>
    <p class="center">Bukti Peminjaman Buku</p>
    <hr>

    <p><b>Nama Peminjam:</b><br>
        {{ $peminjaman->user->name }}
    </p>

    <p><b>Judul Buku:</b><br>
        {{ $peminjaman->buku->title }}
    </p>

    <p><b>Tanggal Pinjam:</b><br>
        {{ \Carbon\Carbon::parse($peminjaman->tanggal_pinjam)->format('d M Y') }}
    </p>

    <p><b>Jatuh Tempo:</b><br>
        {{ \Carbon\Carbon::parse($peminjaman->tanggal_kembali)->format('d M Y') }}
    </p>

    <hr>

    <p class="center">
        Harap dikembalikan tepat waktu 📅
    </p>

    <p class="center">
        Terima kasih 🙏
    </p>

    <div class="btn-print">
        <button onclick="window.print()">🖨 Print</button>
    </div>

</body>
</html>
