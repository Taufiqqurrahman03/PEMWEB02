<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <title>Login</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 flex justify-center items-center min-h-screen">

  <form action="/rental_app/process-login" method="POST" class="bg-white p-8 rounded shadow-md w-96">
    <h2 class="text-2xl font-bold mb-4 text-center text-gray-700">Login</h2>
    <input type="text" name="username" placeholder="Username" required class="w-full px-4 py-2 mb-4 border rounded">
    <input type="password" name="password" placeholder="Password" required class="w-full px-4 py-2 mb-4 border rounded">
    <button type="submit" class="w-full bg-blue-500 text-white py-2 rounded hover:bg-blue-600">Login</button>
  </form>

</body>
</html>
