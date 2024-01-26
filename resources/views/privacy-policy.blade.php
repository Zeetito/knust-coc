<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>KMS - Knust Church of Christ Management System</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            padding: 20px;
            background-color: #f4f4f4;
        }
        h1 {
            color: #333;
        }
        p {
            margin-bottom: 15px;
            line-height: 1.6;
        }
        footer {
            margin-top: 20px;
            text-align: center;
            color: #666;
        }
    </style>
</head>
<body>
    <h1>KMS - Knust Church of Christ Management System</h1> <a href="{{route('home')}}"> &larr;Go Back</a>

    <h2>About KMS</h2>
    <p>KMS is an application that seeks to connect all individuals who in one way or another are affiliates to the Church of Christ on Kwame Nkrumah University of Science and Technology (KNUST) campus.</p>

    <h2>Information We Collect</h2>
    <p>When You Sign up, we first collect;</p>
    <ul>
        <li>Email</li>
        <li>Username</li>
        <li>First, Last and other names</li>
        <li>Date of Birth</li>
        <li>Password</li>
        <li>Gender</li>
        <li>Baptismal Status (Whether or not you're baptized)</li>
        <li>Availability Status (Whether or not you're physically part of the congregation at the current time).</li>
        <li>Academic Status (Whether or not you're a student)</li>
    </ul>

    <p>Based on the Status of the user we may collect the following details.</p>
    <ul>
        <li>Residence</li>
        <li>Program of Study</li>
        <li>Year</li>
        <li>Room Number</li>
        <li>N.S status (If the user is or is not a national service personnel).</li>
        <li>Year group (if the user has completed the university).</li>
        <li>Guardian Contact</li>
        <li>Country and State (for users who are not physically part of the congregation in the current time).</li>
    </ul>

    <h2>How We Use Your Information</h2>
    <p>To know which individuals are not available for meetings and why so.</p>
    <p>To help facilitate activities like visitations and morning devotions of the church.</p>
    <p>To help users get easy access to upcoming activities planned by the church.</p>
    <p>To easily contact all affiliates of the church when necessary.</p>
    <p>To ensure easy identification of affiliates of the church so that any necessary assistance needed could be given immediately.</p>

    <h2>Data Security</h2>
    <p>We take the security of your information seriously and employ industry-standard measures to protect it from unauthorized access, disclosure, alteration, and destruction.</p>

    <h2>No Sharing with Third Parties</h2>
    <p>We do not share your personal information with third parties. Your privacy is our priority, and we are committed to keeping your data confidential.</p>

    <h2>Public Display</h2>
    <p>Emails, Full Date of Births, and Guardian contacts are not for public display to other users.</p>

    <h2>Updates to the Privacy Policy</h2>
    <p>We may update our Privacy Policy from time to time. Any changes will be communicated through the platform, and it is your responsibility to review the Privacy Policy periodically.</p>

    <h2>Contact us</h2>

    <footer>
        <p id="copyright"></p>

        <script>
            document.getElementById("copyright").innerHTML = "&copy; " + new Date().getFullYear() + " KMS - Knust Church of Christ Management System. All rights reserved.";
        </script>
    </footer>
</body>
</html>
