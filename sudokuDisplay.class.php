<?php
namespace Sudoku;

class display {
  private $solver;

  function __construct(solver $solver) {
    $this->solver = $solver;
    $this->board = $solver->getBoard();
  }

  public function printBoard($withHints = FALSE) {
    $board = $this->solver->getBoard();

    $str = '<div class="board">';

    for ($y=8; $y>=0; $y--) {
      $str .= '<div class="row row-' . $y . '">';
      for ($x=0; $x<9; $x++) {
        $str .= '<div class="cell cell-' . $x . '-' . $y . '">';
        $str .= '<span class="value';
        if ($board[$x][$y]['starting_val']) $str .= ' starting-val';
        $str .= '">' . $board[$x][$y]['value'] . '</span>';

        if ($withHints && !empty($board[$x][$y]['options'])) {
          $str .= '<div class="hints">';
          $str .= implode(' ', $board[$x][$y]['options']);
          $str .= '</div>';
        }

        $str .= '</div>';
      }

      $str .= '</div>';
    }

    $str .= '</div>';

    return $str;
  }

  public function printStats() {
    $str = '<p>Num Solved: ' . $this->solver->getNumSolved() . ' out of 81</p>';
    $str .= '<p>Num Unknown Solved: ' . $this->solver->getUnknownNumberSolved() . ' out of ' . $this->solver->getUnknownNumber() . ' (' . ($this->solver->getUnknownNumber() - $this->solver->getUnknownNumberSolved()) . ')</p>';

    return $str;
  }

  public function printLog() {
    $logs = $this->solver->getLog();

    $str = '<ul>';
    foreach ($logs as $log) {
      $str .= '<li>' . $log .'</li>';
    }
    $str .= '</ul>';

    return $str;
  }
}