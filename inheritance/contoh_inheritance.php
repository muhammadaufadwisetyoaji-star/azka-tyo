<?php 
 class karyawan {
    private $nama;
    protected $gajipokok;

    public function __construct($nama, $gajipokok)
    {
        $this->nama = $nama;
        $this->gajipokok = $gajipokok;
    }

    public function getNama()
    {
        return $this->nama;
    }
    public function hitungtotalgaji()
    {
        return $this->gajipokok;
    }
 }
    class manager extends karyawan {
        private $bonus;

        public function __construct($nama, $gajipokok, $bonus)
        {
            parent::__construct($nama, $gajipokok);
            $this->bonus = $bonus;
        }
        public function getBonus()
        {
            return $this->bonus;
        }
    }
    $staff = new karyawan("budi","5000000");
    $manager = new manager("joko","5700000","1000000");

    echo "nama karyawan: " .$this->getnama(). 
    " | total gaji: Rp. ". number_format($staff -> hitungtotalgaji(),0,',','.'). "<br>";

    $totalgajimanager = $manager->hitungtotalgaji() +
    $manager->getBonus();

    echo "nama manager: ". $manager->getNama().
    " | total gaji: rp. ". number_format($totalgajimanager,0,',',','). "<br>";
?>