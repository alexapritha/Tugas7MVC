<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Sistem Peminjaman Buku</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        }
    </style>
</head>
<body class="min-h-screen flex items-center justify-center">
    <div class="bg-white p-8 rounded-2xl shadow-lg w-96">
        <h1 class="text-4xl font-bold text-center tracking-tight">Welcome Back!</h1>
        <p class="text-center text-gray-500 mb-6 text-sm">Please login to your account</p>

        <?php if (isset($_SESSION['login_error'])): ?>
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                <?php 
                    echo $_SESSION['login_error'];
                    unset($_SESSION['login_error']);
                ?>
            </div>
        <?php endif; ?>

        <form action="index.php?c=Login&m=authenticate" method="POST">
            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="email">
                    Email Address
                </label>
                <input type="email" 
                       id="email" 
                       name="email" 
                       class="w-full px-4 py-2 border rounded-md bg-gray-100 focus:outline-none focus:border-blue-500 focus:bg-white transition duration-200"
                       required>
                <?php if (isset($_SESSION['email_error'])): ?>
                    <p class="text-red-500 text-xs mt-1">
                        <?php 
                            echo $_SESSION['email_error'];
                            unset($_SESSION['email_error']);
                        ?>
                    </p>
                <?php endif; ?>
            </div>

            <div class="mb-6">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="password">
                    Password
                </label>
                <input type="password" 
                       id="password" 
                       name="password" 
                       class="w-full px-4 py-2 border rounded-md bg-gray-100 focus:outline-none focus:border-blue-500 focus:bg-white transition duration-200"
                       required>
                <?php if (isset($_SESSION['password_error'])): ?>
                    <p class="text-red-500 text-xs mt-1">
                        <?php 
                            echo $_SESSION['password_error'];
                            unset($_SESSION['password_error']);
                        ?>
                    </p>
                <?php endif; ?>
            </div>

            <button type="submit" 
                    class="w-full bg-gradient-to-r from-blue-500 to-blue-600 text-white font-bold py-2 px-4 rounded-md hover:from-blue-600 hover:to-blue-700 focus:outline-none transition duration-200">
                Sign In
            </button>
        </form>
    </div>
</body>
</html>
