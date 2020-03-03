<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Lib\Bingo;
use App\BingoCards;
use App\BingoNumbers;

class BingoController extends Controller
{
    private $db_bingo_cards;
    private $db_bingo_nums;
    private $bingo;

    public function __construct(BingoCards $db_bingo_cards, 
                                BingoNumbers $db_bingo_nums, 
                                Bingo $bingo)
    {
    	$this->db_bingo_cards = $db_bingo_cards;
        $this->db_bingo_nums = $db_bingo_nums;
    	$this->bingo = $bingo;

    }

    public function issue($encrypt_id)
    {
    	// 発行者IDを復号し、カードを発行
        $encrypt_id = str_replace("\\", "/", $encrypt_id);
    	$bingo_issuers_id = openssl_decrypt($encrypt_id, 'BF-CBC', env('APP_KEY'), 0, env('OPENSSL_IV'));
    	$bingo_card = $this->db_bingo_cards->cardIssue($bingo_issuers_id);
    	$encrypt_card_id = openssl_encrypt($bingo_card->id, 'BF-CBC', env('APP_KEY').'card', 0, env('OPENSSL_IV'));
        $encrypt_card_id = str_replace("/", "\\", $encrypt_card_id);
        return redirect('/card/$encrypt_card_id');
    }

    public function card($encrypt_card_id)
    {
    	$encrypt_card_id = str_replace("\\", "/", $encrypt_card_id);
    	$bingo_card_id = openssl_decrypt($encrypt_card_id, 'BF-CBC', env('APP_KEY').'card', 0, env('OPENSSL_IV'));
    	$bingo_card = BingoCards::find($bingo_card_id);
    	$bingo_card->decode_card_array = unserialize($bingo_card->card_array);
    	$bingo_card->chk_bingo = $this->bingo->chk_bingo($bingo_card);


        $pickable_nums = array();
        $bingo_nums = BingoNumbers::where('bingo_issuers_id', $bingo_card->bingo_issuers_id)->get();
        $bingo_nums->all_nums = $this->bingo->all_nums();
        $bingo_nums->selected_nums = $this->bingo->chk_nums($bingo_nums);

        foreach ($bingo_nums->selected_nums as $key => $value) {
            if ($value === false) {
                $pickable_nums[] = $key;
            }
        }
        return view('card/card', compact('bingo_card', 'pickable_nums'));
    }

    public function select_num(Request $request)
    {
        $issuer_id = $request->issuer_id;
        $selected = $this->db_bingo_nums->select_num($request, $issuer_id);
        return redirect(url()->previous());
    }

    public function signup()
    {
        return view('signup');
    }

    public function regist(Request $request)
    {
        dd($request->all());
    }
}
