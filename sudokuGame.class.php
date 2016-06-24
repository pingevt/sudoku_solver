<?php
namespace Sudoku;

class game {
  private $board = array();
  private $difficulty = '';

  function __construct($board, $difficulty) {
    $this->board = $board;
    $this->difficulty = $difficulty;
  }

  public function getDifficulty() {
    return $this->difficulty;
  }

  public function getBoard() {
    return $this->board;
  }
}