<?php

namespace App\Jobs;

use App\Jobs\Job;
use Illuminate\Contracts\Bus\SelfHandling;

class CreatePreviewBook extends Job implements SelfHandling
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
        $this->fileName = storage_path('app/pdfs/').$bookUrl;

        $this->pdfPreview =  new \FPDI();
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

        $this->pdfPreview->setSourceFile($this->fileName);

        for($i=1;$i<=10;$i++) {

            $this->pdfPreview->AddPage();

            $this->pdfPreview->useTemplate($this->pdfPreview->importPage($i));

        }

        return $this->pdfPreview->Output();

    }
}
