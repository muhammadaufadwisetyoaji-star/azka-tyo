<?php
namespace App\Controllers;

use App\Models\siswa;

class siswaController {
    public function prosesdata(string $nis,string $nama, string $kelas, string $jurusan): void{
        //return "memproses data kontroller siswa.";
        $siswa1 = new siswa($nis,$nama,$kelas,$jurusan);
        echo "<div style='border:2px solid #007bff;padding:15px;font-family:sans-serif;background-color:#f8f9fa;border-radius:10px'>";

        echo "<h3 style='color:#007bff;margin-top:0;'>
        data profil siswa (via controller) </h3>";

        echo "<b>NIS:</b>{$siswa1->getNis()}<br>";
        echo "<b>NAMA:</b>{$siswa1->getNama()}<br>";
        echo "<b>KELAS:</b>{$siswa1->getKelas()}<br>";
        echo "<b>JURUSAN:</b>{$siswa1->getJurusan()}<br>";
        echo "</div>";

    }
}
?>