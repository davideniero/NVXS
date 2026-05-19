<?php 
include('config.php'); 

$errore = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $login_input = trim($_POST['login_input']);
    $password = $_POST['password'];

    if (!empty($login_input) && !empty($password)) {
        $stmt = $db->prepare("SELECT id, username, password FROM utenti WHERE username = ? OR email = ?");
        $stmt->bind_param("ss", $login_input, $login_input);
        $stmt->execute();
        $stmt->store_result();

        if ($stmt->num_rows > 0) {
            $stmt->bind_result($id, $username, $password_salvata);
            $stmt->fetch();

            if (password_verify($password, $password_salvata)) {
                $_SESSION['user_id'] = $id;
                $_SESSION['user_username'] = $username;
                
                header("Location: index.php");
                exit();
            } else {
                $errore = "Password errata!";
            }
        } else {
            $errore = "Nessun account trovato con queste credenziali!";
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
    <title>NVXS | Login</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>@import url('https://fonts.googleapis.com/css2?family=Archivo:ital,wght@0,900;1,900&display=swap');</style>
</head>
<body class="bg-white text-black" style=\"font-family: 'Archivo', sans-serif;\">
    <?php include('header.php'); ?>

    <main class="max-w-md mx-auto px-6 py-20">
        <h1 class="text-5xl font-black uppercase italic mb-8 border-b-4 border-black pb-4 text-center">Accedi</h1>
        
        <?php if(!empty($errore)): ?>
            <div class="bg-red-100 border-l-4 border-red-600 text-red-700 p-4 mb-6 font-bold uppercase text-xs"><?php echo $errore; ?></div>
        <?php endif; ?>

        <form action="login.php" method="POST" class="flex flex-col gap-6">
            <div class="flex flex-col">
                <label class="text-[10px] font-black uppercase mb-1 tracking-widest text-gray-400">Username o Email</label>
                <input type="text" name="login_input" required class="border-b-2 border-black bg-transparent py-2 font-bold uppercase text-sm outline-none focus:border-red-600 transition-colors">
            </div>

            <div class="flex flex-col">
                <label class="text-[10px] font-black uppercase mb-1 tracking-widest text-gray-400">Password</label>
                <input type="password" name="password" required class="border-b-2 border-black bg-transparent py-2 font-bold text-sm outline-none focus:border-red-600 transition-colors">
            </div>

            <button type="submit" class="w-full bg-black text-white py-4 font-black uppercase italic hover:bg-gray-800 transition transform hover:-translate-y-1 shadow-lg mt-4">
                Entra nel Market
            </button>
        </form>
        
        <p class="text-center text-xs uppercase font-bold text-gray-400 mt-6">
            Non hai un account? <a href="registrazione.php" class="text-black underline font-black">Registrati ora</a>
        </p>
    </main>

    <?php include('footer.php'); ?>
</body>
</html>