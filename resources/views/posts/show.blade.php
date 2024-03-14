<x-app-layout>
    <x-slot name="header">
        <link rel="stylesheet" href="{{ asset('css/show.css') }}">
        <h1 class="mt-2">TO DO リスト</h1>
    </x-slot>
        <div class="content">
                    <div class="content__post">
                    <div class="title">Title</div>
                        <h2>{{ $post->title }}</h3>
                    <div class="body">Body</div>
                        <h2>{{ $post->body }}</h>    
                    </div>
                        <div class="category">Category</div>
                        @if(!empty($post->category->id ))
                            <h2>{{ $post->category->name }}</h>
                        @endif
                        <div class="priority">Priority</div>
                        @if(!empty($post->priority->id ))
                            <h2>{{ $post->priority->name }}</h>
                        @endif
                        <div class="deadline">Deadline</div>
                        @if($post->deadline)
                            {{ \Carbon\Carbon::parse($post->deadline)->format('Y/m/d') }}
                        @endif
                        <div class="edit">
                    <form action="/posts/{{ $post->id }}/edit" method="GET">
                <button type="submit" class="button-edit">Edit</button>
                    </form>
                </div>
            <div class="back">
                <a href="/">戻る</a>
            </div>
        </div>
</x-app-layout>