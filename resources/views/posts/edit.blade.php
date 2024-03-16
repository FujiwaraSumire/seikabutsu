<x-app-layout>
    <x-slot name="header">
        <link rel="stylesheet" href="{{ asset('css/edit.css') }}">   
        <h1 class="mt-2">To Do リスト</h1>
    </x-slot>

    <div class="container">
        <form action="/posts/{{ $post->id }}" method="POST">
            @csrf
            @method('PUT')

            <div class="edit">Edit</div>

            <div class="content__title">
                <h2>Title</h2>
                <input type="text" name="post[title]" placeholder="タイトル" value="{{ $post->title }}">
                <p class="title__error" style="color:#AAC4FF">{{ $errors->first('post.title') }}</p>
            </div>

            <div class='content__body'>
                <h2>To Do details</h2>
                <input type="text" name="post[body]" placeholder="詳細" value="{{ $post->body }}">
            </div>

            <h2>Category</h2>
            <!-- カテゴリーの入力フォーム -->
            <div>
                <input type="text" id="categoryInput" name="post[new_category]" placeholder="新しいカテゴリー名" value="{{ $post->new_category }}">
            </div>

            <!-- カテゴリーの選択フォーム -->
            <div>
                <select id="categorySelect" name="post[category_id]">
                    <option value="">選択してください</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                </select>
            </div>

            <h2>Priority</h2>
            <select name="post[priority_id]">
                <option value="">選択してください</option>
                @foreach($priorities as $priority)
                    <option value="{{ $priority->id }}">{{ $priority->name }}</option>
                @endforeach
            </select>

            <div class="time class">
                <h2>Deadline</h2>
                <input type="datetime-local" name="post[deadline]">
            </div>
            <input type="submit" value="保存">
            <div class="back"><a href="/">戻る</a></div>
        </form>
    </div>
</x-app-layout>
