<html>
<head>
    <title>Your Login Credentials</title>
</head>
<body>
    <p>Dear {{ $email }},</p>
    <p>Your account has been created successfully. Here are your login details:</p>
    <p>Email: {{ $email }}</p>
    <p>Password: {{$password}}</p>
    <p>We recommend that you change your password after your first login.</p>
    <p>Thank you for registering with us.</p>
   
</body>
</html>