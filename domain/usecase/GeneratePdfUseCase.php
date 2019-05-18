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
    public function generateFromHtml($html)
    {
        $this->pdf->generateFromHtml($html);
    }
    public function generateHtml($todos)
    {
        $i = 1;
        $html = <<<ENDHTML
<table width="300" border="1" cellpadding="2" cellspacing="3">
<thead>
    <tr>
    <th>No</th>
    <th>Todo</th>
    </tr>
</thead>
<tbody>
ENDHTML;

        foreach ($todos as $todo) {
            $html .= "
    <tr>
    <td> " . $i++ . " </td>
    <td> " . $todo->getTitle() . " </td>
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
