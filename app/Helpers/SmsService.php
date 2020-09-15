<?php

namespace App\Helpers;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;

class SmsService implements ShouldQueue
{
    use Queueable;

    private $telListe;
    private $mesaj;

    public  function __construct($telListe = [], $mesaj)
    {
        $this->telListe = $telListe;
        $this->mesaj = $mesaj;
    }

    public function send()
    {
        $tels = "";

        foreach ($this->telListe as $t) {
            $tels .= "<YOLLA><MESAJ>";
            $tels .= $this->mesaj;
            $tels .= "</MESAJ>";
            $tels .= "<NO>";
            $tels .= $t;
            $tels .= "</NO>";
            $tels .= "</YOLLA>";
        }
        $userName = env('SMS_USER_NAME');
        $password = env('SMS_PASSWORD');
        $title = env('SMS_TITLE');

        $xml = "<SERVIS><BILGI><KULLANICI_ADI>" . $userName . "</KULLANICI_ADI><SIFRE>" . $password . "</SIFRE>" .
            "<GONDERIM_TARIH></GONDERIM_TARIH><BASLIK>" . $title . "</BASLIK><ACTION>1</ACTION></BILGI><ISLEM>" . $tels .
            "</ISLEM></SERVIS>";

        //The URL that you want to send your XML to.
        $url = env('SMS_URL');


        //setting the curl parameters.
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        // Following line is compulsary to add as it is:
        curl_setopt(
            $ch,
            CURLOPT_POSTFIELDS,
            "xml=" . $xml
        );
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 300);
        $data = curl_exec($ch);
        curl_close($ch);
        return $data;
    }
}