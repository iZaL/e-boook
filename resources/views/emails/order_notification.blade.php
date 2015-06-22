
<div style="margin-right: auto; margin-left:auto; font-size:medium; color: black; font-weight: bold; margin:5px; padding: 10px; border: 1px solid gray;">
    <h1 style="background-color: #7187a4;">Order Notification - E-Boook.com </h1>
    <h3>An order has been accepted by Administration - E-book.com.</h3>

    <p>
        <h4>your Order Status now is : {{ $data['stage'] }}</h4>
        <p>for the following Book : {{ $data['book']['title_en'] }} </p>
        <p>In Arabic : {{ $data['book']['title_ar'] }}</p>
        <p>Total Pages : {{ $data['book']['meta']['total_pages'] }} </p>
        <p>Book Price : {{ $data['book']['meta']['price'] }} KD </p>
    </p>
    <h3>Buyer Information </h3>
    <p>
        Name : {{ $data['username'] }}
    </p>
    <p>
        Email : {{ $data['email'] }}
    </p>
    <p>
        Mobile : {{ $data['mobile'] }}
    </p>

</div>
