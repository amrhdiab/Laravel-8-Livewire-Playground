@extends('layouts.app')
@section('title','Dashboard')
@section('scripts')
    <script type="text/javascript">

        // closing any modal dynamically
        window.livewire.on('cancel', modal => {
            $('#' + modal).modal('hide');
        });

    </script>
@endsection

@section('content')
    <div class="container">
        <h3>Your Posts</h3>
        @livewire('posts.posts-table')
    </div>
@endsection