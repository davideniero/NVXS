<?php include('config.php'); ?>
<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <title>NVXS | Pokémon</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>@import url('https://fonts.googleapis.com/css2?family=Archivo:ital,wght@0,900;1,900&display=swap');</style>
</head>
<body class="bg-white" style="font-family: 'Archivo', sans-serif;">
    <?php include('header.php'); ?>
    <main class="max-w-7xl mx-auto px-6 py-12">
        <h1 class="text-6xl font-black uppercase italic mb-10 border-b-4 border-blue-600 pb-4">Pokémon</h1>
        <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
            <?php foreach($pokemon as $id_p => $p): ?>
                <a href="prodotto.php?id=<?php echo $id_p; ?>" class="block group">
                    <div class="border p-4 hover:shadow-2xl transition-all">
                        <div class="bg-blue-50 flex items-center justify-center h-56 mb-4 overflow-hidden">
                            <img src="<?php echo $p['img']; ?>" class="max-h-full group-hover:scale-110 transition duration-500">
                        </div>
                        <h2 class="font-black text-xl uppercase italic"><?php echo $p['brand']; ?></h2>
                        <p class="text-gray-400 text-xs font-bold mb-4"><?php echo $p['model']; ?></p>
                        <p class="text-2xl font-black text-blue-600">€<?php echo number_format($p['price'], 0, ',', '.'); ?></p>
                    </div>
                </a>
            <?php endforeach; ?>
        </div>
    </main>
</body>
</html>