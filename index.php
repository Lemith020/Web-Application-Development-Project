<!DOCTYPE html>
<html>
<head>
    <title>Sun & Sea Restaurant</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f8fafc;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        .container {
            text-align: center;
            background: white;
            padding: 40px;
            border-radius: 12px;
            box-shadow: 0 4px 6px rgba(0,0,0,0.05);
        }
        h1 { color: #1e293b; margin-bottom: 20px; }
        p { color: #64748b; margin-bottom: 30px; }
        .btn {
            display: inline-block;
            padding: 12px 24px;
            margin: 10px;
            background-color: #0284c7;
            color: white;
            text-decoration: none;
            border-radius: 6px;
            font-weight: 600;
            transition: background 0.2s;
        }
        .btn:hover { background-color: #0369a1; }
        .btn-admin { background-color: #0f172a; }
        .btn-admin:hover { background-color: #1e293b; }
    </style>
</head>
<body>
    <div class="container">
        <h1>Welcome to Sun & Sea Restaurant</h1>
        <p>Please select your portal to continue:</p>
        
        
        <a href="customer/index.php" class="btn">Customer Portal</a>
        
        
        <a href="admin/login.php" class="btn btn-admin">Admin Portal</a>
    </div>
</body>
</html>