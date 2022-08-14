<?php

function search_strings($haystack, $needle){
    $search = strpos($haystack, $needle);
    $search = strval($search);
    $search = ($search === '0')? true : $search;
    if($search){
        return true;
    }else{
        return false;
    }
}




