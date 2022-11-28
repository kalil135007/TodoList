<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ URL::asset('css/app.css')}}">
    <title>Todo List</title>
</head>
<body>
    <header class="top">
        <b>Lista de Tarefas</b>
    </header>
    <div class="top_div1">
        <div class="div1">
            <div class="sub_div1">
                <p class="p1">Tarefas</p>
                <button type="button" class="add">Adcionar</button>
            </div>
            <div class="sub_div2">
                <table class="table">
                    <thead>
                        <tr>
                            <th class="name">Nome</th>
                            <th class="funcao">Editar</th>
                            <th class="funcao">Excluir</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>

        </div>
    </div>






    <script src="script.js"></script>
</body>
</html>