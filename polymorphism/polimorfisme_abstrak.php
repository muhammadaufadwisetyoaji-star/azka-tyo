<?php
abstract class notifikasiWeb{
    protected string $penerima;
    protected string $pesan;

    public function __construct(string $penerima,string $pesan)
    {
        $this->penerima = $penerima;
        $this->pesan = $pesan;
    }

    public function getInfoPengiriman():string{
        return "mengirim ke: {$this->penerima}";
    }
    abstract public function kirimNotifikasi():void;
}
class notifEmail extends notifikasiWeb{
    private string $subjek;
   public function __construct(string $penerima,string $pesan,string $subjek){
    parent::__construct($penerima,$pesan);
    $this->subjek = $subjek;
   }

   
   public function kirimNotifikasi(): void
   {
    echo "<div style='border: 2px solid #007bff;
    padding: 10px;
    margin-bottom: 10px;
    bacground-color: #f8f9fa;
    '>";

    echo "<h4>[email] - subjek: {$this->subjek}</h4>";
    echo "<p>{$this->getInfoPengiriman()}</p>";
    echo "<p>isimpesan: <i><{$this->pesan}</i></p>";
    echo "</div>";
    }

}
class notifwA extends notifikasiWeb {
    public function kirimNotifikasi(): void
    {
     echo "<div style='border:2px solid #28a745;padding:10px;margin-bottom:10px;background-color:#e8f5e9;'>";
     echo "<h4>[whatsapp message]</h4>";
     echo "<p>{$this->getInfoPengiriman()}</p>";
     echo "<p>pesan:<i>{$this->pesan}</i></p>";
     echo "</div>";   
    }
}
class notifikasiBrowswer extends notifikasiWeb{
        private string $browserApp;

        public function __construct(string $penerima,string $pesan,string $browserApp){
            parent::__construct($penerima,$pesan);
            $this->browserApp = $browserApp;
        }

        public function kirimNotifikasi(): void
        {
            echo "<div style='border:2px solid #ffc107;padding:10px;margin-bottom:10px;background-color:#ff3cd;'>";
     echo "<h4>[PUSH NOTIF] - Browser: {$this->browserApp}</h4>";
     echo "<p>{$this->getInfoPengiriman()}</p>";
     echo "<p?>notif:<i>{$this->pesan}</i></p>";
     echo "</div>";
        }
}
class notifmanager {

public static function proseskirim(notifikasiWeb $notif): void{
    $notif->kirimNotifikasi();
}
}

class notifGithub extends notifikasiWeb{
    private string $username;
    public function __construct(string $nama,$pesan,$username){
        parent::__construct($nama,$pesan);
        $this->username = $username;
    }
    public function kirimNotifikasi(): void
        {
            echo "<div style='border:2px solid #2f1f5a;padding:10px;margin-bottom:10px;background-color:#ff3cd;'>";
     echo "<h4>[PUSH NOTIF] - Github: {$this->username}</h4>";
     echo "<p>{$this->getInfoPengiriman()}</p>";
     echo "<p?>notif:<i>{$this->pesan}</i></p>";
     echo "</div>";
        }
}
echo "<h2>dashboard simulasi pengirim web</h2>";

$notif1 = new notifEmail("amba@gmail.com","akun anda berhasil didaftarkan.","konfirmasi akun");
$notif2 = new notifwA("885877846734", "kode OTP anda adalah 970", "jangan berikan kesiapapun!");
$notif3 = new notifikasiBrowswer("token_device_asus", "ada diskon 40% untuk produk pilihan anda!","google crome");
$notif4 =  new notifGithub("ababil@github.com","gabung github collab!","ababil-hacker");

notifmanager::proseskirim($notif1);
notifmanager::proseskirim($notif2);
notifmanager::proseskirim($notif3);
notifmanager::proseskirim($notif4);