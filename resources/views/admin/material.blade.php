@extends('layouts.admin')
@section('content')
    <div class="content admin">
        <div class="toolbar row">
            <div class="col-sm-6">
                <div class="page-header">
                    <h1>
                        Material
                    </h1>
                    <small>Añade, edita, asigna y mucho más</small>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="breadcrumb">

                </div>
            </div>
            <div class="col-md-12">
                <div class="panel panel-white">
                    <div class="panel-heading" id="materialPanel">
                    </div>
                    <div class="panel-body">
                        <ul class="nav nav-tabs tabbs">
                            @foreach($materialAgrupado->keys() as $material_item)
                                <li><a data-toggle="tab" href="#{{$material_item}}">{{$material_item}}</a></li>
                            @endforeach
                                <li><a data-toggle="tab" href="#form">Añadir <i class="fa fa-plus"></i></a></li>
                        </ul>
                        <div class="tab-content">
                            @foreach($materialAgrupado->keys() as $key)
                                <div id="{{$key}}" class="tab-pane fadeInLeft">
                                <div class="table-responsive">
                                    <table class="table">
                                        <thead>
                                        <tr>
                                            <th>Cantidad</th>
                                            <th>Subtipo</th>
                                            <th>Descripcion</th>
                                            <th>Disponible</th>
                                            <th>Acciones</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach(array_get($materialAgrupado,$key) as $material_item)
                                        <tr>
                                            <td>{{$material_item->cantidad}}</td>
                                            <td>{{$material_item->subtype}}</td>
                                            <td>{{$material_item->description}}</td>
                                            <td>{{$material_item->stock}}</td>
                                            <td class="icon-med"><i class="fa fa-trash"> </i>
                                                <i class="fa fa-pencil-square"></i>
                                                <i class="fa fa-plus-circle"></i>
                                            </td>
                                        </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            @endforeach
                                <div id="form" class="tab-pane fadeInLeft">
                                    <form action="{{route('material.create')}}">
                                        <div class="matForm">
                                            <h2>Crear Material</h2>
                                            <div class="inputs">
                                                <div>
                                                    <input name="type" placeholder="Ej: Balones" type="text">
                                                    <label for="type">Tipo</label>
                                                </div>
                                                <div>
                                                    <input name="subtype" placeholder="Ej: Fútbol 7" type="text">
                                                    <label for="subtype">Subtipo</label>
                                                </div>
                                                <div>
                                                    <input name="cantidad" placeholder="Ej:10" type="number">
                                                    <label for="cantidad">Cantidad</label>
                                                </div>
                                                <div>
                                                    <input name="description" placeholder="Ej: Balones nike fútbol 7" type="text">
                                                    <label for="description">Descripción</label>
                                                </div>
                                                <input class="createButton" type="submit" value="CREAR">

                                            </div>
                                        </div>
                                    </form>
                                </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script src="{{asset('assets/js/admin/material.js')}}" type="text/javascript"></script>
@endsection