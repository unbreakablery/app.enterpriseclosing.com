@extends('layouts.app')

@section('content')
<div class="container no-max-width bg-black main-container position-relative">
    @include('left-menu')
    <div class="row">
        <main role="main" class="main-content">
            @include('sections.users-body')
        </main>
    </div>
</div>
@endsection
