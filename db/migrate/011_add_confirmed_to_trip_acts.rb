class AddConfirmedToTripActs < ActiveRecord::Migration
  def self.up
    add_column :trips, :confirmed, :boolean
    add_column :activities, :confirmed, :boolean
  end

  def self.down
    remove_column :trips, :confirmed
    remove_column :activities, :confirmed
  end
end
