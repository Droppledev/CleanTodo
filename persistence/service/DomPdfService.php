<?php
namespace CleanTodo\Persistence\Service;

use CleanTodo\Domain\Service\PdfServiceInterface;
use Dompdf\Dompdf;

class DomPdfService implements PdfServiceInterface
{
    private $dompdf;
    public function __construct(Dompdf $dompdf)
    {
        $this->dompdf = $dompdf;
    }
    public function generateFromHTML($html)
    {
        $this->dompdf->loadHtml($html);
        // (Optional) Setup the paper size and orientation
        $this->dompdf->setPaper('A4');
        // Render the HTML as PDF
        $this->dompdf->render();
        // Output the generated PDF to Browser
        $this->dompdf->stream("sample");
    }
}
