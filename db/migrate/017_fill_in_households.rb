class FillInHouseholds < ActiveRecord::Migration
  def self.up
    transaction do
      select_values("SELECT id FROM participants").each do |pid|
        hid = insert "INSERT INTO households(`comment`) VALUES('Created automatically for participant #{pid}')"
        update "UPDATE participants SET household_id = #{hid} WHERE id = #{pid}"
      end
    end
  end

  def self.down
  end
end
