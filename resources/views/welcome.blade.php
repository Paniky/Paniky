<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>LOGIN - PANIKY</title>

    @if(!empty(session('usid')) && null !== session('usid') &&
    !empty(session('ustype')) && null !== session('ustype'))
        <script type="text/javascript">
            window.location.replace('http://test.paniky.com/{{session('usid')}}');
        </script>

    @endif
    <style type="text/css">
        html,body{
            height: 100%;
            width: 100%;
            margin: 0 auto;
        }
        #login-container{
            display: flex;
            height: 100%;
            width: 100%;
            background-color: #161616;
            flex-direction: row;
            font-family: Arial, Helvetica, sans-serif;
        }

        #login-column{
            margin-top: 5%;
            flex: 2;
            height: 80%;
            display: flex;
            flex-direction: column;
            justify-items: center;
            align-items: center;
        }
        #blank-space-main{
            flex: 3;
            height: 100%;
        }
        #paniky-desc{
            display: flex;
            flex-direction: column;
            flex: 1;
            color: white;
        }
        #form-container{
            flex: 1;
            width: 100%;
            height: 50%;
        }
        #form-container form{
            display: flex;
            float: left;
            flex-direction: column;
            height: 100%;
            width: 70%;
        }
        #left-span{
            flex: 1;
        }
        label{
            color: white;
            flex: 1;
        }
        input{
            flex: 1;
            width: 100%;
            padding: 5%;
        }
        input[type='text'],input[type='password']{
            background-color : #252525;
            color: white;
            font-size: 15px;
            font-weight: bold;
            border: none;
        }
        input[type='submit']{
            background-color: #0c0c0c;
            color: white;
            font-size: 15px;
            border: none;
        }
    </style>
</head>
<body>

    <div id="login-container">
        <div id="left-span"></div>
        <div id="login-column">
            <div id="paniky-desc">
                <div><p style="flex:1;font-size: 250%;font-weight: bold;">PANIKY</p></div>
                <div><p style="flex:1;font-size: 150%;font-weight: bold;">Únete a la comunidad de artistas del horror mas grande de latinoamérica</p></div>
            </div>

            <div id="form-container">
                <form action="user/login/action" method="POST">
                    @csrf
                    <label>Email: </label>
                    <input type="text" name="mail" placeholder="example@mail.com"><br>
                    <label>Contraseña: </label>
                    <input type="password" name="psswd" placeholder="contraseña" ><br><br>
                    <input type="submit" value="INICIAR SESIÓN" style="width:110%">
                </form>
            </div>
        </div>
        <div id="blank-space-main">a</div>
    </div>

</body>
</html>
