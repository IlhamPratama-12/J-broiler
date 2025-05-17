@extends('main.includes.master', ['title' => 'Kontak'])

@section('content')
<div class="bg-light py-3">
    <div class="container">
        <div class="row">
            <div class="col-md-12 mb-0">
                <a href="{{ route('main.home') }}">Home</a>
                <span class="mx-2 mb-0">/</span>
                <strong class="text-black">Kontak Kami</strong>
            </div>
        </div>
    </div>
</div>
@endsection
