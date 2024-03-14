<x-app-layout>
    <x-slot name="header">
        <!-- public/css/index.css を読み込む -->
        <link rel="stylesheet" href="{{ asset('css/index.css') }}">
        <h1 class="mt-2">TO DO リスト</h1>
    </x-slot>
        <div class="header-content">
            <button class="button-create" onclick="location.href='/posts/create'">Create</button>
        </div>
            <!-- ここにタスクが表示される -->
            <div class="py-12">
                <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-6 text-gray-900">
                            <div class="task">タスク</div>
                                <div class="body">
                                    <div class="text-center">
                                        <div class="header-right"></div>
                                    </div>
                                </div>
                                <table class="post">
                                    <thead>
                                        <tr>
                                            <th>Status</th>
                                            <th>Title</th>
                                            <th>Detail</th>
                                            <th>
                                                <button type="submit" name="sort" value="@if (!isset($sort) || $sort !== '3') 3
                                                    @elseif ($sort === '3') 4 @endif">Category
                                                </button>
                                            </th>
                                            <th>Priority</th>
                                            <th>
                                                <button type="submit" name="sort" value="@if (!isset($sort) || $sort !== '1') 1 
                                                    @elseif ($sort === '1') 2 @endif">Deadline
                                                </button>
                                              </form>
                                            </th>
                                            <th></th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <!--
                                        * 【task一覧セクション】
                                        * foreach の中でTaskControllerから渡されたデータ $tasks を参照する
                                        * $tasks をループして値を全て表示する
                                        -->
                                        @foreach($posts as $post)
                                            <tr>
                                                <!-- タスクのstatusを表示する -->
                                                <td>
                                                    @if($post->check == 1)
                                                        <form action="{{ route('incomplete', ['post' => $post->id]) }}" method="POST" class="button-incomplete">
                                                            @csrf
                                                            @method('PATCH')
                                                            <button type="button" onclick="confirmAction(this, 'Incompleteに変更しますか？')">Completed✨</button>
                                                        </form>
                                                    @else
                                                        <form action="{{ route('completed', ['post' => $post->id]) }}" method="POST" class="button-completed">
                                                            @csrf
                                                            @method('PATCH')
                                                            <button type="button" onclick="confirmAction(this, 'Completed✨に変更しますか？')">Incomplete</button>
                                                        </form>
                                                    @endif
                                                </td>
                                                <!-- タスクのtitleを表示する -->
                                                <td>
                                                    <h2 class="title"><a href="/posts/{{ $post->id }}" class="task-link">{{ $post->title }}</a></h>
                                                </td>
                                                <!-- タスクのbodyを表示する -->
                                                <td>
                                                    <p class="body">{{ $post->body }}</p>
                                                </td>
                                                <!-- タスクのcategoryを表示する -->
                                                <td>
                                                    <h2 class="category">
                                                        @if(!empty($post->category->id ))
                                                            <p class="category">{{ $post->category->name }}</p>
                                                        @endif
                                                    </h>
                                                </td>
                                                <!-- タスクのpriorityを表示する -->
                                                <td>
                                                    <h2 class="priority">
                                                        @if(!empty($post->priority->id ))
                                                            <p class="priority">{{ $post->priority->name }}</p>
                                                        @endif
                                                    </h>
                                                </td>
                                                <!-- タスクのdeadlineを表示する -->
                                                <td>
                                                    <span class="deadline">
                                                        @if($post->deadline)
                                                            {{ \Carbon\Carbon::parse($post->deadline)->format('Y/m/d') }}
                                                        @endif
                                                    </span>
                                                </td>
                                                    
                                                <!-- editボタンを表示する -->
                                                <td>
                                                    <form action="/posts/{{ $post->id }}/edit" method="GET">
                                                        <button type="submit" class="button-edit">Edit</button>
                                                    </form>
                                                </td>
                                                <!-- deleteボタンを表示する -->
                                                <td>
                                                    <form id="form_{{ $post->id }}" action="/posts/{{ $post->id }}" method="POST">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="button" onclick="deletePost({{ $post->id }})" class="button-delete">Delete</button>
                                                    </form>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>    
                    </div>
                </div>
            </div>
            <div class='paginate'></div>
        
            <script>
                function deletePost(id) {
                    'use strict';
            
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
