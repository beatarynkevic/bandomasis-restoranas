@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Add restaurant</div>

                <div class="card-body">
                    <form method="POST" action="{{route('restaurant.update',[$restaurant->id])}}">
                    <div class="form-group">
                            <label>Title</label>
                            <input type="text" class="form-control" name="restaurant_title" value="{{old('restaurant_title',$restaurant->title)}}">
                            <small class="form-text text-muted">Please enter title</small>
                        </div>
                        <div class="form-group">
                            <label>Customers</label>
                            <input type="text" class="form-control" name="restaurant_customers" value="{{old('restaurant_customers', $restaurant->customers)}}">
                            <small class="form-text text-muted">Please enter how many customers restaurant have</small>
                        </div>
                        <div class="form-group">
                            <label>Employees</label>
                            <input type="text" class="form-control" name="restaurant_employees" value="{{old('restaurant_employees', $restaurant->employees)}}">
                            <small class="form-text text-muted">Please enter how many emplyees restaurant have</small>
                        </div>
                        <div class="form-group">
                            <select name="menu_id">
                                @foreach ($menus as $menu)
                                <option value="{{$menu->id}}" @if($menu->id == $restaurant->menu_id) selected @endif>
                                    {{$menu->title}}
                                </option>
                                @endforeach
                            </select>
                        </div>
                        @csrf
                        <button type="submit" class="btn btn-outline-success">ADD</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
