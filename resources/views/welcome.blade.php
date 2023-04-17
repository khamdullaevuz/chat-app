@extends('layouts.app')
@section('content')
<div class="container mt-4">
    <div class="card">
        <div class="card-body">
            <form action="{{route('chat')}}">
            <div class="form-group mb-2">
                <label for="message">Enter name</label>
                <div class="input-group">
                    <input name="name" type="text" id="message" class="form-control">
                    <button type="submit" class="btn btn-primary" id="send">Enter chat</button>
                </div>
            </div>
            </form>
        </div>
    </div>
</div>
@endsection
