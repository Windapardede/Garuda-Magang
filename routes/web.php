<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdministrasiController;
use App\Http\Controllers\KemampuanController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\InstansiController;
use App\Http\Controllers\WawancaraController;
use App\Http\Controllers\PosisiController;
use App\Http\Controllers\KriteriaPenilaianController;
use App\Http\Controllers\JurusanController;
use App\Http\Controllers\KelolaMentorController;
use App\Http\Controllers\TestimoniController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\TemplateSertifikatController;
use App\Http\Controllers\SertifikatPenilaianController;
use App\Http\Controllers\BerhasilDaftarController;
use App\Http\Controllers\KegiatankuController;
use App\Http\Controllers\NotifikasiUserController;
use App\Http\Controllers\PosisiUserController;
use App\Http\Controllers\PenilaianController;
use App\Http\Controllers\PesertaMagangAktifController;
use App\Http\Controllers\PendaftarMagangController;
use App\Http\Controllers\AlumniMagangController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\DetailMonitoringController;
use App\Http\Controllers\AlumniMagangMentorController;
use App\Http\Controllers\PenilaianMentorController;
use App\Http\Controllers\BeriSertifikatController;
use App\Http\Controllers\ProfileUserController;
use App\Http\Controllers\ProfileAdminController;
use App\Http\Controllers\ProfileMentorController;
use App\Http\Controllers\ProfileHrdController;
use App\Http\Controllers\MenteeController;
use App\Http\Controllers\KelolaHrdController;
use App\Http\Controllers\SeleksiProsesController;
use App\Http\Controllers\DetailProjekController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Config\FileUpload;
use Illuminate\Http\Request;

Route::get('/user', function () {
    return view('pages.user.berhasidaftar.index');
})->name('user.home');

Route::post('/create_new_account/store', [RegisterController::class, 'store'])->name('create_new_account.store');
Route::get('/create_new_account/kirim-ulang-otp', [RegisterController::class, 'verify'])->name('create_new_account.verify');
Route::post('/create_new_account/verifikasi', [RegisterController::class, 'verifikasi'])->name('create_new_account.verifikasi');
// Authentication Routes
Route::get('/', function () {
    return view('pages.auth.home');
});
Route::get('/signin', function () {
    return view('pages.auth.auth-login');
});
Route::get('/register', function () {
    return view('pages.auth.register');
});

Route::get('/notifikasi', function () {
    return view('pages.notifikasi');
});

Route::get('/posisiaktf', [PosisiUserController::class, 'index']);

Route::get('/otp', function (Request $request) {
    $email = $request->query('email');
    return view('pages.auth.otp', compact('email'));
});

Route::get('/lupa-sandi', function (Request $request) {
    $email = $request->query('email');
    return view('pages.auth.lupa-sandi', compact('email'));
});

