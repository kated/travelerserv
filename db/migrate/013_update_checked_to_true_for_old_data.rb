class UpdateCheckedToTrueForOldData < ActiveRecord::Migration
  def self.up
    update "UPDATE questionnaire_record_fields SET checked = 1"
  end

  def self.down
  end
end
