<x-app-layout>
    <x-slot name="header">
       <!-- public/css/create.css を読み込む -->
        <link rel="stylesheet" href="{{ asset('css/create.css') }}">   
        TO DO リスト
    </x-slot>
        <h1>To Do</h1>
        <form action="{{ route('post.store') }}" method="POST">
            @csrf
            <div class="title">
                <h2>Title</h2>
                <input type="text" name="post[title]" placeholder="タイトル" value="{{ old('post.title') }}"/>
                <p class="title__error" style="color:red">{{ $errors->first('post.title') }}</p>
            </div>
             <div class="body">
                <h2>To Do details</h2>
                <textarea name="post[body]" placeholder="詳細">{{ old('post.body') }}</textarea>
            </div>
                <h2>Category</h2>
                <!-- カテゴリーの入力フォーム -->
            <div>
                <input type="text" id="categoryInput" name="post[new_category]" placeholder="新しいカテゴリー名" value="{{ old('post.new_category') }}"/>
            </div>

                <!-- カテゴリーの選択フォーム -->
            <div>
                <select id="categorySelect" name="post[category_id]" placeholder="カテゴリーを選択">
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
                <input type="datetime-local" name="post[deadline]"/>
            </div>

            <input type="submit" value="作成"/>
        </form>
        <div class="back">[<a href="/">戻る</a>]</div>
        <div class="category">
        </div>
</x-app-layout>
