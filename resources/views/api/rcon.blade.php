<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Rcon Test</title>
</head>
<body>
    <h1>Rcon test</h1>
    <form action="/api/server/rcon" method="post">
    
        <div>
            <label for="host">Hostname</label>
            <input type="text" name="host" id="host">
        </div>
    
        <div>
            <label for="port">Port</label>
            <input type="text" name="port" id="port">
        </div>
    
        <div>
            <label for="password">Password</label>
            <input type="text" name="password" id="password">
        </div>
    
        <div>
            <label for="cmd">Commsnd</label>
            <input type="text" name="cmd" id="cmd">
        </div>

        <button type="submit">Submit</button>
    </form>
</body>
</html>