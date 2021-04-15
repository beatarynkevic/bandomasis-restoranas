@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h2>Dienos paitiekalu sarasas</h2>
                </div>
                <div class="card-body">
                    <table class="table">
                        <thead>
                            <tr>
                            <th scope="col">Pavadinimas</th>
                            <th scope="col">Kaina</th>
                            <th scope="col">Viso svoris</th>
                            <th scope="col">Mesos svoris</th>
                            <th scope="col">Veiksmas</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach ($menus as $menu)
                            <tr scope="row">
                                <td>{{$menu->title}}</td>
                                <td>{{$menu->price}}</td>
                                <td>{{$menu->weight}}</td>
                                <td>{{$menu->meat}}</td>
                                <td>
                                    <div class="list-line__buttons">
                                        <a href="{{route('menu.show',[$menu])}}" class="btn btn-success">SHOW</a>
                                        <a href="{{route('menu.pdf', [$menu])}}" class="btn btn-warning">PDF</a>
                                        <a href="{{route('menu.edit',[$menu])}}" class="btn btn-info">EDIT</a>
                                        <form method="POST" action="{{route('menu.destroy', [$menu])}}">
                                            @csrf
                                            <button type="submit" class="btn btn-danger">DELETE</button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
