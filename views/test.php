<?php
function test()
{
    return <<<HTML
        <a href="url">er</a>
HTML;
}

function test2()
{
    return <<<HTML
    <a href="url2.php">er2</a>
    HTML;
}

dump(test2()) ;