<!DOCTYPE html> 
<html> 
    <head> 
        <meta charset="UTF-8"> 
        <title>New User Registered</title> 
        <style> 
        body { font-family: Arial, sans-serif; background-color: #f7f9fc; padding: 30px; color: #333; } 
        .container { max-width: 600px; margin: auto; background-color: #ffffff; border-radius: 8px; box-shadow: 0 4px 10px rgba(0,0,0,0.1); padding: 30px; } 
        .header { font-size: 20px; font-weight: bold; color: #2c3e50; margin-bottom: 20px; } 
        .username-box { background-color: #e3f2fd; color: #0d47a1; font-weight: bold; font-size: 18px; padding: 10px 15px; border-radius: 5px; display: inline-block; } 
        .footer { margin-top: 30px; font-size: 14px; color: #888; } 
        </style> 
    </head>
    <body> 
        <div class="container"> 
            <div class="header">New User Registration</div> 
            <p>A new user has just registered to the system with the following username:</p>
            <p class="username-box">{{ $username }}</p> <p>Please check the system dashboard for further details.</p>

            <div class="footer">This is an automated message from your Laravel application.</div>
        </div>
    </body> 
</html>