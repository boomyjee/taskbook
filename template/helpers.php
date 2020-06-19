<?php

function _e($str) {
    return htmlentities($str);
}

function url($relative_url) {
    return INDEX_URL."/".$relative_url;
}