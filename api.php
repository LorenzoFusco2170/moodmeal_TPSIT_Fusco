<?php

//chiamata all'api pubblica
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type");
header("Content-Type: application/json; charset=utf-8");


if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(204);
    exit;
}

//solo metodo GET accettato
if ($_SERVER['REQUEST_METHOD'] !== 'GET') {
    http_response_code(405);
    echo json_encode(["error" => "Metodo non consentito. Usa GET."]);
    exit;
}

//database con le ricette
$ricette = [

    "felice" => [
        "emoji"        => "😄",
        "recipe"       => "Pasta al Pesto Genovese",
        "message"      => "Sei raggiante! Un piatto fresco e profumato come te.",
        "time_minutes" => 20,
        "difficulty"   => "facile",
        "servings"     => 2,
        "ingredients"  => [
            "160g spaghetti",
            "50g basilico fresco",
            "30g parmigiano",
            "20g pecorino",
            "2 spicchi aglio",
            "30g pinoli",
            "80ml olio EVO",
            "sale q.b."
        ],
        "steps" => [
            "Porta a ebollizione abbondante acqua salata e cuoci gli spaghetti al dente.",
            "Nel frullatore metti basilico, aglio, pinoli, parmigiano, pecorino e frulla.",
            "Aggiungi l'olio a filo fino a ottenere una crema liscia.",
            "Scola la pasta tenendo un po' di acqua di cottura.",
            "Condisci con il pesto, aggiungendo acqua di cottura se necessario.",
            "Servi subito con una foglia di basilico fresco."
        ]
    ],

    "stanco" => [
        "emoji"        => "😴",
        "recipe"       => "Pasta e Fagioli",
        "message"      => "Sei a pezzi? Questo piatto ti rimette in piedi senza sforzo.",
        "time_minutes" => 30,
        "difficulty"   => "facile",
        "servings"     => 2,
        "ingredients"  => [
            "160g pasta mista (ditaloni o spaghetti spezzati)",
            "400g fagioli borlotti in scatola",
            "2 spicchi aglio",
            "200g pomodori pelati",
            "rosmarino",
            "olio EVO",
            "sale e pepe"
        ],
        "steps" => [
            "Scalda l'olio in una pentola e fai soffriggere aglio e rosmarino.",
            "Aggiungi i pelati schiacciati e cuoci 5 minuti.",
            "Unisci i fagioli scolati e metà frullati (per cremosità).",
            "Aggiungi acqua calda fino a coprire, porta a bollore.",
            "Cala la pasta e cuoci nel brodo di fagioli.",
            "Servi con un filo d'olio a crudo e pepe macinato."
        ]
    ],

    "triste" => [
        "emoji"        => "😢",
        "recipe"       => "Risotto al Parmigiano con Burro",
        "message"      => "Un abbraccio in forma di piatto. Il burro risolve tutto.",
        "time_minutes" => 25,
        "difficulty"   => "media",
        "servings"     => 2,
        "ingredients"  => [
            "160g riso Carnaroli",
            "80g parmigiano grattugiato",
            "60g burro",
            "1 scalogno",
            "mezzo bicchiere vino bianco secco",
            "700ml brodo vegetale caldo",
            "sale q.b."
        ],
        "steps" => [
            "Sciogli metà burro in una casseruola e fai appassire lo scalogno tritato.",
            "Tosta il riso 2 minuti, poi sfuma con il vino bianco.",
            "Aggiungi il brodo caldo un mestolo alla volta, mescolando sempre.",
            "Dopo circa 18 minuti, spegni il fuoco.",
            "Manteca con il burro rimasto e il parmigiano, mescolando energicamente.",
            "Lascia riposare 2 minuti con il coperchio, poi servi."
        ]
    ],

    "arrabbiato" => [
        "emoji"        => "😡",
        "recipe"       => "Penne all'Arrabbiata",
        "message"      => "Sei infuocato? Sfogati sui peperoncini. Ci sta.",
        "time_minutes" => 20,
        "difficulty"   => "facile",
        "servings"     => 2,
        "ingredients"  => [
            "160g penne rigate",
            "400g pomodori pelati",
            "3 spicchi aglio",
            "2-4 peperoncini rossi (piccanti a piacere)",
            "olio EVO",
            "prezzemolo fresco",
            "sale q.b."
        ],
        "steps" => [
            "Cuoci le penne in abbondante acqua salata.",
            "In una padella scalda l'olio con aglio intero e peperoncini.",
            "Aggiungi i pelati schiacciati e cuoci a fuoco vivace 10 minuti.",
            "Elimina l'aglio intero (o lascialo se vuoi più carattere).",
            "Scola la pasta al dente e saltala nella salsa.",
            "Servi con prezzemolo fresco e altro peperoncino se sei ancora arrabbiato."
        ]
    ],

    "romantico" => [
        "emoji"        => "🥰",
        "recipe"       => "Tagliatelle al Tartufo e Burro",
        "message"      => "L'amore merita qualcosa di speciale. Il tartufo non mente.",
        "time_minutes" => 25,
        "difficulty"   => "media",
        "servings"     => 2,
        "ingredients"  => [
            "200g tagliatelle fresche all'uovo",
            "60g burro di ottima qualità",
            "40g parmigiano",
            "tartufo nero o pasta di tartufo",
            "sale fino",
            "pepe bianco"
        ],
        "steps" => [
            "Porta a bollore l'acqua salata per la pasta.",
            "In una padella scalda il burro a fiamma bassissima senza farlo colorire.",
            "Aggiungi la pasta di tartufo o lamelle sottili al burro.",
            "Cuoci le tagliatelle 2-3 minuti (fresche), scolale al dente.",
            "Saltale nella padella con burro al tartufo e parmigiano.",
            "Aggiungi acqua di cottura per mantecare, servi con pepe bianco e tartufo grattugiato."
        ]
    ],

    "avventuroso" => [
        "emoji"        => "🤠",
        "recipe"       => "Pasta con Tonno, Olive e Capperi",
        "message"      => "Spirito libero! Un piatto di mare che non ti aspetti.",
        "time_minutes" => 15,
        "difficulty"   => "molto facile",
        "servings"     => 2,
        "ingredients"  => [
            "160g spaghetti",
            "160g tonno al naturale in scatola",
            "80g olive taggiasche",
            "2 cucchiai capperi sotto sale",
            "400g pomodorini ciliegino",
            "2 spicchi aglio",
            "olio EVO",
            "origano",
            "peperoncino q.b."
        ],
        "steps" => [
            "Cuoci gli spaghetti in acqua salata.",
            "Dissala i capperi in acqua fredda per 5 minuti.",
            "In padella scalda l'olio con aglio e peperoncino.",
            "Aggiungi i pomodorini tagliati a metà e cuoci 5 minuti.",
            "Unisci tonno sgocciolato, olive e capperi.",
            "Scola la pasta e saltala nel sugo, aggiungi origano e servi."
        ]
    ]
];

//parametro ?mood=
$mood_raw = isset($_GET['mood']) ? trim($_GET['mood']) : '';
$mood     = strtolower($mood_raw);

if ($mood === '') {
    http_response_code(400);
    echo json_encode([
        "error"        => "Parametro 'mood' mancante.",
        "example"      => "api.php?mood=felice",
        "valid_moods"  => array_keys($ricette)
    ]);
    exit;
}

if (!array_key_exists($mood, $ricette)) {
    http_response_code(404);
    echo json_encode([
        "error"       => "Umore '{$mood}' non riconosciuto.",
        "valid_moods" => array_keys($ricette),
        "tip"         => "Prova con: felice, stanco, triste, arrabbiato, romantico, avventuroso"
    ]);
    exit;
}

//risposta
$result = $ricette[$mood];
$result["mood"]      = $mood;
$result["status"]    = "ok";
$result["generated"] = date("Y-m-d H:i:s");
$result["api_version"] = "1.0";

http_response_code(200);
echo json_encode($result, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
exit;
?>