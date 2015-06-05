<?php
/**
 * Created by PhpStorm.
 * User: usamaahmed
 * Date: 6/4/15
 * Time: 7:27 AM
 */
namespace App\Src\Book;

trait BookHelpers {

    /**
     * @return string
     * Generate PDF file Name for the Book
     */
    private function generateFileName()
    {
        return md5(uniqid(mt_rand(), true)) . '.pdf';
    }


}