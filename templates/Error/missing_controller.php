<!DOCTYPE html>
<html>
<head>
    <title>Whoops! Looks Like We Got Lost ️</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 16px;
            margin: 2em;
            line-height: 1.8;
        }
        h1 {
            color: #c0392b;
        }
        p {
            margin-bottom: 1em;
        }
        a {
            color: #007bff;
            text-decoration: none;
        }
    </style>
</head>
<body>
    <h1>Hold on a sec! (Error <?php echo $code; ?>) </h1>
    <p>The page you requested seems to have gotten lost in the internet wilderness. Don't worry, these things happen even to the best of us (including websites!). </p>
    <p>Here are a few things you can try:</p>
    <ul style="list-style: none; padding: 0;">
        <li>️‍Double-check the URL for any typos. You might have missed a turn!</li>

        <a href="<?=$this->Url->build(['controller'=> 'Pages','action'=>'home'])?>">Go back to the Home page</a>
    </ul>

</body>

</html>
