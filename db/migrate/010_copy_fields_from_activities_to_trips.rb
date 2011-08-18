class CopyFieldsFromActivitiesToTrips < ActiveRecord::Migration
  def self.up
    add_column :trips, :start, :datetime
    add_column :trips, :end, :datetime
  end

  def self.down
    remove_column :trips, :start
    remove_column :trips, :end
  end
end
