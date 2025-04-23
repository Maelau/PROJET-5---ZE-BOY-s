<?php
// src/Service/PdfGenerator.php

namespace App\Service;

use Dompdf\Dompdf;
use Dompdf\Options;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class PdfGenerator
{
    private $twig;
    
    public function __construct(\Twig\Environment $twig)
    {
        $this->twig = $twig;
    }

    public function generateLigneFacturePdf($ligneFactures)
    {
    
        $options = new Options();
        $options->set('isHtml5ParserEnabled', true);
        $options->set('isPhpEnabled', true); 
        $pdf = new Dompdf($options);


        $html = $this->renderView('pdf/ligne_factures.html.twig', [
            'ligneFactures' => $ligneFactures,
        ]);

        $pdf->loadHtml($html);

        
        $pdf->setPaper('A4', 'landscape'); 

        $pdf->render();


        return $pdf->output();
    }

    private function renderView($template, $params)
    {
        return $this->twig->render($template, $params);
    }
}
