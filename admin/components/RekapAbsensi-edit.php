<?php
require_once('../../connection/conf.php');

if(!isset($_SESSION['admin'])){
    header('Location: ../../auth/login?act=notlogin');
    exit();
}
$id = $_GET['id'];
$editDataAbsenSiswa = $confg->query("SELECT * FROM tbl_absensi_siswa WHERE id = $id ");

if(isset($_POST['submit'])){
    $tanggal = htmlspecialchars(htmlentities(mysqli_real_escape_string($confg, $_POST['tanggal'])));
    $waktu = htmlspecialchars(htmlentities(mysqli_real_escape_string($confg, $_POST['waktu'])));
    $nis = htmlspecialchars(htmlentities(mysqli_real_escape_string($confg, $_POST['nis'])));
    $nama_siswa = htmlspecialchars(htmlentities(mysqli_real_escape_string($confg, $_POST['nama_siswa'])));
    $kelas_siswa = htmlspecialchars(htmlentities(mysqli_real_escape_string($confg, $_POST['kelas_siswa'])));
    $status_siswa = htmlspecialchars(htmlentities(mysqli_real_escape_string($confg, $_POST['status_siswa'])));
    $poin_siswa = htmlspecialchars(htmlentities(mysqli_real_escape_string($confg, $_POST['poin_siswa'])));

    if($tanggal != '' OR $waktu != '' OR $nis != '' OR $nama_siswa != '' OR $kelas_siswa != '' OR $status_siswa != '' OR $poin_siswa != ''){
        $updateAbsensi = mysqli_query($confg, "UPDATE tbl_absensi_siswa SET tanggal = '$tanggal', waktu = '$waktu', nis = '$nis', nama= '$nama_siswa' , kelas = '$kelas_siswa', status = '$status_siswa' , poin = '$poin_siswa' WHERE id = $id ");
        if($updateAbsensi == TRUE){
            header('Location: RekapAbsensi-edit?id='.$id.'&act=successAdd');
            $updatePoin = $confg->query("UPDATE user SET poin = '$poin_siswa' WHERE id = $id");
        }else{
            header('Location: RekapAbsensi-edit?id='.$id.'&act=failAdd');
        }
    }else{
        header('Location: RekapAbsensi-edit?id='.$id.'&act=empty');
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../public/css/output.css">
    <link rel="icon" type="image/png" href="../../icons/world-book-day.png"/>
    <script src="../../js/timer.js"></script>
    <?php require '../../assets/header.php'; ?>
    <title>APP KESISWAAN - EDIT REKAP ABSENSI SISWA</title>
</head>
<body class="bg-slate-900 " onload="startTime();">
<div class="md:flex md:flex-row">
        <!-- Mobile Menu -->
        <div class="bg-slate-800 w-72 text-purple-600 font-mono focus:outline-none z-20 px-6 py-9 absolute inset-y-0 left-0 transform -translate-x-full transition duration-500 ease-in-out lg:relative lg:translate-x-0" id="sidebar">
            <button href="" title="meta icons" class="font-extrabold text-2xl text-indigo-500 flex items-center space-x-2">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M12.316 3.051a1 1 0 01.633 1.265l-4 12a1 1 0 11-1.898-.632l4-12a1 1 0 011.265-.633zM5.707 6.293a1 1 0 010 1.414L3.414 10l2.293 2.293a1 1 0 11-1.414 1.414l-3-3a1 1 0 010-1.414l3-3a1 1 0 011.414 0zm8.586 0a1 1 0 011.414 0l3 3a1 1 0 010 1.414l-3  3a1 1 0 11-1.414-1.414L16.586 10l-2.293-2.293a1 1 0 010-1.414z" cli p-rule="evenodd" />
                </svg>
             <span class="">Kesiswaan</span>
             </button>
             <nav class="text-slate-400 min-h-screen overflow-y-auto top-0 inset-x-0 font-mono text-[1.3rem] relative pt-7 gap-3 md:text-lg">
                <a href="../" class="flex items-center gap-2 text-zinc-300 py-2 px-3 my-5 hover:bg-indigo-500 rounded-md transition duration-200">
                    <div class="flex items-center">
                        <img src="../../icons/layout.png" class="h-6 w-6"alt="">
                    </div>
                Dashboard
                </a>
                <div class="relative" x-data="{ isOpen : false }">
                        <button
                        @click="isOpen = !isOpen"
                        href="components/absensi" 
                        class="flex items-center justify-center text-zinc-300 gap-2 py-2 px-3 -inset-x-5 bg-slate-900 rounded-md transition duration-200">
                        <img src="../../icons/calendar.png" class="h-6 w-6" alt="" srcset="">
                        </svg>
                        <span>RekapAbsensi</span>
                        <div class="relative">
                            <svg fill="currentColor" viewBox="0 0 20 20" :class="{'rotate-180': isOpen, 'rotate-0': !isOpen}" class="inline w-5 h-5 transition-transform duration-200 transform"><path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                        </div>
                        </button>
                            <!-- Dropdown Menu -->
                                <ul
                                x-show="isOpen"
                                @click.away="isOpen = false"
                                class="space-y-2 text-sm px-3 py-2"
                                x-transition:enter="transition ease-out duration-200" x-transition:enter-start="transform opacity-0 scale-95" x-transition:enter-end="transform opacity-100 scale-100" x-transition:leave="transition ease-in duration-200" x-transition:leave-start="transform opacity-100 scale-100" x-transition:leave-end="transform opacity-0 scale-95">
                                    <li>
                                        <a href="../components/RekapAbsensi" class="flex items-center hover:text-indigo-500 gap-2 transition duration-200 p-1">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="group-hover:bg-slate-200 fill-current"width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#636e72" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"></circle></svg>
                                        Absensi Siswa</a>
                                    </li>
                                    <li>
                                        <a href="../components/RekapAbsensi-guru" class="flex items-center hover:text-indigo-500 gap-2 transition duration-200 p-1">
                                        <svg xmlns="http://www.w3.org/2000/svg"
                                        class="group-hover:bg-slate-200 fill-current" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#636e72" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"></circle></svg>
                                        Absensi Guru</a>
                                    </li>
                                </ul>
                            <!-- End DropDown Menu -->
                    </div>
                    <div class="py-2"></div>
                    <div class="relative" x-data="{ isOpen : false }">
                        <button
                        @click="isOpen = !isOpen"
                        href="components/absensi" 
                        class="flex items-center justify-center text-zinc-300 gap-2 py-2 px-3 -inset-x-5 hover:bg-indigo-500 rounded-md transition duration-200">
                        <img src="../../icons/report.png" class="h-6 w-6" alt="" srcset="">
                        </svg>
                        <span>RekapLaporan</span>
                        <div class="relative">
                            <svg fill="currentColor" viewBox="0 0 20 20" :class="{'rotate-180': isOpen, 'rotate-0': !isOpen}" class="inline w-5 h-5 transition-transform duration-200 transform"><path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                        </div>
                        </button>
                            <!-- Dropdown Menu -->
                                <ul
                                x-show="isOpen"
                                @click.away="isOpen = false"
                                class="space-y-2 text-sm px-3 py-2"
                                x-transition:enter="transition ease-out duration-200" x-transition:enter-start="transform opacity-0 scale-95" x-transition:enter-end="transform opacity-100 scale-100" x-transition:leave="transition ease-in duration-200" x-transition:leave-start="transform opacity-100 scale-100" x-transition:leave-end="transform opacity-0 scale-95">
                                    <li>
                                        <a href="../components/RekapLaporan" class="flex items-center hover:text-indigo-500 gap-2 transition duration-200 p-1">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="group-hover:bg-slate-200 fill-current"width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#636e72" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"></circle></svg>
                                        Laporan Siswa</a>
                                    </li>
                                    <li>
                                        <a href="../components/RekapLaporan-guru" class="flex items-center hover:text-indigo-500 gap-2 transition duration-200 p-1">
                                        <svg xmlns="http://www.w3.org/2000/svg"
                                        class="group-hover:bg-slate-200 fill-current" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#636e72" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"></circle></svg>
                                        Laporan Guru</a>
                                    </li>
                                </ul>
                            <!-- End DropDown Menu -->
                    </div>
                    <div class="py-2"></div>
                <div class="relative" x-data="{ isOpen : false }">
                    <button
                    @click="isOpen = !isOpen"
                    href="components/absensi" 
                    class="flex items-center justify-center text-zinc-300 gap-2 py-2 px-3 -inset-x-5 hover:bg-indigo-500 rounded-md transition duration-200">
                    <img src="../../icons/data.png" class="h-6 w-6" alt="">
                    </svg>
                    <span>Data Umum</span>
                    <div class="relative">
                        <svg fill="currentColor" viewBox="0 0 20 20" :class="{'rotate-180': isOpen, 'rotate-0': !isOpen}" class="inline w-5 h-5 transition-transform duration-200 transform"><path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                    </div>
                    </button>
                        <!-- Dropdown Menu -->
                            <ul
                            x-show="isOpen"
                            @click.away="isOpen = false"
                            class="space-y-2 text-sm px-3 py-2"
                            x-transition:enter="transition ease-out duration-200" x-transition:enter-start="transform opacity-0 scale-95" x-transition:enter-end="transform opacity-100 scale-100" x-transition:leave="transition ease-in duration-200" x-transition:leave-start="transform opacity-100 scale-100" x-transition:leave-end="transform opacity-0 scale-95">
                                <li>
                                    <a href="dataSiswa" class="flex items-center hover:text-indigo-500 gap-2 transition duration-200 p-1">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="group-hover:bg-slate-200 fill-current"width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#636e72" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"></circle></svg>
                                    Data Siswa</a>
                                </li>
                                <li>
                                    <a href="tambahSiswa" class="flex items-center hover:text-indigo-500 gap-2 transition duration-200 p-1">
                                    <svg xmlns="http://www.w3.org/2000/svg"
                                    class="group-hover:bg-slate-200 fill-current" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#636e72" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"></circle></svg>
                                    Tambah Data Siswa</a>
                                </li>
                                <li>
                                    <a href="dataGuru" class="flex items-center hover:text-indigo-500 gap-2 transition duration-200 p-1">
                                    <svg xmlns="http://www.w3.org/2000/svg"
                                    class="group-hover:bg-slate-200 fill-current" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#636e72" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"></circle></svg>
                                    Data Guru</a>
                                </li>
                                <li>
                                    <a href="" class="flex items-center hover:text-indigo-500 gap-2 transition duration-200 p-1">
                                    <svg xmlns="http://www.w3.org/2000/svg"
                                    class="group-hover:bg-slate-200 fill-current" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#636e72" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"></circle></svg>
                                    Tambah Data guru</a>
                                </li>
                                <li>
                                    <a href="Semester" class="flex items-center hover:text-indigo-500 gap-2 transition duration-200 p-1">
                                    <svg xmlns="http://www.w3.org/2000/svg"
                                    class="group-hover:bg-slate-200 fill-current" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#636e72" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"></circle></svg>
                                    Semester</a>
                                </li>
                            </ul>
                        <!-- End DropDown Menu -->
                </div>
                <a href="./Profile" class="flex items-center gap-2 text-zinc-300 py-2 px-3 my-5 hover:bg-indigo-500 rounded-md transition duration-200 ">
                    <img src="../../icons/user.png" class="h-6 w-6" alt="">
                User Profile
                </a>
                <div class="" x-data="{ isOpen : false }">
                    <button
                    @click ="isOpen = !isOpen"
                    href="components/absensi" 
                    class="flex items-center text-zinc-300 gap-2 py-2 px-3 -inset-x-5 hover:bg-indigo-500 rounded-md transition duration-200">
                        <img src="../../icons/online-learning.png" class="h-6 w-6" alt="" srcset="">
                    </svg>
                    <span>Pelajaran</span>
                    <div class="relative">
                        <svg fill="currentColor" viewBox="0 0 20 20" :class="{'rotate-180': isOpen, 'rotate-0': !isOpen}" class="inline w-5 h-5 ml-7 transition-transform duration-200 transform md:-mt-1"><path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                    </div>
                    </button>
                        <!-- Dropdown Menu -->
                            <ul
                            x-show="isOpen"
                            @click.away="isOpen = false"
                            class="space-y-2 text-sm px-3 py-3"
                            x-transition:enter="transition ease-out duration-200" x-transition:enter-start="transform opacity-0 scale-95" x-transition:enter-end="transform opacity-100 scale-100" x-transition:leave="transition ease-in duration-200" x-transition:leave-start="transform opacity-100 scale-100" x-transition:leave-end="transform opacity-0 scale-95">
                                <li>
                                    <a href="listPelajaran" class="flex items-center hover:text-indigo-500 gap-2 transition duration-200 p-1">
                                    <svg xmlns="http://www.w3.org/2000/svg"
                                    class="group-hover:bg-slate-200 fill-current" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#636e72" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"></circle></svg>
                                    List Pelajaran</a>
                                </li>
                                <li>
                                <a href="jadwalMengajar" class="flex items-center hover:text-indigo-500 gap-2 transition duration-200 p-1">
                                    <svg xmlns="http://www.w3.org/2000/svg"
                                    class="group-hover:bg-slate-200 fill-current" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#636e72" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"></circle></svg>
                                    Jadwal Mengajar</a>
                                </li>
                                <li>
                                <a href="ArsipjadwalMengajar" class="flex items-center hover:text-indigo-500 gap-2 transition duration-200 p-1">
                                    <svg xmlns="http://www.w3.org/2000/svg"
                                    class="group-hover:bg-slate-200 fill-current" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#636e72" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"></circle></svg>
                                    Arsip Mengajar</a>
                                </li>
                            </ul>
                        <!-- End DropDown Menu -->
                </div>
                <a href="./add-news" class="flex items-center text-zinc-300 gap-2 py-2 px-3 my-5 hover:bg-indigo-500 rounded-md transition duration-200">
                        <img src="../../icons/news.png" alt="" class="h-6 w-6" srcset="">
                    Add News
                    </a>
                    <a href="../App/Development" class="flex items-center text-zinc-300 gap-2 py-2 px-3 my-5 hover:bg-indigo-500 rounded-md transition duration-200">
                        <img src="../../icons/software-development.png" alt="" class="h-6 w-6" srcset="">
                    Development
                    </a>
                    <div class="relative" x-data="{ isOpen : false }">
                        <button
                        @click="isOpen = !isOpen"
                        href="components/absensi" 
                        class="flex items-center text-zinc-300 gap-2 py-2 px-3 my-5 hover:bg-indigo-500 rounded-md transition duration-200">
                        <img src="../../icons/exam.png" class="h-6 w-6" alt="">
                        </svg>
                        <span>Exam/Ujian</span>
                        <div class="relative">
                            <svg fill="currentColor" viewBox="0 0 20 20" :class="{'rotate-180': isOpen, 'rotate-0': !isOpen}" class="inline w-5 h-5 transition-transform duration-200 transform"><path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                        </div>
                        </button>
                            <!-- Dropdown Menu -->
                                <ul
                                x-show="isOpen"
                                @click.away="isOpen = false"
                                class="space-y-2 text-sm px-3 py-2"
                                x-transition:enter="transition ease-out duration-200" x-transition:enter-start="transform opacity-0 scale-95" x-transition:enter-end="transform opacity-100 scale-100" x-transition:leave="transition ease-in duration-200" x-transition:leave-start="transform opacity-100 scale-100" x-transition:leave-end="transform opacity-0 scale-95">
                                    <li>
                                        <a href="../App/soal-ujian" class="flex items-center hover:text-indigo-500 gap-2 transition duration-200 p-1">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="group-hover:bg-slate-200 fill-current"width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#636e72" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"></circle></svg>
                                        Paket Soal / Ujian</a>
                                    </li>
                                    <li>
                                        <a href="../App/jadwal-Ujian" class="flex items-center hover:text-indigo-500 gap-2 transition duration-200 p-1">
                                        <svg xmlns="http://www.w3.org/2000/svg"
                                        class="group-hover:bg-slate-200 fill-current" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#636e72" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"></circle></svg>
                                        Jadwal Ujian</a>
                                    </li>
                                    <li>
                                        <a href="../App/rekap-ujian" class="flex items-center hover:text-indigo-500 gap-2 transition duration-200 p-1">
                                        <svg xmlns="http://www.w3.org/2000/svg"
                                        class="group-hover:bg-slate-200 fill-current" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#636e72" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"></circle></svg>
                                        Data Ruangan</a>
                                    </li>
                                    <li>
                                        <a href="../App/rekap-ujian" class="flex items-center hover:text-indigo-500 gap-2 transition duration-200 p-1">
                                        <svg xmlns="http://www.w3.org/2000/svg"
                                        class="group-hover:bg-slate-200 fill-current" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#636e72" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"></circle></svg>
                                        Rekap Data Ujian</a>
                                    </li>
                                </ul>
                            <!-- End DropDown Menu -->
                    </div>
                <a href="../components/forum-chat" class="flex items-center text-zinc-300 gap-2 py-2 px-3 my-5 hover:bg-indigo-500 rounded-md transition duration-200">
                    <img src="../../icons/chat.png" alt="" class="h-6 w-6" srcset="">
                Forum Chat
                </a>
                <a href="../../auth/Logout" class="flex items-center text-zinc-300 gap-2  py-2 px-3 my-5 hover:bg-indigo-500 rounded-md transition-all duration-200 ease-in">
                    <img src="../../icons/logout.png" class="h-6 w-6" alt="" srcset="">
                Logout
                </a>
            </nav>
        </div>
            <div class="w-full h-[4rem] m-6 p-4 rounded-lg bg-slate-800 text-zinc-300">
                <div class="container flex justify-end items-center mx-auto">
                    <ul class="flex space-x-5 bottom-0">
                        <div class="relative">
                            <img src="../../icons/notification-bell.png"class="h-8 w-9" alt="" srcset="">
                        </div>
                        <div class="relative">
                        <span id="ct" class="p-1 flex border-green-500 border-[0.5px] text-green-500"></span>
                        </div>
                        <div class="relative" x-data="{ isOpen : false }">
                            <button
                            @click= "isOpen = !isOpen"
                            class="flex items-center pb-2 focus:outline-none ">
                                <div class="gap-3 relative flex md:text-base">
                                    <span class="flex space-y-2"><?= $_SESSION['admin']; ?></span> 
                                   <span class="absolute pt-5 pl-1 text-xs items-center">ADMINISTRATOR</span>
                                   <img src="https://raw.githubusercontent.com/sefyudem/Responsive-Login-Form/master/img/avatar.svg" class="rounded-full flex h-10 w-10 gap-2 pl-2" alt="image" srcset="">
                                </div>
                                <div class="relative">
                                    <svg fill="currentColor" viewBox="0 0 20 20"
                                    :class="{'rotate-180': isOpen, 'rotate-0': !isOpen}"
                                    class="inline w-6 h-6 pt-1 transition-transform duration-200 transform"><path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                                    </div>
                            </button>
                            <!-- Dropdown Menu -->
                            <div class="relative">
                                <ul
                                x-show="isOpen"
                                @click.away="isOpen = false"
                                x-transition:enter="transition ease-out duration-200" x-transition:enter-start="transform opacity-0 scale-95" x-transition:enter-end="transform opacity-100 scale-100" x-transition:leave="transition ease-in duration-200" x-transition:leave-start="transform opacity-100 scale-100" x-transition:leave-end="transform opacity-0 scale-95"
                                class="absolute overflow-hidden rounded-md font-normal right-0 z-10 w-40 bg-slate-800 shadow-lg text-zinc-400 shadow-black space-y-4 divide-y-2 divide-indigo-800 gap-2">
                                    <li class="">
                                        <a href="./Profile" class="hover:bg-indigo-500 hover:text-white hover:transition duration-200 flex items-center px-4 py-3 gap-2">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                                <path fill-rule="evenodd" d="M11.49 3.17c-.38-1.56-2.6-1.56-2.98 0a1.532 1.532 0 01-2.286.948c-1.372-.836-2.942.734-2.106 2.106.54.886.061 2.042-.947 2.287-1.561.379-1.561 2.6 0 2.978a1.532 1.532 0 01.947 2.287c-.836 1.372.734 2.942 2.106 2.106a1.532 1.532 0 012.287.947c.379 1.561 2.6 1.561 2.978 0a1.533 1.533 0 012.287-.947c1.372.836 2.942-.734 2.106-2.106a1.533 1.533 0 01.947-2.287c1.561-.379 1.561-2.6 0-2.978a1.532 1.532 0 01-.947-2.287c.836-1.372-.734-2.942-2.106-2.106a1.532 1.532 0 01-2.287-.947zM10 13a3 3 0 100-6 3 3 0 000 6z" clip-rule="evenodd" />
                                            </svg>Settings</a>
                                        <a href=""class="hover:bg-indigo-500 hover:text-white hover:transition duration-200 flex items-center px-4 py-3 gap-2">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                            </svg>Account</a>
                                        <a href="../../auth/logout" class="hover:bg-indigo-500 hover:text-white hover:transition duration-200 flex items-center px-4 py-3 gap-2">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                          <path stroke-linecap="round" stroke-linejoin="round" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                                        </svg>Logout</a>
                                    </li>
                                </ul>
                                </div>
                            <!-- End Dropdown -->
                        </div>
                        <div class="relative">
                        <button class="mobile-button bg-blue-dark p-1 focus:outline-none lg:hidden">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-slate-200" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h7" />
                            </svg>
                        </button>
                        </div>
                    </ul>
                </div>
                <script>
                    const btn = document.querySelector("button.mobile-button");
                    const side = document.querySelector("#sidebar");

                    btn.addEventListener("click",() =>{
                    side.classList.toggle("-translate-x-full");
                    })
                </script>
                <div class="py-3">
                    <?php
                        while($row = mysqli_fetch_array($editDataAbsenSiswa)){
                    ?>
                    <form action="" class="bg-slate-800 grid grid-cols-1 p-5 py-6 gap-y-12 gap-x-5 mi-h-full relative" method="POST">
                        <h2 class="font-bold text-2xl sm:text-xl"><button class="px-3 py-1 bg-indigo-500 hover:bg-slate-900" onclick="window.location.href='RekapAbsensi'"><</button>&nbspFORM EDIT ABSENSI SISWA</h2>
                        <?php 
                    if(isset($_GET['act'])){
                        if($_GET['act'] == "successAdd"){
                    ?>
                        <div class='w-full p-4 mb-4 text-base text-center flex justify-center bg-green-800 text-green-400 rounded-lg' role='alert' id="success">
                            
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-center" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
                        </svg><span class='font-bold'>&nbspSUCCESS MELAKUKAN UPDATE ABSENSI SISWA &nbspAnda Akan Diarahkan ke ABSENSI SISWA&nbsp</span>
                        <span class="flex items-center" id='waktu'>3</span>
                        <script type="text/javascript">
                            var waktu = 3;
                            setInterval(function() {
                            waktu--;
                            if(waktu < 0) {
                                document.getElementById("success").innerHTML = 'Redirecting...';
                                window.location = 'RekapAbsensi';
                            }else{
                            document.getElementById("waktu").innerHTML = waktu;
                            }
                            }, 1000);
                            </script>
                        </div>
                    <?php
                    }else if($_GET['act'] == "empty"){
                         ?>  
                        <div class='w-full p-4 mb-4 text-base text-center flex justify-center bg-red-600 text-white rounded-lg' role='alert' id="gagal">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-center" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
                        </svg>
                        <span class='font-bold'>&nbspGAGAL MELAKUKAN UPDATE ABSENSI SISWA , DATA TIDAK BOLEH KOSONG</span> 
                        </div>
                    <?php
                    }else{
                         ?>  
                        <div class='w-full p-4 mb-4 text-base text-center flex justify-center bg-red-600 text-white rounded-lg' role='alert' id="gagal">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-center" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
                        </svg>
                        <span class='font-bold'>&nbspGAGAL MELAKUKAN UPDATE ABSENSI SISWA , SILAHKAN PERIKSA DATA ANDA KEMBALI</span> 
                        </div>
                    <?php
                    }
                }
                    ?>
                        <div class="relative">
                            <label for="">TANGGAL</label>
                            <input type="text" name="tanggal" class="absolute flex items-center p-2 w-full bg-transparent border border-gray-600 text-left text-zinc-400 focus:outline-none focus:border-indigo-500 transform translate duration-500" placeholder="Masukkan Nama Anda"value="<?= $row['tanggal'] ?>">
                        </div>
                        <div class="relative">
                            <label for="">Waktu Kehadiran</label>
                            <input type="time" name="waktu" class="absolute flex items-center p-2 w-full bg-transparent border border-gray-600 text-left text-zinc-400 focus:outline-none focus:border-indigo-500 transform translate duration-500" placeholder="Masukkan Password Anda" value="<?= $row['waktu'] ?>">
                        </div>
                        <div class="relative">
                            <label for="">NIS</label>
                            <input type="text" name="nis" class="absolute flex items-center p-2 w-full bg-transparent border border-gray-600 text-left text-zinc-400 focus:outline-none focus:border-indigo-500 transform translate duration-500" placeholder="Masukkan NIS Anda" value="<?= $row['nis'] ?>">
                        </div>
                        <div class="relative">
                            <label for="">NAMA SSIWA</label>
                            <input type="text" name="nama_siswa" class="absolute flex items-center p-2 w-full bg-transparent border border-gray-600 text-left text-zinc-400 focus:outline-none focus:border-indigo-500 transform translate duration-500" placeholder="Masukkan Kelas Anda" value="<?= $row['nama'] ?>">
                        </div>
                        <div class="relative">
                            <label for="">KELAS SISWA</label>
                            <input type="text" name="kelas_siswa" class="absolute flex items-center p-2 w-full bg-transparent border border-gray-600 text-left text-zinc-400 focus:outline-none focus:border-indigo-500 transform translate duration-500" placeholder="Masukkan Kelas Anda" value="<?= $row['kelas'] ?>">
                        </div>
                        <div class="relative">
                            <label for="">STATUS</label>
                            <input type="text" name="status_siswa" class="absolute flex items-center p-2 w-full bg-transparent border border-gray-600 text-left text-zinc-400 focus:outline-none focus:border-indigo-500 transform translate duration-500" placeholder="Masukkan Kelas Anda" value="<?= $row['status'] ?>">
                        </div>
                        <div class="relative">
                            <label for="">POIN SISWA</label>
                            <input type="text" name="poin_siswa" class="absolute flex items-center p-2 w-full bg-transparent border border-gray-600 text-left text-zinc-400 focus:outline-none focus:border-indigo-500 transform translate duration-500" placeholder="Masukkan Kelas Anda" value="<?= $row['poin'] ?>">
                        </div>
                        <div class=""></div>
                            <button type="submit" name="submit" class="bg-purple-dark text-purple-600 p-2 hover:bg-purple-500 hover:text-white hover:transform duration-300">Simpan Data</button>
                    </form>
                    <?php
                        }
                    ?>
                </div>
            </div>
    </div>
</div>
</body>
</html> 