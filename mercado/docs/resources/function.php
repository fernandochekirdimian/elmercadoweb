<?php
function rot13($string, $mode) {
    $s = fopen("php://memory", "rwb");
    stream_filter_append($s, "string.rot13", STREAM_FILTER_WRITE);
    fwrite($s, $string);
    rewind($s);
    return stream_get_contents($s);
}
