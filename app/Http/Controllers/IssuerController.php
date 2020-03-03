<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Lib\Bingo;
use App\User;
use App\BingoCards;
use App\BingoNumbers;

class IssuerController extends Controller
{
	private $db_bingo_issuers;
    private $db_bingo_cards;
    private $db_bingo_nums;
    private $bingo;

    public function __construct(User $db_bingo_issuers, 
    							BingoCards $db_bingo_cards, 
    							BingoNumbers $db_bingo_nums, 
    							Bingo $bingo)
    {
    	$this->db_bingo_issuers = $db_bingo_issuers;
    	$this->db_bingo_cards = $db_bingo_cards;
    	$this->db_bingo_nums = $db_bingo_nums;
    	$this->bingo = $bingo;

    }

    public function index()
    {
    	// 管理画面ポータル
    	$bingo_cards = BingoCards::where('bingo_issuers_id', Auth::id())->paginate(10);
    	foreach ($bingo_cards as $bingo_card) {
    		$bingo_card->key = openssl_encrypt($bingo_card->id, 'BF-CBC', env('APP_KEY').'card', 0, env('OPENSSL_IV'));
    		$bingo_card->key = str_replace("/", "\\", $bingo_card->key);
    	}
    	
    	return view('issuer.index', compact('bingo_cards'));
    }

    public function delete_card(Request $request)
    {
    	// 発行済みのビンゴカードを削除する
    	$delete_id = $request->delete_id;
    	$bingo_card_issuer = BingoCards::select('bingo_issuers_id')->where('id', $delete_id)->first()->bingo_issuers_id;
    	if ($bingo_card_issuer === Auth::id()) {
    		BingoCards::find($delete_id)->delete();
    	}

    	return redirect(url()->previous());
    }

    public function number()
    {
    	// 発行したビンゴカードに対してビンゴの抽選番号を設定する
    	$bingo_nums = BingoNumbers::where('bingo_issuers_id', Auth::id())->get();
    	$bingo_nums->all_nums = $this->bingo->all_nums();
    	$bingo_nums->selected_nums = $this->bingo->chk_nums($bingo_nums);

    	return view('issuer.number', compact('bingo_nums'));
    }

    public function select_num(Request $request)
    {
    	// 抽選番号処理
    	$issuer_id = Auth::id();
    	$selected = $this->db_bingo_nums->select_num($request, $issuer_id);
    	return redirect(url()->previous());
    }

    public function account()
    {
    	// アカウント情報
    	$bingo_issuer = Auth::user();
    	return view('issuer.account', compact('bingo_issuer'));
    }

    public function account_update(Request $request, $issuer_id)
    {
    	// アカウント情報変更
    	if ($issuer_id == Auth::id()) {
    		$this->db_bingo_issuers->update_issuer($request);
    		return redirect()->route('issuer.account');
    	}
    }

    public function account_delete(Request $request, $issuer_id)
    {
    	if ($issuer_id == Auth::id()) {
    		User::find(Auth::id())->delete();
    		return redirect('/');
    	}

    }
}
