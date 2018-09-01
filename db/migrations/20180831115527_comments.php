<?php


use Phinx\Migration\AbstractMigration;

class Comments extends AbstractMigration {
	/**
	 * Change Method.
	 *
	 * Write your reversible migrations using this method.
	 *
	 * More information on writing migrations is available here:
	 * http://docs.phinx.org/en/latest/migrations.html#the-abstractmigration-class
	 *
	 * The following commands can be used in this method and Phinx will
	 * automatically reverse them when rolling back:
	 *
	 *    createTable
	 *    renameTable
	 *    addColumn
	 *    addCustomColumn
	 *    renameColumn
	 *    addIndex
	 *    addForeignKey
	 *
	 * Any other destructive changes will result in an error when trying to
	 * rollback the migration.
	 *
	 * Remember to call "create()" or "update()" and NOT "save()" when working
	 * with the Table class.
	 */
	public function change() {

		$create = function () {
			$table = $this->table( 'comments', [ 'id' => false, 'primary_key' => [ 'comment_id' ] ] );
			$table->addColumn( 'comment_id', 'string', [ 'limit' => 50 ] )
			      ->addColumn( 'comment', 'text', [ 'limit' => 255 ] )
			      ->addColumn( 'entity_id', 'string', [ 'limit' => 50 ] )
			      ->addColumn( 'user_id', 'string', [ 'limit' => 50, 'null' => true ] )
			      ->addColumn( 'organisation_id', 'string', [ 'limit' => 50, 'null' => true ] )
			      ->addColumn( 'modified', 'datetime' )
			      ->addColumn( 'created', 'datetime' )
			      ->create();

			$this->table( 'comments' )->addIndex( [
				'entity_id',
				'created'
			], [ 'name' => 'comment_created_entity' ] )->save();
		};

		if ( ! $this->hasTable( 'comments' ) ) {

			$create();

		} else {
			$this->table( 'comments' )->drop()->save();
			$create();
		}
	}
}
