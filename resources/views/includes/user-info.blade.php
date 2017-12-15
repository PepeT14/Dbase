<!-- START User Info-->
<div class="visible-lg visible-md m-t-10">
        @php
            $user = Auth::user();
            if(Auth::guard('admin')->user()){
                $user = Auth::guard('admin')->user();
            }elseif(Auth::guard('player')->user()){
                $user = Auth::guard('player')->user();
            }
            elseif(Auth::guard('tutor')->user()){
                $user = Auth::guard('tutor')->user();
            }
            elseif(Auth::guard('mister')->user()){
                $user = Auth::guard('mister')->user();
            }
        @endphp
    @if(Auth::guard('admin')->check())
        <div class="pull-left name">
            <span class="semi-bold">{{$user->club->name}}</span>
        </div>
    @else
        <div class="pull-left name">
            <span class="semi-bold">{{ $user->name }}</span>
        </div>
    @endif
    <div class="pull-right name">
        <span class="semi-bold"><i class="fa fa-power-off logout"></i>Salir</span>
    </div>
</div>