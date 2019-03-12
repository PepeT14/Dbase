<div class="row header_section animated faster" id="cabecera_team">
    <div class="team_header_tab active" data-seccion="#plantilla">Plantilla</div>
    <div class="team_header_tab" data-seccion="#clasificacion">CLasificación</div>
    <div class="team_header_tab" data-seccion="#material">Material</div>
</div>
<div class="team_detail_content animated faster" id="plantilla">
    <div class="row cuerpo_tecnico">
        @if($team->misters->count() == 0)
            <div class="col-lg-3 col-md-4 col-sm-6">
                <div class="mister_info shadow">
                    <div class="mister_image">
                        sxxsxw
                    </div>
                    <div class="mister_desc">

                    </div>
                </div>
            </div>
        @endif
        @foreach($team->misters as $mister)
            <div class="col-lg-3 col-md-4 col-sm-6">
                <div class="mister_info">
                    <div class="mister_image">
                        <img src="{{asset($mister->file)}}">
                    </div>
                    <div class="mister_desc">
                        <div class="mister_name">{{$mister->name}}</div>
                        <div class="info-divider"></div>
                        <div class="mister_team">{{$mister->rol}}</div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
    <div class="divider"></div>
    <div class="row plantilla">
        @if($team->players->count() == 0)
            <div class="col-12">
                No hay datos sobre los jugadores de este equipo. Una vez el responsable los haya añadido podrá verse su información aquí.
            </div>
        @endif
        @foreach($team->players as $player)
            <div class="col-lg-3 col-md-4 col-sm-6">
                <div class="mister_info">
                    <div class="mister_image">
                        <img src="{{asset($player->file)}}">
                    </div>
                    <div class="mister_desc">
                        <div class="mister_name">{{$player->name}}</div>
                        <div class="info-divider"></div>
                        <div class="mister_team">{{$player->position}}</div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
<div class="team_detail_content animated faster" id="clasificacion">
   No hay datos aún!
</div>
<div class="team_detail_content animated faster" id="material">
    AQUI VA EL MATERIAL ESPECIFICO DEL EQUIPO. Se Podran poner comentarios y editarlo. (Misma vista que en material, se activará cuando se pinche en material desde la seccion global)
</div>