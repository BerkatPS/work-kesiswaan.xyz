<?php
require_once('../../connection/conf.php');
$id = $_SESSION['userId'];
$dataUser = $confg->query("SELECT tbl_absensi_siswa.id AS id_user_absensi , user.id , tbl_absensi_siswa.tanggal ,tbl_absensi_siswa.waktu, user.NIS , user.name , user.KELAS , tbl_absensi_siswa.status, tbl_absensi_siswa.poin FROM tbl_absensi_siswa JOIN user ON (tbl_absensi_siswa.id_absensi_siswa = user.id) WHERE user.id = $_SESSION[userId] ORDER BY id_user_absensi DESC");

if(!isset($_SESSION['user'])){
    header('Location: ../auth/login?act=notlogin');
    exit();
}

if(isset($_POST['submit'])){
    $judul = htmlentities(htmlspecialchars(strip_tags(stripcslashes(strtoupper(mysqli_real_escape_string($confg,$_POST['Judul']))))));
    $keterangan = htmlentities(htmlspecialchars(strip_tags(stripcslashes(strtoupper(mysqli_real_escape_string($confg,$_POST['keterangan']))))));
    $date_create = date('d F Y H:i:s');

    if($judul != '' OR $keterangan != ''){
        if($judul == 'LAPORAN BUG' OR $judul == 'SARAN'){
            $insertDevAdmin = $confg->query("INSERT INTO dev_admin(level,username,msgnotif,title,information,date_create,status) VALUES('Siswa','$_SESSION[user]','Kamu Punya $judul Dari Siswa : ','$judul','$keterangan','$date_create',0)");

            if($insertDevAdmin == TRUE){
                header('Location: Development?act=successAdd');
            }else{
                header('Location: Development?act=failAdd');
            }
        }else{
            header('Location: Development?act=notacceptible');
        }
    }else{
        header('Location: Development?act=empty');
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="stylesheet" href="../css/output.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/png" href="../../icons/world-book-day.png"/>
    <script src="../../js/timer.js"></script>
    <link rel="stylesheet" type="text/css" href="../../admin/css/dataTable.css">
    <link rel="stylesheet" href="../../assets/blink.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script type="text/javascript" charset="utf8"
    src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.js"></script>
    <script src="../../js/sideToggle.js"></script>
    <?php require '../../assets/header.php';?>
    <title>APP KESISWAAN - DEVELOPMENT</title>
</head>
<body class="bg-slate-900 overflow-x-hidden " onload="startTime();">
<div class="md:flex md:flex-row ">
        <!-- Mobile Menu -->
        <div class="bg-slate-800 w-72 text-purple-600 font-mono focus:outline-none z-20 px-6 py-9 absolute inset-y-0 left-0 transform -translate-x-full transition duration-500 ease-in-out lg:relative lg:translate-x-0" id="sidebar">
            <button href="" title="meta icons" class="font-extrabold text-2xl text-indigo-500 flex items-center space-x-2">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M12.316 3.051a1 1 0 01.633 1.265l-4 12a1 1 0 11-1.898-.632l4-12a1 1 0 011.265-.633zM5.707 6.293a1 1 0 010 1.414L3.414 10l2.293 2.293a1 1 0 11-1.414 1.414l-3-3a1 1 0 010-1.414l3-3a1 1 0 011.414 0zm8.586 0a1 1 0 011.414 0l3 3a1 1 0 010 1.414l-3  3a1 1 0 11-1.414-1.414L16.586 10l-2.293-2.293a1 1 0 010-1.414z" cli p-rule="evenodd" />
                </svg>
             <span class="">Kesiswaan</span>
             </button>
             <nav class="text-slate-400 min-h-screen overflow-y-hidden font-mono text-[1.3rem] relative pt-7 gap-3 text-sm md:text-lg">
                <a href="../" class="flex items-center gap-2 text-zinc-300 py-2 px-3 my-5 hover:bg-indigo-500 rounded-md transition duration-200">
                    <div class="flex items-center">
                        <img src="../../icons/layout.png" class="h-6 w-6"alt="">
                    </div>
                Dashboard
                </a>
                <a href="../components/absensi" class="flex items-center text-zinc-300 gap-2 py-2 px-3 my-5 hover:bg-indigo-500 rounded-md transition duration-200">
                    <img src="../../icons/calendar.png" class="h-6 w-6" alt="" srcset="">
                Absensi
                <p class="text-base ml-8 p-1 px-2 bg-red-600 text-slate-300 rounded-lg" id="blink">New</p>
                </a>
                <a href="../components/laporan" class="flex items-center text-zinc-300 gap-2 py-2 px-3 my-5 hover:bg-indigo-500 rounded-md transition duration-200">
                    <img src="../../icons/report.png" class="h-6 w-6" alt=""> 
                Laporan
                <p class="text-base ml-8 p-1 px-2 bg-red-600 text-slate-300 rounded-lg" id="blink">New</p>
                </a>
                <a href="../pages/user" class="flex items-center gap-2 text-zinc-300 py-2 px-3 my-5 hover:bg-indigo-500 rounded-md transition duration-200 ">
                    <img src="../../icons/user.png" class="h-6 w-6" alt="">
                User Profile
                </a>
                <a href="../components/mata-pelajaran" class="flex items-center gap-2 text-zinc-300 py-2 px-3 my-5 hover:bg-indigo-500 rounded-md transition duration-200 ">
                    <img src="../../icons/online-learning.png" class="h-6 w-6" alt="">
                Pelajaran
                </a>
                <a href="../pages/semester" class="flex items-center gap-2 text-zinc-300 py-2 px-3 my-5 hover:bg-indigo-500 rounded-md transition duration-200 ">
                    <img src="../../icons/statistics.png" class="h-7 w-7" alt="">
                Semester
                </a>
                <a href="../components/forum-chat" class="flex items-center text-zinc-300 gap-2 py-2 px-3 my-5 hover:bg-indigo-500 rounded-md transition duration-200">
                    <img src="../../icons/chat.png" alt="" class="h-6 w-6" srcset="">
                Forum Chat
                </a>
                <a href="../pages/ekstrakurikuler" class="flex items-center text-zinc-300 gap-2 py-2 px-3 my-5 hover:bg-indigo-500 rounded-md transition duration-200">
                    <img src="../../icons/mental-health.png" alt="" class="h-6 w-6" srcset="">
                Eskul
                <p class="text-base ml-12 p-1 px-2 bg-red-600 text-slate-300 rounded-lg" id="blink">New</p>
                </a>
                <a href="./Development" class="flex items-center text-zinc-300 gap-2 py-2 px-3 my-5 bg-slate-900 rounded-md transition duration-200">
                    <img src="../../icons/software-development.png" alt="" class="h-6 w-6" srcset="">
                Development
                </a>
                <a href="../history" class="flex items-center text-zinc-300 gap-2 py-2 px-3 my-5 hover:bg-indigo-500 rounded-md transition duration-200">
                    <img src="../../icons/history.png" alt="" class="h-6 w-6" srcset="">
                History
                </a>
                <a href="../components/terms" class="flex items-center text-zinc-300 gap-2 py-2 px-3 my-5 hover:bg-indigo-500 rounded-md transition duration-200">
                    <img src="../../icons/audit.png" alt="Terms" class="h-6 w-6" srcset="">
                Ketentuan
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
                    <div class="relative cursor-pointer" x-data="{ isOpen : false }">
                            <button
                            @click= "isOpen = !isOpen"
                            class=""
                            >
                                <div class="absolute flex items-center justify-center top-0 right-0 h-5 w-5 bg-red-700 rounded-full md:ml-2">
                                    <?php $query = $confg->query("SELECT * FROM history_siswa WHERE id_siswa = $_SESSION[userId] OR id_kelas = '$_SESSION[kelas]' AND action = 'MATA PELAJARAN' OR action = 'STATUS PELAJARAN' OR action = 'PENGUMUMAN' ORDER BY id DESC")?>
                                    <span class="flex pb-1 sm:pt-1 text-sm text-slate-300" id="notif-number"><?= mysqli_num_rows($query)?></span>
                                </div>
                                <img src="../../icons/notification-bell.png" class="h-8 w-9 ml-5" alt="" srcset="">
                            </button>
                            </script>
                            <ul
                            x-show="isOpen"
                            @click.away="isOpen = false"
                            x-transition:enter="transition ease-out duration-200" x-transition:enter-start="transform opacity-0 scale-95" x-transition:enter-end="transform opacity-100 scale-100" x-transition:leave="transition ease-in duration-200" x-transition:leave-start="transform opacity-100 scale-100" x-transition:leave-end="transform opacity-0 scale-95"
                            class="absolute overflow-hidden rounded-md font-normal right-none md:right-5 z-10 w-72 bg-slate-800 shadow-lg text-zinc-400 shadow-black gap-2">
                                <span class="px-4 py-4 text-sm">Notification</span>
                                <?php
                                $sql = "SELECT * FROM history_siswa WHERE id_siswa = $_SESSION[userId] OR id_kelas = '$_SESSION[kelas]' AND action = 'MATA PELAJARAN' OR action = 'STATUS PELAJARAN' OR action = 'PENGUMUMAN' ORDER BY id DESC LIMIT 5";
                                $query = $confg->query($sql);
                                while($row_history = mysqli_fetch_assoc($query)){
                                ?>
                                <li class="font-sans text-sm relative hover:bg-slate-900">
                                
                                    <a href="../history" class="hover:bg-slate-900">
                                        <div class="px-3 py-3  font-medium relative flex justify-center items-center gap-3">
                                            <a class='text-base'><?= $row_history['msgnotif']?><span class="text-red-600 font-semibold"><?= $row_history['username'] ?></span></a>
                                            <span class="absolute pt-12 text-sm right-0"><?= $row_history['date_create'] ?></span>
                                        </div>
                                    </a>
                                </li>
                            <?php } ?>
                            </ul>
                        </div>    
                        <div class="flex justify-start items-start content-start">
                            <?php 
                            $cekSiswaOnline = $confg->query("SELECT * FROM user WHERE status = 'Online'");
                            $countSiswaOnline = mysqli_num_rows($cekSiswaOnline)
                            ?>
                            <span class="p-1 hidden md:flex border-green-500 border-[0.5px] text-green-500">Siswa Online : <?= $countSiswaOnline ?></span>
                        </div>
                        <div class="relative">
                        <span id="ct" class="p-1 flex  border-green-500 border-[0.5px] text-green-500"></span>
                        </div>
                        <div class="relative" x-data="{ isOpen : false }">
                            <button
                            @click= "isOpen = !isOpen"
                            class="flex items-center pb-2 focus:outline-none ">
                                <div class="gap-3 relative flex md:text-base">
                                    <span class="flex space-y-2 text-slate-300 text-sm md:text-lg"><?= strtoupper($_SESSION['user']) .'&nbsp&nbsp'. strtoupper($_SESSION['kelas']);?> </span> 
                                   <span class="absolute pt-5 pl-1 text-xs md:text-sm items-center text-slate-300">Siswa</span>
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
                                            <a href="../pages/user" class="hover:bg-blue-600 hover:text-white hover:transition duration-200 flex items-center px-4 py-3 gap-2">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                                    <path fill-rule="evenodd" d="M11.49 3.17c-.38-1.56-2.6-1.56-2.98 0a1.532 1.532 0 01-2.286.948c-1.372-.836-2.942.734-2.106 2.106.54.886.061 2.042-.947 2.287-1.561.379-1.561 2.6 0 2.978a1.532 1.532 0 01.947 2.287c-.836 1.372.734 2.942 2.106 2.106a1.532 1.532 0 012.287.947c.379 1.561 2.6 1.561 2.978 0a1.533 1.533 0 012.287-.947c1.372.836 2.942-.734 2.106-2.106a1.533 1.533 0 01.947-2.287c1.561-.379 1.561-2.6 0-2.978a1.532 1.532 0 01-.947-2.287c.836-1.372-.734-2.942-2.106-2.106a1.532 1.532 0 01-2.287-.947zM10 13a3 3 0 100-6 3 3 0 000 6z" clip-rule="evenodd" />
                                                </svg>Settings</a>
                                            <a href="../pages/user"class="hover:bg-blue-600 hover:text-white hover:transition duration-200 flex items-center px-4 py-3 gap-2">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                                </svg>Account</a>
                                            <a href="../../auth/logout" class="hover:bg-blue-600 hover:text-white hover:transition duration-200 flex items-center px-4 py-3 gap-2">
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
                <div class="py-2"></div>
                <div class="py-3">
                    <form action="" class="bg-slate-800 grid grid-cols-1 p-5 py-6 gap-y-12 gap-x-5 mi-h-full relative" method="POST">
                        <h2 class="font-bold text-2xl flex items-center sm:text-xl"><a class="bg-red-600 p-2 font-normal cursor-pointer text-white text-sm focus:outline-none flex items-center justify-center gap-2 rounded-md" onclick="window.location.href= '../'"><svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                        </svg>Kembali Ke Dashboard</a>&nbspFORM LAPOR BUG ATAU MENYAMPAIKAN SARAN PENGEMBANGAN WEBSITE</h2>

                        <?php 
                    if(isset($_GET['act'])){
                        if($_GET['act'] == "successAdd"){
                    ?>
                        <div class='w-full p-4 mb-4 text-base text-center flex justify-center bg-green-800 text-green-400 rounded-lg' role='alert' id="success">
                            
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-center" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
                        </svg><span class='font-bold'>&nbspSUCCESS MEMBUAT LAPORAN ATAU SARAN PENGEMBENGAN WEBSITE &nbspAnda Akan Diarahkan ke DASHBOARD&nbsp</span>
                        <span class="flex items-center" id='waktu'>3</span>
                        <script type="text/javascript">
                            var waktu = 3;
                            setInterval(function() {
                            waktu--;
                            if(waktu < 0) {
                                document.getElementById("success").innerHTML = 'Redirecting...';
                                window.location = '../';
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
                            <span class='font-bold'>&nbspMAAF DATA ANDA TIDAK BOLEH KOSONG</span>
                            </div>
                        <?php
                        }else if($_GET['act'] == "notacceptible"){
                            ?>
                                <div class='w-full p-4 mb-4 text-base text-center flex justify-center bg-red-600 text-white rounded-lg' role='alert' id="gagal">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-center" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
                                </svg>
                                <span class='font-bold'>&nbspMAAF JUDUL ANDA TIDAK DITERIMA SILAHKAN PILIH JUDUL YANG SESUAI</span>
                                </div>
                            <?php
                            }else if($_GET['act'] == "failAdd"){
                            ?>
                                <div class='w-full p-4 mb-4 text-base text-center flex justify-center bg-red-600 text-white rounded-lg' role='alert' id="gagal">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-center" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
                                </svg>
                                <span class='font-bold'>&nbspMAAF GAGAL MEMBUAT LAPORAN ATAU SARAN PENGEMBENGAN WEBSITE</span>
                                </div>
                            <?php
                            }
                        }
                        ?>
                            <h5 class="text-red-600">*Catatan
                            <P>Pilih Judul = <span class="font-bold">LAPORAN BUG</span> , Jika Ada Bug Atau Masalah Dalam WEBSITE <br>
                               Pilih Judul = <span class="font-bold">SARAN</span>, Jika Anda Ingin Menyampaikan Saran Sebuah Teknologi Baru, Atau Saran Fitur Baru Kepada Admin <br>
                            </P>
                            </h5>
                        <div class="relative">
                            <label for="">Judul</label>
                            <textarea name="Judul" id="Judul" class="absolute flex items-center p-2 w-full bg-transparent border border-gray-600 text-left text-zinc-400 focus:outline-none focus:border-indigo-500 transform translate duration-500" placeholder="Masukkan Judul">
                            </textarea>
                        </div>
                        <div class="py-1"></div>
                        <div class="relative ">
                            <label for="">KETERANGAN</label>
                            <textarea name="keterangan" id="keterangan" class="absolute flex items-center p-2 w-full bg-transparent border border-gray-600 text-left text-zinc-400 focus:outline-none focus:border-indigo-500 transform translate duration-500" placeholder="Masukkan Keterangan">
                            </textarea>
                        </div>
                        <div class=""></div>
                            <button type="submit" name="submit" class="bg-blue-dark text-blue-600 p-2 hover:bg-blue-600 hover:text-white hover:transform duration-300">Simpan Data</button>
                    </form>
                </div>
            </div>
    </div>
<script>
$(document).ready(function(){
$('#example').DataTable({
    autoFill: true
});
})

</script>
</body>
</html>