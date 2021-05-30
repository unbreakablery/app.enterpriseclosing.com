@extends('layouts.app')

@section('content')
<div class="container no-max-width bg-black main-container">
    <div class="row">
        
        @include('left-menu')
        
        <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-md-4">
            @include('sections.outbound-body')
        </main>
    </div>
</div>
@endsection
