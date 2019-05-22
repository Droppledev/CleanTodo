<?php
namespace CleanTodo\Domain\UseCase;

use CleanTodo\Domain\Service\PdfServiceInterface;

class GeneratePdfUseCase
{
    private $pdf;
    public function __construct(PdfServiceInterface $pdf)
    {
        $this->pdf = $pdf;
    }
    public function generatePdf($todos)
    {
        $html = $this->generateHtml($todos);
        $this->generateFromHtml($html);
    }
    private function generateFromHtml($html)
    {
        $this->pdf->generateFromHtml($html);
    }
    private function generateHtml($todos)
    {
        $i = 1;
        $html = <<<ENDHTML
<table border="1" cellpadding="2" cellspacing="3">
<thead>
    <tr>
    <th>No</th>
    <th>Title</th>
    <th>Detail</th>
    <th>Priority</th>
    <th>Status</th>
    <th>Date Start</th>
    <th>Date End</th>
    </tr>
</thead>
<tbody>
ENDHTML;

        foreach ($todos as $todo) {
            $html .= "
    <tr>
    <td> " . $i++ . " </td>
    <td> " . $todo->getTitle() . " </td>
    <td> " . $todo->getDetail()->getDetail() . " </td>
    <td> " . $todo->getPriority()->getPriority() . " </td>
    <td> " . $todo->getStatus()->getStatus() . " </td>
    <td> " . $todo->getDateStart() . " </td>
    <td> " . $todo->getDateEnd() . " </td>
    </tr>
    ";
        }
        $html .= <<<ENDHTML
</tbody>
</table>
ENDHTML;
        return $html;
    }
}
