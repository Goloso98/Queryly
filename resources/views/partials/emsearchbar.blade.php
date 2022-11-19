<form action="{{ route('exactMatchSearch') }}" method="post" class="order-form">
    <div class="row">
        <div class="col-lg-12">
            <input type="text" placeholder="Search" name="input" id="input" value="{{ request()->input('input') }}">
        </div>
        <div class="col-lg-12">
            <button type="submit">Submit Now</button>
        </div>
    </div>
</form>