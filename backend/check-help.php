<?php 
session_start();
function generateUniqueId()
{
    return bin2hex(random_bytes(6));
}

function getOrCreateUniqueId()
{
    $uniqueId = $_SESSION['nano'] ?? null;

    if (!$uniqueId) {
        $uniqueId = generateUniqueId();
        $_SESSION['nano'] = $uniqueId;
    }

    return $uniqueId;
}

$cstId = getOrCreateUniqueId();
?>