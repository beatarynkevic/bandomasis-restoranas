@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Menus {{$menu->title}}</div>
                <div class="card-body">
                    {!!$menu->about!!}
                    <div>
                        <a href="{{route('menu.edit',[$menu])}}" class="btn btn-info">EDIT</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
