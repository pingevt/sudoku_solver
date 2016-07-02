<?php
namespace Sudoku;

include_once 'sudokuDisplay.class.php';
include_once 'sudokuGame.class.php';

class solver {
  private $board = array();
  private $initialized = FALSE;

  private $numSolved = 0;
  private $unknownNumber = 81;
  private $unknownNumberSolved = 0;

  private $log = array();

  function __construct() {
    for ($x=0; $x<9; $x++) {
      for ($y=0; $y<9; $y++) {
        $this->board[$x][$y] = array(
          'value' => FALSE,
          'starting_val' => FALSE,
          'options' => array(1,2,3,4,5,6,7,8,9),
        );
      }
    }
  }

  public function initializeBoard($game) {
    if (!$this->initialized) {
      foreach ($game->getBoard() as $y => $col) {
        foreach ($col as $x => $val) {
          if ($val) {
            $this->setValueOnCell($x, $y, $val, TRUE);
            $this->unknownNumber--;
          }
        }
      }

      $this->initialized = TRUE;

      return TRUE;
    }
    else {
      return FALSE;
    }
  }

  public function cleanHints() {
    $this->log[] = 'cleanHints() run';

    for ($x=0; $x<9; $x++) {
      for ($y=0; $y<9; $y++) {
        if ($this->board[$x][$y]['value'] !== FALSE) {
          $this->removeOptionFromRow($y, $this->board[$x][$y]['value']);
          $this->removeOptionFromCol($x, $this->board[$x][$y]['value']);
          $this->removeOptionFromBlock((floor($x/3)), (floor($y/3)), $this->board[$x][$y]['value']);
        }
      }
    }
  }

  private function setValueOnCell($x, $y, $val, $starting_val = FALSE) {

    $this->log[] = 'Setting Value on (' . $x . ', ' . $y . '): ' . $val;

    $this->board[$x][$y]['value'] = $val;
    $this->board[$x][$y]['starting_val'] = $starting_val;
    $this->board[$x][$y]['options'] = array();


    $this->removeOptionFromRow($y, $val);
    $this->removeOptionFromCol($x, $val);
    $this->removeOptionFromBlock((floor($x/3)), (floor($y/3)), $val);

    $this->numSolved++;
    if (!$starting_val) $this->unknownNumberSolved++;
  }

  private function removeOptionOnCell($x, $y, $opt_val) {
    if (in_array($opt_val, $this->board[$x][$y]['options'])) {
      unset($this->board[$x][$y]['options'][array_search($opt_val, $this->board[$x][$y]['options'])]);
      $this->board[$x][$y]['options'] = array_values($this->board[$x][$y]['options']);
    }
  }

  private function removeOptionFromRow($y, $val, $exclusions = array()) {
    for ($x=0; $x<9; $x++) {
      if (!in_array(array($x, $y), $exclusions)) {
        $this->removeOptionOnCell($x, $y, $val);
      }
    }
  }

  private function removeOptionFromCol($x, $val, $exclusions = array()) {
    for ($y=0; $y<9; $y++) {
      if (!in_array(array($x, $y), $exclusions)) {
        $this->removeOptionOnCell($x, $y, $val);
      }
    }
  }

  private function removeOptionFromBlock($bx, $by, $val, $exclusions = array()) {
    for ($x=0;$x<3;$x++) {
      for ($y=0;$y<3;$y++) {
        $x_val = $x + 3*$bx;
        $y_val = $y + 3*$by;

        if (!in_array(array($x_val, $y_val), $exclusions)) {
          $this->removeOptionOnCell($x_val, $y_val, $val);
        }
      }
    }
  }

  private function removeOptionFromBlockCol($bx, $by, $col, $val) {
    for ($y=0;$y<3;$y++) {
      $y_val = $y + 3*$by;
      $this->removeOptionOnCell($col, $y_val, $val);
    }
  }

  private function removeOptionFromBlockRow($bx, $by, $row, $val) {
    for ($x=0;$x<3;$x++) {
      $x_val = $x + 3*$bx;
      $this->removeOptionOnCell($x_val, $row, $val);
    }
  }


  /**
   * Solving functions
   */
  public function _solve() {
    $solve_funcs = array(
      'checkForSingleOption',
      'checkForSingleOptionPresentInRow',
      'checkForSingleOptionPresentInCol',
      'checkForSingleOptionPresentInBlock',
      'checkForKnockoutRowCol',
      'checkForDoublesRow',
      'checkForDoublesCol',
      'checkForDoublesBlock',
      'checkForXYWingKnockoutRows',
    );

    for ($i = 0; $i < count($solve_funcs); $i++) {

      $tries = 0;
      for ($z = $i; $z >= 0; $z--) {
        do {
          $count = $this->{$solve_funcs[$z]}();
          $tries++;
          if ($this->numSolved >= 81) {
            break 3;
          }
        }
        while ($count > 0);

        //if ($tries==1)  break 1;
      }
    }

    return TRUE;
  }

