@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">Welcome</div>

                    <div class="panel-body">
                        @forelse($blogs as $blog)
                            <b>{{ $blog->title }}</b> <br />
                            {{ $blog->contents }}<br /><br />
                        @empty
                            No Data Found
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
