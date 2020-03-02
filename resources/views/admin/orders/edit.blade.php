@extends('app')

@section('content')

    <div class="container">

        <h2>Pedido #{{ $order->id }} - R$ {{ $order->total }}</h2>
        <h3>Cliente: {{ $order->client->user->name }}</h3>
        <h4>Data: {{ $order->created_at }}</h4>

        <p>
            Entregar em: <br>
            <b>{{ $order->client->address }} - {{ $order->client->city }} - {{ $order->client->state }}</b>
        </p>
        <br>

        {!! Form::model($order, ['route' => ['admin.orders.update', $order->id]]) !!}

        <div class="form-group">
            {!! Form::label('status', 'Status:') !!}
            {!! Form::select('status', $list_status, null, ['class'=>'form-control']) !!}
        </div>

        <div class="form-group">
            {!! Form::label('user_deliveryman_id', 'Entregador:') !!}
            {!! Form::select('user_deliveryman_id', $deliveryMan, null, ['class'=>'form-control']) !!}
        </div>

        <div class="form-group">
            {!! Form::submit('Salvar categoria', ['class' => 'btn btn-primary']) !!}
        </div>

        {!! Form::close() !!}

        @include('errors._check')




    </div>

@endsection