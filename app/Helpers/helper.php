<?php

function langs()
{
    $langs = ['ar', 'en'];
    return $langs;
}

function getDepartments()
{
    return \App\Department::latest()->get();
}