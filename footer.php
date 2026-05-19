<footer class="bg-white border-t mt-20">
    <div class="max-w-7xl mx-auto px-6 py-12">
        <div class="flex flex-col md:flex-row justify-between items-start gap-12">
            
            <div class="md:w-1/3">
                <a href="index.php" class="text-4xl font-black italic tracking-tighter uppercase mb-4 block">NVXS</a>
                <p class="text-sm font-bold text-gray-400 uppercase tracking-widest leading-relaxed">
                    Il marketplace definitivo per collezionisti di Sneakers e carte Pokémon. <br>
                    Authentic only. No compromises.
                </p>
            </div>

            <div class="grid grid-cols-2 gap-12 md:w-1/3">
                <div>
                    <h3 class="text-[10px] font-black uppercase text-gray-300 mb-4 tracking-[0.2em]">Shop</h3>
                    <ul class="space-y-2">
                        <li><a href="sneakers.php" class="text-xs font-black uppercase hover:text-green-600 transition">Sneakers</a></li>
                        <li><a href="pokemon.php" class="text-xs font-black uppercase hover:text-blue-600 transition">Pokémon</a></li>
                        <li><a href="#" class="text-xs font-black uppercase hover:text-gray-500 transition">Novità</a></li>
                    </ul>
                </div>
                <div>
                    <h3 class="text-[10px] font-black uppercase text-gray-300 mb-4 tracking-[0.2em]">Supporto</h3>
                    <ul class="space-y-2">
                        <li><a href="#" class="text-xs font-black uppercase hover:text-gray-500 transition">Spedizioni</a></li>
                        <li><a href="#" class="text-xs font-black uppercase hover:text-gray-500 transition">Autenticazione</a></li>
                        <li><a href="#" class="text-xs font-black uppercase hover:text-gray-500 transition">FAQ</a></li>
                    </ul>
                </div>
            </div>

            <div class="md:w-1/3 w-full">
                <h3 class="text-[10px] font-black uppercase text-gray-300 mb-4 tracking-[0.2em]">Newsletter</h3>
                <form class="flex border-b-2 border-black pb-2">
                    <input type="email" placeholder="IL TUO EMAIL" class="bg-transparent border-none outline-none font-bold text-xs uppercase w-full">
                    <button type="submit" class="font-black italic uppercase text-xs hover:text-gray-500">Iscriviti</button>
                </form>
                <div class="flex gap-6 mt-8">
                    <a href="https://www.instagram.com/" class="text-xs font-black uppercase hover:underline">Instagram</a>
                    <a href="https://discord.com/" class="text-xs font-black uppercase hover:underline">Discord</a>
                    <a href="https://x.com/?lang=it" class="text-xs font-black uppercase hover:underline">Twitter</a>
                </div>
            </div>
        </div>

        <div class="border-t border-gray-100 mt-12 pt-8 flex flex-col md:flex-row justify-between items-center gap-4">
            <p class="text-[10px] font-bold text-gray-400 uppercase">© <?php echo date("Y"); ?> NVXS Marketplace. All Rights Reserved.</p>
            <div class="flex gap-6">
                <a href="#" class="text-[10px] font-bold text-gray-400 uppercase hover:text-black">Privacy Policy</a>
                <a href="#" class="text-[10px] font-bold text-gray-400 uppercase hover:text-black">Terms of Service</a>
            </div>
        </div>
    </div>
</footer>