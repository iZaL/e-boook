<?php

namespace App\Jobs;

use App\Jobs\Job;
use Illuminate\Contracts\Bus\SelfHandling;

class CreateBookPreview extends Job implements SelfHandling
{
    public $fileName;
    public $pdfPreview;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($bookUrl)
    {
        $this->fileName = storage_path('app/pdfs/') . $bookUrl;

        $this->pdfPreview = new \FPDI();
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        /*
         * Steps to split a pdf
         * */

        $totalPageNumber = $this->pdfPreview->setSourceFile($this->fileName);

        // check the total pages of each book

        // if preview is in free mode then
        /*
         * free books
         * */
        if ($totalPageNumber >= 10) {
            for ($i = 1; $i <= 10; $i++) {

                $this->addPages($i);

            }
        } else {
            for ($i = 1; $i <= $totalPageNumber; $i++) {

                $this->addPages($i);

            }
        }

        return $this->pdfPreview->Output();

    }

    /**
     * @param $pageNumber
     */
    public function addPages($pageNumber)
    {
        $this->pdfPreview->AddPage($pageNumber);

        $this->pdfPreview->useTemplate($this->pdfPreview->importPage($pageNumber));
    }
}
