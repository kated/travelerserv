class AddTripIdToActivities < ActiveRecord::Migration
  def self.up
    add_column :activities, :trip_id, :integer
  end

  def self.down
    remove_column :activities, :trip_id
  end
end
