<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class LoadController extends AbstractController
{
    #[Route('/load', name: 'app_load')]
    public function index(): Response
    {
        // https://export.admitad.com/by/webmaster/websites/2471085/coupons/export/?website=2471085&region=BY&language=&advcampaigns=26293&advcampaigns=12211&advcampaigns=21749&advcampaigns=25179&advcampaigns=23094&advcampaigns=22850&advcampaigns=16214&advcampaigns=21679&advcampaigns=26618&advcampaigns=19156&advcampaigns=27598&advcampaigns=35319&advcampaigns=23501&advcampaigns=6425&advcampaigns=14359&advcampaigns=29488&keyword=&code=c5klj20bjk&user=vipos&format=xml&v=1
        $url = 'https://export.admitad.com/by/webmaster/websites/2471085/coupons/export/?website=2471085&region=BY&language=&advcampaigns=26293&advcampaigns=12211&advcampaigns=21749&advcampaigns=25179&advcampaigns=23094&advcampaigns=22850&advcampaigns=16214&advcampaigns=21679&advcampaigns=26618&advcampaigns=19156&advcampaigns=27598&advcampaigns=35319&advcampaigns=23501&advcampaigns=6425&advcampaigns=14359&advcampaigns=29488&keyword=&code=c5klj20bjk&user=vipos&format=xml&v=1';

        define('BASEPATH', str_replace('\\', '/', dirname(__FILE__)) . '/'); # путь до каталога с исполняемым файлом
        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, $url); # файл, который надо получить с удаленного сервера
        curl_setopt($ch, CURLOPT_TIMEOUT, 300);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

        $st = curl_exec($ch);
        $fd = @fopen(BASEPATH . '/cupons.xml', "w"); # название файла на этом сервере
        fwrite($fd, $st);
        @fclose($fd);
        echo 'XML выгрузка с купонами получена и загружена на сайт';
        curl_close($ch);
        return $this->render('load/index.html.twig', [
            'controller_name' => 'LoadController',
        ]);
    }
}