  public function checkForSingleOption() {
    $number_solved = 0;

    $this->log[] = 'checkForSingleOption() run';

    for ($x=0;$x<9;$x++) {
      for ($y=0;$y<9;$y++) {
        if (count($this->board[$x][$y]['options']) == 1) {
          $this->setValueOnCell($x, $y, current($this->board[$x][$y]['options']));
          $number_solved++;
        }
      }
    }

    return $number_solved;
  }

  public function checkForSingleOptionPresentInRow() {
    $number_solved = 0;

    $this->log[] = 'checkForSingleOptionPresentInRow() run';

    for ($y=0;$y<9;$y++) {
      for ($o=1; $o<=9; $o++) {
        $count = 0;
        $last_coord = array();

        for ($x=0;$x<9;$x++) {
          if (in_array($o, $this->board[$x][$y]['options'])) {
            $last_coord[] = array($x, $y);
          }
        }

        if (count($last_coord) == 1) {
          $number_solved++;
          $this->setValueOnCell($last_coord[0][0], $last_coord[0][1], $o);
        }
      }
    }

    return $number_solved;
  }

  public function checkForSingleOptionPresentInCol() {
    $number_solved = 0;
    $this->log[] = 'checkForSingleOptionPresentInCol() run';

    for ($x=0;$x<9;$x++) {
      for ($o=1; $o<=9; $o++) {
        $count = 0;
        $last_coord = array();

        for ($y=0;$y<9;$y++) {
          if (in_array($o, $this->board[$x][$y]['options'])) {
            $last_coord[] = array($x, $y);
          }
        }

        if (count($last_coord) == 1) {
          $number_solved++;
          $this->setValueOnCell($last_coord[0][0], $last_coord[0][1], $o);
        }
      }
    }

    return $number_solved;
  }

  public function checkForSingleOptionPresentInBlock() {
    $number_solved = 0;
    $this->log[] = 'checkForSingleOptionPresentInBlock() run';

    for ($bx=0;$bx<3;$bx++) {
      for ($by=0;$by<3;$by++) {
        for ($o=1; $o<=9; $o++) {
          $last_coord = array();

          for ($x=0;$x<3;$x++) {
            for ($y=0;$y<3;$y++) {
              $x_val = $x + 3*$bx;
              $y_val = $y + 3*$by;

              if (in_array($o, $this->board[$x_val][$y_val]['options'])) {
                $last_coord[] = array($x_val, $y_val);
              }
            }
          }

          if (count($last_coord) == 1) {
            $number_solved++;
            $this->setValueOnCell($last_coord[0][0], $last_coord[0][1], $o);
          }
        }
      }
    }

    return $number_solved;
  }

  public function checkForKnockoutRowCol() {
    $number_solved = 0;
    $this->log[] = 'checkForKnockoutRowCol() run';

    for ($bx=0;$bx<3;$bx++) {
      for ($by=0;$by<3;$by++) {
        for ($o=1; $o<=9; $o++) {
          $coords = array();

          for ($x=0;$x<3;$x++) {
            for ($y=0;$y<3;$y++) {
              $x_val = $x + 3*$bx;
              $y_val = $y + 3*$by;

              if (in_array($o, $this->board[$x_val][$y_val]['options'])) {
                $coords[] = array($x_val, $y_val);
              }
            }
          }

          if (count($coords) > 1) {
            $cols = array();
            $rows = array();

            foreach ($coords as $coord) {
              $cols[$coord[0]] = TRUE;
              $rows[$coord[1]] = TRUE;
            }

            if (count($cols) == 1) {
              $col = current(array_keys($cols));
              $this->removeOptionFromBlockCol($bx, (($by+1)%3), $col, $o);
              $this->removeOptionFromBlockCol($bx, (($by+2)%3), $col, $o);
            }

            if (count($rows) == 1) {
              $row = current(array_keys($rows));
              $this->removeOptionFromBlockRow((($bx+1)%3), $by, $row, $o);
              $this->removeOptionFromBlockRow((($bx+2)%3), $by, $row, $o);
            }
          }
        }
      }
    }

    return $number_solved;
  }

