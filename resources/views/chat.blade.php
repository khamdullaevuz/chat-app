@extends('layouts.app')
@section('content')
<div class="container mt-4">
    <h4 class="text-center">{{$name}}</h4>
    <div class="card">
        <div class="card-body">
            <div class="form-group mb-2">
                <label for="message">Message</label>
                <div class="input-group">
                    <input type="text" id="message" class="form-control">
                    <button type="button" class="btn btn-primary" id="send">Send</button>
                </div>
            </div>
            <h5>Messages:</h5>
            <div id="messages"></div>
            <button type="button" class="btn btn-danger" id="clear">Clear</button>
        </div>
    </div>
</div>
@endsection
@section('scripts')
<script>
    const socket = new WebSocket('{{ config('services.websocket.host') }}');
    socket.onopen = function() {
        console.log("Соединение установлено.");
    };
    socket.onclose = function(event) {
        if (event.wasClean) {
            console.log('Соединение закрыто чисто');
        } else {
            console.log('Обрыв соединения');
        }
        console.log('Код: ' + event.code + ' причина: ' + event.reason);
    };
    socket.onmessage = function(event) {
        const data = JSON.parse(event.data);
        console.log("Получены данные " + data.message);
        $("#messages").append("<p class=\"justify-content-start\"><b>("+ data.name +")</b> " + data.message + "</p>");
    };
    socket.onerror = function(error) {
        console.log("Ошибка " + error.message);
    };
    $("#send").click(function () {
        const message = $("#message").val();
        const data = {
            message: message,
            name: '{{ $name }}'
        };
        socket.send(JSON.stringify(data));
        $("#messages").append("<p class=\"justify-content-end\"><b>(me)</b> " + message + "</p>");
        $("#message").val("");
    });
    $("#clear").click(function () {
        $("#messages").html("");
    });
    $("#message").keypress(function (e) {
        if (e.which === 13) {
            $("#send").click();
            return false;
        }
    });
</script>
@endsection
