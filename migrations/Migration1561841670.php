<?php
  namespace Migrations;
  use Core\Migration;

  class Migration1561841670 extends Migration {
    public function up() {
      $table = 'sales';
      $this->createTable($table);
      $this->addTimeStamps($table);
      $this->addColumn($table, 'user_id', 'int', ['size'=>11]);
      $this->addColumn($table, 'booking_id', 'int', ['size'=>11]);
      $this->addColumn($table, 'price', 'int', ['size'=>50]);
      $this->addColumn($table, 'booking_date', 'date');
      $this->addSoftDelete($table);
      $this->addIndex($table, 'user_id');
    }
  }
