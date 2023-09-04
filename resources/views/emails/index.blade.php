<!DOCTYPE html>
<html>
<head>
    <title>Forgot Password</title>
    <style>
        /* Add your CSS styles here */
        h1 {
            color: #333;
        }

        p {
            color: #555;
        }

        a {
            color: #007bff;
            text-decoration: none;
        }
    </style>

</head>
<body>
    <h1>Forgot Password</h1>
    <p>Hello {{$user}},</p>
    <p>We received a request to reset your password. If you did not make this request, please ignore this email.</p>
    <p>To reset your password, Put the key below:</p>
 <div  style="font-weight:bold">{{$key}}</div>
    <p>This password reset link will expire in 2 minutes.</p>
    <p>If you have any questions, feel free to contact us.</p>
    <p>Codact Team</p>
</body>
</html>