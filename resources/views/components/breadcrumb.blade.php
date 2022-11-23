<div>
    <ol class="breadcrumb">
    @foreach (array_slice($url, 0, -1) as $elem)
            <li class="breadcrumb-item"><a href="#">{{$elem}}</a></li>
    @endforeach
    </ol>
</div>


<!-- <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="#">Home</a></li>
    <li class="breadcrumb-item active" aria-current="page">Library</li>
</ol> -->
