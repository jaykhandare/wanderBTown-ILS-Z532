<html>
<head></head>
<body>
<?php
/**
 * Created by PhpStorm.
 * User: jkhandar
 * Date: 11/21/17
 * Time: 7:12 PM
 */
define('ROOT_PATH', __DIR__);

include_once './dashboard/dashboardFunctions.php';

?>

<p>
   <?/* $array1 =  getUserDash("d");*/?>

    <? $testvar = getUserPosts();
        echo $testvar[1][1];
   ?>
</p>

</body>
</html>
