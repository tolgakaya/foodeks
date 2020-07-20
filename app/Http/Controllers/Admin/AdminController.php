<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AdminController extends Controller
{
    public function index()
    {
        return  view('backend.blank');
    }

    public function nida()
    {
        $tels = "";
        $mesaj = "Selam";
        $tel_liste = ['05069468693'];
        foreach ($tel_liste as $t) {
            $tels .= "<YOLLA><MESAJ>";
            $tels .= $mesaj;
            $tels .= "</MESAJ>";
            $tels .= "<NO>";
            $tels .= $t;
            $tels .= "</NO>";
            $tels .= "</YOLLA>";
        }
        $xml = "<SERVIS><BILGI><KULLANICI_ADI>814K</KULLANICI_ADI><SIFRE>z9zsaeoJ</SIFRE>" .
            "<GONDERIM_TARIH></GONDERIM_TARIH><BASLIK>TOLINTERNET</BASLIK><ACTION>1</ACTION></BILGI><ISLEM>" . $tels .
            "</ISLEM></SERVIS>";

        //The URL that you want to send your XML to.
        $url = 'http://www.nidamesaj.com/smsapi_post.php';


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