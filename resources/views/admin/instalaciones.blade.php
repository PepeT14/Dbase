@extends('layouts.app')
@section('content')
    <div class="main_panel row col-10 admin_panel" id="instalaciones">
        <div class="col-3 animated faster">

        </div>
        <div class="col-9 animated faster" id="instalaciones_calendar">
            <div class="panel_header">
                <div class="panel_title"></div>
            </div>
            <div class="panel_body">
                <table class="table">
                    <thead>
                    <tr>
                        <th scope="col"></th>
                        <th scope="col">Lunes</th>
                        <th scope="col">Martes</th>
                        <th scope="col">Miércoles</th>
                        <th scope="col">Jueves</th>
                        <th scope="col">Viernes</th>
                        <th scope="col">Sábado</th>
                        <th scope="col">Domingo</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($instalaciones as $instalacion)
                        <tr>
                            <th scope="row">{{$instalacion->name}}</th>
                            <td class="table-success">LIBRE</td>
                            <td class="table-success">LIBRE</td>
                            <td class="table-success">LIBRE</td>
                            <td class="table-success">LIBRE</td>
                            <td class="table-success">LIBRE</td>
                            <td class="table-success">LIBRE</td>
                            <td class="table-success">LIBRE</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection