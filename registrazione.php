<?php 
include('config.php'); 

$errore = "";
$successo = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username']);
    $email = trim($_POST['email']);
    $password = $_POST['password'];

    if (!empty($username) && !empty($email) && !empty($password)) {
        $stmt = $db->prepare("SELECT id FROM utenti WHERE username = ? OR email = ?");
        $stmt->bind_param("ss", $username, $email);
        $stmt->execute();
        $stmt->store_result();

        if ($stmt->num_rows > 0) {
            $errore = "Username o Email già registrati!";
        } else {
            $password_criptata = password_hash($password, PASSWORD_BCRYPT);
            
            $ins = $db->prepare("INSERT INTO utenti (username, email, password) VALUES (?, ?, ?)");
            $ins->bind_param("sss", $username, $email, $password_criptata);
            
            if ($ins->execute()) {
                $successo = "Registrazione completata! Puoi fare il login.";
            } else {
                $errore = "Errore durante la registrazione. Riprova.";
            }
            $ins->close();
        }
        $stmt->close();
    } else {
        $errore = "Compila tutti i campi!";
    }
}
?>
<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <title>NVXS | Registrati</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>@import url('https://fonts.googleapis.com/css2?family=Archivo:ital,wght@0,900;1,900&display=swap');</style>
</head>
<body class="bg-white text-black" style=\"font-family: 'Archivo', sans-serif;\">
    <?php include('header.php'); ?>

    <main class="max-w-md mx-auto px-6 py-20">
        <h1 class="text-5xl font-black uppercase italic mb-8 border-b-4 border-black pb-4 text-center">Registrati</h1>
        
        <?php if(!empty($errore)): ?>
            <div class="bg-red-100 border-l-4 border-red-600 text-red-700 p-4 mb-6 font-bold uppercase text-xs"><?php echo $errore; ?></div>
        <?php endif; ?>
        <?php if(!empty($successo)): ?>
            <div class="bg-green-100 border-l-4 border-green-600 text-green-700 p-4 mb-6 font-bold uppercase text-xs"><?php echo $successo; ?></div>
        <?php endif; ?>

        <form action="registrazione.php" method="POST" class="flex flex-col gap-6">
            <div class="flex flex-col">
                <label class="text-[10px] font-black uppercase mb-1 tracking-widest text-gray-400">Username</label>
                <input type="text" name="username" required class="border-b-2 border-black bg-transparent py-2 font-bold uppercase text-sm outline-none focus:border-red-600 transition-colors">
            </div>

            <div class="flex flex-col">
                <label class="text-[10px] font-black uppercase mb-1 tracking-widest text-gray-400">Email</label>
                <input type="email" name="email" required class="border-b-2 border-black bg-transparent py-2 font-bold uppercase text-sm outline-none focus:border-red-600 transition-colors">
            </div>

            <div class="flex flex-col">
                <label class="text-[10px] font-black uppercase mb-1 tracking-widest text-gray-400">Password</label>
                <input type="password" name="password" required class="border-b-2 border-black bg-transparent py-2 font-bold text-sm outline-none focus:border-red-600 transition-colors">
            </div>

            <button type="submit" class="w-full bg-black text-white py-4 font-black uppercase italic hover:bg-gray-800 transition transform hover:-translate-y-1 shadow-lg mt-4">
                Crea Account
            </button>
        </form>
        
        <p class="text-center text-xs uppercase font-bold text-gray-400 mt-6">
            Hai già un account? <a href="login.php" class="text-black underline font-black">Accedi qui</a>
        </p>
    </main>

    <?php include('footer.php'); ?>
</body>
</html>