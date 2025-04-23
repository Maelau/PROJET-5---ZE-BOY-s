<?php
// src/Controller/LigneFactureControllerV2.php

namespace App\Controller;

use App\Entity\Lignefacture;
use App\Form\LigneFactureType;
use App\Repository\LignefactureRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class LigneFactureControllerV2 extends AbstractController
{
    #[Route('/lignefacture', name: 'app_lignefacture_index')]
    public function index(LignefactureRepository $lignefactureRepository): Response
    {
        return $this->render('ligne_facture/index.html.twig', [
            'lignefactures' => $lignefactureRepository->findAll(),
        ]);
    }

    #[Route('/lignefacture/new', name: 'app_lignefacture_new', methods: ['GET', 'POST'])]
    public function new(Request $request, LignefactureRepository $lignefactureRepository): Response
    {
        $ligneFacture = new Lignefacture();
        $form = $this->createForm(LigneFactureType::class, $ligneFacture);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $lignefactureRepository->save($ligneFacture, true);
            return $this->redirectToRoute('app_lignefacture_index');
        }

        return $this->render('ligne_facture/new.html.twig', [
            'lignefacture' => $ligneFacture,
            'form' => $form->createView(),        
        ]);
    }
    #[Route('/lignefacture/pdf', name: 'app_lignefacture_pdf')]
    public function generatePdf(LignefactureRepository $lignefactureRepository, PdfGenerator $pdfGenerator): Response
    {
        $ligneFactures = $lignefactureRepository->findAll();

        $pdfContent = $pdfGenerator->generatePdf('pdf/ligne_factures.html.twig', [
            'ligneFactures' => $ligneFactures,
        ]);

        return new Response($pdfContent, 200, [
            'Content-Type' => 'application/pdf',
            'Content-Disposition' => 'inline; filename="ligne_factures.pdf"',
        ]);
    }
}
