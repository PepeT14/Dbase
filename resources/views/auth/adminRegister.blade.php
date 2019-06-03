
<!doctype html>
<html lang="es">
<head>
    @include ('includes.meta')
    @include ('includes.styles')
    <link rel="stylesheet" href="{{asset('css/register.css')}}" type="text/css">
</head>
<body>
<div class="loader"><img class="icono-loader" src="{{asset('imagenes/carga.png')}}"></div>
<div class="register-form-container">
        <div class="main_panel z-depth-1">
            <div class="register-form-title">
                <div class="title">Bienvenido a dbaseapp!</div>
                <div class="info">Formulario para el administrador de  {{$club->name}}</div>
            </div>
            <form id="admin-register-form" data-club="{{$club->id}}">
                <div class="row align-items-center">
                    <div class="input-field">
                        <i class="material-icons prefix">email</i>
                        <input type="email" id="admin-email" name="admin-email">
                        <label for="admin-email">Email</label>
                    </div>
                    <svg class="checkmark" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 50 50">
                        <circle id="admin-email-error" class="checkmark__circle" cx="25" cy="25" r="20" fill="none"></circle>
                        <path class="checkmark__icon check" fill="none" d="M14.1 27.2l7.1 7.2 16.7-16.8"></path>
                        <path class="checkmark__icon cross" fill="none" d="M16 16 36 36 M36 16 16 36" ></path>
                    </svg>
                </div>
                <div class="row align-items-center">
                    <div class="input-field">
                        <i class="material-icons prefix">account_circle</i>
                        <input type="text" id="admin-username" name="admin-username">
                        <label for="admin-username">Usuario</label>
                    </div>
                    <svg class="checkmark" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 50 50">
                        <circle class="checkmark__circle" cx="25" cy="25" r="20" fill="none"></circle>
                        <path class="checkmark__icon check" fill="none" d="M14.1 27.2l7.1 7.2 16.7-16.8"></path>
                        <path class="checkmark__icon cross" fill="none" d="M16 16 36 36 M36 16 16 36" ></path>
                    </svg>
                </div>
                <div class="row align-items-center">
                    <div class="input-field">
                        <i class="material-icons prefix">lock</i>
                        <input id="admin-password" name="admin-password" type="password">
                        <label for="admin-password">Contraseña</label>
                    </div>
                    <svg class="checkmark" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 50 50">
                        <circle class="checkmark__circle" cx="25" cy="25" r="20" fill="none"></circle>
                        <path class="checkmark__icon check" fill="none" d="M14.1 27.2l7.1 7.2 16.7-16.8"></path>
                        <path class="checkmark__icon cross" fill="none" d="M16 16 36 36 M36 16 16 36" ></path>
                    </svg>
                </div>
                <div class="row align-items-center">
                    <div class="input-field">
                        <i class="material-icons prefix">lock</i>
                        <input id="admin-password_confirm" name="admin-password_confirm" type="password">
                        <label for="admin-password_confirm">Repite la contraseña</label>
                    </div>
                    <svg class="checkmark" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 50 50">
                        <circle class="checkmark__circle" cx="25" cy="25" r="20" fill="none"></circle>
                        <path class="checkmark__icon check" fill="none" d="M14.1 27.2l7.1 7.2 16.7-16.8"></path>
                        <path class="checkmark__icon cross" fill="none" d="M16 16 36 36 M36 16 16 36" ></path>
                    </svg>
                </div>
                <div class="buttons">
                    <button class="waves-effect waves-light teal btn btn" type="submit">REGISTRARME</button>
                </div>
            </form>
        </div>
    </div>
</div>

@include('includes.scripts')
<script src="{{asset('js/admin/register.js')}}" type="text/javascript"></script>

<script>
    $(window).on('load',function(){
        $('.loader').fadeOut('slow');
    });
</script>
</body>
</html>