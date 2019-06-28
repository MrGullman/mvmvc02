<?php
  namespace Migrations;
  use Core\Migration;

  class Migration1560600350 extends Migration {
    public function up() {
      $table = 'post_images';
      $this->createTable($table);
      $this->addColumn($table, 'post_id', 'int');
      $this->addColumn($table, 'name', 'varchar', ['size'=>255]);
      $this->addColumn($table, 'url', 'varchar', ['size'=>255]);
      $this->addColumn($table, 'sort', 'int');
      $this->addSoftDelete($table);
      $this->addIndex($table, 'post_id');
      $this->addIndex($table, 'sort');
    }
  }
