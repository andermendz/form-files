<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>

    <!-- Fonts -->
    <link href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
    <script src="https://kit.fontawesome.com/267916192d.js" crossorigin="anonymous"></script>

    <!-- Styles -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous">
    </script>



    <style>
        body {
            font-family: 'Nunito', sans-serif;
        }

        #container {

            display: flex;
            height: 100vh;
            justify-content: center;
            align-items: center
        }

        #form-container {
            display: flex;
            flex-direction: column;
            border: 2px solid rgb(186, 186, 186);
            border-radius: 20px;




        }

        #form-header {
            display: flex;
            color: white;
            background-color: #0c64d0;
            font-weight: bolder;
            align-items: center;
            height: 100px;
            text-align: left;
            padding-left: 20px;
            border-top-left-radius: 20px;
            border-top-right-radius: 20px;
        }

        #form {
            display: flex;
            padding: 20px;
            background-color: #fbfbfb;

            border-bottom-left-radius: 20px;
            border-bottom-right-radius: 20px;

        }

        #form-b1 {
            display: flex;
            gap: 20px;

        }

        .btn-send {
            color: #ffffff;
            background-color: #009c10;
        }

        .table {
            margin: 0px;
        }

        .th-sm {
            font-size: 14px;
        }
    </style>
</head>

<body class="antialiased">
    <div id="container">
        <div id="form-container">
            <div id="form-header">
                CONSULTA DE DOCUMENTOS DE SOPORTE
            </div>

            <div id="form">
                <form method="post" action="{{ route('saveFile') }}" enctype='multipart/form-data'>
                    @csrf
                    <div
                        style="display:flex; flex-direction:column; justify-content: space-around; height:70px; margin:15px">
                        <div style="font-size: 14px">
                            TIPOS DE ARCHIVOS PERMITIDOS: PDF,JPEG,JPG,PNG,XLS,XLSX,PPT,PPTX,DOC,DOCX
                        </div>
                        <div style="font-size: 14px">
                            TAMAÑO MAXIMO DEL ARCHIVO: 50 MB
                        </div>
                    </div>


                    <div id="form-b1">
                        <div>
                            <label for="file" class="form-label" style="font-size:16px">SELECCIONA UN
                                ARCHIVO</label>
                            <input type="file" class="form-control" name="file" id="file" placeholder="file"
                                accept=".pdf,.jpeg,.jpg,.png,.xls,.xlsx,.ppt,.pptx,.doc,.docx" />
                       
                                @error('file')
                                    <small style="color: red"> {{ $message }}</small>
                                @enderror
                       
                            </div>
                        <div>
                            <label for="description" class="form-label" style="font-size:16px">DESCRIPCION DEL
                                ARCHIVO</label>
                            <input type="text" class="form-control" name="description" id="description" />
                     
                            @error('description')
                            <small style="color: red"> {{ $message }}</small>
                        @enderror
                     
                        </div>

                        <div style="display:flex;">
                            <button button type="submit" style="height: 35px; align-self:flex-end;"
                                class="btn btn-send">

                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                    fill="currentColor" class="bi bi-check-lg" viewBox="0 0 16 16">
                                    <path
                                        d="M12.736 3.97a.733.733 0 0 1 
                                    1.047 0c.286.289.29.756.01 1.05L7.88 
                                    12.01a.733.733 0 0 1-1.065.02L3.217 
                                    8.384a.757.757 0 0 1 0-1.06.733.733 
                                    0 0 1 1.047 0l3.052 3.093 5.4-6.425a.247.247 0 0 1 .02-.022Z" />
                                </svg>
                            </button>
                        </div>

                    </div>
                </form>
            </div>
            <div style="display: flex; margin:10px;border:2px solid rgb(185, 185, 185); border-radius:20px;">
                <table id="dtOrderExample" class="table table-striped table-bordered table-sm"
                    style="border-radius: 20px; overflow:hidden;" cellspacing="0" width="100%">
                    <thead>
                        <tr>
                            <th class="th-sm">DESCRIPCION DEL ARCHIVO
                            </th>
                            <th class="th-sm">FECHA DE SUBIDA
                            </th>
                            <th class="th-sm">TIPO DE ARCHIVO

                            </th>
                            <th>
                                <i class="fa-solid fa-download"></i>
                            </th>
                            <th class="th-sm">
                                ELIMINAR

                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($listFiles as $file)
                            <tr>

                                <td>{{ $file->description }}</td>
                                <td>{{ $file->created_at }}</td>
                                <td>{{ $file->fileType }}</td>
                                <td>

                                    <!--
                                    llama a files -> files el cual contiene la ruta del archivo dentro del programa
                                    el cual esta localizado en el public patch
                                    -->

                                    <a href="{{ $file->file }} " target="_blank">
                                        <i class="fa fa-light fa-file-arrow-down"></i>
                                    </a>
                                </td>
                                <td>

                                    <!--
                                    llama a el metodo delete y da opcion de borrar el archivo mediante file->id
                                    -->

                                    <form action="{{ route('delete', $file->id) }}" method="POST">
                                        @csrf
                                        <div style=" display:flex; padding: 1px; justify-content:center;">
                                            <button type="submit"   
                                                style="background-color:rgba(255, 0, 0, 0);border:0px;">
                                                <i style="background-color:rgba(255, 255, 255, 0); color: rgb(171, 21, 21);"
                                                    class="fa fa-light fa-delete-left"></i>
                                            </button>
                                        </div>

                                    </form>
                                </td>

                            </tr>
                        @endforeach
                </table>
            </div>

        </div>

    </div>
</body>

</html>
