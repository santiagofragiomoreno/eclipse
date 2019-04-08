<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
</head>
<body>

    <script>
    $(document).ready(function(){
        var datos = { id_asistente: 1,
                      nombre: "pepito",
                      foto:"",
                    }

        $.ajax({
            url: "http://localhost/CEI/API/update_asistente/76",
            method : "POST",
            data : datos,
            success : function(data){
                console.log(data);
            }
        })
    })
    </script>
    
</body>
</html>