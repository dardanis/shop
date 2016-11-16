<?php $translation=[];
$ids=DB::table('translations')->select('label', 'fr')->get();


foreach($ids as $row)
{
    $translation[$row->label]=$row->fr;
}

return $translation;