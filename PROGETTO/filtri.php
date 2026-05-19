<?php
$categoria_per_filtri = (basename($_SERVER['PHP_SELF']) == 'sneakers.php') ? 'sneaker' : 'pokemon';
$brands_unici = array_unique(array_column(array_filter($prodotti, function($p) use ($categoria_per_filtri) {
    return $p['type'] == $categoria_per_filtri;
}), 'brand'));
?>

<div class="bg-gray-50 border-b">
    <form method="GET" action="<?php echo $_SERVER['PHP_SELF']; ?>" class="max-w-7xl mx-auto px-6 py-8 flex flex-wrap gap-8 items-end">
        
        <div class="flex flex-col min-w-[200px]">
            <label class="text-[10px] font-black uppercase mb-2 tracking-widest text-gray-400">Seleziona Brand</label>
            <select name="modello" class="border-b-2 border-black bg-transparent py-2 font-bold uppercase text-sm outline-none">
                <option value="">Tutti i Brand</option>
                <?php foreach($brands_unici as $b): ?>
                    <option value="<?php echo $b; ?>" <?php echo ($_GET['modello'] ?? '') == $b ? 'selected' : ''; ?>><?php echo $b; ?></option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="flex flex-col">
            <label class="text-[10px] font-black uppercase mb-2 tracking-widest text-gray-400">Range Prezzo (€)</label>
            <div class="flex items-center gap-2">
                <input type="number" name="min_price" placeholder="Min" 
                       value="<?php echo $_GET['min_price'] ?? ''; ?>" 
                       class="w-24 border-b-2 border-black bg-transparent py-2 font-bold text-sm outline-none">
                <span class="font-bold text-gray-400">-</span>
                <input type="number" name="max_price" placeholder="Max" 
                       value="<?php echo $_GET['max_price'] ?? ''; ?>" 
                       class="w-24 border-b-2 border-black bg-transparent py-2 font-bold text-sm outline-none">
            </div>
        </div>

        <div class="flex flex-col min-w-[180px]">
            <label class="text-[10px] font-black uppercase mb-2 tracking-widest text-gray-400">Ordina Per</label>
            <select name="ordine" class="border-b-2 border-black bg-transparent py-2 font-bold uppercase text-sm outline-none">
                <option value="">Default</option>
                <option value="prezzo_asc" <?php echo ($_GET['ordine'] ?? '') == 'prezzo_asc' ? 'selected' : ''; ?>>Prezzo: Crescente</option>
                <option value="prezzo_desc" <?php echo ($_GET['ordine'] ?? '') == 'prezzo_desc' ? 'selected' : ''; ?>>Prezzo: Decrescente</option>
            </select>
        </div>

        <div class="flex items-center gap-6 ml-auto">
            <button type="submit" class="bg-black text-white px-10 py-3 font-black uppercase italic hover:bg-gray-800 transition transform hover:-translate-y-1 shadow-lg text-sm">
                Filtra Risultati
            </button>
            <a href="<?php echo $_SERVER['PHP_SELF']; ?>" class="text-xs font-black uppercase tracking-widest text-gray-400 hover:text-black underline">Reset</a>
        </div>
    </form>
</div>