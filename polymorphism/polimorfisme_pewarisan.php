<?php
class pegawai{
    protected $nama_pegawai;
    protected $gaji_pegawai;

    public function __construct($nama_pegawai,$gaji_pegawai){
        $this->nama_pegawai = $nama_pegawai;
        $this->gaji_pegawai = $gaji_pegawai;
    }
    public function getNama(){
        return $this->nama_pegawai;
    }
    public function hitungGaji(){
        return $this->gaji_pegawai;
    }
}

class freelancer extends pegawai{
    private $projectRate;
    private $jumlahProject;

    public function __construct($nama_pegawai,$projectRate,$jumlahProject){
        parent::__construct($nama_pegawai,0);
        $this->projectRate  = $projectRate;
        $this->jumlahProject = $jumlahProject;
    }
    public function hitungGaji(){
        return $this->projectRate * $this->jumlahProject;
    }
}

class karyawanTetap extends pegawai{
    private $tunjangan;
    public function __construct($nama_pegawai,$gaji_pegawai,$tunjangan){
        parent::__construct($nama_pegawai,$gaji_pegawai);
        $this->tunjangan = $tunjangan;
    }

    public function hitungGaji(){
        return parent::hitungGaji() + $this->tunjangan;
    }
}

function cetakGaji(pegawai $pegawai){
    echo "Gaji ". $pegawai->getNama().": Rp".number_format($pegawai->hitungGaji(),0,',','.')."<br>";
}

$pegawaiBiasa = new pegawai(" mas fuad",5000000);
$pegawaiFreeelancer = new freelancer("mas rusdi",1000000,3);
$pegawaiTetap = new karyawanTetap("mas amba",10000000,3000000);

cetakGaji($pegawaiBiasa);
cetakGaji($pegawaiFreeelancer);
cetakGaji($pegawaiTetap);
?>