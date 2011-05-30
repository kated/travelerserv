class SetupPolymorphicSchemaForFixes < ActiveRecord::Migration
  def self.up
    change_table :travel_fixes do |t|
      t.integer :parent_id
      t.string :parent_type, :limit => 32
    end

    change_table :trips do |t|
      t.remove :start_travel_fix_id
      t.remove :end_travel_fix_id
    end

    change_table :activities do |t|
      t.remove :trip_id
      t.remove :start
      t.remove :stop
    end
  end

  def self.down
    raise IrreversibleMigration
  end
end
