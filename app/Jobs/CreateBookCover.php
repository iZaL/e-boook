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
     * @return void
     */
    public function __construct(Book $book,$request)
    {
        $this->book = $book;
        $this->request = $request;
        // good size is 600 * 400
        /*
        $filename = $image->getClientOriginalName();
        $filename = Str::random(5).''.$filename;
        $realpath = $image->getRealPath();
        $imgThumbnail = Image::make($realpath)->resize('200','200')->save(public_path('uploads/thumbnail/'.$filename));
        $imageLarge = Image::make($realpath)->resize('500','500')->save(public_path('uploads/large/'.$filename));
        $createdPost->photos()->create(['path'=>$filename]);
        */
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle(Image $cover)
    {
        $covers = ['cover_ar','cover_en'];
        foreach($covers as $coverImage) {
            $fileName = $this->request->file($coverImage)->getClientOriginalName();
            $fileName = Str::random(5).''.$fileName;
            $realPath = $this->request->file($coverImage)->getRealPath();
            $cover->make($realPath)->resize('150','225')->save(storage_path('app/'.$coverImage.'/thumbnail/'.$fileName));
            $cover->make($realPath)->resize('400','600')->save(storage_path('app/'.$coverImage.'/large/'.$fileName));
            $this->book->where('id','=',$this->book->id)->update([$coverImage => $fileName]);
            $this->book->save();
        }
    }
}
