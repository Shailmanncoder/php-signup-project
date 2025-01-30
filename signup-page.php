<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign up</title>
    <style>
        /* Body Styling */
        body {
            font-family: Arial, sans-serif;
            background-color: #f6f8fa;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        
        form {
            background: white;
            padding: 25px;
            width: 350px;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            text-align: center;
        }

    
        input {
            width: 100%;
            padding: 10px;
            border: 1px solid #d1d5da;
            border-radius: 6px;
            font-size: 14px;
            margin-bottom: 15px;
            transition: border-color 0.3s ease-in-out;
        }

        input:focus {
            border-color:rgb(8, 8, 8);
            outline: none;
            box-shadow: 0px 8px 5px rgba(12, 12, 12, 0.3);
        }

       
        
        .btn {
            width: 100%;
            background-color: #2ea44f;
            color: white;
            padding: 10px;
            font-size: 16px;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            transition: background 0.3s;
        }

        .btn:hover {
            background-color: #22863a;
        }

        /* Footer Links */
        .form-footer {
            font-size: 12px;
            margin-top: 15px;
            color: #586069;
        }

        .form-footer a {
            color: #0366d6;
            text-decoration: none;
        }

        .form-footer a:hover {
            text-decoration: underline;
        }
        .btn {
    width: 48%;
    background-color: #2ea44f;
    color: white;
    padding: 10px;
    font-size: 16px;
    border: none;
    border-radius: 6px;
    cursor: pointer;
    transition: background 0.3s;
    margin-top: 20px;
    margin-right: 10px;
}

.butn {
    width: 48%;
    background-color: #2ea44f;
    color: white;
    padding: 10px;
    font-size: 16px;
    border: none;
    border-radius: 6px;
    cursor: pointer;
    transition: background 0.3s;
    margin-top: 20px;
}

    </style>
</head>
<body>
    <form action="" method="post">
    <h1>Signup</h1> 

        <input type="email" placeholder="Enter your email"required>
        <input type="password" placeholder="Enter your Password" maxlength="40"required>
        <input type="number" placeholder="Enter your number" maxlength="10"required>
        <input type="text" placeholder="Enter your country"required>
        <input type="text" placeholder="Enter your state"required>
        <input type="text" placeholder="Enter your city"required>
       <button type="submit" class="btn">Login</button><button type="submit" class="butn">Clear</button>
    </form>
</body>
</html>