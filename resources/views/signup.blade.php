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
            <a class="navbar-brand" href="{{ route('signup') }}">ビンゴ発行者登録/ログイン</a>
          </div>
        </div>
      </nav>
      <div class="content">
        <div class="row">
          <div class="col-md-12">
            <div class="card">
              <div class="card-body">
                <p class="navbar-brand">ログイン</p>
                <form method="POST" action="{{ route('login') }}">
                        @csrf
                        <div class="row">
                          <div class="col-md-12">
                            <div class="form-group">
                              <label>ログインID</label>
                              <input id="login_id" type="login_id" class="form-control @error('login_id') is-invalid @enderror" name="login_id" value="{{ old('login_id') }}" required autocomplete="login_id" autofocus>
                            </div>
                          </div>
                        </div>
                        <div class="row">
                          <div class="col-md-12">
                            <div class="form-group">
                              <label>パスワード</label>
                              <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
                            </div>
                          </div>
                        </div>
                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('ログイン') }}
                                </button>
                            </div>
                        </div>
                    </form>
                    <p class="navbar-brand">新規登録</p>
                    <form method="POST" action="{{ route('regist') }}">
                        @csrf
                        <div class="row">
                          <div class="col-md-12">
                            <div class="form-group">
                              <label>ログインID</label>
                              <input type="text" class="form-control" name="login_id" value="" required="">
                            </div>
                          </div>
                        </div>
                        <div class="row">
                          <div class="col-md-12">
                            <div class="form-group">
                              <label>パスワード</label>
                              <input type="password" class="form-control" name="password" value="" required="">
                            </div>
                          </div>
                        </div>
                        <div class="row">
                          <div class="col-md-12">
                            <div class="form-group">
                              <label>ビンゴカード側でビンゴ数字を指定するのを許可する</label>
                              <select class="form-control" name="bingo_type" required="">
                                <option value="1">はい</option>
                                <option value="0">いいえ</option>
                              </select>
                            </div>
                          </div>
                        </div>
                        <div class="row">
                          <div class="col-md-12">
                            <div class="form-group">
                              <label>特定のURLからビンゴカードを自動発行するのを許可する</label required="">
                              <select class="form-control" name="self_issue_flag">
                                <option value="1">はい</option>
                                <option value="0">いいえ</option>
                              </select>
                            </div>
                          </div>
                        </div>
                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('登録') }}
                                </button>
                            </div>
                        </div>
                    </form>
              </div>
          </div>
        </div>
      </div>
    </div>
@endsection