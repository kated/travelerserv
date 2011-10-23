class AddHouseholdToParticipants < ActiveRecord::Migration
  def self.up
    add_column :participants, :household_id, :integer
  end

  def self.down
    remove_column :participants, :household_id
  end
end
