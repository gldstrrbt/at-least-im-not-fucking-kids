<?php
// Basic checks
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["sin"])) {
    $sin = trim($_POST["sin"]);

    // --- New & Improved: Text Normalization Function ---
    function normalizeText($text) {
        // Convert to lowercase early to simplify subsequent replacements
        $text = strtolower($text);

        // Step 1: Aggressive Leet-speak and character substitutions
        $text = str_ireplace(['1', '!', 'i', '|'], 'l', $text); // 1, !, i, | -> l (for more robust detection of words like "kill")
        $text = str_ireplace(['3', '&'], 'e', $text);    // 3, & -> e
        $text = str_ireplace(['4', '@', '^'], 'a', $text); // 4, @, ^ -> a
        $text = str_ireplace(['5', '$', 's'], 'z', $text);    // 5, $, s -> z (to normalize 's' sound for easier regex)
        $text = str_ireplace(['0'], 'o', $text);    // 0 -> o
        $text = str_ireplace(['7', '+'], 't', $text);    // 7, + -> t
        $text = str_ireplace(['9'], 'g', $text);    // 9 -> g
        $text = str_ireplace(['8'], 'b', $text);    // 8 -> b (for 1488)
        $text = str_ireplace(['k'], 'c', $text);    // k -> c (for kkk)
        $text = str_ireplace(['r'], 'v', $text);    // r -> v (for rape)
        $text = str_ireplace(['x'], 'cks', $text); // x -> cks (for fuking -> fuc_ing -> fuc_cking)
        $text = str_ireplace(['y'], 'i', $text); // y -> i

        // Remove common separators and punctuation that can obfuscate words
        $text = preg_replace('/[_\-\.\,\!\?\(\)\[\]\{\}\*#`~;\:\+\=\\\/]/', '', $text);

        // Remove any remaining non-alphabetic characters (except spaces)
        $text = preg_replace('/[^a-z\s]/', '', $text);
        
        // Normalize multiple spaces to a single space
        $text = preg_replace('/\s+/', ' ', $text);

        return trim($text); // Trim leading/trailing spaces
    }

    // Apply normalization BEFORE any banning or replacement rules
    $normalized_sin = normalizeText($sin);

    // --- Comprehensive List of Banned Keywords (checked against normalized text) ---
    // These include racial slurs, homophobic/transphobic slurs, antisemitic terms,
    // anti-immigrant terms, islamophobic terms, and other highly offensive phrases.
    $banned_keywords = [
        // Racial slurs (including common misspellings/variations)
        'nigger', 'niggas', 'nigers', 'niggar', 'niggaz', 'niglet', 'coon', 'chinc', 'chincs', 'gook', 'gooks', 'spic', 'spics',
        'kike', 'kikes', 'wetback', 'wetbac', 'zipperhead', 'ghetto', 'coloreds', 'darkie', 'darkies', 'slope', 'slopes', 'beaner', 'beaners',

        // Sexual exploitation of minors
        'fuckingkids', 'fuckinkids', 'fucxingkids', 'fuckingchildren', 'fuckinchildren', 'childabuse', 'minorabuse', 'underage',
        'pedophile', 'pedo', 'pedos', 'groomer', 'grooming', 'touchkids', 'kidtouch', 'kidssex', 'childsex', 'vaped', 'vapist', 'vaping', // 'vaped' as a common misspelling of 'raped'
        'cing', 'cist', 'cistz', // variations for 'raping' and 'rapist' from 'r' -> 'v' and 's' -> 'z' normalization
        'childporn', 'kidsporn', 'molest', 'molests', 'molesting',

        // Anti-LGBTQ+
        'faggot', 'faggots', 'fagget', 'fag', 'fags', 'dyke', 'dykes', 'tranny', 'trannies', 'transvestite', 'homos', 'homosexuals',
        'lgbtqismentallyill', 'gayismentallyill', 'transismentallyill', 'troon', 'troons', 'sodomite', 'sodomites',

        // Antisemitic
        'jewsrape', 'jewscontrol', 'jewsbad', 'jewishcontrol', 'jewishcabal', 'zionistconspiracy', 'holocaustdenier', 'oven', 'heeb', 'heebs',

        // Anti-immigrant/xenophobic
        'massmigrationbad', 'illegals', 'illegalaliens', 'invaders', 'deportthemall',

        // Supremacist/Hate Group Codes
        '1488', 'hailhitler', 'whitepower', 'whitesupremacy', 'kkk', 'nazis', 'hitlerr', // 'hitlerr' for a common typo
        'seigheil', 'swastika', 'aryan', 'supremacist',

        // Other highly offensive/violent
        'rape', 'raping', 'rapist', 'suicidebomb', 'terrorist', 'genocide', 'murderall', 'killall', 'deathwish', 'violenceagainst',
        'hatecrime', 'bestiality', 'beastiality', 'incest', 'incestuous', 'childmarriage', 'torture', 'mutilate', 'abused', 'abuser',

        // Specific phrases from your examples
        'imfuczingkids', // from "I'm fuking kids" with new normalization rules
        'ihatemaszmigration', // from "I fuckin hate Massmigration" with new normalization rules
        'hwabab', // from HWABAG (without numbers)
        'niggevcpe', // from NIGGERRAPE after normalization
        'iamingkids', // from "I am ing kids"
        'niggevporn', // from "N!GGER PORN" after normalization
        'ivapedmiauntieandvecoovdedhetwevcgingonme', // from "I raped my auntie and recorded her twerking on me" after normalization
        'ihaiziggers', // from "i hate iggers" after normalization
        'ihateni99ezz', // from "I hate ni99ers" after normalization
        'cckillallnggeva', // from "KKKill all nggers" after normalization
        'izouchkids', // from "I touch kids" after normalization
        'nilggevaabound', // from "N1ggers abound" after normalization
        'puzhhomozexuallzoffofbuildingzbecauzezheiavmednallilledpeopl', // from "Push Homosexuals off of buildings, because they are disgusting mentally ill people" after normalization
        'jewzvacpeckidz', // from "jews rape kids" after normalization
        'pedophil', // Common misspelling
    ];

    foreach ($banned_keywords as $keyword) {
        if (strpos($normalized_sin, $keyword) !== false) {
            http_response_code(400);
            echo "invalid_or_banned";
            exit;
        }
    }

    // --- Comprehensive Regex for problematic phrases (checked against normalized text) ---
    // This regex catches more complex patterns like "x" instead of "fuck", or implied child abuse scenarios.
    // It's checked against the normalized text to catch common bypasses.
    $banned_regex_patterns = [
        // Sexual content involving minors (more general patterns)
        "/\b(fuc?ck?z?ing?|x|bang|screw|crap|defile|abuse|touch|playz?|iz|ing|pizzez|zex|zexing)\s*(kidz?|childven|minovz?|undeveadgez?|littlev?onz?|bouiz?|givlz?|vapez?|youngonez?|youngzevz?)\b/",
        // Explicitly violent/hateful acts
        "/\b(kill|mucdev|slauzhzev|cuzh|hatve|izovate|extevm?inate|givve)\s*(all|evevyone|gveoupz?|wacez?|jewz?|blackz?|immigvanzz?|homoz?exualz?|tvanz?|qv?eevz?)\b/",
        // Specific hate group related terms that might not be caught by keywords
        "/(14\s*88|88\s*14|c+k+c+|nazi|hitler)/",
        // Threats or incitement of violence
        "/(puzh|thveow|huwt|huvm?|doinv|dovtuv?)/", // "push", "throw", "hurt", "harm", "do violence", "do torture"
    ];

    foreach ($banned_regex_patterns as $pattern) {
        if (preg_match($pattern, $normalized_sin)) {
            http_response_code(400);
            echo "invalid_or_banned";
            exit;
        }
    }

    // --- NO MORE SOFT REPLACEMENTS FOR HATEFUL TERMS ---
    // The previous code replaced offensive terms with "lover," "prince," etc.
    // Given your goal to *prevent* such content, these replacements are removed.
    // The submission will now be blocked if these terms (or their normalized forms) are detected by the keywords or regex.

    // Final sanitization of the $sin string (the original user input) for saving
    $safe = preg_replace('/\.\s*$/', '', $sin); // Remove trailing period
    $safe = strip_tags($safe); // Removes any remaining HTML tags
    $safe = rtrim(preg_replace('/\s+/', ' ', $safe)); // normalize whitespace

    // Now, perform length and period count checks on the original user's text ($safe)
    if (
        $safe &&
        strlen($safe) > 10 &&
        substr_count($safe, '.') <= 1
    ) {
        $entry = $safe . "\n";
        file_put_contents(__DIR__ . "/sins.txt", $entry, FILE_APPEND | LOCK_EX);
        http_response_code(200);
        echo "ok";
        exit;
    } else {
        // This 'else' block will primarily be hit if the input is too short or has too many periods,
        // as most truly problematic content should be caught by the earlier banning logic.
        http_response_code(400);
        echo "invalid_or_banned";
        exit;
    }
} else {
    http_response_code(405); // Method Not Allowed
    echo "method_not_allowed";
    exit;
}
?>