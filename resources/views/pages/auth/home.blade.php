@extends('components.user.header2')

@section('title', 'Home')

{{-- CSS & Bootstrap --}}
<link href="{{ asset('user/css/styles.css') }}" rel="stylesheet" />
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

@section('content')
<section class="notifikasi py-5">
  <!-- Header -->
  <header class="masthead position-relative">
    <div class="overlay"></div>
    <div class="container position-relative">
      <div class="row justify-content-start align-items-center vh-10">
        <div class="col-md-8 text-white">
          <h1 class="fw-bold">
            <span class="text-danger">Garuda</span> Smart <br />
            Internship
          </h1>
          <p class="lead">
            Jelajahi serangkaian pengalaman berkesan dan bermakna melalui
            program Garuda Smart Internship!
          </p>
          <a href="register" class="btn btn-danger btn-sm fw-bold px-5">
            <i class="fa-solid fa-right-to-bracket me-2"></i>Daftar
          </a>
        </div>
      </div>
    </div>
  </header>

  <!-- Apa itu GSI -->
  <section class="bg-light section-spacing py-5">
    <div class="container">
      <div class="row d-flex align-items-center">
        <div class="col-lg-4 text-center">
          <img src="{{ asset('img_home/img/model.png') }}" class="img-fluid" alt="Seorang peserta program Garuda Smart Internship" />
        </div>
        <div class="col-lg-8 custom-spacing">
          <h1 class="custom-title">
            Apa itu <b class="text-danger">Garuda Smart <br />Internship?</b>
          </h1>
          <p class="custom-text">
            Garuda Smart Internship merupakan peluang magang yang ditawarkan
            untuk siswa dan mahasiswa yang ingin meraih pengalaman magang yang
            bermutu dan berkesan. Program ini dirancang untuk memberikan
            kesempatan kepada peserta magang untuk mengembangkan pengetahuan,
            keterampilan, dan wawasan praktis dalam lingkungan kerja. Dengan
            mendaftar pada program ini, peserta magang dapat memperoleh
            pengalaman yang positif dan berharga, memberikan kontribusi secara
            efektif dalam dunia profesional, serta membangun dasar yang kokoh
            untuk karir masa depan mereka.
          </p>
        </div>
      </div>
    </div>
  </section>

  <!-- Manfaat -->
  <section class="benefits-section text-center">
    <div class="container">
      <h1 class="fw-bold text-white text-center mb-4">
        Apa Saja Manfaat Magang di <br />
        Garuda Cyber Indonesia?
      </h1>
      <div class="row">
        <div class="col-lg-3 col-md-6 mb-4">
          <div class="benefit-card">
            <img src="{{ asset('img_home/icons/1.png') }}" alt="Soft Skill" class="benefit-icon" />
            <h4>Penyempurnaan <br />Soft Skill</h4>
            <p>Kerja tim, adaptabilitas, dan kemampuan berkomunikasi secara efektif.</p>
          </div>
        </div>
        <div class="col-lg-3 col-md-6 mb-4">
          <div class="benefit-card">
            <img src="{{ asset('img_home/icons/2.png') }}" alt="Peluang Kerja" class="benefit-icon" />
            <h4>Peluang Kerja</h4>
            <p>Magang yang menjanjikan peluang karir di dunia profesional.</p>
          </div>
        </div>
        <div class="col-lg-3 col-md-6 mb-4">
          <div class="benefit-card">
            <img src="{{ asset('img_home/icons/3.png') }}" alt="Referensi Karir" class="benefit-icon" />
            <h4>Referensi Karir <br />Masa Depan</h4>
            <p>Memberikan referensi yang kuat saat memasuki dunia kerja setelah lulus.</p>
          </div>
        </div>
        <div class="col-lg-3 col-md-6 mb-4">
          <div class="benefit-card">
            <img src="{{ asset('img_home/icons/4.png') }}" alt="Sertifikat" class="benefit-icon" />
            <h4>Sertifikat</h4>
            <p>Raihan sertifikat sebagai bentuk penghargaan atas pencapaian selama magang.</p>
          </div>
        </div>
      </div>
    </div>
  </section>

<!-- FAQ Modern Stylish -->
<section class="faq-section py-5 bg-light">
  <div class="container">
    <h1 class="text-center fw-bold mb-5">Pertanyaan Umum</h1>

    <div class="accordion" id="faqAccordion">
      <!-- FAQ ITEM 1 -->
      <div class="accordion-item rounded-3 shadow-sm mb-3 border-0">
        <h2 class="accordion-header">
          <button class="accordion-button collapsed py-3 px-4 rounded-3 fw-semibold" type="button" data-bs-toggle="collapse" data-bs-target="#faq1" aria-expanded="false" aria-controls="faq1">
            Bagaimana cara registrasi akun Garuda Smart Internship?
          </button>
        </h2>
        <div id="faq1" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
          <div class="accordion-body px-4">
            Kamu bisa mendaftar akun melalui tombol <strong>Daftar</strong> di halaman utama, lalu mengisi form sesuai data diri. Setelah itu kamu akan diarahkan ke proses verifikasi email.
          </div>
        </div>
      </div>

      <!-- FAQ ITEM 2 -->
      <div class="accordion-item rounded-3 shadow-sm mb-3 border-0">
        <h2 class="accordion-header">
          <button class="accordion-button collapsed py-3 px-4 rounded-3 fw-semibold" type="button" data-bs-toggle="collapse" data-bs-target="#faq2" aria-expanded="false" aria-controls="faq2">
            Bagaimana cara mengajukan magang di sistem Garuda Smart Internship?
          </button>
        </h2>
        <div id="faq2" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
          <div class="accordion-body px-4">
            Setelah berhasil masuk, kamu bisa memilih posisi magang yang tersedia dan mengajukan lamaran dengan mengisi data dan dokumen yang dibutuhkan.
          </div>
        </div>
      </div>

      <!-- FAQ ITEM 3 -->
      <div class="accordion-item rounded-3 shadow-sm mb-3 border-0">
        <h2 class="accordion-header">
          <button class="accordion-button collapsed py-3 px-4 rounded-3 fw-semibold" type="button" data-bs-toggle="collapse" data-bs-target="#faq3" aria-expanded="false" aria-controls="faq3">
            Apakah saya bisa mendaftar lebih dari 1 posisi dalam periode yang sama?
          </button>
        </h2>
        <div id="faq3" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
          <div class="accordion-body px-4">
            Tidak. Setiap peserta hanya diperbolehkan mendaftar satu posisi magang dalam satu periode agar seleksi berjalan optimal.
          </div>
        </div>
      </div>
    </div>
  </div>
</section>


@include('components.user.footer')
@endsection

{{-- Bootstrap JS --}}
@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
@endpush
