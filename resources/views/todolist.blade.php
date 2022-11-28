<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ URL::asset('css/app.css')}}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <title>Todo List</title>
    <script src="https://code.jquery.com/jquery-3.6.1.min.js" 
    integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script>
</head>

<body class="body" onload="getTasks()">
    <div class="container">
        <div class="center-screen">
            <div class="row">
                <div class="col-4">
                    <form>
                        <div class="form-group">
                            <i class="bi bi-arrow-right-circle-fill"></i>
                            <label for="taskInput" class="text">To Do List</label>
                            <div class="input-group">
                                <span class="input-group-addon"><i class="glyphicon glyphicon-plus"></i></span>
                                <input type="text" class="form-control" id="taskInput" id="inputSuccess2" aria-describedby="emailHelp" placeholder="Digite nova tarefa">
                            </div>
                        </div>
                    </form>
                    <div class="input-group">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-ok"></i></span>
                        <button type="btn btn-primary" onClick="saveTask()" class="buttonAdd">Adcionar</button>
                    </div>
                </div>
                <div class="col-7 offset-1">
                    <div class="input-group">
                        <i class="	glyphicon glyphicon-list-alt" style="font-size: 2em;"></i>
                        <span class="tarefas" style="margin-left: 70px;">Tarefas</span>
                    </div>
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col"><i class="glyphicon glyphicon-asterisk"></i></th>
                                <th scope="col">Nomes</th>
                            </tr>
                        </thead>
                        <tbody>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="modal" id="edtionModal" tabindex="-1" role="dialog" aria-labelledby="edtionModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="edtionModalLabel">Editar Tarefa</h5>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="form-group">
                            <input type="hidden" id="task-id">
                            <label for="task-description" class="col-form-label">Nome:</label>
                            <input type="text" class="form-control" id="task-description">
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secundary" data-bs-dismiss="modal">Fechar<span class="glyphicon glyphicon-remove"></button>
                    <button type="button" class="btn btn-primary" onclick="editTask()">Salvar<span class="glyphicon glyphicon-bookmark"></button>
                </div>
            </div>
        </div>
    </div>
    <script>
        //READ - GET
        
        function getTasks() {
            $.ajax(
                {
                    type: "GET",
                    url: "/todolist",
                    success: function(data) {
                        console.log(data);
                        const table = document.getElementsByTagName("tbody")[0];
                        table.innerHTML = "";
                        if (data.length === 0) {
                            const row = table.insertRow(0);
                            const cell = row.insertCell(0);
                            cell.innerHTML = "Sem Tarefas Salvas";
                        } else {
                            for (let index = 0; index < data.length; index++) {
                                const row = table.insertRow(index);
                                const cell1 = row.insertCell(0);
                                const cell2 = row.insertCell(1);
                                const cell3 = row.insertCell(2);
                                const cell4 = row.insertCell(3);
                                cell1.innerHTML = data[index].id;
                                cell2.innerHTML = data[index].name;
                                cell3.innerHTML = `<button class="btn btn-primary" onclick="openModal(\'${data[index].id}\', \'${data[index].name}\')">Editar<span class="glyphicon glyphicon-pencil"></button>`;
                                cell4.innerHTML = `<button class="btn btn-danger" onclick="deleteTask(${data[index].id})">Excluir<span class="glyphicon glyphicon-trash"></button>`;
                            }
                        }
                    }
                }
            )
        }
        function saveTask() {
            const todo = document.getElementById("taskInput").value;
            if (todo.trim().length === 0) {
                return alert("Por favor, Insira a Tarefa");
            }
            $.ajax(
                {
                type: "POST",
                url: "/todolist",
                data: {
                    name: todo
                },
                success: function() {
                    getTasks();
                },
                error: function(data){
                    alert(`Error ${JSON.stringify(data)}`);
                }
            });
        }
        function deleteTask(id, name) {
            $.ajax({
                type: "DELETE",
                url: `/todolist/${id}`,
                success: function(){
                    getTasks();
                },
                error: function(data){
                    alert(`Error ${JSON.stringify(data)}`);
                }
                });
        }
        function openModal(id, name) {
            $('#edtionModal').modal('show');
            $('#task-id').val(id);
            $('#task-description').val(name);
        }
        function editTask () {
            const idTask = $("#task-id").val();
            const nameTask = $("#task-description").val();
            if (nameTask.trim().length === 0) {
                return alert("Por favor, Insira a Tarefa");
            }
            $.ajax({
                type: "PUT",
                url: `/todolist/${idTask}`,
                data: {
                    name: nameTask
                }, 
                success: function() {
                    getTasks();
                }
                // error: function(data) {
                //     alert(`Error ${JSON.stringify(data)}`);
                // }
            });
        }
        </script>
</body>
</html>