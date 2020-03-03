@extends('issuer.app')

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
            <a class="navbar-brand" href="{{ route('issuer.number') }}">ビンゴ番号指定</a>
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
                        <h5>以下の番号をクリック</h5>
                        <div class="row">
                        @foreach ($bingo_nums->all_nums as $key => $value)
                        @if (!$bingo_nums->selected_nums[$key])
                        <div class="col-0-8">
                          <form action="{{ route('bingo.select') }}" method="POST">
                            @csrf
                            <input type="hidden" name="selected_num" value="{{ $value }}">
                            <button class="btn btn-info" type="submit">{{ $value }}</button>
                          </form>
                        </div>
                        @else
                        <div class="col-0-8">
                          <form action="{{ route('bingo.select') }}" method="POST">
                            @csrf
                            <input type="hidden" name="selected_num" value="{{ $value }}">
                            <button class="btn btn-danger" type="submit">{{ $value }}</button>
                          </form>
                        </div>
                        @endif
                        @endforeach
                      </div>
                    </div>
                  </div>
              </div>
          </div>
        </div>
      </div>
</div>
@endsection