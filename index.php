<!DOCTYPE html>
<html>
<head>
  <title>Sudoku</title>
  <link type="text/css" rel="stylesheet" href="/css/style.css" media="all" />
</head>
<body>

<?php
include_once('krumo/class.krumo.php');
include 'sudokuSolver.class.php';
include 'sudokuDisplay.class.php';

$s = new Sudoku\solver();

$board = array(
  array(6, false, false, false, false, false, false, false, 7),
  array(false, false, 2, 4, false, 7, 6, false, false),
  array(false, 4, 7, 3, false, 8, 1, 5, false),
  array(false, 6, 3, 8, false, 1, 9, 4, false),
  array(false, false, false, false, false, false, false, false, false),
  array(false, 1, 4, 6, false, 9, 2, 7, false),
  array(false, 2, 5, 9, false, 4, 8, 3, false),
  array(false, false, 6, 5, false, 3, 7, false, false),
  array(3, false, false, false, false, false, false, false, 4),
);


$board2 = array(
  array(7, false, false, false, false, false, 9, false, false),
  array(false, false, 5, false, false, 1, false, false, 6),
  array(false, 8, false, false, false, 3, 7, false, 4),
  array(false, false, false, 2, false, false, false, false, false),
  array(false, false, false, false, false, false, 5, false, 8),
  array(false, 6, 4, false, false, 8, false, 7, false),
  array(6, false, 7, false, 4, false, false, false, 1),
  array(false, false, false, false, false, 6, false, false, 9),
  array(false, 1, 2, false, 5, false, 3, 6, false),
);

$s->initializeBoard($board);

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
$s2->initializeBoard($board2);

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