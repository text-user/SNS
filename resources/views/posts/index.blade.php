@extends('layouts.app')

@section('content')

<div class="card-body">
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <h5 class="card-title">検索フォーム</h5>
                <div id="custom-search-input">
                    <div class="input-group col-md-12">
                        <form action="{{route('posts.search')}}" method="get">
                            {{csrf_field()}}
                            <input type="text" class="form-control input-lg" placeholder="Buscar" name="search">
                            <span class="input-group-btn" style="position: relative;top: -36px; left: 193px;">
                                <button class="btn btn-info" type="submit">
                                    <i class="fas fa-search"></i>
                                </button>
                            </span>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="card-header">Board</div>

@isset($search_result)
    <h5 class="card_title">{{$search_result}}</h5>
@endisset

<div class="card-body">
    @if (session('status'))
        <div class="alert alert-success" role="alert">
            {{session('status')}}
        </div>
    @endif

    @foreach($posts as $post)
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">タイトル:
                    {{ $post->title}}
                </h5>

                <h5 class="card-title">日時:
                    {{$post->created_at}}
                </h5>

                <h5 class="card-title">
                    カテゴリ-:
                    <a href="{{ route('posts.index', ['category_id' => $post->category_id]) }}">
                        {{$post->categories->category_name}}
                    </a>
                </h5>

                <h5 class="card-title">
                    投稿者:
                    <a href="{{ route('users.show', $post->user_id) }}">{{ $post->user->name}}</a>
                </h5>
                <p class="card-text">
                    <p>内容</p>
                    {{ $post->content}}</p>
                <a href="{{route('posts.show', $post->id) }}" class="btn btn-primary">詳細</a>
            </div>
        </div>
    @endforeach
</div>
@endsection