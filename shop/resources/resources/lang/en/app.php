<?php $translation=[];
$ids=DB::table('translations')->select('label', 'en')->get();


foreach($ids as $row)
{
    $translation[$row->label]=$row->en;
}

return $translation;