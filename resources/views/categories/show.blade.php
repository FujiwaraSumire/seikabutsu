<x-app-layout>
    <x-slot name="header">
        　TO DO リスト
    </x-slot>
        @extends('layouts.app')
        
        @section('content')
            <h1>To-Do List for {{ $category->name }}</h1>
        
            @foreach ($posts as $post)
                <div>
                    <h2>{{ $post->title }}</h2>
                    <p>{{ $post->body }}</p>
                    <!-- 他の情報を表示... -->
                </div>
            @endforeach
        
            {{ $posts->links() }} <!-- ページネーションのためのリンク -->
        @endsection
</x-app-layout>
