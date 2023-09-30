<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?=$title;?></title>
    <style>
        *{
            font-family:'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            margin: 0;
            padding: 0;
        }
    </style>
</head>
<body style="display: flex; flex-direction: column; height: 100vh;">
    <header style="text-align: center; color: white; background-color: #E74C3C;">
        <h1>ERC</h1>
    </header>
    <div style="align-self: center; flex-grow: 1; display: flex; flex-direction: column; justify-content: center; align-items: center;">
        <h2>
            This is the welcome page!
        </h2> 
        <a href="<?=base_url('about')?>">
            About
        </a>
    </div>
</body>
</html>

