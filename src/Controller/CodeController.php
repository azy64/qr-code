<?php

namespace App\Controller;

use App\Services\GenerateQrCode;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class CodeController extends AbstractController
{
    #[Route('/code', name: 'app_code')]
    public function index(): Response
    {
        return $this->render('code/index.html.twig', [
            'controller_name' => 'CodeController',
        ]);
    }


    #[Route('/code-generate', name: 'app_generate')]
    public function qrcode(Request $request, GenerateQrCode $generateQrCode): Response
    {
        $qrText = $request->request->get('qr-text');
        $client = $request->request->get('client');
        $date = new \DateTime();
        $namefile = $client."-".$date->getTimestamp();
       $result = $generateQrCode->generateQr($namefile, $qrText);
        return $this->render('code/qrcode.html.twig', [
            'qrCode' => $qrText, 'path'=> $result->getDataUri(),
        ]);
    }
}
