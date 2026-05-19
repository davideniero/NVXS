<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$db_host = "localhost";
$db_user = "root";
$db_pass = "";
$db_name = "test"; 

$db = new mysqli($db_host, $db_user, $db_pass, $db_name);

if ($db->connect_error) {
    die("Connessione al database fallita: " . $db->connect_error);
}
$prodotti = [
    1 => [
        "type" => "sneaker", "brand" => "Jordan", "model" => "1 Retro High OG Chicago", "price" => 445,
        "desc" => "La sneaker più iconica di sempre, nella colorazione originale del 1985.",
        "img" => "https://images.stockx.com/360/Air-Jordan-1-Retro-High-OG-Chicago-Reimagined/Images/Air-Jordan-1-Retro-High-OG-Chicago-Reimagined/Lv2/img01.jpg?auto=compress&w=480"
    ],
    2 => [
        "type" => "sneaker", "brand" => "Nike", "model" => "Dunk Low Panda", "price" => 115,
        "desc" => "Semplice, versatile e intramontabile. La scarpa perfetta per ogni outfit.",
        "img" => "https://images.stockx.com/360/Nike-Dunk-Low-White-Black-2021-W/Images/Nike-Dunk-Low-White-Black-2021-W/Lv2/img01.jpg?auto=compress&w=480"
    ],
    3 => [
        "type" => "sneaker", "brand" => "Jordan", "model" => "4 Retro Military Black", "price" => 480,
        "desc" => "Una silhouette classica in una colorazione pulita ed elegante.",
        "img" => "https://images.stockx.com/360/Air-Jordan-4-Retro-Military-Black/Images/Air-Jordan-4-Retro-Military-Black/Lv2/img01.jpg?auto=compress&w=480"
    ],
    4 => [
        "type" => "sneaker", "brand" => "Jordan", "model" => "1 Retro High Travis Scott", "price" => 1650,
        "desc" => "Swoosh invertito e materiali premium per la collaborazione più cercata.",
        "img" => "https://images.stockx.com/360/Air-Jordan-1-Retro-High-Travis-Scott/Images/Air-Jordan-1-Retro-High-Travis-Scott/Lv2/img01.jpg?auto=compress&w=480"
    ],
    5 => [
        "type" => "sneaker", "brand" => "Adidas", "model" => "Yeezy Boost 350 V2 Beluga", "price" => 320,
        "desc" => "L'unione tra il comfort Boost e il design visionario di Kanye West.",
        "img" => "images/img1.png"
    ],
    6 => [
        "type" => "sneaker", "brand" => "Nike", "model" => "Air Max 1 Travis Scott Cactus Corp", "price" => 410,
        "desc" => "Un design outdoor ispirato al trail running con il tocco di Cactus Jack.",
        "img" => "images/img2.png"
    ],
    7 => [
        "type" => "sneaker", "brand" => "Jordan", "model" => "1 Retro High Dior", "price" => 7500,
        "desc" => "Il punto d'incontro definitivo tra luxury fashion e streetwear.",
        "img" => "https://images.stockx.com/360/Air-Jordan-1-Retro-High-Dior/Images/Air-Jordan-1-Retro-High-Dior/Lv2/img01.jpg?auto=compress&w=480"
    ],
    8 => [
        "type" => "sneaker", "brand" => "Nike", "model" => "Dunk Low Off-White Lot 1", "price" => 1200,
        "desc" => "Dalla collezione 'The 50', il Lot 1 si distingue per la suola vintage.",
        "img" => "https://images.stockx.com/360/Nike-Dunk-Low-Off-White-Lot-1/Images/Nike-Dunk-Low-Off-White-Lot-1/Lv2/img01.jpg?auto=compress&w=480"
    ],
    9 => [
        "type" => "sneaker", "brand" => "New Balance", "model" => "550 White Grey", "price" => 140,
        "desc" => "Un classico del basket anni '80 tornato prepotentemente di moda.",
        "img" => "https://images.stockx.com/360/New-Balance-550-White-Grey/Images/New-Balance-550-White-Grey/Lv2/img01.jpg?auto=compress&w=480"
    ],
    10 => [
        "type" => "sneaker", "brand" => "Jordan", "model" => "3 Retro A Ma Maniére", "price" => 620,
        "desc" => "Dettagli di lusso e materiali premium per questa collab acclamata.",
        "img" => "https://images.stockx.com/360/Air-Jordan-3-Retro-A-Ma-Maniere-W/Images/Air-Jordan-3-Retro-A-Ma-Maniere-W/Lv2/img01.jpg?auto=compress&w=480"
    ],
    11 => [
        "type" => "sneaker", "brand" => "Nike", "model" => "Air Force 1 Low Off-White", "price" => 1500,
        "desc" => "La leggendaria versione di Virgil Abloh della AF1.",
        "img" => "https://images.stockx.com/360/Nike-Air-Force-1-Low-Off-White/Images/Nike-Air-Force-1-Low-Off-White/Lv2/img01.jpg?auto=compress&w=480"
    ],
    12 => [
        "type" => "sneaker", "brand" => "Jordan", "model" => "4 Retro Union Off Noir", "price" => 890,
        "desc" => "Linguetta ripiegata e mix di materiali unico nel suo genere.",
        "img" => "https://images.stockx.com/360/Air-Jordan-4-Retro-Union-Off-Noir/Images/Air-Jordan-4-Retro-Union-Off-Noir/Lv2/img01.jpg?auto=compress&w=480"
    ],
    13 => [
        "type" => "sneaker", "brand" => "Adidas", "model" => "Yeezy Slide Bone", "price" => 160,
        "desc" => "Il massimo della comodità estiva con il design minimalista Yeezy.",
        "img" => "https://images.stockx.com/360/adidas-Yeezy-Slide-Bone-2022/Images/adidas-Yeezy-Slide-Bone-2022/Lv2/img01.jpg?auto=compress&w=480"
    ],
    14 => [
        "type" => "sneaker", "brand" => "Nike", "model" => "SB Dunk Low Travis Scott", "price" => 1800,
        "desc" => "Texture bandana e inserti in flanella per questa icona SB.",
        "img" => "https://images.stockx.com/360/Nike-SB-Dunk-Low-Travis-Scott/Images/Nike-SB-Dunk-Low-Travis-Scott/Lv2/img01.jpg?auto=compress&w=480"
    ],
    15 => [
        "type" => "sneaker", "brand" => "Jordan", "model" => "1 Low Fragment x Travis Scott", "price" => 1400,
        "desc" => "Il trio perfetto: Jordan, Hiroshi Fujiwara e Travis Scott.",
        "img" => "images/img3.png"
    ],
    16 => [
        "type" => "sneaker", "brand" => "Nike", "model" => "Air Max 97 Sean Wotherspoon", "price" => 1100,
        "desc" => "Velluto a coste colorato ispirato ai cappellini vintage degli anni '80.",
        "img" => "https://images.stockx.com/360/Nike-Air-Max-1-97-Sean-Wotherspoon-NA/Images/Nike-Air-Max-1-97-Sean-Wotherspoon-NA/Lv2/img01.jpg?auto=compress&w=480"
    ],
    17 => [
        "type" => "sneaker", "brand" => "New Balance", "model" => "2002R Protection Pack", "price" => 290,
        "desc" => "Design 'distrutto' e qualità costruttiva superiore.",
        "img" => "images/img4.png"
    ],
    18 => [
        "type" => "sneaker", "brand" => "Jordan", "model" => "11 Retro Gratitude", "price" => 230,
        "desc" => "L'eleganza del patent leather incontra la storia del basket.",
        "img" => "images/img5.png"
    ],
    19 => [
        "type" => "sneaker", "brand" => "Nike", "model" => "Dunk Low SB Jarritos", "price" => 550,
        "desc" => "Ispirata alla celebre bevanda messicana, con materiali personalizzabili.",
        "img" => "https://images.stockx.com/360/Nike-SB-Dunk-Low-Jarritos/Images/Nike-SB-Dunk-Low-Jarritos/Lv2/img01.jpg?auto=compress&w=480"
    ],
    20 => [
        "type" => "sneaker", "brand" => "Jordan", "model" => "4 Retro Black Cat", "price" => 900,
        "desc" => "Total black opaco per una delle Jordan 4 più amate di sempre.",
        "img" => "https://images.stockx.com/360/Air-Jordan-4-Retro-Black-Cat-2020/Images/Air-Jordan-4-Retro-Black-Cat-2020/Lv2/img01.jpg?auto=compress&w=480"
    ],
    21 => [
        "type" => "sneaker", "brand" => "Nike", "model" => "Sacai LDWaffle Pine Green", "price" => 580,
        "desc" => "Doppia suola, doppio Swoosh, doppio divertimento.",
        "img" => "images/img6.png"
    ],
    22 => [
        "type" => "sneaker", "brand" => "Adidas", "model" => "Yeezy Boost 700 Waverunner", "price" => 450,
        "desc" => "La scarpa che ha dato inizio al trend delle 'Dad Shoes'.",
        "img" => "images/img7.png"
    ],
    23 => [
        "type" => "sneaker", "brand" => "Jordan", "model" => "1 Retro High University Blue", "price" => 410,
        "desc" => "Ispirata ai colori dell'università di Michael Jordan, la UNC.",
        "img" => "https://images.stockx.com/360/Air-Jordan-1-Retro-High-White-University-Blue-Black/Images/Air-Jordan-1-Retro-High-White-University-Blue-Black/Lv2/img01.jpg?auto=compress&w=480"
    ],
    24 => [
        "type" => "sneaker", "brand" => "Nike", "model" => "Air Force 1 Low Tiffany & Co.", "price" => 1350,
        "desc" => "Un tocco di alta gioielleria sull'icona delle strade di New York.",
        "img" => "images/img8.png"
    ],
    25 => [
        "type" => "sneaker", "brand" => "Jordan", "model" => "5 Retro Off-White Black", "price" => 720,
        "desc" => "Design tecnico e oblò sulla tomaia per questa rilettura di Virgil.",
        "img" => "https://images.stockx.com/360/Air-Jordan-5-Retro-Off-White-Black/Images/Air-Jordan-5-Retro-Off-White-Black/Lv2/img01.jpg?auto=compress&w=480"
    ],
    26 => [
        "type" => "sneaker", "brand" => "Nike", "model" => "Vaporwaffle Sacai Black Gum", "price" => 400,
        "desc" => "L'evoluzione della collaborazione Sacai con suola waffle raddoppiata.",
        "img" => "images/img9.png"
    ],
    27 => [
        "type" => "sneaker", "brand" => "Adidas", "model" => "Campus 00s Grey White", "price" => 110,
        "desc" => "Estetica chunky ispirata allo skate dei primi anni 2000.",
        "img" => "https://images.stockx.com/360/adidas-Campus-00s-Grey-White/Images/adidas-Campus-00s-Grey-White/Lv2/img01.jpg?auto=compress&w=480"
    ],
    28 => [
        "type" => "sneaker", "brand" => "Jordan", "model" => "4 Retro Pine Green SB", "price" => 540,
        "desc" => "La prima Jordan 4 ottimizzata per lo skateboard.",
        "img" => "https://images.stockx.com/360/Air-Jordan-4-Retro-SB-Pine-Green/Images/Air-Jordan-4-Retro-SB-Pine-Green/Lv2/img01.jpg?auto=compress&w=480"
    ],
    29 => [
        "type" => "sneaker", "brand" => "Nike", "model" => "Dunk Low SB Chunky Dunky", "price" => 1600,
        "desc" => "Ispirata al gelato Ben & Jerry's, una delle Dunk più folli mai fatte.",
        "img" => "https://images.stockx.com/360/Nike-SB-Dunk-Low-Ben-Jerrys-Chunky-Dunky/Images/Nike-SB-Dunk-Low-Ben-Jerrys-Chunky-Dunky/Lv2/img01.jpg?auto=compress&w=480"
    ],
    30 => [
        "type" => "sneaker", "brand" => "Jordan", "model" => "1 Retro High Lost and Found", "price" => 430,
        "desc" => "L'effetto vintage che simula un ritrovamento in un vecchio magazzino.",
        "img" => "https://images.stockx.com/360/Air-Jordan-1-Retro-High-OG-Chicago-Reimagined/Images/Air-Jordan-1-Retro-High-OG-Chicago-Reimagined/Lv2/img01.jpg?auto=compress&w=480"
    ],
    31 => [
        "type" => "sneaker", "brand" => "Jordan", "model" => "1 Retro High OG 85 Georgetown", "price" => 320,
        "desc" => "Un omaggio alle origini del basket collegiale con colori classici e forma fedele all'originale.",
        "img" => "https://images.stockx.com/360/Air-Jordan-1-Retro-High-85-Georgetown/Images/Air-Jordan-1-Retro-High-85-Georgetown/Lv2/img01.jpg?auto=compress&w=480"
    ],
    32 => [
        "type" => "sneaker", "brand" => "Nike", "model" => "Dunk Low Grey Fog", "price" => 180,
        "desc" => "L'alternativa elegante alla Panda. Toni grigi neutri per un look pulito.",
        "img" => "https://images.stockx.com/360/Nike-Dunk-Low-Grey-Fog/Images/Nike-Dunk-Low-Grey-Fog/Lv2/img01.jpg?auto=compress&w=480"
    ],
    33 => [
        "type" => "sneaker", "brand" => "Adidas", "model" => "Yeezy Boost 350 V2 Zebra", "price" => 310,
        "desc" => "Una delle colorazioni più iconiche della linea Yeezy, caratterizzata dal pattern zebrato.",
        "img" => "images/img10.png"
    ],
    34 => [
        "type" => "sneaker", "brand" => "Jordan", "model" => "4 Retro Lightning", "price" => 350,
        "desc" => "Un ritorno esplosivo dal 2006. Giallo vibrante che non passa inosservato.",
        "img" => "https://images.stockx.com/360/Air-Jordan-4-Retro-Lightning-2021/Images/Air-Jordan-4-Retro-Lightning-2021/Lv2/img01.jpg?auto=compress&w=480"
    ],
    35 => [
        "type" => "sneaker", "brand" => "Nike", "model" => "Air Max 1 Patta Waves Monarch", "price" => 380,
        "desc" => "La collaborazione con Patta che ha introdotto il design a onde sulla mudguard.",
        "img" => "images/img11.png"
    ],
    36 => [
        "type" => "sneaker", "brand" => "New Balance", "model" => "990v3 JJJJound Olive", "price" => 650,
        "desc" => "Estetica minimalista e qualità costruttiva impeccabile 'Made in USA'.",
        "img" => "https://images.stockx.com/360/New-Balance-990v3-JJJJound-Olive/Images/New-Balance-990v3-JJJJound-Olive/Lv2/img01.jpg?auto=compress&w=480"
    ],
    37 => [
        "type" => "sneaker", "brand" => "Jordan", "model" => "1 Retro High Spider-Man Origin Story", "price" => 700,
        "desc" => "Celebra l'uscita del film 'Into the Spider-Verse' con dettagli riflettenti.",
        "img" => "images/img12.png"
    ],
    38 => [
        "type" => "sneaker", "brand" => "Nike", "model" => "Sacai x VaporWaffle Sesame", "price" => 420,
        "desc" => "Un mix di texture e colori terra per questa silhouette raddoppiata di Chitose Abe.",
        "img" => "images/img13.png"
    ],
    39 => [
        "type" => "sneaker", "brand" => "Jordan", "model" => "11 Retro Cherry", "price" => 250,
        "desc" => "Il classico patent leather si tinge di un rosso ciliegia brillante su base bianca.",
		"img" => "images/img14.png"
    ],
    40 => [
        "type" => "sneaker", "brand" => "Adidas", "model" => "Yeezy 500 Blush", "price" => 290,
        "desc" => "Design chunky ispirato agli anni '90 con ammortizzazione Adiprene.",
        "img" => "https://images.stockx.com/360/adidas-Yeezy-500-Blush/Images/adidas-Yeezy-500-Blush/Lv2/img01.jpg?auto=compress&w=480"
    ],
    41 => [
        "type" => "sneaker", "brand" => "Nike", "model" => "Dunk Low Jackie Robinson", "price" => 330,
        "desc" => "Dedicata alla leggenda del baseball, con dettagli ricamati e messaggi motivazionali.",
        "img" => "https://images.stockx.com/360/Nike-Dunk-Low-Jackie-Robinson/Images/Nike-Dunk-Low-Jackie-Robinson/Lv2/img01.jpg?auto=compress&w=480"
    ],
    42 => [
        "type" => "sneaker", "brand" => "Jordan", "model" => "3 Retro White Cement Reimagined", "price" => 310,
        "desc" => "La leggendaria colorazione del 1988 torna con un trattamento vintage.",
        "img" => "https://images.stockx.com/360/Air-Jordan-3-Retro-White-Cement-Reimagined/Images/Air-Jordan-3-Retro-White-Cement-Reimagined/Lv2/img01.jpg?auto=compress&w=480"
    ],
    43 => [
        "type" => "sneaker", "brand" => "Nike", "model" => "Air Force 1 Low Supreme White", "price" => 150,
        "desc" => "La classica AF1 bianca arricchita dall'iconico box logo rosso di Supreme.",
		"img" => "images/img15.png"
    ],
    44 => [
        "type" => "sneaker", "brand" => "New Balance", "model" => "1906R Protection Pack Black", "price" => 210,
        "desc" => "Stile runner tecnico anni 2000 rivisitato con pannelli a taglio vivo.",
		"img" => "images/img16.png"
    ],
    45 => [
        "type" => "sneaker", "brand" => "Jordan", "model" => "1 Retro High Trophy Room", "price" => 1800,
        "desc" => "Edizione limitatissima ispirata alla sala dei trofei di Michael Jordan.",
        "img" => "https://images.stockx.com/360/Air-Jordan-1-Retro-High-Trophy-Room-Chicago/Images/Air-Jordan-1-Retro-High-Trophy-Room-Chicago/Lv2/img01.jpg?auto=compress&w=480"
    ],
    46 => [
        "type" => "sneaker", "brand" => "Nike", "model" => "SB Dunk Low What The Paul", "price" => 550,
        "desc" => "Un mix folle di tutte le migliori colorazioni create per Paul Rodriguez.",
        "img" => "https://images.stockx.com/360/Nike-SB-Dunk-Low-What-The-P-Rod/Images/Nike-SB-Dunk-Low-What-The-P-Rod/Lv2/img01.jpg?auto=compress&w=480"
    ],
    47 => [
        "type" => "sneaker", "brand" => "Adidas", "model" => "Samba OG Cloud White", "price" => 120,
        "desc" => "La scarpa da calcio indoor diventata un pilastro del fashion globale.",
        "img" => "images/img21.png"
    ],
    48 => [
        "type" => "sneaker", "brand" => "Jordan", "model" => "4 Retro University Blue", "price" => 460,
        "desc" => "Tomaia interamente in suede azzurro per un look premium intramontabile.",
        "img" => "https://images.stockx.com/360/Air-Jordan-4-Retro-University-Blue/Images/Air-Jordan-4-Retro-University-Blue/Lv2/img01.jpg?auto=compress&w=480"
    ],
    49 => [
        "type" => "sneaker", "brand" => "Nike", "model" => "Air Max 90 Off-White Desert Ore", "price" => 950,
        "desc" => "Virgil Abloh reinterpreta la Air Max 90 in toni sabbia e dettagli fluo.",
        "img" => "https://images.stockx.com/360/Nike-Air-Max-90-Off-White-Desert-Ore/Images/Nike-Air-Max-90-Off-White-Desert-Ore/Lv2/img01.jpg?auto=compress&w=480"
    ],
    50 => [
        "type" => "sneaker", "brand" => "Jordan", "model" => "1 High 85 Black White", "price" => 340,
        "desc" => "Colorazione Panda su silhouette originale '85. Semplicità e storia.",
		"img" => "images/img17.png"
    ],
    51 => [
        "type" => "sneaker", "brand" => "Asics", "model" => "Gel-Kayano 14 JJJJound", "price" => 800,
        "desc" => "L'apice del trend 'Silver Runner' con la firma dei designer di Montreal.",
		"img" => "images/img18.png"
    ],
    52 => [
        "type" => "sneaker", "brand" => "Nike", "model" => "Kobe 6 Protro Reverse Grinch", "price" => 520,
        "desc" => "La leggendaria scarpa di Kobe Bryant in un'esplosione di rosso e dettagli verdi.",
        "img" => "https://images.stockx.com/360/Nike-Kobe-6-Protro-Reverse-Grinch/Images/Nike-Kobe-6-Protro-Reverse-Grinch/Lv2/img01.jpg?auto=compress&w=480"
    ],
    53 => [
        "type" => "sneaker", "brand" => "Jordan", "model" => "1 Low Travis Scott Black Phantom", "price" => 680,
        "desc" => "Look stealth total black con cuciture a contrasto bianche e logo ape.",
		"img" => "images/img19.png"
    ],
    54 => [
        "type" => "sneaker", "brand" => "Nike", "model" => "Dunk Low Rose Whisper", "price" => 140,
        "desc" => "Colorazione soft e primaverile per una delle Dunk femminili più amate.",
        "img" => "https://images.stockx.com/360/Nike-Dunk-Low-Rose-Whisper-W/Images/Nike-Dunk-Low-Rose-Whisper-W/Lv2/img01.jpg?auto=compress&w=480"
    ],
    55 => [
        "type" => "sneaker", "brand" => "Adidas", "model" => "Yeezy Boost 700 Analog", "price" => 260,
        "desc" => "Toni crema e bianco sporco per una versione elegante della 700.",
        "img" => "https://images.stockx.com/360/adidas-Yeezy-Boost-700-Analog/Images/adidas-Yeezy-Boost-700-Analog/Lv2/img01.jpg?auto=compress&w=480"
    ],
    56 => [
        "type" => "sneaker", "brand" => "Jordan", "model" => "2 Retro J Balvin", "price" => 280,
        "desc" => "Colori del cielo e luci LED sulla linguetta per la collab con la superstar latina.",
        "img" => "https://images.stockx.com/360/Air-Jordan-2-Retro-J-Balvin/Images/Air-Jordan-2-Retro-J-Balvin/Lv2/img01.jpg?auto=compress&w=480"
    ],
    57 => [
        "type" => "sneaker", "brand" => "Nike", "model" => "Air Presto Off-White", "price" => 1200,
        "desc" => "Comfort estremo e design industriale per questo capolavoro 'The Ten'.",
        "img" => "https://images.stockx.com/360/Nike-Air-Presto-Off-White/Images/Nike-Air-Presto-Off-White/Lv2/img01.jpg?auto=compress&w=480"
    ],
    58 => [
        "type" => "sneaker", "brand" => "New Balance", "model" => "9060 Sea Salt", "price" => 190,
        "desc" => "Silhouette futuristica e suola scultorea per il massimo del comfort moderno.",
        "img" => "https://images.stockx.com/360/New-Balance-9060-Sea-Salt/Images/New-Balance-9060-Sea-Salt/Lv2/img01.jpg?auto=compress&w=480"
    ],
    59 => [
        "type" => "sneaker", "brand" => "Jordan", "model" => "6 Retro Travis Scott British Khaki", "price" => 480,
        "desc" => "Tasche laterali e suola glow-in-the-dark per questa avventura nel deserto.",
        "img" => "https://images.stockx.com/360/Air-Jordan-6-Retro-Travis-Scott-British-Khaki/Images/Air-Jordan-6-Retro-Travis-Scott-British-Khaki/Lv2/img01.jpg?auto=compress&w=480"
    ],
    60 => [
        "type" => "sneaker", "brand" => "Nike", "model" => "Dunk Low Syracuse", "price" => 450,
        "desc" => "L'originale colorazione universitaria arancio e bianca degli anni '80.",
		"img" => "images/img20.png"
    ],


    101 => [
        "type" => "pokemon",
        "brand" => "Base Set",
        "model" => "Charizard 1st Ed. Shadowless",
        "price" => 12500,
        "desc" => "Il re indiscusso delle carte Pokémon. Questa versione Shadowless della prima edizione è il pezzo pregiato di ogni collezione.",
        "img" => "images/imgpok1.png"
    ],
    102 => [
        "type" => "pokemon",
        "brand" => "Neo Genesis",
        "model" => "Lugia Holo",
        "price" => 850,
        "desc" => "Dalle profondità delle Isole Vorticose, il leggendario Lugia nella sua apparizione più iconica nel set Neo Genesis.",
		"img" => "images/imgpok2.png"    ],
    103 => [
        "type" => "pokemon",
        "brand" => "Evolving Skies",
        "model" => "Rayquaza VMAX (Alt Art)",
        "price" => 420,
        "desc" => "Conosciuta come 'Moonbreon' o il drago supremo, è la carta più ricercata dell'era moderna di Spada e Scudo.",
		"img" => "images/imgpok3.png"
    ],
    104 => [
        "type" => "pokemon",
        "brand" => "Promo",
        "model" => "Ancient Mew",
        "price" => 150,
        "desc" => "Rilasciata originariamente per il secondo film Pokémon, scritta in un antico alfabeto runico.",
		"img" => "images/imgpok4.png"
    ],
    105 => [
        "type" => "pokemon",
        "brand" => "Team Rocket",
        "model" => "Dark Blastoise Holo",
        "price" => 280,
        "desc" => "Uno dei design più aggressivi e amati del set Team Rocket, un classico degli anni '90.",
		"img" => "images/imgpok5.png"    ],
    106 => [
        "type" => "pokemon",
        "brand" => "Celebrations",
        "model" => "Gold Star Umbreon",
        "price" => 95,
        "desc" => "La ristampa del 25° anniversario della leggendaria carta Gold Star del 2005.",
		"img" => "images/imgpok6.png"    ]
	];

