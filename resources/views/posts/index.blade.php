<x-app-layout>
    <x-slot name="header">
        <!-- public/css/index.css を読み込む -->
        <link rel="stylesheet" href="{{ asset('css/index.css') }}">    
        TO DO リスト
    </x-slot>
        <div class="header-content">
        <button class="button-create" onclick="location.href='/posts/create'"> To Do Create</button>
    </div>

    <div class="post">
        @foreach ($posts as $post)
            <div class="py-12">
                <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-6 text-gray-900">
                            <div class="post">
                                <p class="text">
                                @if($post->check == 1)
                                    <form action="{{ route('incomplete', ['post' => $post->id]) }}" 
                                        method="POST" class="button-incomplete">
                                        @csrf
                                        @method('PATCH')
                                        <button type="button" onclick="confirmAction(this, 'Incompleteに変更しますか？')">Completed✨</button>
                                    </form>
                                @else
                                    <form action="{{ route('completed', ['post' => $post->id]) }}" 
                                        method="POST" class="button-completed">
                                        @csrf
                                        @method('PATCH')
                                        <button type="button" onclick="confirmAction(this, 'Completed✨に変更しますか？')">Incomplete</button>
                                    </form>
                                @endif
                                <div class="extra-space"></div> 
                                <h2 class="title"><a href="/posts/{{ $post->id }}">{{ $post->title }}</a></h2>
                                <p class="body">{{ $post->body }}</p>
                                <div class="extra-space"></div> 
                                <a href="/categories/{{ $post->category->id }}">{{ $post->category->name }}</a>
                                <div class="extra-space"></div> 
                                <a href="/priorities/{{ $post->priority->id }}">{{ $post->priority->name }}</a>
                                <div class="extra-space"></div> <!-- 追加: 余白を作成 -->
                                <form action="/posts/{{ $post->id }}" id="form_{{ $post->id }}" method="post">
                                    @csrf
                                    @method('DELETE')
                                    <button type="button" class="button-delete" onclick="deletePost({{ $post->id }})">delete</button> 
                                </form>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
    <div class='paginate'></div>
    <script>
        function deletePost(id) {
            'use strict'

            if (confirm('削除すると復元できません。\n本当に削除しますか？')) {
                document.getElementById(`form_${id}`).submit();
            }
        }

        function confirmAction(button, message) {
            if (confirm(message)) {
                const form = button.closest(".button-incomplete, .button-completed");
                form.classList.add("completed");
                form.submit();
                button.disabled = true;
            }
        }

        document.querySelectorAll(".button-incomplete, .button-completed").forEach(function(form) {
            form.addEventListener("submit", function(event) {
                event.preventDefault();
                // ここにサーバーへの非同期送信などの追加処理があれば追加
            });
        });
    </script>
</x-app-layout>
