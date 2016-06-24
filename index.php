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

$s->initializeBoard($games['easy'][0]);

$display = new Sudoku\display($s);
print $display->printBoard(TRUE);

$s->checkForSingleOption();
$s->cleanHints();
$s->checkForSingleOption();
$s->checkForSingleOptionPresentInRow();
$s->checkForSingleOptionPresentInCol();
$s->checkForSingleOptionPresentInBlock();
$s->checkForSingleOption();
$s->checkForSingleOption();
$s->checkForSingleOption();
print $display->printBoard(TRUE);
print $display->printStats();
print $display->printLog();

//krumo($s->getBoard());




$s2 = new Sudoku\solver();
$s2->initializeBoard($games['expert'][0]);

$display2 = new Sudoku\display($s2);
print $display2->printBoard(TRUE);

$s2->checkForSingleOption();
$s2->cleanHints();
$s2->checkForSingleOption();
$s2->checkForSingleOption();
$s2->checkForSingleOption();
$s2->checkForSingleOption();
$s2->checkForSingleOption();
$s2->checkForSingleOption();
$s2->checkForSingleOption();
$s2->checkForSingleOption();
print $display2->printBoard(TRUE);
print $display2->printStats();

$s2->checkForSingleOptionPresentInBlock();
$s2->checkForSingleOption();
$s2->checkForSingleOption();
$s2->checkForSingleOption();
$s2->checkForSingleOption();
print $display2->printBoard(TRUE);
print $display2->printStats();
print $display2->printLog();

?>
</body>
</html>