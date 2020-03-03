@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <div class="row">
                    @foreach ($bingo_card->decode_card_array as $key => $value)
                        @if (!$bingo_card->chk_bingo[$key])
                        <div class="col-2-4 rounded-circle bg-dafult">{{ $value }}</div>
                        @else
                        <div class="col-2-4 rounded-circle bg-atari">{{ $value }}</div>
                        @endif
                    @endforeach
                    </div>

                    <!-- {{ var_dump($bingo_card->decode_card_array) }} -->
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
