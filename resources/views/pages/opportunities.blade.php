@extends('layouts.app')

@section('content')
<div class="container no-max-width bg-transparent main-container position-relative">
    @include('left-menu')
    <div class="row">
        <main role="main" class="main-content">
            @include('sections.opportunities-body')
        </main>
    </div>
</div>
@endsection
