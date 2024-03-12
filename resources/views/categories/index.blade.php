<x-app-layout>
    <x-slot name="header">
        　TO DO リスト
    </x-slot>
        <div class="header-content">
            <button class="header-button" onclick="location.href='/posts/create'">Create</button>
        </div>
        <div class='posts'>
            @foreach ($posts as $post)
                <div class='post'>
                    <h2 class='title'><a href="/posts/{{ $post->id }}">{{ $post->title }}</a>
                    </h2>
                     <a href="/categories/{{ $post->category->id }}">{{ $post->category->name }}</a>
                    <p class='body'>{{ $post->body }}</p>
                    <form action="/posts/{{ $post->id }}" id="form_{{ $post->id }}" method="post">
                        @csrf
                        @method('DELETE')
                        <button type="button" onclick="deletePost({{ $post->id }})">delete</button> 
                    </form>
                </div>
            @endforeach
        </div>
        <div class='paginate'>
        </div>
       <script>
           function deletePost(id) {
               'use strict'

           if (confirm('削除すると復元できません。\n本当に削除しますか？')) {
            document.getElementById(`form_${id}`).submit();
           }
        }
       </script>
</x-app-layout>