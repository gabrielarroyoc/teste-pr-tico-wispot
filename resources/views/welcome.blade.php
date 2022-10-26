<?php
// include_once("conexao.php");
// $table_eventos = "SELECT id, name, description, time, start_time, end_time, recurrence FROM table_eventos";
// $table_eventos = mysqli_query($conn, $table_eventos);
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset='utf-8' />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <link href='css/fullcalendar.min.css' rel='stylesheet' />
    <link href='css/fullcalendar.print.min.css' rel='stylesheet' media='print' />
    <link href='css/personalizado.css' rel='stylesheet' />
    <script src='js/moment.min.js'></script>
    <script src='js/jquery.min.js'></script>
    <script src='js/fullcalendar.min.js'></script>
    <script src='locale/pt-br.js'></script>
    <script>
        $(document).ready(function() {
            $('#calendar').fullCalendar({
                header: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'month,agendaWeek,agendaDay'
                },
                defaultDate: Date(),
                initialView: 'timeGridWeek',
                navLinks: true,
                editable: true,
                eventLimit: true,
                events: [
                    @foreach($agendamentos as $agendamento) {
                        id: '{{$agendamento->id}}',
                        title: '{{$agendamento->name}}',
                        start: '{{$agendamento->time}}T{{$agendamento->start_time}}',
                        end: '{{$agendamento->time}}T{{$agendamento->end_time}}',
                        color: '#ffff00',
                        textColor: "#000",
                        display: 'inverse-background'
                    },
                    @endforeach {

                    }
                ]
            });
        });
    </script>
</head>

<body>
    <div id='calendar'></div>

    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif


    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Criação de atividade esportiva</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="{{route('criar-evento')}}">
                        @csrf
                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">Eventos</label>
                            <input name="evento" type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                        </div>
                        <div class="mb-3">
                            <div class="form-floating">
                                <textarea name="descricao" class="form-control" placeholder="Leave a comment here" id="floatingTextarea2" style="height: 100px"></textarea>
                                <label for="floatingTextarea2">Descrição</label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <div class="mb-3">
                                    <label for="exampleInputEmail1" class="form-label">De:</label>
                                    <input name="data" type="date" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                                </div>
                                <div class="row">
                                    <div class="col-6">
                                        <div class="mb-3">
                                            <label for="exampleInputEmail1" class="form-label">Início:</label>
                                            <input name="inicio" type="time" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="mb-3">
                                            <label for="exampleInputEmail1" class="form-label">Término:</label>
                                            <input name="fim" type="time" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col">
                                <div class="mb-3 form-check">
                                    <div class="form-check">
                                        <input name="check_repete" class="form-check-input" type="radio" id="flexRadioDefault1">
                                        <label class="form-check-label" for="flexRadioDefault1">
                                            Não se repete
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input name="check_repete" class="form-check-input" type="radio" id="flexRadioDefault2" checked>
                                        <label class="form-check-label" for="flexRadioDefault2">
                                            Repetir
                                        </label>

                                    </div>
                                    <label for="customRange2" id="customRange2label" class="form-label">Intervalo de semanas: 1</label>
                                    <input oninput="UpdateRange(this)" name="intervalo_semanas" type="range" value="1" class="form-range" min="1" max="5" id="customRange2">
                                </div>
                            </div>
                        </div>
                        <div class="d-flex justify-content-end">
                            <button type="submit" class="btn btn-primary">Salvar</button>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>
    <center>
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
            Criar atividade esportiva
        </button>
    </center>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
    <script>
        const range = document.querySelector("#customRange2label");

        function UpdateRange(newRange) {
            range.innerText = "Intervalo de semanas: " + newRange.value;
        }
    </script>
</body>

</html>