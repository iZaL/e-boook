<?php namespace App\Listeners;

use App\Events\BookPublished;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Knp\Snappy\Pdf;

class CreatePdf implements ShouldQueue
{

    private $pdf;

    private $uploadPath;

    /**
     * Create the event listener.
     *
     */
    public function __construct()
    {
        $this->pdf = new Pdf(base_path('vendor/h4cc/wkhtmltopdf-amd64/bin/wkhtmltopdf-amd64'));
        $this->uploadPath = base_path('storage/app/pdfs/');
    }

    /**
     * Handle the event.
     *
     * @param  BookPublished $event
     * @return void
     */
    public function handle(BookPublished $event)
    {
        // create PDF
        $this->pdf->generateFromHtml($event->book->body, $this->uploadPath . $event->book->url);

        return true;
    }

}
