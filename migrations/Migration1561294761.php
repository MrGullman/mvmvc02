<?php
  namespace Migrations;
  use Core\Migration;

  class Migration1561294761 extends Migration {
    public function up() {
      $table = 'bookings';
      $this->createTable($table);
      $this->addTimeStamps($table);
      $this->addColumn($table, 'user_id', 'int', ['size'=>11]);
      $this->addColumn($table, 'booking_nr', 'varchar', ['size'=>20]);
      $this->addColumn($table, 'purpose', 'varchar', ['size'=>150]);
      $this->addColumn($table, 'name', 'varchar', ['size'=>100]);
      $this->addColumn($table, 'phone1', 'varchar', ['size'=>50]);
      $this->addColumn($table, 'phone2', 'varchar', ['size'=>50]);
      $this->addColumn($table, 'email', 'varchar', ['size'=>150]);
      $this->addColumn($table, 'city', 'varchar', ['size'=>150]);
      $this->addColumn($table, 'address', 'varchar', ['size'=>255]);
      $this->addColumn($table, 'time', 'time');
      $this->addColumn($table, 'date', 'date');
      $this->addColumn($table, 'travle_supplement', 'varchar', ['size'=>255]);
      $this->addColumn($table, 'outher', 'text');
      $this->addSoftDelete($table);
      $this->addIndex($table, 'booking_nr');
      $this->addIndex($table, 'user_id');

    }
  }
