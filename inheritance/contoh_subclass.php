<?php
require "contoh_superclass.php";

class siswa extends person{
    private string $nisn;

    #[override]
    public function __construct(string $nama, string $alamat,string $nisn){
        parent::__construct($nama,$alamat);
        $this->nisn = $nisn;
    }
    public function belajar(): void{
        echo "siswa bernama : " .$this->getnama() 
        ."sedang belajar mata pelajaran RPL.<br>";
    }
}
$siswa1 = new siswa("ahmad dani","kendal","12345");
$siswa1->tampilkanInfo();
$siswa1->belajar();
?>
