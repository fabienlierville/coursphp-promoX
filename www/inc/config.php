<?php
function get_words(string $sentence, int $count = 10) :string {
    preg_match("/(?:\w+(?:\W+|$)){0,$count}/", $sentence, $matches);
    return $matches[0];
}