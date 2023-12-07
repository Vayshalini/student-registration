<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forgot Password</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
    <link rel="stylesheet" href="path/to/your/css/file.css">
    <style>
        /* Add your imported styles here */
        @import url("https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800;900&display=swap");

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: "Poppins", sans-serif;
        }

        body {
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            background: url('../images/background_login.jpg') no-repeat;
            background-size: cover;
            background-position: center;
        }

        .container {
            width: 420px;
            background: transparent;
            border: 2px solid rgba(255, 255, 255, .2);
            backdrop-filter: blur(20px);
            box-shadow: 0 0 10px rgba(0, 0, 0, .2);
            color: #fff;
            border-radius: 10px;
            padding: 30px 40px;
            font-family: "Poppins", sans-serif; /* Apply the same font-family */
        }

        .container h1 {
            font: 28px;
            text-align: center;
        }

        .container .row {
            margin-bottom: 30px;
        }

        .container .form-control {
            width: 100%;
            height: 50px;
            background: transparent;
            border: none;
            outline: none;
            border: 2px solid rgba(255, 255, 255, .2);
            border-radius: 40px;
            font-size: 16px;
            color: #fff;
            padding: 20px 45px 20px 20px;
        }

        .container .form-control::placeholder {
            color: #fff;
        }

        .container .form-control:focus {
            border-color: #fff; /* Change border color on focus */
        }

        .container .btn-primary {
            width: 100%;
            height: 45px;
            background: #fff;
            border: none;
            outline: none;
            border-radius: 40px;
            box-shadow: 0 0 10px rgba(0, 0, 0, .1);
            cursor: pointer;
            font-size: 16px;
            color: #333;
            font-weight: 600;
        }

        .border {
            border: 2px solid rgba(255, 255, 255, .2);
            /* border: 1px solid #30425414!important; */
        }

        .container h1 {
            font-size: 28px; /* Set the desired font size */
            text-align: center;
            margin-bottom: 20px; /* Add margin to separate from the form */
        }

    </style>
</head>
<body>
    <div class="container p-3 border  rounded-3">
        <h1 class="text-center p-4 ">Password Reset</h1>
        
        <form action="forgot_pw_process.php" method="post">
            <div class="row mb-3 justify-content-md-center">
                <div class="col-auto">
                    <input type="email" name="email" placeholder="Email address" class="form-control">
                </div>
                <div class="col-auto">
                    <button type="submit" class="btn btn-primary" name="reset">Reset</button>
                </div>
            </div>
        </form>
    </div>
</body>
</html>
