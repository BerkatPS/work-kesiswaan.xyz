<?php
require_once('../../connection/conf.php');

if(!isset($_SESSION['admin'])){
    header('Location: ../../auth/login?act=notlogin');
    exit();
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
    <title>APP KESISWAAN - FORUM CHAT</title>
</head>
<body class="bg-slate-900 " onload="startTime();">
<div class="md:flex relative md:fixed w-full md:w-7/12 min-h-screen ">
        <!-- Mobile Menu -->
        <div class="overflow-hidden inset-0">
            <div class="bg-slate-800 w-72 text-purple-600 font-mono focus:outline-none z-10 px-6 py-9 absolute transform -translate-x-full overflow-hidden transition duration-500 ease-in-out lg:relative lg:translate-x-0" id="sidebar">
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
                        class="flex items-center justify-center text-zinc-300 gap-2 py-2 px-3 -inset-x-5 hover:bg-indigo-500 rounded-md transition duration-200">
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
                                        <a href="RekapAbsensi" class="flex items-center hover:text-indigo-500 gap-2 transition duration-200 p-1">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="group-hover:bg-slate-200 fill-current"width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#636e72" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"></circle></svg>
                                        Absensi Siswa</a>
                                    </li>
                                    <li>
                                        <a href="RekapAbsensi-guru" class="flex items-center hover:text-indigo-500 gap-2 transition duration-200 p-1">
                                        <svg xmlns="http://www.w3.org/2000/svg"
                                        class="group-hover:bg-slate-200 fill-current" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#636e72" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"></circle></svg>
                                        Absensi Guru</a>
                                    </li>
                                </ul>
                            <!-- End DropDown Menu -->
                    </div>
                    <div class="py-3"></div>
                    <div class="relative" x-data="{ isOpen : false }">
                        <button
                        @click="isOpen = !isOpen"
                        href="absensi" 
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
                                        <a href="RekapLaporan" class="flex items-center hover:text-indigo-500 gap-2 transition duration-200 p-1">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="group-hover:bg-slate-200 fill-current"width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#636e72" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"></circle></svg>
                                        Laporan Siswa</a>
                                    </li>
                                    <li>
                                        <a href="RekapAbsensi-guru" class="flex items-center hover:text-indigo-500 gap-2 transition duration-200 p-1">
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
                        href="absensi" 
                        class="flex items-center justify-center text-zinc-300 gap-2 py-2 px-4 -inset-x-5 hover:bg-indigo-500 rounded-md transition duration-200">
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
                                        <a href="../pages/dataSiswa" class="flex items-center hover:text-indigo-500 gap-2 transition duration-200 p-1">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="group-hover:bg-slate-200 fill-current"width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#636e72" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"></circle></svg>
                                        Data Siswa</a>
                                    </li>
                                    <li>
                                        <a href="../pages/tambahSiswa" class="flex items-center hover:text-indigo-500 gap-2 transition duration-200 p-1">
                                        <svg xmlns="http://www.w3.org/2000/svg"
                                        class="group-hover:bg-slate-200 fill-current" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#636e72" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"></circle></svg>
                                        Tambah Data Siswa</a>
                                    </li>
                                    <li>
                                        <a href="../pages/dataGuru" class="flex items-center hover:text-indigo-500 gap-2 transition duration-200 p-1">
                                        <svg xmlns="http://www.w3.org/2000/svg"
                                        class="group-hover:bg-slate-200 fill-current" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#636e72" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"></circle></svg>
                                        Data Guru</a>
                                    </li>
                                    <li>
                                        <a href="../pages/tambahGuru" class="flex items-center hover:text-indigo-500 gap-2 transition duration-200 p-1">
                                        <svg xmlns="http://www.w3.org/2000/svg"
                                        class="group-hover:bg-slate-200 fill-current" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#636e72" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"></circle></svg>
                                        Tambah Data guru</a>
                                    </li>
                                    <li>
                                        <a href="../pages/Semester" class="flex items-center hover:text-indigo-500 gap-2 transition duration-200 p-1">
                                        <svg xmlns="http://www.w3.org/2000/svg"
                                        class="group-hover:bg-slate-200 fill-current" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#636e72" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"></circle></svg>
                                        Semester</a>
                                    </li>
                                </ul>
                            <!-- End DropDown Menu -->
                    </div>
                    <a href="../pages/Profile" class="flex items-center gap-2 text-zinc-300 py-2 px-3 my-5 hover:bg-indigo-500 rounded-md transition duration-200 ">
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
                                @click.away="isOpen = true"
                                class="space-y-2 text-sm px-3 py-3"
                                x-transition:enter="transition ease-out duration-200" x-transition:enter-start="transform opacity-0 scale-95" x-transition:enter-end="transform opacity-100 scale-100" x-transition:leave="transition ease-in duration-200" x-transition:leave-start="transform opacity-100 scale-100" x-transition:leave-end="transform opacity-0 scale-95">
                                    <li>
                                        <a href="../pages/listPelajaran" class="flex items-center hover:text-indigo-500 gap-2 transition duration-200 p-1">
                                        <svg xmlns="http://www.w3.org/2000/svg"
                                        class="group-hover:bg-slate-200 fill-current" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#636e72" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"></circle></svg>
                                        List Pelajaran</a>
                                    </li>
                                    <li>
                                    <a href="../pages/jadwalMengajar" class="flex items-center hover:text-indigo-500 gap-2 transition duration-200 p-1">
                                        <svg xmlns="http://www.w3.org/2000/svg"
                                        class="group-hover:bg-slate-200 fill-current" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#636e72" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"></circle></svg>
                                        Jadwal Mengajar</a>
                                    </li>
                                    <li>
                                    <a href="../pages/arsipMengajar" class="flex items-center hover:text-indigo-500 gap-2 transition duration-200 p-1">
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
                    <a href="" class="flex items-center text-zinc-300 gap-2 py-2 px-3 my-5 bg-slate-900 rounded-md transition duration-200">
                        <img src="../../icons/chat.png" alt="" class="h-6 w-6" srcset="">
                    Forum Chat
                    </a>
                    <a href="../../auth/Logout" class="flex items-center text-zinc-300 gap-2  py-2 px-3 my-5 hover:bg-indigo-500 rounded-md transition-all duration-200 ease-in">
                        <img src="../../icons/logout.png" class="h-6 w-6" alt="" srcset="">
                    Logout
                    </a>
                </nav>
            </div>
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
                                    <span class="flex space-y-2">TATAUSAHA </span> 
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
                                        <a href="../pages/Profile" class="hover:bg-indigo-500 hover:text-white hover:transition duration-200 flex items-center px-4 py-3 gap-2">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                                <path fill-rule="evenodd" d="M11.49 3.17c-.38-1.56-2.6-1.56-2.98 0a1.532 1.532 0 01-2.286.948c-1.372-.836-2.942.734-2.106 2.106.54.886.061 2.042-.947 2.287-1.561.379-1.561 2.6 0 2.978a1.532 1.532 0 01.947 2.287c-.836 1.372.734 2.942 2.106 2.106a1.532 1.532 0 012.287.947c.379 1.561 2.6 1.561 2.978 0a1.533 1.533 0 012.287-.947c1.372.836 2.942-.734 2.106-2.106a1.533 1.533 0 01.947-2.287c1.561-.379 1.561-2.6 0-2.978a1.532 1.532 0 01-.947-2.287c.836-1.372-.734-2.942-2.106-2.106a1.532 1.532 0 01-2.287-.947zM10 13a3 3 0 100-6 3 3 0 000 6z" clip-rule="evenodd" />
                                            </svg>Settings</a>
                                        <a href="../pages/Profile"class="hover:bg-indigo-500 hover:text-white hover:transition duration-200 flex items-center px-4 py-3 gap-2">
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
                    <div class="flex items-center justify-center">
                            <h2 class="text-2xl font-bold">FORUM CHATTING APPLICATION</h2>
                    </div>
                </div>
                <div class="flex md:grid grid-cols-1 justify-center gap-5 focus:outline-none">
                    
                    <div class="bg-slate-800 w-72 relative">
                        <div class="flex items-center justify-center py-5">
                            <img src="../../icons/recorded-call.png"class="h-10 w-10 flex items center" alt="">
                        </div>
                        <div class="px-6 py-2 text-sm">
                                <li style="list-style-type:none">
                                    <p class="flex items-center hover:text-indigo-500 gap-2 transition duration-200 p-1">
                                    <svg xmlns="http://www.w3.org/2000/svg"
                                    class="group-hover:bg-slate-200 fill-current" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#636e72" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"></circle></svg>
                                    Forum Chat Guru</p>
                                </li>
                                <li style="list-style-type:none">
                                    <p class="flex items-center hover:text-indigo-500 gap-2 transition duration-200 p-1">
                                    <svg xmlns="http://www.w3.org/2000/svg"
                                    class="group-hover:bg-slate-200 fill-current" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#636e72" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"></circle></svg>
                                    Aplikasi Aktif Pada Jam Tertentu</p>
                                </li>
                                <li style="list-style-type:none">
                                    <p class="flex items-center hover:text-indigo-500 gap-2 transition duration-200 p-1">
                                    <svg xmlns="http://www.w3.org/2000/svg"
                                    class="group-hover:bg-slate-200 fill-current" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#636e72" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"></circle></svg>
                                    Hanya Bisa Diakses Oleh Guru Saja</p>
                                </li>
                                <li style="list-style-type:none">
                                    <p class="flex items-center hover:text-indigo-500 gap-2 transition duration-200 p-1">
                                    <svg xmlns="http://www.w3.org/2000/svg"
                                    class="group-hover:bg-slate-200 fill-current" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#636e72" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"></circle></svg>
                                    Jika Status Anda Bukan Guru Maka Anda Tidak bisa Masuk</p>
                                </li>
                                <li style="list-style-type:none">
                                    <p class="flex items-center hover:text-indigo-500 gap-2 transition duration-200 p-1">
                                    <svg xmlns="http://www.w3.org/2000/svg"
                                    class="group-hover:bg-slate-200 fill-current" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#636e72" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"></circle></svg>
                                    Menggunakan Key Untuk Masuk Ke Chat</p>
                                </li>
                                <li style="list-style-type:none">
                                    <p class="flex items-center hover:text-indigo-500 gap-2 transition duration-200 p-1">
                                    <svg xmlns="http://www.w3.org/2000/svg"
                                    class="group-hover:bg-slate-200 fill-current" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#636e72" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"></circle></svg>
                                    Bisa MengInvite Guru Yang Diinginkan</p>
                                </li>
                                <li style="list-style-type:none">
                                    <p class="flex items-center hover:text-indigo-500 gap-2 transition duration-200 p-1">
                                    <svg xmlns="http://www.w3.org/2000/svg"
                                    class="group-hover:bg-slate-200 fill-current" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#636e72" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"></circle></svg>
                                    Forum Chat Hanya Bisa Digunakan Jika Ada Orang Yang Membuat Sebuh Grup</p>
                                </li>
                        </div>
                        <div class="px-6 py-6 flex items-center justify-center">
                            <button class="w-full p-2 text-green-200  hover:transition duration-300 bg-green-800 hover:text-white" id="blink">Forum Chat Guru</button>
                        </div>
                    </div>
                    <div class="bg-slate-800 w-72 relative">
                        <div class="flex items-center justify-center py-5">
                            <img src="../../icons/chat.png"class="h-10 w-10 flex items center" alt="">
                        </div>
                        <div class="px-6 py-2 text-sm">
                                <li style="list-style-type:none">
                                    <p class="flex items-center hover:text-indigo-500 gap-2 transition duration-200 p-1">
                                    <svg xmlns="http://www.w3.org/2000/svg"
                                    class="group-hover:bg-slate-200 fill-current" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#636e72" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"></circle></svg>
                                    Forum Chat Siswa</p>
                                </li>
                                <li style="list-style-type:none">
                                    <p class="flex items-center hover:text-indigo-500 gap-2 transition duration-200 p-1">
                                    <svg xmlns="http://www.w3.org/2000/svg"
                                    class="group-hover:bg-slate-200 fill-current" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#636e72" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"></circle></svg>
                                    Aplikasi Aktif Pada Jam Tertentu</p>
                                </li>
                                <li style="list-style-type:none">
                                    <p class="flex items-center hover:text-indigo-500 gap-2 transition duration-200 p-1">
                                    <svg xmlns="http://www.w3.org/2000/svg"
                                    class="group-hover:bg-slate-200 fill-current" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#636e72" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"></circle></svg>
                                    Hanya Bisa Diakses Oleh Siswa Saja</p>
                                </li>
                                <li style="list-style-type:none">
                                    <p class="flex items-center hover:text-indigo-500 gap-2 transition duration-200 p-1">
                                    <svg xmlns="http://www.w3.org/2000/svg"
                                    class="group-hover:bg-slate-200 fill-current" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#636e72" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"></circle></svg>
                                    Jika Status Anda Bukan Siswa Maka Anda Tidak bisa Masuk</p>
                                </li>
                                <li style="list-style-type:none">
                                    <p class="flex items-center hover:text-indigo-500 gap-2 transition duration-200 p-1">
                                    <svg xmlns="http://www.w3.org/2000/svg"
                                    class="group-hover:bg-slate-200 fill-current" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#636e72" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"></circle></svg>
                                    Menggunakan Key Untuk Masuk Ke Chat</p>
                                </li>
                                <li style="list-style-type:none">
                                    <p class="flex items-center hover:text-indigo-500 gap-2 transition duration-200 p-1">
                                    <svg xmlns="http://www.w3.org/2000/svg"
                                    class="group-hover:bg-slate-200 fill-current" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#636e72" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"></circle></svg>
                                    Bisa MengInvite Siswa Yang Diinginkan</p>
                                </li>
                                <li style="list-style-type:none">
                                    <p class="flex items-center hover:text-indigo-500 gap-2 transition duration-200 p-1">
                                    <svg xmlns="http://www.w3.org/2000/svg"
                                    class="group-hover:bg-slate-200 fill-current" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#636e72" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"></circle></svg>
                                    Forum Chat Hanya Bisa Digunakan Jika Ada Orang Yang Membuat Sebuh Grup</p>
                                </li>
                        </div>
                        <div class="px-6 py-6 flex items-center justify-center">
                            <button class="w-full p-2 text-green-200  hover:transition duration-300 bg-green-800 hover:text-white" id="blink">Forum Chat Siswa</button>
                        </div>
                    </div>
                    <div class="bg-slate-800 w-72 relative grid-cols-1">
                        <div class="flex items-center justify-center py-5 grid-cols-1">
                            <img src="../../icons/chat2.png"class="h-10 w-10 flex items center" alt="">
                        </div>
                        <div class="px-6 py-2 text-sm">
                                <li style="list-style-type:none">
                                    <p class="flex items-center hover:text-indigo-500 gap-2 transition duration-200 p-1">
                                    <svg xmlns="http://www.w3.org/2000/svg"
                                    class="group-hover:bg-slate-200 fill-current" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#636e72" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"></circle></svg>
                                    Forum Chat Semua</p>
                                </li>
                                <li style="list-style-type:none">
                                    <p class="flex items-center hover:text-indigo-500 gap-2 transition duration-200 p-1">
                                    <svg xmlns="http://www.w3.org/2000/svg"
                                    class="group-hover:bg-slate-200 fill-current" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#636e72" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"></circle></svg>
                                    Aplikasi Aktif Pada Jam Tertentu</p>
                                </li>
                                <li style="list-style-type:none">
                                    <p class="flex items-center hover:text-indigo-500 gap-2 transition duration-200 p-1">
                                    <svg xmlns="http://www.w3.org/2000/svg"
                                    class="group-hover:bg-slate-200 fill-current" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#636e72" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"></circle></svg>
                                    Bisa Diakses Oleh Semua orang. Siswa , Guru , Dll</p>
                                </li>
                                <li style="list-style-type:none">
                                    <p class="flex items-center hover:text-indigo-500 gap-2 transition duration-200 p-1">
                                    <svg xmlns="http://www.w3.org/2000/svg"
                                    class="group-hover:bg-slate-200 fill-current" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#636e72" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"></circle></svg>
                                    Jika Status Anda Bukan Siswa Maka Anda Tidak bisa Masuk</p>
                                </li>
                                <li style="list-style-type:none">
                                    <p class="flex items-center hover:text-indigo-500 gap-2 transition duration-200 p-1">
                                    <svg xmlns="http://www.w3.org/2000/svg"
                                    class="group-hover:bg-slate-200 fill-current" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#636e72" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"></circle></svg>
                                    Menggunakan Key Untuk Masuk Ke Chat</p>
                                </li>
                                <li style="list-style-type:none">
                                    <p class="flex items-center hover:text-indigo-500 gap-2 transition duration-200 p-1">
                                    <svg xmlns="http://www.w3.org/2000/svg"
                                    class="group-hover:bg-slate-200 fill-current" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#636e72" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"></circle></svg>
                                    Bisa MengInvite Semua Orang Yang Diinginkan </p>
                                </li>
                                <li style="list-style-type:none">
                                    <p class="flex items-center hover:text-indigo-500 gap-2 transition duration-200 p-1">
                                    <svg xmlns="http://www.w3.org/2000/svg"
                                    class="group-hover:bg-slate-200 fill-current" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#636e72" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"></circle></svg>
                                    Forum Chat Bisa Digunakan Jika Ada Orang Yang Membuat Sebuh Grup</p>
                                </li>
                        </div>
                        <div class="px-6 py-6 flex items-center justify-center">
                            <button class="w-full p-2 text-green-200  hover:transition duration-300 bg-green-800 hover:text-white"id="blink">Forum Chat Semua</button>
                        </div>
                    </div>
                </div>
            </div>
            
    </div>
</div>
</body>
</html> 