$file_name = basename($_SERVER['PHP_SELF']);
if ($file_name == 'sneakers.php') {
    $categoria_attuale = 'sneaker';
} elseif ($file_name == 'pokemon.php') {
    $categoria_attuale = 'pokemon';
} else {
    $categoria_attuale = 'home';
}

$prodotti_filtrati = array_filter($prodotti, function($p) use ($categoria_attuale) {
    return $p['type'] == $categoria_attuale;
});

if (!empty($_GET['modello'])) {
    $prodotti_filtrati = array_filter($prodotti_filtrati, function($p) {
        return $p['brand'] == $_GET['modello'];
    });
}

if (!empty($_GET['min_price'])) {
    $prodotti_filtrati = array_filter($prodotti_filtrati, function($p) {
        return $p['price'] >= (int)$_GET['min_price'];
    });
}
if (!empty($_GET['max_price'])) {
    $prodotti_filtrati = array_filter($prodotti_filtrati, function($p) {
        return $p['price'] <= (int)$_GET['max_price'];
    });
}

$ordine = $_GET['ordine'] ?? '';
if ($ordine == 'prezzo_asc') {
    uasort($prodotti_filtrati, function($a, $b) { return $a['price'] <=> $b['price']; });
} elseif ($ordine == 'prezzo_desc') {
    uasort($prodotti_filtrati, function($a, $b) { return $b['price'] <=> $a['price']; });
}

$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
$prodotto = isset($prodotti[$id]) ? $prodotti[$id] : null;

$sneakers = array_filter($prodotti, function($p) { return $p['type'] == 'sneaker'; });
$pokemon = array_filter($prodotti, function($p) { return $p['type'] == 'pokemon'; });
?>

