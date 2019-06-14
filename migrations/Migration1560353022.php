<?php
  namespace Migrations;
  use Core\Migration;

  class Migration1560353022 extends Migration {
    public function up() {
      $table = "contacts";
      $this->createTable($table);
      $this->addColumn($table, 'user_id', 'int', ['size'=>11]);
      $this->addColumn($table, 'fname', 'varchar', ['size'=>155]);
      $this->addColumn($table, 'lname', 'varchar', ['size'=>155]);
      $this->addColumn($table, 'email', 'varchar', ['size'=>155]);
      $this->addColumn($table, 'address', 'varchar', ['size'=>255]);
      $this->addColumn($table, 'address2', 'varchar', ['size'=>255]);
      $this->addColumn($table, 'city', 'varchar', ['size'=>100]);
      $this->addColumn($table, 'postalcode', 'varchar', ['size'=>65]);
      $this->addColumn($table, 'home_phone', 'varchar', ['size'=>55]);
      $this->addColumn($table, 'cell_phone', 'varchar', ['size'=>55]);
      $this->addColumn($table, 'work_phone', 'varchar', ['size'=>55]);
      $this->addSoftDelete($table);
      $this->addIndex($table, 'user_id');
    }
  }
