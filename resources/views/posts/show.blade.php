<x-app-layout>
    <x-slot name="header">
        　 {{ $post->title }}
    </x-slot>
        <div class="content">
            <div class="content__post">
                <h3>TO DO</h3>
                <p>{{ $post->body }}</p>    
            </div>
             <a href="/categories/{{ $post->category->id }}">{{ $post->category->name }}</a>
        </div>
        <div class="edit">
            <a href="/posts/{{ $post->id }}/edit">edit</a>
        </div>
        <div class="footer">
            <a href="/">戻る</a>
        </div>
</x-app-layout>