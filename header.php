<?php
$conteggio_carrello = isset($_SESSION['carrello']) ? array_sum($_SESSION['carrello']) : 0;
?>
<nav class="border-b p-6 flex justify-between items-center sticky top-0 bg-white z-50">
    <a href="index.php" class="text-3xl font-black italic tracking-tighter uppercase">NVXS</a>
    
    <div class="hidden md:flex space-x-10 font-bold uppercase text-xs tracking-widest">
        <a href="index.php" class="hover:text-gray-500 transition-colors">Home</a>
        <a href="sneakers.php" class="hover:text-green-600 transition-colors">Sneakers</a>
        <a href="pokemon.php" class="hover:text-blue-600 transition-colors">Pokémon</a>
    </div>
    
    <div class="flex items-center gap-6 font-bold text-xs uppercase">
        <div class="hidden lg:block border border-black px-4 py-2">
            <?php echo date("d M Y"); ?>
        </div>
        
        <div class="flex gap-4 items-center tracking-widest">
            <?php if (isset($_SESSION['user_username'])): ?>
                <span class="text-gray-400 font-medium">Ciao, <b class="text-black font-black italic"><?php echo htmlspecialchars($_SESSION['user_username']); ?></b></span>
                
				<a href="dashboard_offerte.php" class="border border-black px-3 py-2 font-black hover:bg-black hover:text-white transition-colors text-[10px] tracking-wider">
					Gestione Offerte
				</a>
				
                <a href="carrello.php" class="bg-black text-white px-3 py-2 font-black hover:bg-gray-800 transition-colors text-[10px] tracking-wider flex items-center gap-1">
                    Carrello 
                </a>
                
                <a href="logout.php" class="bg-red-600 text-white px-3 py-2 font-black hover:bg-red-700 transition-colors text-[10px]">Logout</a>
            <?php else: ?>
                <a href="login.php" class="hover:underline font-black">Login</a>
                <span class="text-gray-300">/</span>
                <a href="registrazione.php" class="hover:underline font-black text-gray-500">Registrati</a>
            <?php endif; ?>
        </div>
    </div>
</nav>