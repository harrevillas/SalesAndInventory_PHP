<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verify Email</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #add8e6;
        }
        .container {
            margin-top: 50px;
            max-width: 350px;
            background: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .form-group {
            margin-bottom: 15px;
        }
        .form-group label {
            font-weight: bold;
        }
        .btn-primary {
            background-color: #007bff;
            border-color: #007bff;
        }
        .verification-code input {
            width: 40px;
            height: 40px;
            text-align: center;
            font-size: 1.5rem;
            margin-right: 5px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2 class="text-center">Email Verification</h2>
        <p>We emailed you a six-digit code. Enter the code below to confirm your email address.</p>
        <form method="POST">
            <input type="hidden" name="email" value="<?php echo $_GET['email']; ?>" required>
            <div class="verification-code">
                <input type="text" maxlength="1" required>
                <input type="text" maxlength="1" required>
                <input type="text" maxlength="1" required>
                <input type="text" maxlength="1" required>
                <input type="text" maxlength="1" required>
                <input type="text" maxlength="1" required>
            </div>
            <div class="form-group">
                <input type="text" class="form-control" id="verification_code" name="verification_code" placeholder="Enter verification code" required style="display: none;">
            </div>
            <button type="submit" name="verify_email" class="btn btn-primary btn-block">Verify</button>
        </form>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', (event) => {
            const inputs = document.querySelectorAll('.verification-code input');
            const hiddenInput = document.getElementById('verification_code');

            inputs.forEach((input, index) => {
                input.addEventListener('input', () => {
                    if (input.value.length > 0 && index < inputs.length - 1) {
                        inputs[index + 1].focus();
                    }

                    hiddenInput.value = Array.from(inputs).map(i => i.value).join('');
                });
            });
        });
    </script>
</body>
</html>

<?php
if (isset($_POST["verify_email"])) {
    $email = $_POST["email"];
    $verification_code = $_POST["verification_code"];

    // Connect with database
    $conn = new mysqli("localhost", "root", "", "verfication");

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Check if the verification code matches
    $stmt = $conn->prepare("SELECT id FROM verify WHERE email = ? AND verification_code = ? AND email_verified_at IS NULL");
    $stmt->bind_param("ss", $email, $verification_code);
    $stmt->execute();
    $stmt->store_result();

        if ($stmt->affected_rows == 0) {
            echo '
            <div class="container mt-5">
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <strong>Warning!</strong> Verification code failed.
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            </div>';
            die();
        }


    // Mark email as verified
    $stmt = $conn->prepare("UPDATE verify SET email_verified_at = NOW() WHERE email = ? AND verification_code = ?");
    $stmt->bind_param("ss", $email, $verification_code);
    $stmt->execute();

    $stmt->close();
    $conn->close();

    header("Location: edit_categorie.php?id=" . $_GET['id']);
    exit();
}
?>
