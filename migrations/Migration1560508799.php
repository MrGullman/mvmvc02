<?php
  namespace Migrations;
  use Core\Migration;

  class Migration1560508799 extends Migration {
    public function up() {
      $table = "posts";
      $this->createTable($table);
      $this->addColumn($table, 'user_id', 'int', ['size'=>11]);
      $this->addColumn($table, 'category_id', 'int', ['size'=>11]);
      $this->addColumn($table, 'title', 'varchar', ['size'=>155]);
      $this->addColumn($table, 'post', 'text');
      $this->addColumn($table, 'tags', 'text');
      $this->addSoftDelete($table);
      $this->addTimeStamps($table);
      $this->addIndex($table, 'user_id');
      $this->addIndex($table, 'category_id');
    }
  }
