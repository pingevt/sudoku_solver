<?php

$board = array(
  array(false, false, false, false, false, false, false, false, false),
  array(false, false, false, false, false, false, false, false, false),
  array(false, false, false, false, false, false, false, false, false),
  array(false, false, false, false, false, false, false, false, false),
  array(false, false, false, false, false, false, false, false, false),
  array(false, false, false, false, false, false, false, false, false),
  array(false, false, false, false, false, false, false, false, false),
  array(false, false, false, false, false, false, false, false, false),
  array(false, false, false, false, false, false, false, false, false),
);

$games = array(
  'easy' => array(),
  'medium' => array(),
  'hard' => array(),
  'expert' => array(),
  'skilled' => array(),
  'adept' => array(),
  'master' => array(),
  'genius' => array(),
);

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
$games['easy'][] = new Sudoku\game($board, Sudoku\DIFF_EASY);







$board = array(
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
$games['expert'][] = new Sudoku\game($board, Sudoku\DIFF_EXPERT);

$board = array(
  array(2, false, 3, false, 7, false, 9, false, 6),
  array(false, false, 6, false, false, false, 4, false, false),
  array(false, 7, false, 2, false, 8, false, 1, false),
  array(1, false, false, false, 5, false, false, false, 3),
  array(false, false, false, false, false, false, false, false, false),
  array(false, 3, 9, false, false, false, 1, 4, false),
  array(false, false, false, 6, false, 1, false, false, false),
  array(false, 8, false, false, false, false, false, 6, false),
  array(false, false, false, 5, false, 4, false, false, false),
);
$games['expert'][] = new Sudoku\game($board, Sudoku\DIFF_EXPERT);

$board = array(
  array(false, false, 6, false, false, false, 4, false, false),
  array(5, false, 4, false, false, false, 8, false, 0),
  array(false, false, false, 5, 4, 7, false, false, false),
  array(false, 8, false, 9, 3, 4, false, 6, false),
  array(false, false, false, false, false, false, false, false, false),
  array(false, 4, false, 7, 2, 8, false, 9, false),
  array(false, false, false, 6, 7, 3, false, false, false),
  array(1, false, 8, false, false, false, 6, false, 7),
  array(false, false, 9, false, false, false, 5, false, false),
);
$games['expert'][] = new Sudoku\game($board, Sudoku\DIFF_EXPERT);








$board = array(
  array(6, false, false, false, 8, false, false, 5, false),
  array(false, false, 8, 9, false, false, false, 7, 6),
  array(4, false, false, 3, false, false, false, false, 9),
  array(false, false, 3, false, 1, false, 5, 2, false),
  array(1, false, false, false, false, 2, false, false, 8),
  array(false, false, 4, false, 3, false, 9, 6, false),
  array(2, false, false, 1, false, false, false, false, 5),
  array(false, false, 1, 4, false, false, false, 8, 2),
  array(8, false, false, false, 2, false, false, 9, false),
);
$games['skilled'][] = new Sudoku\game($board, Sudoku\DIFF_SKILLED);

$board = array(
  array(false, false, false, 6, 1, 3, false, false, 8),
  array(false, false, false, false, 7, false, 2, false, false),
  array(false, false, 8, false, false, false, 1, false, false),
  array(5, false, false, false, 2, 1, false, 7, false),
  array(7, 3, false, 5, false, false, false, false, 4),
  array(6, false, false, 3, false, false, false, 9, false),
  array(false, 5, 3, false, false, false, 4, false, false),
  array(false, false, false, 9, false, 4, false, false, 6),
  array(4, false, false, false, 3, false, false, 8, false),
);
$games['skilled'][] = new Sudoku\game($board, Sudoku\DIFF_SKILLED);

$board = array(
  array(1, false, false, 2, false, 4, false, false, 8),
  array(9, false, 6, false, false, false, 2, false, 7),
  array(false, false, false, false, false, false, false, false, false),
  array(false, false, 9, 5, 7, 2, 3, false, false),
  array(false, false, false, false, false, false, false, false, false),
  array(false, false, 2, 6, false, 3, 1, false, false),
  array(2, false, 7, false, false, false, 9, false, 1),
  array(false, false, false, 8, false, 9, false, false, false),
  array(6, false, false, false, 1, false, false, false, 4),
);
$games['skilled'][] = new Sudoku\game($board, Sudoku\DIFF_SKILLED);

$board = array(
  array(false, false, 3, 9, false, 2, 7, false, false),
  array(false, 4, false, false, false, false, false, 8, false),
  array(9, false, false, false, 4, false, false, false, 5),
  array(false, 3, 5, 6, false, 9, 2, 4, false),
  array(false, false, false, false, false, false, false, false, false),
  array(false, 7, 9, 8, false, 4, 6, 5, false),
  array(7, false, false, false, 3, false, false, false, 2),
  array(false, 5, false, false, false, false, false, 7, false),
  array(false, false, 8, 5, false, 7, 1, false, false),
);
$games['skilled'][] = new Sudoku\game($board, Sudoku\DIFF_SKILLED);





$board = array(
  array(false, false, false, false, 9, 5, false, 6, false),
  array(false, false, false, 3, false, 6, 8, false, false),
  array(false, 6, false, false, false, false, 7, false, 5),
  array(4, false, 9, false, false, false, false, false, 6),
  array(false, 2, false, false, 1, false, false, 8, false),
  array(5, false, false, false, false, false, 2, false, 4),
  array(2, false, 6, false, false, false, false, 7, false),
  array(false, false, 5, 8, false, 7, false, false, false),
  array(false, 9, false, 2, 5, false, false, false, false),
);
$games['adept'][] = new Sudoku\game($board, Sudoku\DIFF_ADEPT);





$board = array(
  array(3, false, false, false, false, 4, false, 6, false),
  array(false, false, 8, false, false, false, 1, false, false),
  array(false, 4, 9, 7, false, false, false, false, false),
  array(false, false, 2, false, false, false, false, false, 9),
  array(false, false, false, false, false, 1, 5, 2, false),
  array(8, false, false, false, 5, 7, false, false, false),
  array(false, 7, false, false, 3, false, false, false, false),
  array(4, false, false, false, 1, false, false, 3, 7),
  array(false, false, false, 6, false, false, false, 5, false),
);
$games['master'][] = new Sudoku\game($board, Sudoku\DIFF_MASTER);











$board = array(
  array(false, 1, false, false, false, 8, false, false, 9),
  array(false, false, 5, false, 2, false, false, false, false),
  array(false, false, 3, false, 5, 4, false, false, false),
  array(5, false, false, false, false, 2, 7, false, 1),
  array(false, false, 6, false, 3, false, 8, 9, false),
  array(false, 8, false, 4, false, false, false, false, false),
  array(2, false, 8, false, 7, false, 5, 3, false),
  array(false, false, false, 2, false, false, false, false, 7),
  array(false, false, 1, false, false, 5, false, false, false),
);
$games['genius'][] = new Sudoku\game($board, Sudoku\DIFF_GENIUS);

