<?php 
echo $company_info->id;
echo $company_info->name;
echo $company_info->company_flg;
?>

<a href="{{ url('test_follow', ['id' => $company_info->id]) }}">フォローをする</a>
