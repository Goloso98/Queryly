<article class="message" data-id="{{ $message->id }}">
    <div class="card">
        <div class="card-body">
            <h3 class="card-title">{{ $message->name }}</h3>
            <form method="post" action="{{ route('messages.delete', $message->id) }}">
                        @csrf
                        @method('PATCH')
                        <button type="submit" class="delete btn">  Delete Message </button>
                    </form>
            <p class="card-text">{{ $message->message }}</p>
            <p class="card-text">Email: {{$message->email}}</p>
        </div>
    </div>
</article>