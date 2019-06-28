<?php
  namespace Migrations;
  use Core\Migration;

  class Migration1560579166 extends Migration {
    public function up() {
      $table = 'category';
      $this->createTable($table);
      $this->addTimeStamps($table);
      $this->addColumn($table, 'name', 'varchar', ['size'=>100]);
      $this->addSoftDelete($table);
    }
  }
