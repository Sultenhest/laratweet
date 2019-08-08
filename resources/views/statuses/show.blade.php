@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                @include('statuses.partials.status_card')

                <ul class="timeline">
                    @foreach ($status->replies as $reply)
                        <li>
                            @include("statuses.partials.status_card", [
                                'status' => $reply
                            ])
                        </li>
                    @endforeach
                </ul>
            </div>

            <div class="col-md-8">
                 <div class="card">
                    <div class="card-header">{{ __('Post a Reply') }}</div>

                    <div class="card-body">
                        <form method="POST" action="{{ $status->path() }}/reply">
                            @include('statuses.form', [
                                'status' => new App\Status,
                                'buttonText' => 'Create Status'
                            ])
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection