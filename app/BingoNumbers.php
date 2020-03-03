<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;

class BingoNumbers extends Model
{
    //
    use SoftDeletes;

    protected $fillable = [
        'bingo_number', 'bingo_issuers_id',
    ];

    public function select_num($request, $issuer_id)
    {
    	$selected_num = $request->selected_num;
    	$chk = BingoNumbers::where('bingo_number', $selected_num)->where('bingo_issuers_id', $issuer_id)->first();
    	$chk2 = BingoNumbers::withTrashed()->where('bingo_number', $selected_num)->where('bingo_issuers_id', $issuer_id)->first();
    	if ($chk) {
    		$chk->delete();
    	} elseif ($chk2) {
    		$chk2->restore();
    	} else {
    		BingoNumbers::create(['bingo_number' => $selected_num, 'bingo_issuers_id' => $issuer_id]);
    	}

       return true;
    }
}
