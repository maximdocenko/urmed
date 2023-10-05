<?php

function meta($meta, $key) {
    foreach ($meta as $item) {
        if($item->key == $key) {
            return $item->value;
        }
    }
    return '';
}
