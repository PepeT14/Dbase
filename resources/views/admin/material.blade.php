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
                            @foreach($material as $material_item)
                                <li><a data-toggle="tab" href="#{{$material_item->type}}">{{$material_item->type}}</a></li>
                            @endforeach
                                <li><a data-toggle="tab" href="#form"><i class="fa fa-plus"></i></a></li>
                        </ul>
                        <div class="tab-content">
                            @foreach($material as $material_item)
                                <div id="{{$material_item->type}}" class="tab-pane fadeInLeft">
                                <div class="table-responsive">
                                    <table class="table">
                                        <thead>
                                        <tr>
                                            <th>Cantidad</th>
                                            <th>Subtipo</th>
                                            <th>Disponible</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <tr>
                                            <td>{{$material_item->cantidad}}</td>
                                            <td>{{$material_item->subtype}}</td>
                                            <td>{{$material_item->stock}}</td>
                                        </tr>
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
                                                <input name="type" placeholder="Tipo Ej: Balones" type="text">
                                                <input name="subtype" placeholder="Subtipo Ej: Fútbol 7" type="text">
                                                <input name="cantidad" placeholder="Cantidad Ej:10" type="number">
                                                <input name="description" placeholder="Descripción Ej: Balones nike fútbol 7" type="text">
                                            </div>

                                            <input class="createButton" type="submit" value="CREAR">

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