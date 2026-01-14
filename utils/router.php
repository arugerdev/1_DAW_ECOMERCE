<?php

function is_url($compareUrl)
{
    return $compareUrl == get_current_url();
}

function get_current_url()
{
    return $_SERVER["REQUEST_URI"];
}
