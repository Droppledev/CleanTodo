<?php
namespace CleanTodo\Domain\Service;

interface PdfServiceInterface
{
    public function generateFromHtml($html);
}
