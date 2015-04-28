<?php
/**
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.View.Emails.html
 * @since         CakePHP(tm) v 0.10.0.1076
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Shagunn</title>
</head>
<body>
<center>
<table width="600">
<tr><td><a href="<?php echo BASE_URL;?>"><img src="<?php echo BASE_URL;?>img/icons/logo.png" alt="Shagunn" border="0" /></a></td></tr>
<tr><td>
<?php
echo $content;
?>
</td></tr></table>
</center>
</body>
</html>