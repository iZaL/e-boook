
@extends('layouts.one_col')

@section('content')
    @foreach($books as $book)
        <div class="">{{ $book->title_en }}</div>
        <div class="">{{ $book->body  }}</div>
    @endforeach
    <?php echo $books->render(); ?>
@stop
