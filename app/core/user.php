<?php
session_start();
class User
{
    function user()
    {
        if (count($_COOKIE) > 0) {
            if (isset($_COOKIE["user"])) {
                $_SESSION['user'] = base64_decode(htmlspecialchars($_COOKIE["user"]));
            }
        } else {
            setCookie('user');
        }
    }
}
