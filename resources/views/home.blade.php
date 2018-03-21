@extends('layouts.app')

@section('content')
<div class="container">
    @empty($table->getData())
        No responses recorded yet.
    @else
        @include('forms')
    @endempty
</div>
@endsection
