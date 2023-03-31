@props(['comment'])

<article>
    <header class="mb-4">
        <h3 class="font-bold">{{ $comment->author->username}}</h3>

        <p class="text-xs">
            Posted
            <time>{{ $comment->created_at}}</time>
        </p>
    </header>
        <p>
            {{ $comment->body }}
        </p>

        <p>{{ $comment->rating }} Stars</p>
</article>
