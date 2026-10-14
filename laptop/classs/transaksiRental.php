<?php
class rental {
    private $namaPenyewa;
    private $jenisLaptop;
    private $lamaSewa;
    private $keterlambatan;
    private $addOns = [];
    private $tarif = 50000;
    private $denda = 20000;

    public function __construct($nam, $jenis, $lama, $keterlambatan, $add) {
        $this->namaPenyewa = $nam;
        $this->jenisLaptop = $jenis;
        $this->setLamaSewa($lama);
        $this->keterlambatan = $keterlambatan;
        $this->addOns = $add;
    }

    public function setLamaSewa($lama) {
        if ($lama <= 0) {
            die("lama sewa minimal 1 hari!");
        }
        $this->lamaSewa = $lama;
    }

    public function hitungBiayaAddons() {
        $biaya = 0;
        if (in_array("mouse", $this->addOns)) {
            $biaya += 5000 * $this->lamaSewa;
        }
        if (in_array("tas", $this->addOns)) {
            $biaya += 10000 * $this->lamaSewa;
        }
        return $biaya;
    }

    public function hitungSubTotal() {
        return ($this->tarif * $this->lamaSewa) + $this->hitungBiayaAddons();
    }

    public function hitungDiskon() {
        $subtotal = $this->hitungSubTotal();
        if ($this->lamaSewa >= 5) {
            return $subtotal * 0.10;
        } else {
            return 0;
        }
    }

    public function hitungDenda() {
        if ($this->keterlambatan > 0) {
            return $this->keterlambatan * $this->denda;
        } else {
            return 0;
        }
    }

    public function hitungTotalBayar() {
        return ($this->hitungSubTotal() - $this->hitungDiskon()) + $this->hitungDenda();
    }
}
?>
