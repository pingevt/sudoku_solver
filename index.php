<!DOCTYPE html>
<html>
<head>
  <title>Sudoku</title>
  <link type="text/css" rel="stylesheet" href="/css/style.css" media="all" />
</head>
<body>

<?php
include_once('krumo/class.krumo.php');
include_once('sudokuSolver.class.php');
include_once('_games.php');

$s = new Sudoku\solver();

//$s->initializeBoard($games['easy'][0]);           // 0
//$s->initializeBoard($games['expert'][0]);         // 0
//$s->initializeBoard($games['expert'][1]);         // 0
//$s->initializeBoard($games['expert'][2]);         // 34 | 19
//$s->initializeBoard($games['skilled'][0]);        // 39 | 38
//$s->initializeBoard($games['skilled'][1]);        // 47 | 0
//$s->initializeBoard($games['skilled'][2]);        // 45
$s->initializeBoard($games['skilled'][3]);        // 29
//$s->initializeBoard($games['adept'][0]);          // 37 | 30 | 0 --- XY WING
//$s->initializeBoard($games['master'][0]);         // 39
//$s->initializeBoard($games['genius'][0]);         // 39

$display = new Sudoku\display($s);
print $display->printBoard();

$s->_solve();
print $display->printBoard(TRUE);

$s->_solve();
print $display->printBoard(TRUE);
print $display->printStats();
print $display->printLog();

?>
</body>
</html>