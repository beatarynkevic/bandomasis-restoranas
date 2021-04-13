@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h2>List of restaurants</h2>
                    <div class="make-inline">
                        <form action="{{route('restaurant.index')}}" method="get" class="make-inline">
                            <div class="form-group make-inline">
                                <label>restaurant: </label>
                                <select class="form-control" name="id">
                                    <option value="0" disabled @if($filterBy==0) selected @endif>Select menu</option>
                                    @foreach ($menus as $menu)
                                    <option value="{{$menu->id}}" @if($filterBy==$menu->id) selected @endif>
                                        {{$menu->title}}
                                    </option>
                                    @endforeach
                                </select>
                            </div>
                            <button type="submit" class="btn btn-info ">Filter</button>
                        </form>
                        <a href="{{route('restaurant.index')}}" class="btn btn-info">Clear filter</a>
                    </div>
                </div>

                <div class="card-body">
                    <table class="table">
                        <thead>
                            <tr>
                            <th scope="col">Pavadinimas</th>
                            <th scope="col">Customers</th>
                            <th scope="col">Employees</th>
                            <th scope="col">Dienos patiekalas</th>
                            <th scope="col">Veiksmai</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach ($restaurants as $restaurant)
                            <tr scope="row">
                                <td>{{$restaurant->title}}</td>
                                <td>{{$restaurant->customers}}</td>
                                <td>{{$restaurant->employees}}</td>
                                <td>{{$restaurant->restaurantMenus->title}}</td>
                                <td>
                                    <div class="list-line__buttons">
                                        <a href="{{route('restaurant.edit',[$restaurant])}}" class="btn btn-info">EDIT</a>
                                        <form method="POST" action="{{route('restaurant.destroy', [$restaurant])}}">
                                            @csrf
                                            <button type="submit" class="btn btn-danger">DELETE</button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
