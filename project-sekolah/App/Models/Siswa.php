<?php
namespace App\Models;
class siswa{
    private string $nis;
    private string $nama;
    private string $kelas;
    private string $jurusan;

    public function  __construct(string $nis, string $nama,string $kelas, string $jurusan){
     $this->nis = $nis;
     $this->nama = $nama;
     $this->kelas = $kelas;
     $this->jurusan = $jurusan;
    }

    public function getNis(): string{
        return $this->nis;
    }

     public function getNama(): string{
        return $this->nama;
    }

    public function getKelas(): string{
        return $this->kelas;
     }

     public function getJurusan(): string{
         return $this->jurusan;
     }
     
}
?>