  public function checkForDoublesRow() {
    $number_solved = 0;
    $this->log[] = 'checkForDoublesRow() run';

    for ($y=0;$y<9;$y++) {
      for ($x=0;$x<9;$x++) {
        if (!empty($this->board[$x][$y]['options']) && count($this->board[$x][$y]['options']) == 2) {
          $opts = $this->board[$x][$y]['options'];
          for ($x2=($x+1);$x2<9;$x2++) {
            if (!empty($this->board[$x2][$y]['options']) && count($this->board[$x2][$y]['options']) == 2) {
              if ($this->board[$x][$y]['options'] === $this->board[$x2][$y]['options']) {
                // remove these two options from row.
                $this->removeOptionFromRow($y, $this->board[$x][$y]['options'][0], array(
                  array($x, $y),
                  array($x2, $y),
                ));
                $this->removeOptionFromRow($y, $this->board[$x][$y]['options'][1], array(
                  array($x, $y),
                  array($x2, $y),
                ));
              }
            }
          }
        }
      }
    }

    return $number_solved;
  }

  public function checkForDoublesCol() {
    $number_solved = 0;
    $this->log[] = 'checkForDoublesRow() run';

    for ($y=0;$y<9;$y++) {
      for ($x=0;$x<9;$x++) {
        if (!empty($this->board[$x][$y]['options']) && count($this->board[$x][$y]['options']) == 2) {
          $opts = $this->board[$x][$y]['options'];

          for ($y2=($y+1);$y2<9;$y2++) {
            if (!empty($this->board[$x][$y2]['options']) && count($this->board[$x][$y2]['options']) == 2) {
              if ($this->board[$x][$y]['options'] === $this->board[$x][$y2]['options']) {
                // remove these two options from row.
                $this->removeOptionFromCol($x, $this->board[$x][$y]['options'][0], array(
                  array($x, $y),
                  array($x, $y2),
                ));
                $this->removeOptionFromCol($x, $this->board[$x][$y]['options'][1], array(
                  array($x, $y),
                  array($x, $y2),
                ));
              }
            }
          }
        }
      }
    }

    return $number_solved;
  }

  public function checkForDoublesBlock() {
    $number_solved = 0;
    $this->log[] = 'checkForDoublesBlock() run';

    for ($bx=0; $bx<3; $bx++) {
      for ($by=0; $by<3; $by++) {

        $block_cells = array();

        for ($x=0;$x<3;$x++) {
          $x_val = $x + 3*$bx;
          for ($y=0;$y<3;$y++) {
            $y_val = $y + 3*$by;

            if (!empty($this->board[$x_val][$y_val]['options']) && count($this->board[$x_val][$y_val]['options']) == 2) {
              $block_cells[] = array(
                'coord' => array($x_val, $y_val),
                'options' => $this->board[$x_val][$y_val]['options'],
              );
            }
          }
        }

        if (!empty($block_cells) && count($block_cells) >= 2) {

          for ($bn=0; $bn<count($block_cells); $bn++) {

            for ($bn2=$bn+1; $bn2<count($block_cells); $bn2++) {
              if ($block_cells[$bn]['options'] == $block_cells[$bn2]['options']) {

                $this->removeOptionFromBlock($bx, $by, $block_cells[$bn]['options'][0], array($block_cells[$bn]['coord'], $block_cells[$bn2]['coord']));
                $this->removeOptionFromBlock($bx, $by, $block_cells[$bn]['options'][1], array($block_cells[$bn]['coord'], $block_cells[$bn2]['coord']));

              }
            }
          }
        }
      }
    }

    return $number_solved;
  }

  public function checkForXYWingKnockoutRows() {
    $number_solved = 0;
    $this->log[] = 'checkForXYWingKnockoutRows() run';

    for ($n=1; $n<=9; $n++) {
      $num_possibilities_by_row = array();

      for ($y=0;$y<9;$y++) {
        for ($x=0;$x<9;$x++) {
          if (in_array($n, $this->board[$x][$y]['options'])) {
            $num_possibilities_by_row[$y][] = $x;
          }
        }
      }

      foreach ($num_possibilities_by_row as $y => &$row_data) {
        if (count($row_data) == 2) {
          $keys = array_keys($num_possibilities_by_row, $row_data);
          if (count($keys) == 2) {
            unset($num_possibilities_by_row[$keys[0]]);
            unset($num_possibilities_by_row[$keys[1]]);

            $this->removeOptionFromCol($row_data[0], $n, array(
              array($row_data[0], $y),
              array($row_data[0], $keys[1]),
              array($row_data[1], $y),
              array($row_data[1], $keys[1]),
            ));

            $this->removeOptionFromCol($row_data[1], $n, array(
              array($row_data[0], $y),
              array($row_data[0], $keys[1]),
              array($row_data[1], $y),
              array($row_data[1], $keys[1]),
            ));
          }
        }
      }
    }

    return $number_solved;
  }


  /**
   * Getter/Setter
   */
  public function getBoard() {
    return $this->board;
  }

  public function getUnknownNumber() {
    return $this->unknownNumber;
  }

  public function getUnknownNumberSolved() {
    return $this->unknownNumberSolved;
  }

  public function getNumSolved() {
    return $this->numSolved;
  }

  public function getLog() {
    return $this->log;
  }
}