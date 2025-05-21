@extends('layout.app')

@section('title', 'Home Page')

@section('nav-menu')

<nav>
    <a href="/home">
        <div class="nav-item on-page">
            <i class='bx bx-home'></i>
            <span>Home</span>
        </div>
    </a>
    <a href="/reimbursement">
        <div class="nav-item">
            <i class="bx icon-gui-refund"></i>
            <span>Reimbursement</span>
        </div>
    </a>
</nav>

@endsection

@section('content')

<main class="content">

    <section class="head-info shadow section-cards">
        <h1>Selamat Datang</h1>
        <div class="user-info">
            <i class="bx bx-user-circle"></i>
            <span>
                {{ Auth::user()->nama }}

            </span>
        </div>
    </section>

    <section class="main-content shadow section-cards">
        <div class="content-head">
            <div class="content-title">
                <i class="bx bx-info-circle"></i>
                <h2>Deskripsi</h2>
            </div>
        </div>

        <p>
            Ini adalah aplikasi yang digunakan untuk mengajukan claim reimbursement pada PT Jasanet Mitra Networking Indonesia.
            <br><br>
            Untuk mengajukan reimbursement, silahkan masuk ke menu Reimbursement dan klik tombol "Tambah".<br>
            Anda akan diarahkan pada halaman formulir yang harus diisi sebagai syarat pengajuan reimbursement.<br>
            Silakan lengkapi formulir tersebut, pihak finance akan memverisikasi segera.<br>
            Anda juga dapat memeriksa status pengajuan anda pada menu Reimbursement.
        </p>
    </section>

</main>

@endsection