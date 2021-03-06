<?php namespace App\Listeners;

use App\Events\BookPublished;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Session;
use Knp\Snappy\Pdf;


class CalculateBookPage implements ShouldQueue
{

    private $uploadPath;

    /**
     * Create the event listener.
     *
     */
    public function __construct()
    {
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

        $fpdi = new \FPDI();

        // count the book page
        $pageCount = $fpdi->setSourceFile($this->uploadPath.$event->book->url);

        // update the database with total page count
        $event->book->meta->total_pages = $pageCount;
        $event->book->meta->save();

//        Session::put('total_pages',$pageCount);
    }

}
