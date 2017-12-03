@extends('layouts.app')

@section('content')
    <div class="welcome text-center">
        <br>
        <div class="welcomeRow">
            <div class="welcomeColumn">
                <select class="cs-select cs-skin-elastic" name='state'>
                    <option value="" disabled selected>Comunidad</option>
                </select>
            </div>
            <div class="welcomeColumn">
                <select class="cs-select cs-skin-elastic" name="province">
                    <option value="" disabled selected>Provincia</option>
                </select>
            </div>
            <div class="welcomeColumn">
                <select class="cs-select cs-skin-elastic" name="category">
                    <option value="" disabled selected>Categoría</option>
                    <option value="">Pre-Benjamin</option>
                    <option value="">Benjamin</option>
                    <option value="">Infantil</option>
                    <option value="">Cadete</option>

                </select>
            </div>
            <div class="welcomeColumn">
                <select class="cs-select cs-skin-elastic" name="league">
                    <option value="" disabled selected>Liga</option>
                </select>
            </div>
        </div>
        <br>
    </div>



    <!-- Facilities And What we do best -->
    <div class="theme-padding">
        <div class="container">

            <!-- Main Heading -->
            <div class="main-heading-holder">
                <div class="main-heading">
                    <h2>CLUB <span class="red-color">FACILITIES</span></h2>
                    <p>Kings Club Despicable briefly jeepers much roughly sped ouch in one away supportive grateful.</p>
                </div>
            </div>
            <!-- Main Heading -->

            <!-- Facilities row -->
            <ul class="row">

                <!-- Facilities column -->
                <li class="col-lg-4 col-md-4 col-xs-6 r-full-width">
                    <div class="facilities-column center">
                        <span class="Facilities-icon bg-1 position-center-x"><img src="images/png-icons/img-01.png" alt=""></span>
                        <h5><a href="#">PLAYER WORKSHOPS</a></h5>
                        <p>Sem augue scelerisque sapien neque congue fusce ac, lobortis donec non adipiscing fusce lobortis placerat donec, tempus</p>
                    </div>
                </li>
                <!-- Facilities column -->

                <!-- Facilities column -->
                <li class="col-lg-4 col-md-4 col-xs-6 r-full-width">
                    <div class="facilities-column center">
                        <span class="Facilities-icon bg-2 position-center-x"><img src="images/png-icons/img-02.png" alt=""></span>
                        <h5><a href="#">Media Galleries</a></h5>
                        <p>Quis pellentesque convallis sem torquent lacus blandit rutrum, at adipiscing sociosqu vitae facilisis ornare, phasellus</p>
                    </div>
                </li>
                <!-- Facilities column -->

                <!-- Facilities column -->
                <li class="col-lg-4 col-md-4 col-xs-6 r-full-width">
                    <div class="facilities-column center">
                        <span class="Facilities-icon bg-3 position-center-x"><img src="images/png-icons/img-03.png" alt=""></span>
                        <h5><a href="#">LADIES TEAM</a></h5>
                        <p>Eu sem consequat bibendum torquent phasellus dapibus enim congue felis dapibus cras, molestie ac molestie</p>
                    </div>
                </li>
                <!-- Facilities column -->

                <!-- Facilities column -->
                <li class="col-lg-4 col-md-4 col-xs-6 r-full-width">
                    <div class="facilities-column center">
                        <span class="Facilities-icon bg-4 position-center-x"><img src="images/png-icons/img-04.png" alt=""></span>
                        <h5><a href="#">SOCCER board</a></h5>
                        <p>Leo tellus fermentum etiam cubilia erat himenaeos platea nostra, vehicula eleifend massa habitasse quis ut purus</p>
                    </div>
                </li>
                <!-- Facilities column -->

                <!-- Facilities column -->
                <li class="col-lg-4 col-md-4 col-xs-6 r-full-width">
                    <div class="facilities-column center">
                        <span class="Facilities-icon bg-5 position-center-x"><img src="images/png-icons/img-05.png" alt=""></span>
                        <h5><a href="#">DEDICATED COACHS</a></h5>
                        <p>Dapibus commodo nibh quisque tempor euismod dolor placerat tempor molestie, vel pulvinar quisque proin habitant</p>
                    </div>
                </li>
                <!-- Facilities column -->

                <!-- Facilities column -->
                <li class="col-lg-4 col-md-4 col-xs-6 r-full-width">
                    <div class="facilities-column center">
                        <span class="Facilities-icon bg-6 position-center-x"><img src="images/png-icons/img-06.png" alt=""></span>
                        <h5><a href="#">Tournament</a></h5>
                        <p>Aenean pulvinar facilisis etiam enim augue tortor consequat euismod habitant purus quisque facilisis, pellentesque</p>
                    </div>
                </li>
                <!-- Facilities column -->

            </ul>
            <!-- Facilities row -->

        </div>
    </div>
    <!-- Facilities And What we do best -->

    <!-- Coach Statement -->
    <div class="coach-statement-holder theme-padding parallax-window" data-appear-top-offset="600" data-parallax="scroll" data-image-src="images/cabecera1.png">
        <div class="container">
            <div class="coach-statement">
                {{--<div class="coach-img">--}}
                    {{--<img src="images/coach.jpg" alt="">--}}
                {{--</div>--}}
                <div class="statement">
                    <h3>Motivate</h3>
                    <p>"Porque cuando A y B se pelean, siempre gana C"</p>
                    <img src="images/signature.png" alt="">
                </div>
            </div>
        </div>
    </div>
    <!-- Coach Statement -->

    <!-- Contact -->
    <div class="theme-padding white-bg">
        <div class="container">

            <!-- Main Heading -->
            <div class="main-heading-holder">
                <div class="main-heading">
                    <h2>contact us</h2>
                    <p>Chelsea captain John Terry is not ready to start against Stoke on Saturday and is struggling to prove his fitness.</p>
                </div>
            </div>
            <!-- Main Heading -->

            <!-- contact columns -->
            <ul class="row">
                <li class="col-sm-4">
                    <div class="address-widget">
                        <span class="address-icon"><i class="fa fa-phone"></i></span>
                        <h5>OUR NUMBERS</h5>
                        <p>49 30 47373795<span class="red-color">Alise Vivienne ( manager )</span></p>
                        <p>49 30 47373795<span class="red-color">Tina Rollandos ( secretary )</span></p>
                        <p>Call at any time convenient for you. We are available for you 24/7</p>
                    </div>
                </li>
                <li class="col-sm-4">
                    <div class="address-widget more-info">
                        <span class="address-icon"><i class="fa fa-info"></i></span>
                        <h5>MORE INFO</h5>
                        <strong>Cupim brisket shank, prosciutto porchetta kevin jowl ham hock.</strong>
                        <p>Bresaola alcatra boudin andouille, ball tip rump pancetta shoulder. Beef ribs turducken tail flank. Leberkas pancetta tri-tip biltong spare ribs.</p>
                    </div>
                </li>
                <li class="col-sm-4">
                    <div class="address-widget office-adderss">
                        <span class="address-icon"><i class="fa fa-map-marker"></i></span>
                        <h5>OUR office address</h5>
                        <p>1782 Harrison Street  Sun Prairie, WI 53590</p>
                        <p><i class="red-color fa fa-envelope-o"></i>moin@blindtextgenerator.de</p>
                        <p>Our office is located near the city center, on the left is a spacious park, swimming pool.</p>
                    </div>
                </li>
            </ul>
            <!-- contact columns -->

        </div>
    </div>
    <!-- Contact -->

@endsection
@section('scripts')
    <script src="{{asset('js/welcome.js')}}" type="text/javascript"></script>
@endsection