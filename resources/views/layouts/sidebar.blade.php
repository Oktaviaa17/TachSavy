<div class="sidebar">
    <h3>📚 TachSavvy Library</h3>

    @php
        $role = auth()->user()->role;
    @endphp

    {{-- ========================= --}}
    {{-- ADMIN MENU --}}
    {{-- ========================= --}}
    @if($role === 'admin')
        <a href="{{ route('dashboard') }}">📊 Dashboard Admin</a>
        <a href="{{ route('kategori.index') }}">📂 Kategori Buku</a>
        <a href="{{ route('buku.index') }}">📚 Buku</a>
        <a href="{{ route('peminjaman.index') }}">📖 Peminjaman Buku</a>
        <a href="{{ route('peminjaman.riwayat') }}">📚 Riwayat Peminjaman</a>
        <a href="{{ route('ulasans.index') }}">⭐ Ulasan Buku</a>

        {{-- 🔥 CRUD PENJAGA --}}
        <a href="{{ route('penjaga.index') }}">👨‍💼 Data Penjaga</a>

         {{-- 🔥 CRUD USER --}}
        <a href="{{ route('user.index') }}">👨‍💼 Data User</a>

        {{-- LAPORAN --}}
        <a href="{{ route('laporan.peminjaman.bulanan') }}">🧾 Laporan Peminjaman</a>

    {{-- ========================= --}}
    {{-- PENJAGA MENU --}}
    {{-- ========================= --}}
    @elseif($role === 'penjaga')
        <a href="{{ route('dashboard') }}">📊 Dashboard Penjaga</a>
        <a href="{{ route('kategori.index') }}">📂 Kategori Buku</a>
        <a href="{{ route('buku.index') }}">📚 Buku</a>
        <a href="{{ route('peminjaman.index') }}">📖 Peminjaman Buku</a>
        <a href="{{ route('peminjaman.riwayat') }}">📚 Riwayat Peminjaman</a>
        <a href="{{ route('ulasans.index') }}">⭐ Ulasan Buku</a>
        {{-- LAPORAN --}}
        <a href="{{ route('laporan.peminjaman.bulanan') }}">🧾 Laporan Peminjaman</a>


    {{-- ========================= --}}
    {{-- USER MENU --}}
    {{-- ========================= --}}
    @elseif($role === 'user')
        <a href="{{ route('home') }}">🏠 Home</a>
        <a href="{{ route('kategori.index') }}">📂 Kategori Buku</a>
        <a href="{{ route('buku.index') }}">📚 Buku</a>
        <a href="{{ route('peminjaman.index') }}">📖 Peminjaman Buku</a>
        <a href="{{ route('peminjaman.riwayat') }}">📚 Riwayat Saya</a>
        <a href="{{ route('ulasans.index') }}">⭐ Ulasan Buku</a>
    @endif

    {{-- ========================= --}}
    {{-- LOGOUT --}}
    {{-- ========================= --}}
    <form action="{{ route('logout') }}" method="POST" style="margin-top:15px;">
        @csrf
        <button type="submit" class="logout-btn">🚪 Logout</button>
    </form>
</div>