@extends('layouts.app')

@section('content')
<div class="container no-max-width bg-black main-container">
    <div class="row">

        @include('left-menu')

        <main role="main" class="main-content">
            @include('sections.settings-body')
        </main>
    </div>
</div>
@endsection
