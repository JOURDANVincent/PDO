<?php

    // déclaration des test et REGEX
    define('R_STR', "/^[a-zA-Z \sÀÁÂÃÄÅàáâãäåÒÓÔÕÖØòóôõöøÈÉÊËèéêëÇçÌÍÎÏìíîïÙÚÛÜùúûüÿÑñ-]{2,20}$/");
    define('R_BREW', "/^[a-zA-Z \_]{2,20}$/");
    define('R_INT', "/^[0-9]{1,2}$/");
    define('R_PASSWD', "/^(?=.{10,}$)(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*\W).*$/");
    define('R_MAIL', "/^[\w-\.]+@([\w-]+\.)+\.[\w-]{2,6}$/");
    define('R_DATE', "/^\d{4}-\d{2}-\d{1,2}$/");
    define('R_PHONE', "/^[\w-\.]+@([\w-]+\.)+\.[\w-]{2,5}$/");
    // "/^(?=.{10,}$)(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*\W).*$/"
?> 