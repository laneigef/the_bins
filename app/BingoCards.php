<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Lib\Bingo;

class BingoCards extends Model
{
    //
    use SoftDeletes;

    protected $fillable = [
        'card_array', 'bingo_issuers_id',
    ];

    public function bingo_issuers()
    {
        return $this->belongsTo('App\User');
    }

    public function cardIssue($bingo_issuers_id)
    {
    	$bingo_card = BingoCards::create([
            'card_array' => 'tmp',
            'bingo_issuers_id' => $bingo_issuers_id,
        ]);

        // 作ったビンゴの配列を保存
        $b = new Bingo();
        $bingo_card->card_array = serialize($b->make_card($bingo_card));
        $bingo_card->save();

       return $bingo_card;
    }
}
