<?php

function highlightSearch($text, $search)
{
    if (!$search || !$text) {
        return htmlspecialchars($text, ENT_QUOTES, 'UTF-8'); // Prevents XSS
    }

    // Normalize and split search terms
    $terms = explode(' ', trim($search));
    $patterns = [];

    foreach ($terms as $term) {
        if (!empty($term)) {
            // Create a regex pattern that matches both accented and non-accented versions
            $patterns[] = createAccentInsensitiveRegex($term);
        }
    }

    if (empty($patterns)) {
        return htmlspecialchars($text, ENT_QUOTES, 'UTF-8');
    }

    // Create regex pattern to match all search words
    $regex = '/' . implode('|', $patterns) . '/iu';

    // Highlight matched words
    return preg_replace($regex, '<span style="background-color: yellow;">$0</span>', $text);
}

/**
 * Create an accent-insensitive regex pattern for a word
 */
function createAccentInsensitiveRegex($word)
{
    $accentedMap = [
        'a' => '[aàáâãäåāăąǎ]',
        'c' => '[cçćĉċč]',
        'e' => '[eèéêëēĕėęě]',
        'i' => '[iìíîïĩīĭįı]',
        'n' => '[nñńņňŉ]',
        'o' => '[oòóôõöøōŏő]',
        'u' => '[uùúûüũūŭůűų]',
        'y' => '[yýÿŷ]'
    ];

    $pattern = '';
    for ($i = 0; $i < mb_strlen($word); $i++) {
        $char = mb_substr($word, $i, 1);
        $pattern .= $accentedMap[$char] ?? preg_quote($char, '/');
    }

    return $pattern;
}
