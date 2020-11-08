@extends('layouts.app')

@section('content')
    <div class="card card-default">
        <div class="card-header">
            {{ isset( $post ) ? 'Edit Post' : 'Create Post' }}
        </div>
        <div class="card-body">
            <form action="{{ isset( $post ) ? route('posts.update', $post->id ) : route('posts.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                @if(isset( $post ) )
                    @method('PUT')
                @endif
                <div class="form-group">
                    <label for="title">Titlte</label>
                    <input type="text" name="title" id="title" class="form-control" value="{{ isset($post) ? $post->title: '' }}"/>
                </div>
                <div class="form-group">
                    <label for="description">Description</label>
                    <textarea name="description" id="description" class="form-control" cols="5" rows="5">
                        {{ isset( $post ) ? $post->description : '' }}
                    </textarea>
                </div>
                <div class="form-group">
                    <label for="content">Content</label>
                    <input type="hidden" name="content" id="content" value="{{ isset( $post ) ? $post->content : '' }}"/>
                    <trix-editor input="content"></trix-editor>
                </div>
                <div class="form-group">
                    <label for="published_at">Published At</label>
                    <input type="text" name="published_at" id="published_at" class="form-control" value="{{ isset( $post ) ? $post->published_at : '' }}"/>
                </div>
                @if( isset( $post ) )
                    <div class="form-group">
                        <img src="{{asset('storage/' . $post->image)}}" alt="" width="200px" height="200px"/>
                    </div>
                @endif
                <div class="form-group">
                    <label for="image">Image</label>
                    <input type="file" name="image" id="image" class="form-control"/>
                </div>

                <div class="form-group">
                    <label for="category_id"></label>
                    <select name="category_id" id="category" class="form-control">
                        @foreach( $categories as $category )
                            <option value="{{ $category->id }}" @if( isset( $post ) && $category->id === $post->category_id ) selected @endif >{{ $category->name }}</option>
                        @endforeach
                    </select>
                </div>
                @if( $tags->count() > 0 )
                    <div class="form-group">
                        <label for="tags">tags</label>
                        <select name="tags[]" id="tags" class="tags-selector form-control" multiple>
                            @foreach( $tags as $tag )
                                <option value="{{ $tag->id }}" @if( isset( $post ) && $post->hasTag( $tag->id ) ) selected @endif>{{ $tag->name }}</option>
                            @endforeach
                        </select>
                    </div>
                @endif
                <div class="form-group">
                    <button class="btn btn-success" type="submit">
                        {{ isset( $post ) ? 'Update Post' : 'Create Post' }}
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/trix/1.3.0/trix.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>
    <script>
        flatpickr( '#published_at', {
            enableTime: true,
            enableSeconds: true
        } )

        $( document ).ready( function () {
            $( '.tags-selector' ).select2();
        } );

    </script>
@endsection

@section('css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/trix/1.3.0/trix.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet"/>
@endsection
