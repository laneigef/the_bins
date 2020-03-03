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
            <a class="navbar-brand" href="{{ route('issuer.account') }}">アカウント情報変更</a>
          </div>
        </div>
      </nav>
      <div class="content">
        <div class="row">
          <div class="col-md-12">
            <div class="card">
              <div class="card-body">
                <form action="{{ route('issuer.account.update', ['issuer_id' => $bingo_issuer->id]) }}" method="post">
                  @csrf
                  <div class="row">
                    <div class="col-md-12">
                      <div class="form-group">
                        <label>ログインID</label>
                        <input type="text" class="form-control" name="login_id" value="{{ $bingo_issuer->login_id }}">
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-12">
                      <div class="form-group">
                        <label>パスワード</label>
                        <input type="password" class="form-control" name="password" placeholder="変更する場合のみ入力してください">
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-12">
                      <div class="form-group">
                        <label>ビンゴカード側でビンゴ数字を指定するのを許可する</label>
                        <select class="form-control" name="bingo_type">
                          <option value="1" @if ($bingo_issuer->bingo_type === 1) selected @endif>はい</option>
                          <option value="0" @if ($bingo_issuer->bingo_type === 0) selected @endif>いいえ</option>
                        </select>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-12">
                      <div class="form-group">
                        <label>特定のURLからビンゴカードを自動発行するのを許可する</label>
                        <select class="form-control" name="self_issue_flag">
                          <option value="1" @if ($bingo_issuer->self_issue_flag  === 1) selected @endif>はい</option>
                          <option value="0" @if ($bingo_issuer->self_issue_flag  === 0) selected @endif>いいえ</option>
                        </select>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="update ml-auto mr-auto">
                      <button type="submit" class="btn btn-primary btn-round">アカウント情報を変更する</button>
                    </div>
                  </div>
                </form>
                <form action="{{ route('issuer.account.delete', ['issuer_id' => $bingo_issuer->id]) }}" method="post">
                  @csrf
                  <div class="row">
                    <div class="update ml-auto mr-auto">
                      <button type="submit" class="btn btn-danger btn-round">アカウント自体を削除する</button>
                    </div>
                  </div>
                </form>
              </div>
          </div>
        </div>
      </div>
</div>
@endsection