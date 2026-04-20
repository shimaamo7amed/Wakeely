<?php

function api_lang()
{
    $lang = request()->header('Accept-Language', 'ar');

    return in_array($lang, ['ar', 'en']) ? $lang : 'ar';
}
