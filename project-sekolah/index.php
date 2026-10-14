<?php
use App\Models\Siswa;
use App\Controllers\siswaController;
//use App\Models\siswa as ModelsSiswa;

require_once 'App/Models/Siswa.php';
require_once 'App/Controllers/siswaController.php';

echo "<h1>sistem informasi sekolah -  smk texmaco semarang";
echo "<hr>";

$controller = new siswaController();
$controller->prosesData("25701","siti kusmini","XI","rekayasa perangkat lunak");
echo"<br>";
$controller->prosesData("6437","azka f a", "XI","RPL");
echo"<br>";
$controller->prosesdata("546737","m aufa","XI","RPL");

echo "<br><hr>";

$siswa1 = new siswa("145678","bowo","XI","teknik mesin");
echo "nis: ".$siswa1->getnis(). "<br>";
echo "nama: ".$siswa1->getnama(). "<br>";
echo "kelas: ".$siswa1->getkelas(). "<br>";
echo "jurusan: ".$siswa1->getjurusan();


?>