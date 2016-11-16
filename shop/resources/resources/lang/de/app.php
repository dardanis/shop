<?php $translation=[];
$ids=DB::table('translations')->select('label', 'de')->get();


foreach($ids as $row)
{
    $translation[$row->label]=$row->de;
}

return $translation;