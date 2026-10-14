<?php
 interface cetaktable{
 public function tampilkancetak(): void;
 }
 class laporansiswa implements cetaktable{
   private string $namasiswa;
   private string $kelas;

    public function __construct(string $nama, string $kelas){
            $this->namasiswa = $nama;
            $this->kelas = $kelas;
    }
    public function tampilkancetak(): void{
            echo "<div style='
            border : 1px solid green;
            padding:10px;
            margin-bottom:10px;>";
            echo "<h3> cetak dokumen: rapor siswa <h3>";
            echo "nama : {$this->namasiswa} | kelas: {$this->kelas}";
            echo"</div>";
        }
 }
class laporanGuru implements cetaktable{
    private string $namaGuru;
    private string $mataPelajaran;

    public function __construct(string $nama,string $mapel){
        $this->namaGuru = $nama;
        $this->mataPelajaran = $mapel;
    }

    public function tampilkancetak(): void{
        echo "<div style='
            border : 1px solid green;
            padding:10px;
            margin-bottom:10px;>";
            echo "<h3> cetak dokumen: jadwal/data guru <h3>";
            echo "nama : {$this->namaGuru} | mata pelajaran: {$this->mataPelajaran}";
            echo"</div>";
    }
}
class cetakmanager{
    public static function prosesCetak(cetaktable $dokumen):void{
        $dokumen->tampilkanCetak();
    }
}
echo "<h2>daftar cetak dokumen sekolah </h2>";

$siswa1 = new laporansiswa("windah batubara","XI RPL 2");
$siswa2 = new laporansiswa("cou kho wie","XI RPL 1");
$siswa3 = new laporansiswa("azka faadhilla azhar","XI RPL 1");
$siswa4 = new laporansiswa("m.aufa dwi setyo aji","XI RPL 1");

$guru1 = new laporanGuru("pak jerry, s.pd","matematika");
$guru2 = new laporanGuru("'pak galih haris fauzi,","produktif rpl");
cetakmanager::prosesCetak($siswa1);
cetakmanager::prosesCetak($siswa2);
cetakmanager::prosesCetak($siswa3);
cetakmanager::prosesCetak($siswa4);
cetakmanager::prosesCetak($guru1);
cetakmanager::prosesCetak($guru2);
?>