<?php


use Phinx\Migration\AbstractMigration;

class TopicCommentMaps extends AbstractMigration {
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
			$table = $this->table( 'topic_comment_maps',
				[
					'id'          => false,
					'primary_key' => [ 'topic', 'comment_id' ]
				]
			);
			$table->addColumn( 'topic', 'string', [ 'limit' => 50 ] )
			      ->addColumn( 'comment_id', 'string', [ 'limit' => 50 ] )
			      ->addColumn( 'created', 'datetime' )
			      ->create();

			$this->table( 'topic_comment_maps' )->addIndex( [
				'comment_id',
				'created'
			], [ 'name' => 'comment_id_created_index' ] )->save();

			$this->table( 'topic_comment_maps' )->addIndex( [
				'comment_id'
			] )->save();
			$this->table( 'topic_comment_maps' )->addIndex( [
				'topic'
			] )->save();
			$this->table( 'topic_comment_maps' )->addIndex( [
				'topic',
				'created'
			], [ 'name' => 'topic_created_index' ] )->save();
		};

		if ( ! $this->hasTable( 'comments' ) ) {

			$create();

		} else {
			$this->table( 'topic_comment_maps' )->drop()->save();
			$create();
		}
	}
}
