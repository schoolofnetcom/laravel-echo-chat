@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Escolha uma das salas abaixo</div>

                    <div class="panel-body">
                        @foreach($rooms as $room)
                            <ul class="list-group">
                                <li class="list-group-item">
                                    <a href="{{ route('chat.rooms.show', ['id' => $room->id])  }}">
                                        {{ $room->name  }}
                                    </a>
                                </li>
                            </ul>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
