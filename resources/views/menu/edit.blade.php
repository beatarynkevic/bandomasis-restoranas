@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Edit dienos pietus</div>
                <div class="card-body">
                    <form method="POST" action="{{route('menu.update', [$menu])}}">

                        <div class="form-group">
                            <label>Title</label>
                            <input type="text" class="form-control" name="menu_title" value="{{old('menu_title')}}">
                            <small class="form-text text-muted">Please enter menu title</small>
                        </div>
                        <div class="form-group">
                            <label>Price</label>
                            <input type="text" class="form-control" name="menu_price" value="{{old('menu_price')}}">
                            <small class="form-text text-muted">Please enter price</small>
                        </div>
                        <div class="form-group">
                            <label>Weight</label>
                            <input type="text" class="form-control" name="menu_weight" value="{{old('menu_weight')}}">
                            <small class="form-text text-muted">Please enter weight</small>
                        </div>
                        <div class="form-group">
                            <label>Meat</label>
                            <input type="text" class="form-control" name="menu_meat" value="{{old('menu_meat')}}">
                            <small class="form-text text-muted">Please enter meat</small>
                        </div>
                        <div class="form-group">
                            <label>About</label>
                            <textarea id="summernote" name="menu_about"></textarea>
                            <small class="form-text text-muted">Parasykite ka nors :) </small>
                        </div>
                        @csrf
                        <button type="submit" class="btn btn-primary">Edit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    window.addEventListener('DOMContentLoaded', (event) => {
        $('#summernote').summernote();
    });

</script>
@endsection
