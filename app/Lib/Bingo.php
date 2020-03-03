<?php 

namespace App\Lib;

use App\BingoNumbers;
use Carbon\Carbon;

class Bingo
{
  public function make_card($bingo_card)
  {
    mt_srand($bingo_card->id);
 
    $number_array = array();
    for ($i = 0; $i < 5; $i++) {
        for ($j = 0; $j < 5; $j++) {
        	// 25マスビンゴのルールで範囲を指定
            $min_number = $j * 15 + 1; 
            $max_number = $j * 15 + 15;

            // mr_randの結果が重複したら使わない
            // 参考：https://pisuke-code.com/php-create-non-overlap-randoms/
            while(true){
                $number = mt_rand($min_number, $max_number);
                if (!in_array($number, $number_array)) {
                	$index = count($number_array);
                	$index = (string)$index + 1;
                	$number_array["$index"] = $number;
                    break;
                }
            }
        }
    }
    return $number_array;
  }

  public function chk_bingo($bingo_card)
  {
  	// 該当ビンゴ発行者が指定している当選番号に当たっているかを判定
  	$chk_result = array();
  	foreach ($bingo_card->decode_card_array as $key => $value) {
  		$chk = BingoNumbers::where('bingo_issuers_id', $bingo_card->bingo_issuers_id)
  							->where('bingo_number', $value)
  							->exists();
  		if ($chk) {
  			$chk_result[$key] = $chk;
  		} else {
  			$chk_result[$key] = false;
  		}
  	}

  	return $chk_result;
  }

  public function all_nums()
  {
    $nums_array = array();
    for ($i = 1; $i < 76; $i++) {
      $nums_array[(string)$i] = $i;
    }

    return $nums_array;
  }

  public function chk_nums($bingo_nums)
  {
    $chk_result = array();
    $bingo_issuers_id = $bingo_nums->first()->bingo_issuers_id;
    foreach ($bingo_nums->all_nums as $key => $value) {
      $chk = BingoNumbers::where('bingo_issuers_id', $bingo_issuers_id)
                ->where('bingo_number', $value)
                ->exists();
      if ($chk) {
        $chk_result[$key] = $chk;
      } else {
        $chk_result[$key] = false;
      }
    }
    return $chk_result;

  }

}