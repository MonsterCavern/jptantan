<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://unpkg.com/purecss@2.0.3/build/pure-min.css" integrity="sha384-4ZPLezkTZTsojWFhpdFembdzFudphhoOzIunR1wH6g1WQDzCAiPvDyitaK67mp0+" crossorigin="anonymous">

</head>

<body>
<form class="pure-form" action="/messages" method="POST">
    @CSRF
    <fieldset class="pure-group">
        <input type="text" value="Cosmo" name="name" class="pure-input-1-2" placeholder="Username" />
    <!--    <input type="text" class="pure-input-1-2" placeholder="Password" /> -->
        <input type="email" value="email" name="email" class="pure-input-1-2" placeholder="Email" />
    </fieldset>
    <fieldset class="pure-group">
    <!--    <input type="text" class="pure-input-1-2" placeholder="A title" /> -->
        <textarea name="content"  class="pure-input-1-2" placeholder="Textareas work too">
        1112234
        </textarea>
    </fieldset>
    <button type="submit" class="pure-button pure-input-1-2 pure-button-primary">Sign in</button>
</form>
    
</body>
</html>

