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
            <a class="navbar-brand" href="{{ route('issuer.index') }}">発行済みカード一覧</a>
          </div>
        </div>
      </nav>
      <div class="content">
        <div class="row">
          <div class="col-md-12">
            <div class="card">
              <!-- <div class="card-header"> -->
                <!-- <h4 class="card-title"> Simple Table</h4> -->
              <!-- </div> -->
              <div class="card-body">
                  <div class="row">
                    <div class="col-md-12">
                        <div class="d-flex justify-content-center text-center">
                            {{ $bingo_cards->links() }}
                        </div>
                        <div class="text-center">
                            <p>{{ $bingo_cards->total().'件中　'.$bingo_cards->firstItem().'-'.$bingo_cards->lastItem().'件表示' }}</p>
                        </div>
                        <table class="table text-center">
                            <tr>
                                <th class="text-center">ユニークID</th>
                                <th class="text-center">発行日時</th>
                                <th class="text-center">表示</th>
                                <th class="text-center">削除</th>
                            </tr>
                            @foreach($bingo_cards as $bingo_card)
                            <tr>
                                <td>{{ $bingo_card->key }}</td>
                                <td>{{ $bingo_card->created_at}}</td>
                                <td>
                                    <a href="{{ route('bingo.card', ['encrypt_card_id' => $bingo_card->key]) }}" target="_blank">
                                        <button type="button" class="btn btn-info">表示</button>
                                    </a>
                                </td>
                                <td>
                                    <form action="{{ route('bingo.delete') }}" method="POST">
                                        @csrf
                                        <input type="hidden" name="delete_id" value="{{ $bingo_card->id }}">
                                        <button class="btn btn-danger" type="submit">削除</button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </table>
                        <div class="d-flex justify-content-center text-center">
                            {{ $bingo_cards->links() }}
                        </div>
                    </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
</div>
@endsection