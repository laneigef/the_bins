@extends('layouts.app')

@section('content')
<div class="main-panel">
      <!-- Navbar -->
      <nav class="navbar navbar-expand-lg navbar-absolute fixed-top navbar-transparent">
        <div class="container-fluid">
          <div class="navbar-wrapper">
            <div class="navbar-toggle">
              <button type="button" class="navbar-toggler">
                <span class="navbar-toggler-bar bar1"></span>
                <span class="navbar-toggler-bar bar2"></span>
                <span class="navbar-toggler-bar bar3"></span>
              </button>
            </div>
            <p class="navbar-brand">ビンゴカード</p>
          </div>
        </div>
      </nav>
      <div class="content">
        <div class="row">
          <div class="col-md-12">
            <div class="card">
              <div class="card-body">
                  <div class="row">
                    <div class="col-md-12">
                      <h5>ビンゴカードは以下</h5>
                      <div class="row bingo-row">
                        @foreach ($bingo_card->decode_card_array as $key => $value)
                        @if (!$bingo_card->chk_bingo[$key])
                        <div class="col-2-4">
                          <button class="btn btn-info btn-bingo-num" type="button">{{ $value }}</button>
                        </div>
                        @else
                        <div class="col-2-4">
                          <button class="btn btn-danger btn-bingo-num" type="button">{{ $value }}</button>
                        </div>
                        @endif
                        @endforeach
                      </div>
                      @if ($bingo_card->bingo_issuers->bingo_type === 1)
                      <h5>ビンゴ番号を指定</h5>
                      <div class="text-center">
                        <form action="{{ route('bingo.self_select') }}" method="POST">
                          @csrf
                          <select class="form-control" name="selected_num">
                            @foreach ($pickable_nums as $num)
                            <option value="{{ $num }}">{{ $num }}</option>
                            @endforeach
                          </select>
                          <input type="hidden" name="issuer_id" value="{{ $bingo_card->bingo_issuers_id }}">
                          <button class="btn btn-info" type="submit">この番号を指定する</button>
                        </form>
                      </div>
                      @endif
                    </div>
                  </div>
              </div>
          </div>
        </div>
      </div>
</div>
@endsection