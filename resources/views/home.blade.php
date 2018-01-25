@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard</div>
                <a href="/allarticle">管理後台</a><br>
                <a href="/allintern">首頁</a><br>

                <div class="panel-body">
                    You are logged in!
                </div>
                @if (session('msg'))
                <div>
                    {{ session('msg') }}
                </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
