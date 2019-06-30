@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Status') }}</div>

                    <div class="card-body">
                        <form method="POST" action="/status">
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