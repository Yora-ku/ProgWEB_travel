<?php
function base_url($path = '') {
    return "http://localhost/PHP/travel_gani/" . ltrim($path, '/');
}

function asset_url($path = '') {
    return base_url('asset/' . ltrim($path, '/'));
}
