<x-app-layout>
    <x-slot name="header">
        <h1 class="mt-2">TO DO リスト</h>
    </x-slot>
        <div class="container">
            <h1>To-Do List for {{ $category->name }}</h1>
    
            @foreach ($posts as $post)
                <div>
                    <h2>{{ $post->title }}</h2>
                    <p>{{ $post->body }}</p>
                    <!-- 他の情報を表示... -->
                </div>
            @endforeach
            
            {{ $posts->links() }} <!-- ページネーションのためのリンク -->
        </div>
</x-app-layout>
