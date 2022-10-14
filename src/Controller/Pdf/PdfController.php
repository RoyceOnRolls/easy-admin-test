<?php

namespace App\Controller\Pdf;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
// use Mpdf\Mpdf;
use Symfony\Component\HttpFoundation\Response;
use App\Entity\Product;
use App\Repository\ProductRepository;

class PdfController extends AbstractController
{
    #[Route('/pdf', name: 'app_pdf')]
    public static function getPdf()
    {
        $mpdf = new \Mpdf\Mpdf();

        // $html = $this->render('pdf/pdf.html.twig');

        $html = 'Hello King';

        $mpdf->WriteHTML($html);

        $mpdf->Output();

        // return $this->render('pdf/pdf.html.twig');
    }

    #[Route('/test', name: 'app_test-pdf')]
    public function seeContent(ProductRepository $productRepository): Response
    {
        $id = 1;

        $product = $productRepository->find($id);

        // dd($product);

        $mpdf = new \Mpdf\Mpdf();

        $header = $this->renderView('pdf/pdf-header.html.twig');
        $mpdf->SetHTMLHeader($header);

        $footer = $this->renderView('pdf/pdf-footer.html.twig');
        $mpdf->SetHTMLFooter($footer);


        $html = $this->renderView('pdf/pdf.html.twig', [
            'Product' => $product,
            'text' => 'hnaya xdadin'
        ]);

        $mpdf->WriteHTML($html);

        $mpdf->Output();

        return $this->render('pdf/pdf.html.twig' . [
            'Product' => $product,
            'text' => 'hnaya xdadin'
        ]);
    }
}
