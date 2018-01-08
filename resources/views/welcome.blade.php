@extends('layouts.app')

@section('content')
    <div class="welcome text-center">
    <!-- Facilities And What we do best -->
    <div class="theme-padding">
        <div class="container">

            <!-- Main Heading -->
            <div class="main-heading-holder">
                <div class="main-heading">
                    <h2>FootdBaseApp</h2>
                    <p>Es mucho más que un sistema de información, empieza a gestionar de una manera profesional tu club desde ya.</p>
                </div>
            </div>
            <!-- Main Heading -->

            <!-- Facilities row -->
            <ul class="row">

                <!-- Facilities column -->
                <li class="col-lg-4 col-md-4 col-xs-6 r-full-width">
                    <div class="facilities-column center">
                        <span class="Facilities-icon bg-1 position-center-x"><img src="images/png-icons/img-01.png" alt=""></span>
                        <h5>PLAYER WORKSHOPS</h5>
                        <p>Sem augue scelerisque sapien neque congue fusce ac, lobortis donec non adipiscing fusce lobortis placerat donec, tempus</p>
                    </div>
                </li>
                <!-- Facilities column -->

                <!-- Facilities column -->
                <li class="col-lg-4 col-md-4 col-xs-6 r-full-width">
                    <div class="facilities-column center">
                        <span class="Facilities-icon bg-2 position-center-x"><img src="images/png-icons/img-02.png" alt=""></span>
                        <h5>Media Galleries</h5>
                        <p>Quis pellentesque convallis sem torquent lacus blandit rutrum, at adipiscing sociosqu vitae facilisis ornare, phasellus</p>
                    </div>
                </li>
                <!-- Facilities column -->

                <!-- Facilities column -->
                <li class="col-lg-4 col-md-4 col-xs-6 r-full-width">
                    <div class="facilities-column center">
                        <span class="Facilities-icon bg-3 position-center-x"><img src="images/png-icons/img-03.png" alt=""></span>
                        <h5>LADIES TEAM</h5>
                        <p>Eu sem consequat bibendum torquent phasellus dapibus enim congue felis dapibus cras, molestie ac molestie</p>
                    </div>
                </li>
                <!-- Facilities column -->

                <!-- Facilities column -->
                <li class="col-lg-4 col-md-4 col-xs-6 r-full-width">
                    <div class="facilities-column center">
                        <span class="Facilities-icon bg-4 position-center-x"><img src="images/png-icons/img-04.png" alt=""></span>
                        <h5>SOCCER board</h5>
                        <p>Leo tellus fermentum etiam cubilia erat himenaeos platea nostra, vehicula eleifend massa habitasse quis ut purus</p>
                    </div>
                </li>
                <!-- Facilities column -->

                <!-- Facilities column -->
                <li class="col-lg-4 col-md-4 col-xs-6 r-full-width">
                    <div class="facilities-column center">
                        <span class="Facilities-icon bg-5 position-center-x"><img src="images/png-icons/img-05.png" alt=""></span>
                        <h5>DEDICATED COACHS</h5>
                        <p>Dapibus commodo nibh quisque tempor euismod dolor placerat tempor molestie, vel pulvinar quisque proin habitant</p>
                    </div>
                </li>
                <!-- Facilities column -->

                <!-- Facilities column -->
                <li class="col-lg-4 col-md-4 col-xs-6 r-full-width">
                    <div class="facilities-column center">
                        <span class="Facilities-icon bg-6 position-center-x"><img src="images/png-icons/img-06.png" alt=""></span>
                        <h5>Tournament</h5>
                        <p>Aenean pulvinar facilisis etiam enim augue tortor consequat euismod habitant purus quisque facilisis, pellentesque</p>
                    </div>
                </li>
                <!-- Facilities column -->

            </ul>
            <!-- Facilities row -->

        </div>
    </div>
    <!-- Facilities And What we do best -->

@endsection
@section('scripts')
    <script src="{{asset('js/welcome.js')}}" type="text/javascript"></script>
@endsection