Route::get('file', [FileUpload::class, 'main'])->name('file');
// Protected Routes (Requires Authentication)
Route::middleware(['auth'])->group(function () {


    Route::get('home', [HomeController::class, 'index'])->name('home');

    // Resources (Standard CRUD)
    Route::resource('administrasi', AdministrasiController::class);
    Route::resource('kemampuan', KemampuanController::class);
    Route::resource('wawancara', WawancaraController::class);
    Route::resource('masterposisi', PosisiController::class);
    Route::post('/masterposisi/publishunpublish', [PosisiController::class, 'publishUnpublish'])->name('masterposisi.publishUnpublish');
    Route::resource('jurusan', JurusanController::class);
    Route::resource('instansi', InstansiController::class);
    Route::post('/instansi/blacklistunblacklist', [InstansiController::class, 'blacklistunblacklist'])->name('instansi.blacklistunblacklist');
    Route::resource('kelolamentor', KelolaMentorController::class);
    Route::resource('kelolamentor.mentee', MenteeController::class)->only(['store', 'destroy']);
    Route::resource('kriteriapenilaian', KriteriaPenilaianController::class);
    Route::resource('kriteriapenilaian.edit', KriteriaPenilaianController::class)->only(['store', 'destroy']);
    Route::resource('testimoni', TestimoniController::class);
    Route::resource('templatesertifikat', TemplateSertifikatController::class);
    Route::resource('sertifikatpenilaian', SertifikatPenilaianController::class);
    Route::resource('berhasildaftar', BerhasilDaftarController::class);
    Route::resource('notifikasiuser', NotifikasiUserController::class);
    Route::resource('penilaian', PenilaianController::class);
    Route::resource('penilaianmentor', PenilaianMentorController::class);
    Route::get('pesertamagangaktif', [PesertaMagangAktifController::class, 'index'])->name('pesertamagangaktif.index');
    Route::get('pesertamagangaktif/export/pdf', [PesertaMagangAktifController::class, 'exportPdf'])->name('pesertamagangaktif.export.pdf');
    Route::get('pendaftarmagang', [PendaftarMagangController::class, 'index'])->name('pendaftarmagang.index');
    Route::get('pendaftarmagang/export/pdf', [PendaftarMagangController::class, 'exportPdf'])->name('pendaftarmagang.export.pdf');
    // Route::resource('alumnimagang', AlumniMagangController::class);
    Route::get('alumnimagang', [AlumniMagangController::class, 'index'])->name('alumnimagang.index');
    Route::get('alumnimagang/export/pdf', [AlumniMagangController::class, 'exportPdf'])->name('alumnimagang.export.pdf');
    Route::resource('monitoring', ProjectController::class);
    Route::resource('detailmonitoring', DetailMonitoringController::class);
    Route::resource('detailproject', DetailProjekController::class);
    // Route::resource('dataalumni', AlumniMagangMentorController::class);
    Route::get('dataalumni', [AlumniMagangMentorController::class, 'index'])->name('dataalumni.index');
    Route::get('dataalumni/export/pdf', [AlumniMagangMentorController::class, 'exportPdf'])->name('dataalumni.export.pdf');
    Route::resource('berisertifikat', BeriSertifikatController::class);
    Route::get('berisertifikat/nilai/{id}', [BeriSertifikatController::class, 'generateNilai'])->name('berisertifikat.nilai.beri');
    Route::resource('kelolahrd', KelolaHrdController::class);
    // Route::resource('profileadmin', ProfileAdminController::class);
    // Route::resource('profilementor', ProfileMentorController::class);
    Route::resource('profilehrd', ProfileHrdController::class);
    Route::resource('profileuser', ProfileUserController::class);
    Route::post('/profileuser/{id}/edit', [ProfileUserController::class, 'update']);

    // Route::resource('seleksiproses', SeleksiProsesController::class);

    Route::get('seleksiproses', [SeleksiProsesController::class, 'index'])->name('seleksiproses.index');
    Route::get('seleksiproses/export/pdf', [SeleksiProsesController::class, 'exportPdf'])->name('seleksiproses.export.pdf');

    Route::resource('posisiuser', PosisiUserController::class);
    Route::get('/posisi', [PosisiUserController::class, 'posisiaktif'])->name('posisi.aktif');


    Route::resource('kegiatanku', KegiatankuController::class);
    Route::get('/user/kegiatanku/soal', [KegiatankuController::class, 'soaluser'])->name('user.kegiatanku.soal');
    Route::post('/user/kegiatanku/upload-jawaban', [KegiatankuController::class, 'uploadJawaban'])->name('user.kegiatanku.upload_jawaban');
    Route::get('/kegiatanku/project-detail/{id}', [KegiatankuController::class, 'showProjectDetail'])->name('kegiatanku.project.detail');
    Route::post('/kegiatanku/project-detail/{id}', [KegiatankuController::class, 'simpanDetailProject'])->name('kegiatanku.project.simpanDetailPro');
    Route::put('/kegiatanku/project-detail/{id}', [KegiatankuController::class, 'editDetailProject'])->name('kegiatanku.project.editDetailProject');
    Route::post('/kegiatanku/testimoni/simpan', [KegiatankuController::class, 'testimoni'])->name('kegiatanku.testimoni.simpan');
    //pengajuan magang
    Route::post('/user/ajukan-magang/{id}', [PendaftarMagangController::class, 'pengajuan'])->name('user.pengajuan');
    Route::get('/change-password', [ProfileUserController::class, 'changepassword'])->name('user.change-password');
    Route::post('/update-password', [ProfileUserController::class, 'updatepassword'])->name('user.update-password');





    // Tambahkan rute kustom untuk halaman ganti kata sandi
    // Route::resource('/profileadmin', ProfileAdminController::class)->only(['index', 'update']);
    Route::get('/profileadmin', [ProfileAdminController::class, 'index'])->name('profileadmin.index');
    Route::put('/profileadmin', [ProfileAdminController::class, 'update'])->name('profileadmin.update');
    Route::get('/profileadmin/change-password', [ProfileAdminController::class, 'showChangePasswordForm'])->name('profileadmin.password.change.form');
    Route::put('/profileadmin/change-password', [ProfileAdminController::class, 'updatePassword'])->name('profileadmin.password.update');

    // Tambahkan rute kustom untuk halaman ganti kata sandi
    Route::get('/profilementor', [ProfileMentorController::class, 'index'])->name('profilementor.index');
    Route::put('/profilementor', [ProfileMentorController::class, 'update'])->name('profilementor.update');
    Route::get('/profilementor/change-password', [ProfileMentorController::class, 'showChangePasswordForm'])->name('profilementor.password.change.form');
    Route::put('/profilementor/change-password', [ProfileMentorController::class, 'updatePassword'])->name('profilementor.password.update');

    // Tambahkan rute kustom untuk halaman ganti kata sandi
    Route::get('/profilehrd/change-password', [ProfileHrdController::class, 'showChangePasswordForm'])->name('profilehrd.password.change.form');
    Route::put('/profilehrd/change-password', [ProfileHrdController::class, 'updatePassword'])->name('profilehrd.password.update');


    // Mitra Blacklist/Unblacklist Routes (Didefinisikan di luar resource untuk kejelasan)
    Route::put('instansi/{instansi}/blacklist', [InstansiController::class, 'blacklist'])->name('instansi.blacklist');
    Route::put('instansi/{instansi}/unblacklist', [InstansiController::class, 'unblacklist'])->name('instansi.unblacklist');

    Route::put('posisi/{posisi}/publish', [PosisiController::class, 'publish'])->name('posisi.publish');
    Route::put('posisi/{posisi}/unpublish', [PosisiController::class, 'unpublish'])->name('posisi.unpublish');


    // Administrasi Specific Routes
    Route::post('/administrasi/terima', [AdministrasiController::class, 'terima'])->name('administrasi.terima');
    Route::post('/administrasi/tolak', [AdministrasiController::class, 'tolak'])->name('administrasi.tolak');

    // Kemampuan Specific Routes (Soal)
    Route::prefix('kemampuan')->group(function () {
        // Route::get('{id}/soal', [KemampuanController::class, 'show_soal'])->name('kemampuan.show_soal');
        Route::get('create', [KemampuanController::class, 'create'])->name('kemampuan.create');
        Route::post('', [KemampuanController::class, 'store'])->name('kemampuan.store');
        Route::post('terima', [KemampuanController::class, 'terima'])->name('kemampuan.terima');
        Route::post('tolak', [KemampuanController::class, 'tolak'])->name('kemampuan.tolak');
    });

    // Wawancara Specific Routes
    Route::put('wawancara/{id}/unggah', [WawancaraController::class, 'create'])->name('wawancara.create');
    Route::put('wawancara/{id}/terima', [WawancaraController::class, 'terima'])->name('wawancara.terima');
    Route::put('wawancara/{id}/tolak', [WawancaraController::class, 'tolak'])->name('wawancara.tolak');

    Route::get('/pesertamagangaktif/export-pdf', [PesertaMagangAktifController::class, 'exportPdf'])->name('pesertamagangaktif.export.pdf');
    Route::get('/pendaftarmagang/export-pdf', [PendaftarMagangController::class, 'exportPdf'])->name('pendaftarmagang.export.pdf');
    Route::get('/alumnimagang/export-pdf', [AlumniMagangController::class, 'exportPdf'])->name('alumnimagang.export.pdf');
    Route::get('/alumni/export-pdf', [AlumniMagangMentorController::class, 'exportPdf'])->name('alumni.export.pdf');
});
