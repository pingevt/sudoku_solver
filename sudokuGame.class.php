<?php
namespace Sudoku;

const DIFF_EASY = 0;
const DIFF_MEDIUM = 5;
const DIFF_HARD = 10;
const DIFF_EXPERT = 15;
const DIFF_SKILLED = 20;
const DIFF_ADEPT = 25;
const DIFF_MASTER = 30;
const DIFF_GENIUS = 35;

class game {
  private $board = array();
  private $difficulty = -1;
  private $start_num = 0;

  function __construct($board, $difficulty) {
    $this->board = $board;
    $this->difficulty = $difficulty;

    foreach ($this->board as $y => $row) {
      foreach ($row as $x => $col) {
        if ($col) $this->start_num++;
      }
    }
  }

  public function getDifficulty() {
    return $this->difficulty;
  }

  public function getBoard() {
    return $this->board;
  }
}