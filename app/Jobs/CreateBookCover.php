<?php

namespace App\Jobs;

use Illuminate\Contracts\Bus\SelfHandling;
use Illuminate\Support\Str;
use Intervention\Image\ImageManagerStatic as Image;
use App\Src\Book\Book;

class CreateBookCover extends Job implements SelfHandling
{
    public $book;
    public $request;


    /**
     * Create a new job instance.
     *
     * @param Book $book
     * @param $request
     */
    public function __construct(Book $book, $request)
    {
        $this->book = $book;
        $this->request = $request;
        // good size is 600 * 400

    }

    /**
     * Execute the job.
     *
     * @param Image $cover
     */
    public function handle(Image $cover)
    {
        // check the array of covers for cover_ar and cover_en
        // creating array
        // creating the covers
        $covers = [];
        if (!is_null($this->request->file('cover_ar'))) {
            $covers = array_add($covers, 0, 'cover_ar');
        }
        if (!is_null($this->request->file('cover_en'))) {
            $covers = array_add($covers, 1, 'cover_en');
        }
        //$covers = ['cover_ar','cover_en'];
        foreach ($covers as $coverImage) {
            $fileName = $this->request->file($coverImage)->getClientOriginalName();
            $fileName = Str::random(5) . '' . $fileName;
            $realPath = $this->request->file($coverImage)->getRealPath();
            $cover->make($realPath)->resize('227',
                '350')->save(public_path('img/cover/' . $coverImage . '/thumbnail/' . $fileName));
            $cover->make($realPath)->resize('600',
                '927')->save(public_path('img/cover/' . $coverImage . '/large/' . $fileName));
            $this->book->where('id', '=', $this->book->id)->update([$coverImage => $fileName]);
            $this->book->save();
        }
    }
}
