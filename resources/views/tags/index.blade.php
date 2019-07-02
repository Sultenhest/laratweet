@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Tags</div>

                    <div class="card-body">
                        <ol>
                            @foreach ($tags as $tag)
                                <li>
                                    <a href="{{ $tag->path() }}">
                                        {{ $tag->name }} ( {{ $tag->statuses_count }} )
                                    </a>
                                </li>
                            @endforeach
                        </ol>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection